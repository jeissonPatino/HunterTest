<?php 

    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporteSoporteCisa.xls");
    $ci = &get_instance();
    $ci->load->Model('Reportes_model');
   
    $cumplimiento = 0;
    $Nocumplen = 0;
    $totalBaseMedicion = 0;

    foreach ($getionBase as $key) {
        $totalBaseMedicion++;
        $soporte = $ci->Reportes_model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaInicial, $fechaFinal);
        if($soporte >= 1){
            $cumplimiento++;
        }else{
            $Nocumplen++;
        }
    }

    $label = "['Base de medición', 'Cumplen', 'No cumplen']";
    $data1 = "['".$totalBaseMedicion."', '".$cumplimiento."', '".$Nocumplen."']";

?>



<table class="table table-hover table-bordered" id="tablacontratos">
    <thead>
        <tr>
        <th>No. Liquidaci&oacute;n</th>
        <th>Deudor</th>
        <th>Tipo Identificaci&oacute;n</th>
        <th>Identificaci&oacute;n</th>
        
        <th>SAP</th>
        <th>IF</th>
        <th>Fecha Entrega Soporte</th>
        <th>Fecha Aprobaci&oacute;n Soporte</th>
        <th>Cumple</th>
        </tr> 
    </thead>
    <tbody>
        <?php
            foreach($contratos as $key){

                    $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaInicial, $fechaFinal);
                    $si = 'NO';
                    if($soporte >= 1){
                       $si = 'SI';
                    }
                    $deudor = trim(utf8_encode($key->nombre));
                    echo "<tr>
                            <td>".$key->contrato."</td>
                            <td>".$deudor."</th>
                             <td>".$key->tipo_identificacion."</td>
                            <td>".$key->identificacion."</td>
                           
                            <td>".$key->SAP."</td>
                            <td>".utf8_encode($key->intermediario)."</td>
                            <td>".$key->Fecha_recepcion_soporte."</td>
                            <td>".$key->Fecha_aprobacion_soporte."</td>
                            <td>".$si."</td>
                        </tr>";
            }    
        ?>
        
    </tbody>
</table>