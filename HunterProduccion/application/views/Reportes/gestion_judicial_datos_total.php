 <!-- Morris charts 
<script src="<?php //echo base_url();?>assets/bajadas/rafael.min.js"></script>
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
                <th>Total Liquidaciones</th>
                <th>Total procesos SAP</th>
                <th>Procesos SAP con gestión judicial</th>
                <th>Procesos SAP sin gestión judicial</th>
              </tr> 
            </thead>
            <tbody>
               <?php 

                //var_dump($datos);
                $cumplimiento = 0;
                $Nocumplen = 0;
                $totalBaseMedicion = 0;
                $totalSapConteo =0;
                for($i = 0; $i < count($datos); $i++){
                    $totalSap = $datos[$i]['cumplen']+$datos[$i]['nocumplen'];
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['Total']." </td>
                            <td>".$totalSap." </td>
                            <td>".$datos[$i]['cumplen']." </td>
                            <td>".$datos[$i]['nocumplen']." </td>
                          </tr>";

                    $totalBaseMedicion += $datos[$i]['Total'];
                    $cumplimiento += $datos[$i]['cumplen'];
                    $Nocumplen += $datos[$i]['nocumplen'];
                    $totalSapConteo += $totalSap;
                      
                }
              ?>
              <tr>
                <th>TOTALES</th>
                <td><?php echo $totalBaseMedicion; ?></td>
                <td><?php echo $totalSapConteo; ?></td>
                <td><?php echo $cumplimiento; ?></td>
                <td><?php echo $Nocumplen; ?></td>
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
                <th>Cumple</th>
                <th>No cumple</th>
              </tr> 
            </thead>
            <tbody>
              <?php 
                //var_dump($datos);
                for($i = 0; $i < count($datos); $i++){
                    $totalSap = $datos[$i]['cumplen']+$datos[$i]['nocumplen'];
                    $total = 0;
                    $total2 = 0;
                    if($totalSap > 0){
                       $total = number_format((($datos[$i]['cumplen'] * 100) / $totalSap ), 0);
                       $total2 = number_format((($datos[$i]['nocumplen'] * 100) / $totalSap ), 0);
                    }

                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$total." %</td>
                            <td>".$total2." %</td>
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
        <div class="box-body table-responsive no-padding" >
          <table class="table table-hover table-bordered" id="tablacontratos">
            <thead>
              <tr>
                <th>No. Liquidaci&oacute;n</th>
                <th>Deudor</th>
                <th>Tipo Identificación</th>
                <th>No. Identificación</th>
                
                <th>SAP</th>
                <th>IF</th>
                <th>Valor pagado</th>
                <th>Fecha asignaci&oacute;n abogado</th>
        				<th>Fecha env&iacute;o memorial subrogaci&oacute;n</th>
        				<th>Gesti&oacute;n</th>
        				<th>Fecha de informe</th>
        				<th>Fecha de gesti&oacute;n</th>
        				<th>FRG</th>
        				<th>Nombre ejecutor</th>				
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
  $data4 = '[';

  for($i = 0; $i < count($datos2); $i++){ 
      if($i == 0){
          $nombresLabels .= "'".utf8_encode($datos2[$i]['Frg'])."'";
          $data1 .= "'".$datos2[$i]['Total']."'";
          $data2 .= "'".$datos2[$i]['cumplen']."'";
          $data3 .= "'".$datos2[$i]['nocumplen']."'"; 
          $totalSap = $datos2[$i]['cumplen']+$datos2[$i]['nocumplen'];
          $data4 .= "'".$totalSap."'"; 
      }else{
          $nombresLabels .= ",'".utf8_encode($datos2[$i]['Frg'])."'";
          $data1 .= ",'".$datos2[$i]['Total']."'";
          $data2 .= ",'".$datos2[$i]['cumplen']."'";
          $data3 .= ",'".$datos2[$i]['nocumplen']."'"; 
          $totalSap = $datos2[$i]['cumplen']+$datos2[$i]['nocumplen'];
          $data4 .= ",'".$totalSap."'"; 
      }
  } 

  $label = "[".$nombresLabels."]";
  $data1 .= ']';
  $data2 .= ']';
  $data3 .= ']';
  $data4 .= ']';

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
                    label: "Total Obligaciones",
                    fillColor: "rgba(54, 162, 235)",
                    strokeColor: "rgba(210, 214, 222)",
                    pointColor: "rgba(180, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220)",
                    data: <?php echo $data1;?>
                },
                {
                    label: "Total Procesos SAP",
                    fillColor: "rgba(255, 128, 0)",
                    strokeColor: "rgba(210, 214, 222)",
                    pointColor: "rgba(180, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220)",
                    data: <?php echo $data4;?>
                },
                {
                    label: "Obligaciones Gestionadas",
                    fillColor: "rgba(51, 51, 251)",
                    strokeColor: "rgba(210, 214, 222)",
                    pointColor: "rgba(180, 214, 222)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220)",
                    data: <?php echo $data2;?>
                },
                {
                    label: "Obligaciones Sin Gestionar",
                    fillColor: "rgba(255, 255, 51)",
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
          barStrokeWidth: 1,
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
                  
                  { mData: "SAP" },
                  { mData: "ifinanciero" },
                  { mData: "valorPagado" },
                  { mData: "fecha_abogado" },
				  { mData: "fecha_memorial_subroga" },
				  { mData: "gestionado" },
				  { mData: "fecha_informe" },
				  { mData: "fecha_gestion" },
				  { mData: "frg" },
				  { mData: "nom_ejecutor" }
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
