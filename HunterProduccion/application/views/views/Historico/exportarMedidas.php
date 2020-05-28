<?php 
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=HistoricoMedidas.xls");
?>

<table>
	<thead>
		<tr>
			<th style="text-align:center;">Nombre Deudor</th>
			<th style="text-align:center;">C.C</th>
			<th style="text-align:center;">Proceso SAP</th>
			<th style="text-align:center;">IF</th>
			<th style="text-align:center;">Valor Pagado</th>

			<th style="text-align:center;">Fecha Informe</th>
			<th style="text-align:center;">Medidas cautelares</th>
			<th style="text-align:center;">Ejecutor</th>
			<th style="text-align:center;">No. Liquidaci&oacute;n</th>
			<th style="text-align:center;">FRG</th>
		</tr>
	</thead>
	<tbody>
		<?php 	foreach ($judicial as $key) { 
				$fecha = explode(" ", $key->FechaInforme)[0];
                $fecha = explode("-", $fecha);

                $deudor = utf8_encode($key->nombres);
                $nombre = substr($deudor, 0, 3); 
      	?>  
      		<TR>
      			<td style="text-align:center;"><?php echo $deudor;?></td>
				<td style="text-align:center;"><?php echo $key->identificacion;?></td>
				<td style="text-align:center;"><?php echo $key->SAP; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->financiero); ?></td>
				<td style="text-align:center;"><?php echo "$ ".number_format($key->Vlorpagado,0, ',', '.'); ?></td>
				<td style="text-align:center;"><?php echo $fecha[2]."/". $fecha[1]."/". $fecha[0]; ?></td>

				<td style="text-align:center;"><?php echo utf8_encode($key->Medida); ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->users); ?></td>
				<td style="text-align:center;"><?php echo $key->liquidacion ; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->FRG) ; ?></td>
      		</TR>    
            	
       	<?php  	} ?>
	</tbody>
</table>
