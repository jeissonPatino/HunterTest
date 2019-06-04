<?php
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=GestionExtrajudicial-contrato-".$Contrato.".xls");	
?>
<table>
	<thead>
		<tr>
			<th>Cliente Gestionado</th>
			<th>Medio Comunicación</th>
			<th>Resultado Comunicación</th>
			<th>Gestión</th>
			<th>Subgestión</th>
			<th>Observaciones</th>
			<th>Ejecutor</th>
			<th>Fecha Ejecución</th>
			<th>Hora Ejecución</th>
		
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($datosObligacion as $key) {
	        $fecha = null;
	        $fecha2 = null;
	        $fecha3 =null;
	        if(!is_null($key->fechaIngreso)){
	            $fecha = explode(" ", $key->fechaIngreso)[0];
	            $fecha = explode("-", $fecha);
	           
	            $fecha2 = $fecha[2]."/". $fecha[1]."/". $fecha[0];
	            $fecha3 = $fecha[0].$fecha[1].$fecha[2];
	        }
	        


	        $niidea = '00:00:00';
	        if(!is_null($key->Niidea)){
	           $niidea = explode( ".", explode(" ", $key->Niidea)[1])[0]; 
	        }
	        echo "<tr>
					<td>".utf8_encode($key->nombres)."</td>
					<td>".utf8_encode($key->mediocomunicacion)."</td>
					<td>".utf8_encode($key->resultadocomunicacion)."</td>
					<td>".utf8_encode($key->gestion)."</td>
					<td>".utf8_encode($key->subgestion).".</td>
					<td>".utf8_encode($key->observaciones)."</td>
					<td>".utf8_encode($key->users)."</td>
					<td>".$fecha2."</td>
					<td>".$niidea."</td>
				
				</tr>";
	    }
	?>
	</tbody>
	
</table>