<?php
	//echo "<MARQUEE WIDTH=50% HEIGHT=60> Resultados </MARQUEE>";

	$ci = &get_instance();
    $ci->load->Model('Reportes_model');

    $cumplimiento = 0;
    $Fallos = 0;
    $totalObligaciones = 0;
    $radicadosFueradetiempo = 0;
    $sinradicarFueradeTiempo = 0;
	foreach ($Subrogaciones_envio as $key) {
		
		$totalObligaciones++;
		$fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
    	$nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );

    	$radicado = $ci->Reportes_model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

  	/*if($radicado == 1){
			 $cumplimiento++;
  	}else{
    		$radicadoSt = $ci->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
        if($radicadoSt == 1){
            $radicadosFueradetiempo++;
        }else{
            $radicadoStN = $ci->Reportes_Model->NotieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin); 
            echo $radicadoStN."</br>";
            if($radicadoStN == 0){

                $sinradicarFueradeTiempo++;
            }else{
                $Fallos++;
            }
        }
    }*/

    if($radicado == 1){
        $cumplimiento++;
    }else{
        date_default_timezone_set('America/Bogota');
        $fechaIngreso =  date("Y-m-d H:i:s");

        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
        $datetime2 = new DateTime($fechaIngreso);
        $interval = $datetime1->diff($datetime2);

        if($tiempo > $interval->format('%R%a') ){
            $Fallos++;
        }else{
            $radicadoSt = $ci->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
            if($radicadoSt == 1){
                $radicadosFueradetiempo++;
            }else{
                $sinradicarFueradeTiempo++;
            }
            
        }
    } 
	}


	foreach ($Subrogaciones_envio_corregidos as $key) {
		
		$totalObligaciones++;
		$fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
    	$nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
		$radicado = $ci->Reportes_model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin);

    	if($radicado == 1){
          $cumplimiento++;
      }else{
          date_default_timezone_set('America/Bogota');
          $fechaIngreso =  date("Y-m-d H:i:s");

          $datetime1 = new DateTime($key->Fecha_envio_Memorial);
          $datetime2 = new DateTime($fechaIngreso);
          $interval = $datetime1->diff($datetime2);

          if($tiempo > $interval->format('%R%a') ){
              $Fallos++;
          }else{
              $radicadoSt = $ci->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
              if($radicadoSt == 1){
                  $radicadosFueradetiempo++;
              }else{
                  $sinradicarFueradeTiempo++;
              }
              
          }
      }
	}

	$label = "['Base de medición', 'Meta', 'Radicados en tiempo', 'No Radicados en tiempo', 'Radicados Fuera de tiempo','Sin Radicar Fuera de tiempo']";
    $data1 = "['".$totalObligaciones."' ,'".number_format(($totalObligaciones *($meta / 100 )), 0)."', '".$cumplimiento."', '".$Fallos."', '".$radicadosFueradetiempo."', '".$sinradicarFueradeTiempo."']";

?>


<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
          
        </div>
    </div>
    <div class="box-body">
    	<div class="row">
    		<div class="col-md-12">
    			<table class="table table-hover table-bordered" width="50%">
		    		<thead>
		    			<tr>
		    				<th>FRG</th>
			    			<th>Base de medición</th>
                <th>Meta</th>
			    			<th>Radicados en Tiempo</th>
			    			<th>No Radicados en Tiempo</th>
                <th>Radicados Fuera de Tiempo</th>
                <th>Sin Radicar Fuera de Tiempo</th>
			    			
			    			<th>Días que Deben Transcurrir</th>
			    		</tr>	
		    		</thead>
		    		<tbody>
                <tr>
                    <th><?php echo $frg;?></th>
                    <td><?php echo $totalObligaciones;?></td>
                    <td><?php echo number_format(($totalObligaciones *($meta / 100 )), 0);?></td>
                    <td><?php echo $cumplimiento;?></td>
                    <td><?php echo $Fallos;?></td>
                    <td><?php echo $radicadosFueradetiempo;?></td>
                    <td><?php echo $sinradicarFueradeTiempo;?></td>
                    
                    <td><?php echo $tiempo ;?></td>
                </tr>		    		
            </tbody>
		    	</table>		
    		</div>
    	</div>
    	
    	<br>
    	<br>
        <div class="chart">
          <canvas id="barChart" style="height:230px"></canvas>
        </div>
        <br>
    	   <br>
        <div class="row">
    		<div class="col-md-9">
    			<table class="table table-hover table-bordered" width="50%">
		    		<thead>
		    			<tr>
			    			<th colspan="4" style="text-align: center;">Cumplimiento</th>
			    		</tr>
		    			<tr>
			    			<th>FRG</th>
			    			<th>Cumple con el porcentaje de cumplimiento</th>
			    			<th>No cumple con el porcentaje de cumplimiento</th>
			    			<th>Meta</th>
			    		</tr>	
		    		</thead>
		    		<tbody>
		    			<tr>
	    			    <th><?php echo $frg;?></th>
			    			<td><?php if($totalObligaciones > 0) { echo number_format(($cumplimiento/$totalObligaciones) * 100, 0); }else{ echo '0';} ?> %</td>
			    			<td><?php if($totalObligaciones > 0) { echo number_format(($Fallos/$totalObligaciones) * 100, 0) ;}else{ echo '0';}?> %</td>
			    			<td><?php echo $meta; ?> %</td>
                            
			    		</tr>
		    		</tbody>
		    	</table>
    		</div>
    	</div>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
        
        </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-hover table-bordered" id="tablacontratos">
            <thead>
              <tr>
                <th>No. Liquidaci&oacute;n</th>
                <th>Deudor</th>
                <th>Identificación</th>
                <th>SAP</th>
                <th>IF</th>
                <th>Fecha Envio Memorial </th>
                <th>Fecha Envio Memorial Corregido</th>
                <th>Fecha Radicación del Memorial</th>
                <th>Cumple</th>
              </tr> 
            </thead>
            <tbody>
              
              
            </tbody>
          </table>    
        </div>
      </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">
    $(function(){


        var areaChartData = {
          labels: <?php echo $label;?>,
          datasets: [
            {
              label: "Puebas",
              fillColor: "rgba(180, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(180, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: <?php echo $data1;?>
            }
          ]
        };


        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[0].fillColor = "#00a65a";
        barChartData.datasets[0].strokeColor = "#00a65a";
        barChartData.datasets[0].pointColor = "#00a65a";

        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);


        $("#tablacontratos").DataTable({
                "aaData": <?php echo $contratos; ?>,
                "aoColumns": [
                  
                  { mData: "contrato" },
                  { mData: "nombre"},
                  { mData: "identificacion"},
                  { mData: "SAP"},
                  { mData: "ifinanciero" },
          
                  { mData: "envioMemorial" },
                  { mData: "envioMemorialC" },
                  { mData: "radicacion" },
                  { mData: "cumple" }

                ],
                "oLanguage": {
                          "sLengthMenu": "_MENU_ registros por página",
                          "sZeroRecords": "0 resultados en el criterio de busqueda",
                          "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                          "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
                          "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
                          "sSearch": "Buscar:",
                          "oPaginate": {
                        "sNext": ">>",
                        "sPrevious": "<<"
                      }
                },
                "processing": true,
                "bJQueryUI": true,
                "bProcessing": true,
                "bSort": true,
                "bSortClasses": false,
                "bDeferRender": true,
                "sPaginationType": "simple",
                 "iDisplayLength": 20,
                 "aaSorting":[[1,"asc"]],
                 "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
              });
    });
</script>