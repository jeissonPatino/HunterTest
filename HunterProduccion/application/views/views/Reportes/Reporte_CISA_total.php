 <!-- Morris charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
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
                <th>Cumple</th>
                <th>No Cumple</th>
              </tr> 
            </thead>
            <tbody>
               <?php 
                $totalBaseMedicion = 0;
                for($i = 0; $i < count($datos); $i++){
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['cumplen']." </td>
                            <td>".$datos[$i]['nocumplen']." </td>
                          </tr>";

                    $totalBaseMedicion += $datos[$i]['Total'];
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
              <div class="chart" id="josecharts" style="height: 300px;"></div>
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
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['cumplen']."</td>";

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
                <th>No. Contrato / No. Liquidaci&oacute;n</th>
                <th>Deudor</th>
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
            for($i = 0; $i < count($datos); $i++){ 
                if($i == 0){
          ?> 
                  {y: '<?php echo utf8_encode($datos[$i]['Frg']);?>', a: <?php echo $datos[$i]['Total'];?>, b:<?php echo $datos[$i]['cumplen'];?>  }
          <?php }else{ ?>
                 ,{y: '<?php echo utf8_encode($datos[$i]['Frg']);?>', a: <?php echo $datos[$i]['Total'];?>, b:<?php echo $datos[$i]['cumplen'];?>}
           <?php      
                }
            } 
          ?>
        ],
        barColors: ['#5F9EA0', '#228B22'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: [ 'Total Vendidas', 'Con Soporte'],
        hideHover: false
        
      });

         //dataTables del contrato
        $("#tablacontratos").DataTable({
            "aaData": <?php echo $gestiones_deglosado; ?>,
            "aoColumns": [
              
                    { mData: "contrato" },
                  { mData: "nombre"},
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
