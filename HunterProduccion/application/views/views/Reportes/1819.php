<?php 
    
   function hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo, $valorFinal){

        $ci = &get_instance();
        $ci->load->Model('Reportes_model');

        $consulta = '';
        $from = '';
        $join = '';
        $cosojoin = '';
        $where = '';
        $group = '';
        $label = '';


        switch ($tipo) {
            case "6":
                $consulta =  "DISTINCT Id as valor1, Nombre_b as valor2";
                $from  = "G".$aplicacion;
                $join  = "ParametroGeneral";
                $cosojoin = "G".$aplicacion."_C".$analisis." = Id";
                break;

            case "11":
                $resultObjectCampo =$ci->Reportes_Model->findCampoAsociado($agrupadoPor2);
                $resultObject = $ci->Reportes_Model->findTipoCampoGuionAsociado2($agrupadoPor2);
                $campoAsociado = ($resultObjectCampo != null) ? $resultObjectCampo : null;
                $guionAsociado = ($resultObject != null) ? $resultObject : null;
                $consulta =  "DISTINCT G".$aplicacion."_C".$agrupadoPor2." as valor1, G".$guionAsociado."_C".$campoAsociado." as valor2";
                $from = "G".$aplicacion;
                $join  = "G".$guionAsociado;
                $cosojoin = " G".$aplicacion."_C".$agrupadoPor2." = G".$guionAsociado."_ConsInte__b";
           
                break;
            case "otro":
                //PEndiente terminar armar consultas
                break;
        }
        //echo "SELECT $consulta FROM $from JOIN $join ON  $cosojoin  $where $group";
        $jose = $ci->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);

        foreach ($jose as $key) {
           if($valorFinal == $key->valor1){
              $label = $key->valor2;
           }
        }
        return utf8_encode($label);
    }

?>

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo utf8_encode($nombreGrafica);?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="chart">
          <?php 
              
          
              $label = '[';
              $data2 = '[';
              $i = 0;

              foreach ($consulta as $key) {
                  if($i == 0){
                      
                      $data2 .= '"'.$key->$labelSeries1.'"';
                      $label .= '"'.hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo2,  $key->MAs).'"';
                  }else{
                     
                      $data2 .= ',"'.$key->$labelSeries1.'"';
                      $label .= ',"'.hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo2,  $key->MAs).'"';
                  }   

                  $i++;             
              }

              $label .= ']';
              $data2 .= ']';

              
           ?>
          <canvas id="barChart" style="height:330px"></canvas>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">

  $(function () {
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
              label: "<?php echo $labelSeries2;?>",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: <?php echo $data2;?>
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

      

        //-------------
        //- LINE CHART -
        //--------------
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

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        
  });
  
</script>