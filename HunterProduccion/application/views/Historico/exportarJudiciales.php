<?php 
	header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=HistoricoJudicial.xls");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table >
	<thead>
		<tr>
			<th style="text-align:center;">Nombre Deudor</th>
			<th style="text-align:center;">Tipo Identificaci&oacute;n</th>
			<th style="text-align:center;">No. Identificaci&oacute;n</th>
			
			<th style="text-align:center;">Proceso SAP</th>
			<th style="text-align:center;">IF</th>
			<th style="text-align:center;">Valor Pagado</th>
			<th style="text-align:center;">Fecha Tramite</th>
			<th style="text-align:center;">Fecha Informe</th>
			<th style="text-align:center;">Actuaci&oacute;n</th>
			<th style="text-align:center;">Tipo de proceso</th>
			<th style="text-align:center;">Etapa</th>
			<th style="text-align:center;">No. Liquidaci&oacute;n</th>
			<th style="text-align:center;">FRG</th>
			<th style="text-align:center;">Abogado / Gestor</th>
		</tr>
	</thead>
	<tbody>
		<?php 	foreach ($judicial as $key) { 
           	    $fecha = explode(" ", $key->txtFechaIngreso)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaTramite)[0];
                $fecha1 = explode("-", $fecha1);



                

                $deudor = utf8_encode($key->nombres);
                $nombre = substr($deudor, 0, 3);


      	?>      
      		<tr>
      			<td style="text-align:center;"><?php echo utf8_encode($deudor);?></td>
      			<td style="text-align:center;"><?php echo $key->tipo_identificacion;?></td>
				<td style="text-align:center;"><?php echo $key->identificacion;?></td>
				
				<td style="text-align:center;"><?php echo $key->SAP; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->financiero); ?></td>
				<td style="text-align:center;"><?php echo "$ ".number_format($key->Vlorpagado,0, ',', '.'); ?></td>
				<td style="text-align:center;"><?php echo $fecha1[2]."/". $fecha1[1]."/". $fecha1[0]; ?></td>
				<td style="text-align:center;"><?php echo $fecha[2]."/". $fecha[1]."/". $fecha[0]; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->actuacion) ; ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->claseProceso); ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->Etapa); ?></td>
				<td style="text-align:center;"><?php echo $key->liquidacion ; ?></td>	
				<td style="text-align:center;"><?php echo utf8_encode($key->FRG); ?></td>
				<td style="text-align:center;"><?php echo utf8_encode($key->users ) ; ?></td>
      		</tr>
            
       	<?php  	} ?>
	</tbody>
</table>