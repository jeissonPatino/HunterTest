<?php 
      
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gestion_extrajudicial_mensual.xls");
?>

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

