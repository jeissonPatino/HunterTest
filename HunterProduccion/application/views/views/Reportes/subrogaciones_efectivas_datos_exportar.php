<?php 
     header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=subrogaciones_efectivas.xls");
      $total = 0;
    foreach ($gestiones as $key) {
      $total++;
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
          <td><?php echo $total; ?></td>
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
        </tr> 
    </thead>
    <tbody>

        <tr>
          <td><?php echo $frg; ?></td>
          <td><?php echo $total; ?></td>
          <td><?php echo $meta; ?></td>
          
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
          <th>Identificación</th>
          <th>IF</th>
          <th>Valor pagado</th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($gestiones_deglosado as $key) {

                echo "<tr>
                      <td>".$key->contrato."</td>
                      <td>".utf8_encode($key->nombre)."</td>
                      <td>".$key->identificacion."</td>
                      <td>".utf8_encode($key->intermediario)."</td>
                      <td>"."$ ".number_format($key->Vlorpagado, 0, ',','.')."</td>
                  </tr> ";
            } ?>
    
    </tbody>
</table>   