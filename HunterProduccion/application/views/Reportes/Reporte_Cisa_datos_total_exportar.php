<?php 

    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=reporteSoporteCisa.xls");
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

        for ($i=0; $i < count($gestiones_deglosado); $i++){
            $deudor = trim(utf8_encode($gestiones_deglosado[$i]['nombre']));
                    echo "<tr>
                            <td>".$gestiones_deglosado[$i]['contrato']."</td>
                            <td>".$deudor."</th>
                             <td>".$gestiones_deglosado[$i]['tipo_identificacion']."</td>
                            <td>".$gestiones_deglosado[$i]['identificacion']."</td>
                           
                            <td>".$gestiones_deglosado[$i]['SAP']."</td>
                            <td>".utf8_encode($gestiones_deglosado[$i]['ifinanciero'])."</td>
                            <td>".$gestiones_deglosado[$i]['fecha_soprte']."</td>
                            <td>".$gestiones_deglosado[$i]['fecha_soprte_ap']."</td>
                            <td>".$gestiones_deglosado[$i]['cumple']."</td>
                        </tr>";
        }
            
        ?>
        
    </tbody>
</table>