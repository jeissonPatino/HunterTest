<?php 
      
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gestion_extrajudicial_mensual.xls");

    $ci = &get_instance();
    $ci->load->Model('Reportes_model');
   
    $cumplimiento = 0;
    $Nocumplen = 0;
    $totalBaseMedicion = 0;
    //
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
            <th>FRG</th>
            <th>Base de Medici&oacute;n</th>
            <th>Obligaciones Gestionadas</th>
            <th>Obligaciones Sin Gestionar</th>
        </tr>   
    </thead>
    <tbody>
        <tr>
            <th><?php echo $frg;?></th>
            <td><?php echo $totalBase;?></td>
            <td><?php echo $totalCumplimiento;?></td>
            <td><?php echo $totalNocumplen;?></td>
        </tr>                   
    </tbody>
</table>   


<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
            <th>&nbsp;</th>
        </tr> 
        <tr>
            <th>&nbsp;</th>
        </tr>   
    </thead>
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
        <tr>
        <th><?php echo $frg;?></th>
            
			<!--
				//Manuel Ochoa - Softtek - 19/11/2015 - Se cambian las variables, no se usaban las que eran
				<td><?php if($totalBaseMedicion > 0) { echo number_format(($cumplimiento/$totalBaseMedicion) * 100, 0); }else{ echo '0';} ?> %</td>
				<td><?php if($totalBaseMedicion > 0) { echo number_format(($Nocumplen/$totalBaseMedicion) * 100, 0) ;}else{ echo '0';}?> %</td>
            -->
			
            <td><?php if($totalBase > 0) { echo number_format(($totalCumplimiento/$totalBase) * 100, 0); }else{ echo '0';} ?> %</td>
            <td><?php if($totalBase > 0) { echo number_format(($totalNocumplen/$totalBase) * 100, 0) ;}else{ echo '0';}?> %</td>
			
        </tr>
    </tbody>
</table>
<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
            <th>&nbsp;</th>
        </tr> 
        <tr>
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
        
		<th>IF</th>
		<th>Valor Pagado</th>
		<th>Gesti&oacute;n</th>
      </tr> 
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($gestiones_deglosado); $i++){ 

                echo "<tr>
                        <td>".$gestiones_deglosado[$i]['contrato']."</td>
                        <td>".$gestiones_deglosado[$i]['nombre']."</td>
                        <td>".$gestiones_deglosado[$i]['tipo_identificacion']."</td>
                        <td>".$gestiones_deglosado[$i]['identificacion']."</td>
                        
                        <td>".$gestiones_deglosado[$i]['ifinanciero']."</td>
                        <td>".$gestiones_deglosado[$i]['valorPagado']."</td>
                        <td>".$gestiones_deglosado[$i]['gestionado']."</td>
                      </tr> ";
        }?>
      
    </tbody>
</table>   

