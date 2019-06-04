<?php 
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=subrogaciones_efectivas.xls");
    $total = 0;
    $totalBase = 0;
    $nuevo = 0;
    $viejo = 0;
    foreach ($gestiones as $key) {
        $nuevo = $key->Sub_contrato;
        if($nuevo != $viejo){
            $total++;
        }
        $viejo = $nuevo;
      
    }
    $nuevo = 0;
    $viejo = 0;
    foreach ($gestiones_deglosado_general as $key) {
        $nuevo = $key->contrato;
        if($nuevo != $viejo){
            $totalBase++;
        }
        $viejo = $nuevo;
      
    }
?>
 <table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
          <th>FRG</th>
          <th>Subrogaciones</th>
        </tr> 
    </thead>
    <tbody>
        <tr>
          <td><?php echo $frg; ?></td>
          <td><?php echo $totalBase; ?></td>
        </tr>
    </tbody>
</table>
 <table class="table table-hover table-bordered" width="50%">
        <tr>
          <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
 <table class="table table-hover table-bordered" width="50%">
        <tr>
          <td>&nbsp;</td>
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

        <tr>
          <td><?php echo $frg; ?></td>
          <td><?php echo $total; ?></td>
          <td><?php echo $meta; ?>%</td>
          <td><?php 
                 if($totalBase == 0) echo 0;
                else echo number_format(($total * 100 / (number_format(($totalBase *($meta / 100 )), 0)) ), 0); 
                ?>%</td>
        </tr>
    </tbody>
</table>
<table class="table table-hover table-bordered" width="50%">
        <tr>
          <td>&nbsp;</td>
        </tr>
    </tbody>
</table><table class="table table-hover table-bordered" width="50%">
        <tr>
          <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
<table class="table table-hover table-bordered" id="tablacontratos">
    <thead>
        <tr>
          <th>No. Liquidaci&oacute;n</th>
          <th>Deudor</th>
          <th>Tipo Identificaci&oacute;n</th>
          <th>No. Identificaci&oacute;n</th>
          <th>IF</th>
          <th>Valor pagado</th>
          <th>Factura subrogaci&oacute;n</th>
          <th>Fecha Factura</th>
          <th>Fecha Autos Subrogaci&oacute;n</th>
        </tr> 
    </thead>
    <tbody>
        <?php 
            $nuevo = 0;
            $viejo = 0;
            foreach ($gestiones_deglosado_general as $key) {
                $nuevo = $key->contrato;
                if($nuevo != $viejo){
                    echo "<tr>
                        <td>".$key->contrato."</td>
                        <td>".utf8_encode($key->nombre)."</td>
                         <td>".$key->tipo_identificacion."</td>
                        <td>".$key->identificacion."</td>
                        <td>".utf8_encode($key->intermediario)."</td>
                        <td>"."$ ".number_format($key->Vlorpagado, 0, ',','.')."</td>
                        <td>".$key->Sub_factura_subrogacion."</td>
                        <td>".$key->Sub_fecha_factura."</td>
                        <td>".$key->Sub_fecha_auto."</td>
                    </tr> ";
                }
                $viejo = $nuevo;
            } ?>
    
    </tbody>
</table>   