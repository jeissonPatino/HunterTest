<?php 
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=asignacion_abogados.xls");
    header("Pragma: no-cache");
	header("Expires: 0");
	$datos = array();
	$i = 0;
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

	foreach ($reporte as $key) {
		$total++;
		//pregunto que hallla sido asignado el abogado
		if($key->G719_C17051 != NULL){
			$asignadas++;
			//valido que no se halla devuelto el memorial de subrogacion
			if($key->G719_C17050 != NULL){
				$datetime1 = new DateTime($key->G719_C17050);
				$datetime2 = new DateTime($key->G719_C17051);
				$interval = $datetime1->diff($datetime2);
				if($tiempo > $interval->format('%R%a')){
					$aTiempo++;
				}else{
					$aDesiempo++;
				}
				/*$datos[$i]['resultadoSUB'] = $interval->format('%R%a');
				$datos[$i]['fechaAbogado'] = $key->G719_C17050;
				$datos[$i]['fechaEnvio'] = $key->G719_C17051;*/
			}else{
				$datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
				$datetime2 = new DateTime($key->G719_C17051);
				$interval = $datetime1->diff($datetime2);
				if($tiempo > $interval->format('%R%a')){
					$aTiempo++;
				}else{
					$aDesiempo++;
				}
				/*$datos[$i]['resultado'] = $interval->format('%R%a');
				$datos[$i]['fechaAbogado'] = $key->FechaEnvioMemorialSubrogacionFRG;
				$datos[$i]['fechaEnvio'] = $key->G719_C17051;*/
			}
		}else{
			$Nasignadas++;
			date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

			$datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
			$datetime2 = new DateTime($fechaIngreso);
			$interval = $datetime1->diff($datetime2);

			if($tiempo > $interval->format('%R%a')){
				$noasignadasEntiempo++;
			}else{
				$noasignadasNotiempo++;
			}
			
		}
		
		$i++;
	}

?>

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
		<tr>
			<td><?php echo $frg; ?></td>
			<td><?php echo $total; ?></td>
			<td><?php echo $aTiempo; ?></td>
			<td><?php echo $aDesiempo; ?></td>
			<td><?php echo $noasignadasEntiempo; ?></td>
			<td><?php echo $noasignadasNotiempo; ?></td>
		</tr>
	</tbody>
</table>	
<table class="table table-hover table-bordered" width="50%">
	
	<tbody>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
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
			<th>Cumplimiento</th>
			<th>Meta</th>
		</tr>	
	</thead>
	<tbody>
		<tr>
			<td><?php echo $frg; ?></td>
			<td><?php echo number_format((($aTiempo * 100) / $total ), 2)."%"; ?></td>
			<td><?php echo $meta; ?> %</td>
			
		</tr>
	</tbody>
</table>

<table class="table table-hover table-bordered" width="50%">
	
	<tbody>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

<table class="table table-hover table-bordered" id="tablacontratos">
    <thead>
      	<tr>
			<th>No. Contrato / No. Liquidaci&oacute;n</th>
			<th>IF</th>
			<th>Deudor</th>
			<th>Identificaci&oacute;n</th>
			
			<th>Valor Pagado</th>
			<th>Fecha Env&iacute;o Memorial</th>
			<th>Fecha Asignaci&oacute;n Abogado</th>
			
			<th>Fecha Env&iacute;o Corregido</th>
			<th>D&iacute;as Transcurrido</th>
			<th>Calificaci&oacute;n</th>
      	</tr> 
    </thead>
    <tbody>
      	<?php
      		foreach ($Contratos as $key) {
                $aTiempo = 'Sin asignar';
				$trancurrido = 0;
                if($key->G719_C17051 != NULL){
                    //$asignadas++;
                    //valido que no se halla devuelto el memorial de subrogacion
                    if($key->G719_C17050 != NULL){
                        $datetime1 = new DateTime($key->G719_C17050);
                        $datetime2 = new DateTime($key->G719_C17051);

                        $interval = $datetime1->diff($datetime2);
                        $trancurrido = $interval->format('%R%a');
						if($tiempo >= $interval->format('%R%a')){
                            $aTiempo = 'A tiempo';
                        }else{
                            $aTiempo = 'A destiempo';
                        }
                        
                    }else{
                        $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                        $datetime2 = new DateTime($key->G719_C17051);
                        $interval = $datetime1->diff($datetime2);
						$trancurrido = $interval->format('%R%a');
                        if($tiempo >= $interval->format('%R%a')){
                            $aTiempo = 'A tiempo';
                        }else{
                            $aTiempo = 'A destiempo';
                        }
                       
                    }
                }

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);

                $fecha1 = null;
                $fecha3 = null;
                $fecha2 = null;
                
                if(!is_null($key->G719_C17051)){
                    $fecha1 = explode(" ", $key->G719_C17051)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                }
                
                if(!is_null($key->FechaEnvioMemorialSubrogacionFRG)){
                    $fecha2 = explode(" ", $key->FechaEnvioMemorialSubrogacionFRG)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }
                
                if(!is_null($key->G719_C17050)){
                    $fecha3 = explode(" ", $key->G719_C17050)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }

                echo "<tr>
						<th>".$key->contrato."</th>
						<th>".utf8_encode($key->intermediario)."</th>
						<th>".$deudor."</th>
						<th>".$key->identificacion."</th>
						<th>$ ".number_format($key->Vlorpagado, 0, ',','.')."</th>
						<th>".$fecha2."</th>
						<th>".$fecha1."</th>
						<th>".$fecha3."</th>
						<th>".$trancurrido."</th>
						<th>".$aTiempo."</th>
			      	</tr> ";
            }
      	?>
    </tbody>
</table> 