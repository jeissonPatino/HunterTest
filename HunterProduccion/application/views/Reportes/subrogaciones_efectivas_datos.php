<?php 
	/*$datetime1 = new DateTime('2009-10-11');
	$datetime2 = new DateTime('2009-10-13');
	$interval = $datetime1->diff($datetime2);
	echo $interval->format('%R%a');*/

	$datos = array();



	/*foreach ($gestiones as $key) {
		$total++;
	}*/

	/*echo "ASIGNADAS : ".$asignadas."<br>";
	echo "NO ASIGNADAS : ".$Nasignadas."<br>";*/
	/*echo "ASIGNADAS A TIEMPO : ".$aTiempo."<br>";
	echo "ASIGNADAS A DESTIEMPO : ".$aDesiempo."<br>";
	echo "NO ASIGNADAS EN TIEMPO: ".$noasignadasEntiempo."<br>";
	echo "ASIGNADAS A DESTIEMPO: ".$noasignadasNotiempo."<br>"; 
	echo "TOTAL : ".$total."<br>"; 
	echo "Meta => ".$meta."<br>"; +
	ECHO "Total => ".number_format((($aTiempo * 100) / $total ), 2)."%";*/

$totalNoCumple = number_format(($totalBase *($meta / 100 )), 0) - $total;
if ($totalNoCumple < 0){
  $totalNoCumple = 0;
} 
	$label = "['Base Medición', 'Número de obligaciones a subrogar', 'Cumple', 'No Cumple']";
	$data1 = "['".$totalBase."', '".number_format(($totalBase *($meta / 100 )), 0)."', '".$total."' ,'".$totalNoCumple."']";

?>

<!-- aqui se muestra el resultado en las barras -->
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
			    			<th>Subrogaciones</th>
		
			    		</tr>	
		    		</thead>
		    		<tbody>
		    			<tr>
		    				<td><?php echo utf8_encode($frg); ?></td>
			    			<td><?php echo $totalBase; ?></td>
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
    		<div class="col-md-6">
    			<table class="table table-hover table-bordered" width="50%">
		    		<thead>
		    			<tr>
			    			<th colspan="4" style="text-align: center;">Cumplimiento</th>
			    		</tr>
		    			<tr>
			    			<th>FRG</th>
			    			<th>Cumplimiento</th>
			    			<th>Meta</th>
                <th>Porcentaje avance cumplimiento</th>
			    		</tr>	
		    		</thead>
		    		<tbody>

		    			<tr>
			    			<td><?php echo $frg; ?></td>
			    			<td><?php echo $total; ?></td>
			    			<td><?php echo $meta; ?> %</td>
			    			<td><?php 
                 if($totalBase == 0) echo 0;
                else echo number_format(($total * 100 / (number_format(($totalBase *($meta / 100 )), 0)) ), 0); 
                ?>%</td>
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
                <th>Tipo Identificación</th>
                <th>Identificación</th>
                <th>IF</th>
                <th>Valor pagado</th>
                <th>Factura subrogación</th>
                <th>Fecha Factura</th>
                <th>Fecha Autosubrogacion</th>
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
    
		        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.

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


         //dataTables del contrato
        $("#tablacontratos").DataTable({
            "aaData": <?php echo $gestiones_deglosado; ?>,
            "aoColumns": [
              
              { mData: "contrato" },
              { mData: "nombre"},
              { mData: "tipo_identificacion"},
              { mData: "identificacion"},
              { mData: "ifinanciero" },
              { mData: "valorPagado" },
              { mData: "Sub_factura_subrogacion"},
              { mData: "Sub_fecha_factura" },
              { mData: "Sub_fecha_auto" }
              
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
            "buttons":[{
                            text: 'Exportar Excel',
                            extend: 'excel'
                          }],
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