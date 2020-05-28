<?php 

    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporteSoprtecisa.xls");
    $ci = &get_instance();
    $ci->load->Model('Reportes_model');
   
    $cumplimiento = 0;
    $Nocumplen = 0;
    $totalBaseMedicion = 0;

    foreach ($getionBase as $key) {
        $totalBaseMedicion++;
        $soporte = $ci->Reportes_model->tieneFechaPagoReporte($key->Id, $fechaInicial, $fechaFinal);
        if($soporte >= 1){
            $cumplimiento++;
        }else{
            $Nocumplen++;
        }
    }

    $label = "['Base de medición', 'Cumplen', 'No cumplen']";
    $data1 = "['".$totalBaseMedicion."', '".$cumplimiento."', '".$Nocumplen."']";

?>

<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
            <th colspan="4" style="text-align:center;">Datos de la venta elegida</th>
            
        </tr>
        <tr>
            <th>Número de Venta</th>
            <th>Fecha de Venta</th>
            <th>Fecha de Notificación</th>
            <th>Fecha de Vencimiento de Entrega de los Soportes</th>
        </tr>	
    </thead>
    <tbody>
        <tr>
            <th><?php echo $Ven_nombre;?></th>
            <th><?php echo $fechaVEnta;?></th>
            <td><?php echo $fechaInicial;?></td>
            <td><?php echo $fechaFinal;?></td>
        </tr>		    		
    </tbody>
</table>

<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
            <th colspan="4" style="text-align:center;">Datos del FRG</th>
            
        </tr>
        <tr>
            <th>FRG</th>
            <th>Cumple</th>
            <th>No Cumple</th>
        </tr>	
    </thead>
    <tbody>
        <tr>
            <th><?php echo $frg;?></th>
            <td><?php echo $cumplimiento;?></td>
            <td><?php echo $Nocumplen;?></td>
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
            <th>Porcentaje de cumplimiento</th>
            <th>Porcentaje de Incumplimiento</th>
        </tr>	
    </thead>
    <tbody>
        <tr>
        <th><?php echo $frg;?></th>
            <td><?php if($totalBaseMedicion > 0) { echo number_format(($cumplimiento/$totalBaseMedicion) * 100, 0); }else{ echo '0';} ?> %</td>
            <td><?php if($totalBaseMedicion > 0) { echo number_format(($Nocumplen/$totalBaseMedicion) * 100, 0) ;}else{ echo '0';}?> %</td>
            
        </tr>
    </tbody>
</table>

<table class="table table-hover table-bordered" id="tablacontratos">
    <thead>
        <tr>
        <th>No. Liquidaci&oacute;n</th>
        <th>Deudor</th>
        <th>Identificación</th>
        <th>SAP</th>
        <th>IF</th>
        <th>Fecha Entrega Soporte</th>
        <th>Fecha Aprobación Soporte</th>
        <th>Cumple</th>
        </tr> 
    </thead>
    <tbody>
        <?php
            foreach($contratos as $key){

                    $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->Id, $fechaInicial, $fechaFinal);
                    $si = 'NO';
                    if($soporte >= 1){
                       $si = 'SI';
                    }
                    $deudor = trim(utf8_encode($key->nombre));
                    echo "<tr>
                            <td>".$key->contrato."</td>
                            <td>".$deudor."</th>
                            <td>".$key->identificacion."</td>
                            <td>".$key->SAP."</td>
                            <td>".utf8_encode($key->intermediario)."</td>
                            <td>".$key->Fecha_recepcion_soporte."</td>
                            <td>".$key->Fecha_aprovacion_soporte."</td>
                            <td>".$si."</td>
                        </tr>";
            }    
        ?>
        
    </tbody>
</table>