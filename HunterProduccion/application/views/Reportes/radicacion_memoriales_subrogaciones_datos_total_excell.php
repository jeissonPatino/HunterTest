<?php
  
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte_radicacion_memoriales.xls");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <table class="table table-hover table-bordered" width="50%">
            <thead>
               <tr>
                  <th>FRG</th>
                  <th>Base de medici&oacute;n</th>
                  <th>Radicados en Tiempo</th>
                  <th>No Radicados en Tiempo</th>
                  <th>Radicados Fuera de Tiempo</th>
                  <th>Sin Radicar Fuera de Tiempo</th>
                  <th>Meta</th>
                  <th>D&iacute;as que Deben Transcurrir</th>
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
<table class="table table-hover table-bordered" width="50%">
<thead>
  <tr>
    <th>&nbsp;</th>
     <th>&nbsp;</th>
  </tr> 
</thead>
</table>  

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

<table class="table table-hover table-bordered" width="50%">
<thead>
  <tr>
    <th>&nbsp;</th>
     <th>&nbsp;</th>
  </tr> 
</thead>
</table>


<table class="table table-hover table-bordered" id="tablacontratos">
<thead>
  <tr>
      <th>No. Liquidaci&oacute;n</th>
      <th>Deudor</th>
       <th>Tipo Identificaci&oacute;n</th>
      <th>No. Identificaci&oacute;n</th>
     
      <th>SAP</th>
      <th>IF</th>
      <th>Fecha Envio Memorial </th>
      <th>Fecha Envio Memorial Corregido</th>
      <th>Fecha Radicaci&oacute;n del Memorial</th>
      <th>Cumple</th>
  </tr> 
</thead>
<tbody>
    <?php 
        for($i = 0; $i < count($contratos); $i++){
             echo "<tr>
                        <td>".$contratos[$i]['liquidacion']."</td>
                        <td>".$contratos[$i]['nombre']."</td>
                         <td>".$contratos[$i]['tipo_identificacion']."</td>
                        <td>".$contratos[$i]['identificacion']."</td>
                        
                        <td>".$contratos[$i]['SAP']."</td>
                        <td>".$contratos[$i]['ifinanciero']."</td>
                        <td>".$contratos[$i]['envioMemorial']." </td>
                        <td>".$contratos[$i]['envioMemorialC']."</td>
                        <td>".$contratos[$i]['radicacion']."</td>
                        <td>".$contratos[$i]['cumple']."</th>
                    </tr> ";
        }
    ?>
</tbody>
</table>   





