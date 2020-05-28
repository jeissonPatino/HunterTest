<?php

    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporte_radicacion_memoriales.xls");

	
  $ci = &get_instance();
    $ci->load->Model('Reportes_model');

    $cumplimiento = 0;
    $Fallos = 0;
    $totalObligaciones = 0;
    $radicadosFueradetiempo = 0;
    $sinradicarFueradeTiempo = 0;
  foreach ($Subrogaciones_envio as $key) {
    
      $totalObligaciones++;
      $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
      $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );

      $radicado = $ci->Reportes_model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);


      if($radicado == 1){
          $cumplimiento++;
      }else{
          date_default_timezone_set('America/Bogota');
          $fechaIngreso =  date("Y-m-d H:i:s");

          $datetime1 = new DateTime($key->Fecha_envio_Memorial);
          $datetime2 = new DateTime($fechaIngreso);
          $interval = $datetime1->diff($datetime2);

          if($tiempo > $interval->format('%R%a') ){
              $Fallos++;
          }else{
              $radicadoSt = $ci->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
              if($radicadoSt == 1){
                  $radicadosFueradetiempo++;
              }else{
                  $sinradicarFueradeTiempo++;
              }
              
          }
      }
  }


  foreach ($Subrogaciones_envio_corregidos as $key) {
    
      $totalObligaciones++;
      $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
      $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
      $radicado = $ci->Reportes_model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin);

      if($radicado == 1){
          $cumplimiento++;
      }else{
          date_default_timezone_set('America/Bogota');
          $fechaIngreso =  date("Y-m-d H:i:s");

          $datetime1 = new DateTime($key->Fecha_envio_Memorial);
          $datetime2 = new DateTime($fechaIngreso);
          $interval = $datetime1->diff($datetime2);

          if($tiempo > $interval->format('%R%a') ){
              $Fallos++;
          }else{
              $radicadoSt = $ci->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
              if($radicadoSt == 1){
                  $radicadosFueradetiempo++;
              }else{
                  $sinradicarFueradeTiempo++;
              }
              
          }

      }
  }


	$label = "['Base de medición', 'Cumplen', 'No cumplen', 'Meta']";
    $data1 = "['".$totalObligaciones."', '".$cumplimiento."', '".$Fallos."', '".number_format(($totalObligaciones *($meta / 100 )), 0)."']";

?>


   
<table class="table table-hover table-bordered" width="50%">
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
                <tr>
                    <th><?php echo utf8_encode($frg);?></th>
                    <td><?php echo $totalObligaciones;?></td>
                    <td><?php echo $cumplimiento;?></td>
                    <td><?php echo $Fallos;?></td>
                    <td><?php echo $radicadosFueradetiempo;?></td>
                    <td><?php echo $sinradicarFueradeTiempo;?></td>
                    <td><?php echo number_format(($totalObligaciones *($meta / 100 )), 0);?></td>
                    <td><?php echo $tiempo ;?></td>
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
		<tr>
	    <th><?php echo utf8_encode($frg);?></th>
			<td><?php if($totalObligaciones > 0) { echo number_format(($cumplimiento/$totalObligaciones) * 100, 0); }else{ echo '0';} ?> %</td>
			<td><?php if($totalObligaciones > 0) { echo number_format(($Fallos/$totalObligaciones) * 100, 0) ;}else{ echo '0';}?> %</td>
			<td><?php echo $meta; ?> %</td>
                  
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


<table class="table table-hover table-bordered" id="tablacontratos">
  <thead>
    <tr>
      <th>No. Liquidaci&oacute;n</th>
      <th>Deudor</th>
      <th>Identificaci&oacute;n</th>
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
                        <td>".$contratos[$i]['contrato']."</td>
                        <td>".$contratos[$i]['nombre']."</td>
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
