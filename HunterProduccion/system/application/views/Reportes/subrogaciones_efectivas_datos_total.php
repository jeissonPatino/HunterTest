 <!-- Morris charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php //echo base_url();?>assets/bajadas/rafael.js"></script>
<script src="<?php //echo base_url();?>assets/plugins/morris/morris.min.js"></script>-->

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
               <?php 
                $totalBaseMedicion = 0;
                for($i = 0; $i < count($datos); $i++){
                    
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['total']." </td>
                          </tr>";

                    $totalBaseMedicion += $datos[$i]['total'];
                }
               
              ?>
              <tr>
                <th>TOTALES</th>
                <td><?php echo $totalBaseMedicion; ?></td>
              </tr>
            </tbody>
          </table>    
        </div>
      </div>
      
      <br>
      <br>
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <canvas id="josecharts" style="height:230px"></canvas>   
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        <br>
         <br>
        <div class="row">
        <div class="col-md-6">
          <table class="table table-hover table-bordered" width="50%">
            <thead>
              <tr>
                <th colspan="3" style="text-align: center;">Cumplimiento</th>
              </tr>
              <tr>
                <th>FRG</th>
                <th>Cumplimiento</th>
                <th>Meta</th>
                <th>Porcentaje avance cumplimiento</th>
              </tr> 
            </thead>
            <tbody>
              <?php 
                //var_dump($datos);
                $totales  = 0;
                for($i = 0; $i < count($datos); $i++){
                    $totales = $datos[$i]['total'];
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$totales."</td>
                            <td>".$meta." %</td>
                            <td>".number_format(($totales *($meta / 100 )), 0)."%</td>
                          </tr>";
                }
               
              ?>
             
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
<?php
  $nombresLabels = '';
  $datasets = '';
  $data1 = '[';
  $data2 = '[';
  $data3 = '[';

  for($i = 0; $i < count($datos); $i++){ 
      if($i == 0){
          $nombresLabels .= "'".utf8_encode($datos[$i]['Frg'])."'";
          $data1 .= "'".$datos[$i]['totalBase']."'";
          $data2 .= "'".$datos[$i]['total']."'";
          $data3 .= "'".number_format(($datos[$i]['totalBase'] *($meta / 100 )), 0)."'"; 
      }else{
          $nombresLabels .= ",'".utf8_encode($datos[$i]['Frg'])."'";
          $data1 .= ",'".$datos[$i]['totalBase']."'";
          $data2 .= ",'".$datos[$i]['total']."'";
          $data3 .= ",'".number_format(($datos[$i]['totalBase'] *($meta / 100 )), 0)."'"; 
      }
  } 

  $label = "[".$nombresLabels."]";
  $data1 .= ']';
  $data2 .= ']';
  $data3 .= ']';

?>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">

  $(function(){

      "use strict";
        
      var areaChartData = {
            labels: <?php echo $label;?>,
            datasets: [
                {
                    label: "Base de Medición",
                    fillColor: "#5F9EA0",
                    strokeColor: "#5F9EA0",
                    pointColor: "#5F9EA0",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data1;?>
                },
                {
                    label: "Total Subrogaciones",
                    fillColor: "#FFF000",
                    strokeColor: "#FFF000",
                    pointColor: "#FFF000",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data2;?>
                },
                {
                    label: "Meta",
                    fillColor: "#ADFF2F",
                    strokeColor: "#ADFF2F",
                    pointColor: "#ADFF2F",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data3;?>
                }
            ]
        };


        var barChartCanvas = $("#josecharts").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        /*barChartData.datasets[0].fillColor = "#FFFF00";
        barChartData.datasets[0].strokeColor = "#31B404";
        barChartData.datasets[0].pointColor = "#B43104";*/

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
      /*var bar = new Morris.Bar({
        element: 'josecharts',
        resize: true,
        data: [
        <?php 
           /* for($i = 0; $i < count($datos); $i++){ 
                if($i == 0){
          ?> 
                  {y: '<?php echo utf8_encode($datos[$i]['Frg']);?>', a: <?php echo $datos[$i]['total'];?>, b: <?php echo $datos[$i]['totalBase'];?>, c: <?php echo number_format(($datos[$i]['totalBase'] *($meta / 100 )), 0); ?> }
          <?php }else{ ?>
                 ,{y: '<?php echo utf8_encode($datos[$i]['Frg']);?>', a: <?php echo $datos[$i]['total'];?>, b: <?php echo $datos[$i]['totalBase'];?>, c: <?php echo number_format(($datos[$i]['totalBase'] *($meta / 100 )), 0); ?>}
           <?php      
                }
            } */
          ?>
        ],
        barColors: ['#5F9EA0', '#FFF000', '#ADFF2F'],
        xkey: 'y',
        ykeys: ['b','a', 'c'],
        labels: ['Base de medición', 'Total Subrogaciones', 'Meta'],
        hideHover: false
        
      });*/

         //dataTables del contrato
        $("#tablacontratos").DataTable({
            "aaData": <?php echo $gestiones_deglosado; ?>,
            "aoColumns": [
              
                { mData: "contrato" },
                { mData: "nombre"},
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
