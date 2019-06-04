<?php
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=MedidasCautelares-contrato-".$Contrato.".xls");	
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
	<thead>
		<tr>
			<th>Fecha Informe</th>
			<th>Medida Cautelar</th>
			<th>Fecha Solicitud</th>
			<th>Fecha Decreto</th>
			<th>Fecha Práctica</th>
			<th>Secuestre</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($datosObligacion as $key) {
      
            $fache = explode(' ', $key->FechaInforme);
            $fache = explode('-', $fache[0]);
            $var1 = explode(' ', $key->FechaSolicitud)[0];
            $var1 = explode('-', $var1);
            $var2 = explode(' ', $key->FechaDecreto)[0];
            $var2 = explode('-', $var2);
            $var3 = explode(' ', $key->FechaPractica)[0];
            $var3 = explode('-', $var3);

            
	        echo "<tr>
					<td>".$fache[2]."/".$fache[1]."/".$fache[0]."</td>
					<td>".utf8_encode($key->Medida)."</td>
					<td>".$var1[2]."/".$var1[1]."/".$var1[0]."</td>
					<td>".$var2[2]."/".$var2[1]."/".$var2[0] ."</td>
					<td>".$var3[2]."/".$var3[1]."/".$var3[0].".</td>
					<td>".utf8_encode($key->Secuestre)."</td>
				</tr>";
	    }
	?>
	</tbody>
	
</table>