<?php 
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=HistoricoExtrajudicial.xls");
?>

<table>
	<thead>
		<tr>
			<th style="text-align:center;">Nombre Deudor</th>
			<th style="text-align:center;">C.C</th>
			<th style="text-align:center;">Proceso SAP</th>
			<th style="text-align:center;">IF</th>
			<th style="text-align:center;">Valor Pagado</th>
			<th style="text-align:center;">Fecha gesti&oacute;n</th>
			<th style="text-align:center;">Medio de comunicaci&oacute;n</th>
			<th style="text-align:center;">Resultado de la comunicaci&oacute;n</th>
			<th style="text-align:center;">Gesti&oacute;n</th>
			<th style="text-align:center;">Subgesti&oacute;n</th>
			<th style="text-align:center;">No. Liquidaci&oacute;n</th>
			<th style="text-align:center;">FRG</th>
			<th style="text-align:center;">Abogado / Gestor</th>
		</tr>
	</thead>
	<tbody>
		<?php 	foreach ($extrajudicial as $key) { 
           	    $fecha1 = null;
				$fecha = null;
				$fecha2 = null;
				if(!is_null($key->fechaIngreso)){
					$fecha1 = explode(" ", $key->fechaIngreso)[0];
					$fecha2 = explode("-", $fecha1);
					$fecha =  $fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
				}

				$deudor = utf8_encode($key->nombres);
                $nombre = substr($deudor, 0, 3);

      	?> 
      		<tr>
	            <td style="text-align:center;"><?php echo $deudor;?></td>
				<td style="text-align:center;"><?php echo $key->identificacion;?></td>
				<td style="text-align:center;"><?php echo $key->SAP; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->financiero); ?></td>
				<td style="text-align:center;"><?php echo "$ ".number_format($key->Vlorpagado,0, ',', '.'); ?></td>
				<td style="text-align:center;"><?php echo $fecha; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->mediocomunicacion ); ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->resultadocomunicacion) ; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->gestion); ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->subgestion); ?></td>
				<td style="text-align:center;"><?php echo $key->liquidacion ; ?></td>	
				<td style="text-align:center;"><?php echo utf8_encode($key->FRG); ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->users); ?></td>	
      		</tr>     

       	<?php  	} ?>
	</tbody>
</table>