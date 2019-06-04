<?php 
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=Subrogaciones_efectivas".$fechas.".xls");
?>

<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
        <th>FRG</th>
        <th>Subrogaciones</th>
        </tr> 
    </thead>
    <tbody>
        <?php 
        $totalBaseMedicion = 0;
        for($i = 0; $i < count($datos); $i++){
            
            echo " <tr>
                    <td>".utf8_encode($datos[$i]['Frg'])."</td>
                    <td>".$datos[$i]['total']." </td>
                    </tr>";

            $totalBaseMedicion += $datos[$i]['total'];
        }
        
        ?>
        <tr>
        <th>TOTALES</th>
        <td><?php echo $totalBaseMedicion; ?></td>
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
        <th>Cumplimiento</th>
        <th>Meta</th>
        <th>Porcentaje avance cumplimiento</th>
        </tr> 
    </thead>
    <tbody>
        <?php 
        //var_dump($datos);
        $total  = 0;
        for($i = 0; $i < count($datos); $i++){
            $total = $datos[$i]['total'];
            echo " <tr>
                    <td>".utf8_encode($datos[$i]['Frg'])."</td>
                    <td>".$total."</td>
                    <td>".$meta."</td>";
                    if($total > 0){
                        echo " <td>".number_format((( $total/ $meta) * 100), 0)."%</td>";
                    }else{
                         echo " <td>0 %</td>";
                    }
                   
                    echo "</tr>";
        }
        
        ?>
        
    </tbody>
</table>

<table class="table table-hover table-bordered" id="tablacontratos">
    <thead>
        <tr>
            <th>No. Liquidaci&oacute;n</th>
            <th>Deudor</th>
            <th>Identificación</th>
            <th>IF</th>
            <th>Valor pagado</th>
            <th>Factura subrogación</th>
            <th>Fecha Factura</th>
            <th>Fecha Autosubrogacion</th>
        </tr> 
    </thead>
    <tbody>
          <?php
      		  for($i = 0; $i < count($Contratos); $i++){
                   
                    echo " <tr>
                            <td>".$Contratos[$i]['contrato']."</td>
                            <td>".$Contratos[$i]['nombre']."</td>
                            <td>".$Contratos[$i]['identificacion']."</td>
                            <td>".$Contratos[$i]['ifinanciero']."</td>
                            <td>".$Contratos[$i]['valorPagado']."</td>
                            <td>".$Contratos[$i]['Sub_factura_subrogacion']."</td>
                            <td>".$Contratos[$i]['Sub_fecha_factura']."</td>
                            <td>".$Contratos[$i]['Sub_fecha_auto']."</td>
                            </tr>";
                }
            ?>     
    </tbody>
</table> 