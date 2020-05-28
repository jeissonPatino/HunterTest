<?php
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=GestionJudicial-contrato-".$Contrato.".xls");	
?>
<table>
	<thead>
		<tr>
			<th>Tipo de proceso	</th>
			<th>Fecha de informe</th>
			<th>Etapa</th>
			<th>Actuación</th>
			<th>Fecha de trámite</th>
			<th>Observaciones</th>
			<th>Ejecutor</th>
		
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($datosObligacion as $key) {
	        $fecha = null;
	        $fecha2 = null;
	        $fecha3 =null;
	        if(!is_null($key->fechaIngreso)){
	            $fecha = explode(" ", $key->txtFechaTramite)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaIngreso)[0];
                $fecha1 = explode("-", $fecha1);

	        echo "<tr>
					<td>".utf8_encode($key->TipoProceso)."</td>
					<td>".$fecha1[2]."/". $fecha1[1]."/". $fecha1[0]."</td>
					<td>".utf8_encode($key->Etapa)."</td>
					<td>".utf8_encode($key->actuacion) ."</td>
					<td>".$fecha[2]."/". $fecha[1]."/". $fecha[0].".</td>
					<td>".utf8_encode($key->observaciones)."</td>
					<td>".utf8_encode($key->users)."</td>
				</tr>";
	    }
	?>
	</tbody>
	
</table>