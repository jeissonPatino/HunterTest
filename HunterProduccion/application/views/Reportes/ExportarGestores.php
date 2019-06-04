<?php
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
   header("Content-Disposition: attachment; filename=InformeGestores.xls"); 
?>


<table class="table table-hover table-bordered" id ="tablaCantidadgestionada">
    <thead>
        <tr>
            <th class= 'col-md-6' style="text-align:center ;">Gestor</th>
            <th style="text-align:center;"> Cantidad gestionada </th>     
        </tr> 
    </thead>
    <tbody>
        <?php
        $data =  json_decode($ResultadoCantidadGestionada);
                    foreach($data as $key){

                            echo "<tr>
                                    <td>".$key->Gestor."</td>
                                    <td>".$key->cantidad."</th>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                ";
                    }    
                ?>
    </tbody>
</table>   
        
<table>
    <thead>
        <tr>
                  <th style="text-align:center;">No. Liquidaci&oacute;n</th>     
                  <th style="text-align:center;">Nombre Deudor</th>
                  <th style="text-align:center;">Tipo Identificaci&oacute;n</th>
                  <th style="text-align:center;">No. Identificaci&oacute;n</th>
                  <th style="text-align:center;">Intermediario financiero</th>
                  <th style="text-align:center;">Fecha pago de garant&iacute;a</th>
                  <th style="text-align:center;">Fecha de asignaci&oacute;n</th>
                   <th style="text-align:center;">Gestores</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data =  json_decode($ResultadoFrgGestiones);
                    foreach($data as $key){

                            echo "<tr>
                                    <td>".$key->NumeroLiquidacion."</td>
                                    <td>".$key->NombreDeudor."</th>
                                    <td>".$key->TipoIdentificacion."</th>
                                    <td>".$key->NumeroId."</th>
                                    <td>".$key->Intermediariofinancero."</th>
                                    <td>".$key->FechaPagoGarantia."</th>
                                    <td>".$key->FechaGestion."</th>
                                    <td>".$key->Gestor."</th>
                                </tr>";
                    }    
                ?>
    </tbody>
</table>    