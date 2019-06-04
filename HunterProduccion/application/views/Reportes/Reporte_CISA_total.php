 <!-- Morris charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php// echo base_url();?>assets/bajadas/rafael.js"></script>
<script src="<?php// echo base_url();?>assets/plugins/morris/morris.min.js"></script>-->

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
                            <th colspan="4" style="text-align:center;">Datos de la venta elegida</th>
                
              </tr>
              <tr>
                <th>Número de Venta</th>
                <th>Fecha de Venta</th>
                <th>Fecha de Notificación</th>
                <th>Fecha de Vencimiento de Entrega de los Soportes</th>
              </tr> 
            </thead>
            <tbody>
                        <tr>
                            <th><?php echo $Ven_nombre;?></th>
                            <th><?php echo $fechaVEnta;?></th>
                            <td><?php echo $fechaInicial;?></td>
                            <td><?php echo $fechaFinal;?></td>
                        </tr>           
                    </tbody>
          </table>
          <table class="table table-hover table-bordered" width="50%">
            <thead>
              <tr>
                  <th colspan="4" style="text-align:center;">Datos del FRG</th>
                
              </tr>
              <tr>
                <th>FRG</th>
                <th>Cumple</th>
                <th>No Cumple</th>
              </tr> 
            </thead>
            <tbody>
               <?php 
                $totalNoCumplen = 0;
                $totalCumplen = 0;
                for($i = 0; $i < count($datos); $i++){
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['cumplen']." </td>
                            <td>".$datos[$i]['nocumplen']." </td>
                          </tr>";

                    $totalCumplen += $datos[$i]['cumplen'];
                    $totalNoCumplen += $datos[$i]['nocumplen'];
                }
               
              ?>
              <tr>
                <th>TOTALES</th>
                <td><?php echo $totalCumplen; ?></td>
                <td><?php echo $totalNoCumplen; ?></td>
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
                <th>Porcentaje de cumplimiento</th>
                <th>Porcentaje de Incumplimiento</th>
              </tr> 
            </thead>
            <tbody>
              <?php 
                //var_dump($datos);
                $total  = 0;
                for($i = 0; $i < count($datos); $i++){
                    $total = $datos[$i]['Total'];
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>";

                        if($total > 0) {
                            echo "<td>".number_format(($datos[$i]['cumplen']/$total) * 100, 0)."%</td>";
                            echo "<td>".number_format(($datos[$i]['nocumplen']/$total) * 100, 0)."%</td>";
                        }else{
                            echo "<td>0</td>";
                            echo "<td>0</td>";
                        }

                          
                            
                          echo "</tr>";
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
                <th>Tipo Identificación</th>
                <th>Identificación</th>
                
                <th>SAP</th>
                <th>IF</th>
                <th>Fecha Entrega Soporte</th>
                <th>Fecha Aprobación Soporte</th>
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
<?php
  $nombresLabels = '';
  $datasets = '';
  $data1 = '[';
  $data2 = '['; 
  $data3 = '['; 

  for($i = 0; $i < count($datos); $i++){ 
      if($i == 0){
          $nombresLabels .= "'".utf8_encode($datos[$i]['Frg'])."'";
          $data1 .= "'".$datos[$i]['Total']."'";
          $data2 .= "'".$datos[$i]['cumplen']."'";
          $data3 .= "'".$datos[$i]['nocumplen']."'";

      }else{
          $nombresLabels .= ",'".utf8_encode($datos[$i]['Frg'])."'";
          $data1 .= ",'".$datos[$i]['Total']."'";
          $data2 .= ",'".$datos[$i]['cumplen']."'";
          $data3 .= ",'".$datos[$i]['nocumplen']."'";

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
                    label: "Total Vendidas",
                    fillColor: "rgba(54, 162, 235)",
                    strokeColor: "rgba(210, 214, 222)",
                    pointColor: "rgba(180, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220)",
                    data: <?php echo $data1;?>
                },
                {
                    label: "Con Soporte",
                    fillColor: "rgba(255, 128, 0)",
                    strokeColor: "rgba(210, 214, 222)",
                    pointColor: "rgba(180, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220)",
                    data: <?php echo $data2;?>
                },
                {
                    label: "No Cumplen",
                    fillColor: "rgba(153, 255, 51)",
                    strokeColor: "rgba(210, 214, 222)",
                    pointColor: "rgba(180, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220)",
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
          /*  for($i = 0; $i < count($datos); $i++){ 
                if($i == 0){
          ?> 
                  {y: '<?php echo utf8_encode($datos[$i]['Frg']);?>', a: <?php echo $datos[$i]['Total'];?>, b:<?php echo $datos[$i]['cumplen'];?>  }
          <?php }else{ ?>
                 ,{y: '<?php echo utf8_encode($datos[$i]['Frg']);?>', a: <?php echo $datos[$i]['Total'];?>, b:<?php echo $datos[$i]['cumplen'];?>}
           <?php      
                }
            } */
          ?>
        ],
        barColors: ['#5F9EA0', '#228B22'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: [ 'Total Vendidas', 'Con Soporte'],
        hideHover: false
        
      });*/

         //dataTables del contrato
        $("#tablacontratos").DataTable({
            "aaData": <?php echo $gestiones_deglosado; ?>,
            "aoColumns": [
              
                    { mData: "contrato" },
                  { mData: "nombre"},
                  { mData: "tipo_identificacion"},
                  { mData: "identificacion"},
                  
                  { mData: "SAP" },
                  { mData: "ifinanciero" },
                  { mData: "fecha_soprte" },
                  { mData: "fecha_soprte_ap" },
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
