<?php 
      
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gestion_judicial.xls");
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
                <th>Memoriales enviados</th>
                <th>Memoriales Gestionados</th>
                <th>Memoriales no Gestionados</th>
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
              </tr>
            </tbody>
          </table>    

          <table class="table table-hover table-bordered" width="50%">
            <thead>
              <tr>
                <th colspan="3" style="text-align: center;">Cumplimiento</th>
              </tr>
              <tr>
                <th>FRG</th>
                <th>Cumple con el porcentaje de cumplimiento</th>
                <th>No cumple con el porcentaje de cumplimiento</th>
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
                          </tr>";
                }
               
              ?>
             
            </tbody>
          </table>



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
              <?php for ($i=0; $i < count($gestiones_deglosado); $i++) { 
            echo "<tr>
                    <th>".$gestiones_deglosado[$i]['contrato']."</th>
                    <th>".$gestiones_deglosado[$i]['nombre']."</th>
                    <th>".$gestiones_deglosado[$i]['identificacion']."</th>
                    <th>".$gestiones_deglosado[$i]['SAP']."</th>
                    <th>".$gestiones_deglosado[$i]['ifinanciero']."</th>
                    <th>".$gestiones_deglosado[$i]['valorPagado']."</th>
                    <th>".$gestiones_deglosado[$i]['fecha_abogado']."</th>
                  </tr> ";
          }
          ?>
              
            </tbody>
          </table>    
        