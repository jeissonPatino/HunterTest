
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
                  <th>Base de medición</th>
                  <th>Radicados en Tiempo</th>
                  <th>No Radicados en Tiempo</th>
                  <th>Radicados Fuera de Tiempo</th>
                  <th>Sin Radicar Fuera de Tiempo</th>
                  <th>Meta</th>
                  <th>Días que Deben Transcurrir</th>
  	    		   </tr>
            </thead>
            <tbody>
               <?php 
                //var_dump($datos);
                $cumplimiento = 0;
                $Nocumplen = 0;
                $totalBaseMedicion = 0;
                for($i = 0; $i < count($datos); $i++){
                    
                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$datos[$i]['Total']." </td>
                            <td>".$datos[$i]['cumplen']." </td>
                            <td>".$datos[$i]['nocumplen']." </td>
                            <td>".$datos[$i]['radicadosfueradetiempo']." </td>
                            <td>".$datos[$i]['sinasignarsintiempo']." </td>
                            
                            <td>".number_format(($datos[$i]['Total'] *($meta / 100 )), 0)." </td>
                            <td>".$tiempo." </td>
                          </tr>";

                    $totalBaseMedicion += $datos[$i]['Total'];
                    $cumplimiento += $datos[$i]['cumplen'];
                    $Nocumplen += $datos[$i]['nocumplen'];
                      
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
                <td><?php echo $totalBaseMedicion; ?></td>
                <td><?php echo $cumplimiento; ?></td>
                <td><?php echo $Nocumplen; ?></td>
                <td></td>
                <td></td>
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
              <?php 
                //var_dump($datos);
                for($i = 0; $i < count($datos); $i++){
                    $total = 0;
                    $total2 = 0;
                    if($datos[$i]['Total'] > 0){
                       $total = number_format((($datos[$i]['cumplen'] * 100) / $datos[$i]['Total'] ), 0);
                       $total2 = number_format((($datos[$i]['nocumplen'] * 100) / $datos[$i]['Total'] ), 0);
                    }

                    echo " <tr>
                            <td>".utf8_encode($datos[$i]['Frg'])."</td>
                            <td>".$total." %</td>
                            <td>".$total2." %</td>
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
            for($i = 0; $i < count($datos2); $i++){ 
                if($i == 0){
          ?> 
                  {y: '<?php echo utf8_encode($datos2[$i]['Frg']);?>', a: <?php echo $datos2[$i]['cumplen'];?>, b: <?php echo $datos2[$i]['nocumplen'];?>, c: <?php echo $datos2[$i]['Total'];?>, d: <?php echo number_format(($datos[$i]['Total'] *($meta / 100 )), 0);?>, e: <?php echo $datos2[$i]['radicadosfueradetiempo'];?>, f: <?php echo $datos2[$i]['sinasignarsintiempo'];?>}
          <?php }else{ ?>
                 ,{y: '<?php echo utf8_encode($datos2[$i]['Frg']);?>', a: <?php echo $datos2[$i]['cumplen'];?>, b: <?php echo $datos2[$i]['nocumplen'];?>, c: <?php echo $datos2[$i]['Total'];?>, d: <?php echo number_format(($datos[$i]['Total'] *($meta / 100 )), 0);?>, e: <?php echo $datos2[$i]['radicadosfueradetiempo'];?>, f: <?php echo $datos2[$i]['sinasignarsintiempo'];?>}
           <?php      
                }
            } 
          ?>
        ],
        barColors: ['#FFFF00','#31B404','#B43104', '#00BFFF', '#FFFF00','#31B404' ],
        xkey: 'y',
        ykeys: ['c','a', 'b', 'e', 'f', 'd'],
        labels: ['Base de medición', 'Radicados en tiempo', 'No Radicados en tiempo', 'Radicados Fuera de tiempo','Sin Radicar Fuera de tiempo', 'Meta'],
        hideHover: false
        
      });

         //dataTables del contrato
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


	

