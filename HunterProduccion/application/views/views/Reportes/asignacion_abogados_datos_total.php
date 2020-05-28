 <!-- Morris charts -->
<script src="<?php echo base_url();?>assets/bajadas/rafael.js"></script>
<script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script>

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
               /* foreach ($datos as $key) {
                    $total = 0;
                    if($key->Total > 0){
                       $total = number_format((($key->aTiempo * 100) / $key->Total ), 2);
                    }
                    echo " <tr>
                            <td>".$key->Frg."</td>
                            <td>".$total." %</td>
                            <td>".$meta." %</td>
                            
                          </tr>";
                }*/
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
              <div class="chart" id="josecharts" style="height: 300px;"></div>
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
                //var_dump($datos);
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
               /* foreach ($datos as $key) {
                    $total = 0;
                    if($key->Total > 0){
                       $total = number_format((($key->aTiempo * 100) / $key->Total ), 2);
                    }
                    echo " <tr>
                            <td>".$key->Frg."</td>
                            <td>".$total." %</td>
                            <td>".$meta." %</td>
                            
                          </tr>";
                }*/
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
                <th>No. Liquidación</th>
                <th>Deudor</th>
                <th>Identificación</th>
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

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
 <!-- Morris.js charts -->

<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script type="text/javascript">

  $(function(){

      "use strict";
        
      var bar = new Morris.Bar({
        element: 'josecharts',
        resize: true,
        data: [
        <?php 
            for($i = 0; $i < count($other); $i++){ 
                if($i == 0){
          ?> 
                  {y: '<?php echo utf8_encode($other[$i]['Frg']);?>', a: <?php echo $other[$i]['aTiempo'];?>, b: <?php echo $other[$i]['aDesiempo'];?>, c: <?php echo $other[$i]['noasignadasEntiempo'];?>,  e:<?php echo $other[$i]['Total'];?> }
          <?php }else{ ?>
                  ,{y: '<?php echo utf8_encode($other[$i]['Frg']);?>', a: <?php echo $other[$i]['aTiempo'];?>, b: <?php echo $other[$i]['aDesiempo'];?>,c: <?php echo $other[$i]['noasignadasEntiempo'];?> ,  e:<?php echo $other[$i]['Total'];?> }
           <?php      
                }
            } 
          ?>
        ],
        barColors: ['#0080FF', '#B43104', '#31B404', '#B404AE'],
        xkey: 'y',
        ykeys: ['e', 'a', 'b', 'c'],
        labels: ['Memoriales enviados','Memoriales en tiempo', 'Memoriales fuera de tiempo', 'Sin asignar en tiempo'],
        hideHover: true
        
      });

         //dataTables del contrato
        $("#tablacontratos").DataTable({
            "aaData": <?php echo $Contratos; ?>,
            "aoColumns": [
              
              { mData: "contrato" },
              { mData: "nombre"},
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
