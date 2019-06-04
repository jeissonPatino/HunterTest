<?php
  function sanear_string($string) { 
      $string = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string );
      $string = str_replace( array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string ); 
      $string = str_replace( array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string ); 
      $string = str_replace( array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string ); 
      $string = str_replace( array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string ); 
      $string = str_replace( array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string ); 
      //Esta parte se encarga de eliminar cualquier caracter extraño 
      //$string = str_replace( array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">“, “< ", ";", ",", ":", "."), '', $string ); 
      return $string; 
  }
?>
 <!-- Morris charts
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
                <th>Memoriales enviados</th>
                <th>Memoriales en tiempo</th>
                <th>Memoriales fuera de tiempo</th>
                <th>Sin asignar en tiempo</th>
                <th>Sin asignar fuera de tiempo</th>
              </tr> 
            </thead>
            <tbody>
               <?php 
                //var_dump($datos);
                $asignadas = 0;
                $Nasignadas = 0;
                $aTiempo = 0;
                $aDesiempo = 0;
                $noasignadasEntiempo = 0;
                $noasignadasNotiempo = 0; 
                $tiempo = "+".$tiempo;
                $total = 0;
                $cumple = 0;
                $nocumple = 0;
                for($i = 0; $i < count($others); $i++){
                    
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['Total']." </td>
                            <td>".$datos[$i]['aTiempo']." </td>
                            <td>".$datos[$i]['aDesiempo']." </td>
                            <td>".$datos[$i]['noasignadasEntiempo']." </td>
                            <td>".$datos[$i]['noasignadasdetiempo']." </td>
                          </tr>";

                          $total += $datos[$i]['Total'];
                          $aTiempo += $datos[$i]['aTiempo'];
                          $aDesiempo += $datos[$i]['aDesiempo'];
                          $noasignadasEntiempo += $datos[$i]['noasignadasEntiempo'];
                          $noasignadasNotiempo += $datos[$i]['noasignadasdetiempo'];
                }
              ?>
              <tr>
                <th>TOTALES</th>
                <td><?php echo $total; ?></td>
                <td><?php echo $aTiempo; ?></td>
                <td><?php echo $aDesiempo; ?></td>
                <td><?php echo $noasignadasEntiempo; ?></td>
                <td><?php echo $noasignadasNotiempo; ?></td>
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
        <div class="col-md-4">
          <table class="table table-hover table-bordered" width="50%">
            <thead>
              <tr>
                <th colspan="3" style="text-align: center;">Cumplimiento</th>
              </tr>
              <tr>
                <th>FRG</th>
                <th>Porcentaje de Cumplimiento</th>
                <th>Meta</th>
              </tr> 
            </thead>
            <tbody>
              <?php 
                for($i = 0; $i < count($datos); $i++){
                    $total = 0;
                    if($datos[$i]['Total'] > 0){
                       $total = number_format((($datos[$i]['aTiempo'] * 100) / $datos[$i]['Total'] ), 2);
                    }

                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$total." %</td>
                            <td>".$meta." %</td>
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
    <div class="box-body table-responsive">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-hover table-bordered" id="tablacontratos">
            <thead>
              <tr>
                <th>No. Liquidación</th>
                <th>Deudor</th>
                <th>Tipo Identificación</th>
                <th>No. Identificación</th>
                <th>IF</th>
                <th>Valor Pagado</th>
                <th>Fecha Env&iacute;o Memorial</th>
                <th>Fecha Asignación Abogado</th>
                <th>Fecha Env&iacute;o Corregido</th>
                <th>Días Transcurridos</th>
                <th>Calificación</th>
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
  $data5 = '[';

  for($i = 0; $i < count($other); $i++){ 
      if($i == 0){
          $nombresLabels .= "'".utf8_encode($other[$i]['Frg'])."'";
          $data1 .= "'".$other[$i]['Total']."'";
          $data2 .= "'".$other[$i]['aTiempo']."'";
          $data3 .= "'".$other[$i]['aDesiempo']."'"; 
          $data4 .= "'".$other[$i]['noasignadasEntiempo']."'"; 
          $data5 .= "'".$other[$i]['noasignadasdetiempo']."'"; 
      }else{
          $nombresLabels .= ",'".utf8_encode($other[$i]['Frg'])."'";
          $data1 .= ",'".$other[$i]['Total']."'";
          $data2 .= ",'".$other[$i]['aTiempo']."'";
          $data3 .= ",'".$other[$i]['aDesiempo']."'"; 
          $data4 .= ",'".$other[$i]['noasignadasEntiempo']."'"; 
          $data5 .= ",'".$other[$i]['noasignadasdetiempo']."'"; 
      }
  } 

  $label = "[".$nombresLabels."]";
  $data1 .= ']';
  $data2 .= ']';
  $data3 .= ']';
  $data4 .= ']';
  $data5 .= ']';
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
                    label: "Memoriales enviados",
                    fillColor: "#0080FF",
                    strokeColor: "#0080FF",
                    pointColor: "#0080FF",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data1;?>
                },
                {
                    label: "Memoriales en tiempo",
                    fillColor: "#B43104",
                    strokeColor: "#B43104",
                    pointColor: "#B43104",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data2;?>
                },
                {
                    label: "Memoriales fuera de tiempo",
                    fillColor: "#31B404",
                    strokeColor: "#31B404",
                    pointColor: "#31B404",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data3;?>
                },
                {
                    label: "Sin asignar en tiempo",
                    fillColor: "#B404AE",
                    strokeColor: "#B404AE",
                    pointColor: "#B404AE",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data4;?>
                },
                {
                    label: "Sin asignar fuera de tiempo",
                    fillColor: "#B404AE",
                    strokeColor: "#B404AE",
                    pointColor: "#B404AE",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: <?php echo $data5;?>
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
     /* var bar = new Morris.Bar({
        element: 'josecharts',
        resize: true,
        data: [
        <?php 
           /* for($i = 0; $i < count($other); $i++){ 
                if($i == 0){
          ?> 
                  {y: '<?php echo utf8_encode($other[$i]['Frg']);?>', a: <?php echo $other[$i]['aTiempo'];?>, b: <?php echo $other[$i]['aDesiempo'];?>, c: <?php echo $other[$i]['noasignadasEntiempo'];?>,  e:<?php echo $other[$i]['Total'];?> }
          <?php }else{ ?>
                  ,{y: '<?php echo utf8_encode($other[$i]['Frg']);?>', a: <?php echo $other[$i]['aTiempo'];?>, b: <?php echo $other[$i]['aDesiempo'];?>,c: <?php echo $other[$i]['noasignadasEntiempo'];?> ,  e:<?php echo $other[$i]['Total'];?> }
           <?php      
                }
            } */
          ?>
        ],
        barColors: ['#0080FF', '#B43104', '#31B404', '#B404AE'],
        xkey: 'y',
        ykeys: ['e', 'a', 'b', 'c'],
        labels: ['Memoriales enviados','Memoriales en tiempo', 'Memoriales fuera de tiempo', 'Sin asignar en tiempo'],
        hideHover: true
        
      });*/

         //dataTables del contrato
        $("#tablacontratos").DataTable({
            "aaData": <?php echo $Contratos; ?>,
            "aoColumns": [
              
              { mData: "contrato" },
              { mData: "nombre"},
              { mData: "tipo_identificacion"},
              { mData: "identificacion"},
              { mData: "ifinanciero" },
              { mData: "valorPagado" },
              { mData: "Fasignacion"},
              { mData: "Fenvio" },
              { mData: "Fcorreccion" },
              {mData : "tiempoTrans"},
              { mData: "Tiempos" }

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
