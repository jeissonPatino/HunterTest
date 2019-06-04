<?php 
    $ci = &get_instance();
    $ci->load->Model('Reportes_model');
   
    /*$cumplimiento = 0;
    $Nocumplen = 0;
    $totalBaseMedicion = 0;


    /foreach ($getionBase as $key) {
        $totalBaseMedicion +=1;
        $gestion = $ci->Reportes_model->tieneGestionJudicial($key->G719_ConsInte__b, $fechaInicial, $fechaFinal);
        if($gestion >= 1){
            $cumplimiento++;
        }else{
            $Nocumplen++;
        }
    }*/

    
    $label = "['Base de obligaciones a medir', 'Obligaciones con gestión judicial', 'Obligaciones sin gestión judicial']";
    $data1 = "['".$basemedicion."', '".$cumplimiento."', '".$incumpliemiento."']";
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
			    			<th>Base de obligaciones a medir</th>
			    			<th>Obligaciones con gestión judicial</th>
			    			<th>Obligaciones sin gestión judicial</th>
			    		</tr>	
		    		</thead>
		    		<tbody>
                        <tr>
                            <th><?php echo $frg;?></th>
                            <td><?php echo $basemedicion;?></td>
                            <td><?php echo $cumplimiento;?></td>
                            <td><?php echo $incumpliemiento;?></td>
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
			    			<th colspan="3" style="text-align: center;">Cumplimiento</th>
			    		</tr>
		    			<tr>
			    			<th>FRG</th>
			    			<th>Cumple</th>
			    			<th>No cumple</th>
			    		</tr>	
		    		</thead>
		    		<tbody>
		    			<tr>
	    			    <th><?php echo $frg;?></th>
			    			<td><?php if($basemedicion > 0) { echo number_format(($cumplimiento/$basemedicion) * 100, 0); }else{ echo '0';} ?> %</td>
			    			<td><?php if($basemedicion > 0) { echo number_format(($incumpliemiento/$basemedicion) * 100, 0) ;}else{ echo '0';}?> %</td>
                            
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
                <th>Identificaci&oacute;n</th>
                 <th>SAP</th>
                <th>IF</th>
                <th>Valor Pagado</th>
                <th>Fecha asignaci&oacute;n abogado</th>
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
                "aaData": <?php echo $todaBase; ?>,
                "aoColumns": [
                  
                  { mData: "contrato" },
                  { mData: "nombre"},
                  { mData: "identificacion"},
                  { mData: "SAP" },
                  { mData: "ifinanciero" },
                  { mData: "valorPagado" },
                  { mData: "fecha_abogado" }

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