<?php 
      
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gestion_judicial.xls");
?>

<?php 
    $ci = &get_instance();
    $ci->load->Model('Reportes_model');
   
    $cumplimiento = 0;
    $Nocumplen = 0;
    $totalBaseMedicion = 0;


    foreach ($getionBase as $key) {
        $totalBaseMedicion +=1;
        $gestion = $ci->Reportes_model->tieneGestionJudicial($key->G719_ConsInte__b, $fechaInicial, $fechaFinal);
        if($gestion >= 1){
            $cumplimiento++;
        }else{
            $Nocumplen++;
        }
    }

    
    $label = "['Base de obligaciones a medir', 'Obligaciones con gestión judicial', 'Obligaciones sin gestión judicial']";
    $data1 = "['".$totalBaseMedicion."', '".$cumplimiento."', '".$Nocumplen."']";
?>


    <table class="table table-hover table-bordered" width="50%">
    <thead>
    <tr>
    <th>FRG</th>
    <th>Base de obligaciones a medir</th>
    <th>Obligaciones con gestión judicial</th>
    <th>Obligaciones sin gestión judicial</th>
    </tr>	
    </thead>
    <tbody>
      <tr>
          <th><?php echo $frg;?></th>
          <td><?php echo $totalBaseMedicion;?></td>
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
    			<th>Cumple</th>
    			<th>No cumple</th>
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
           <tr>
                <th>No. Liquidaci&oacute;n</th>
                <th>Deudor</th>
                <th>Identificaci&oacute;n</th>
                 <th>SAP</th>
                <th>IF</th>
                <th>Valor Pagado</th>
                <th>Fecha asignaci&oacute;n abogado</th>
              </tr> 
        </tr> 
      </thead>
      <tbody>
        
          <?php for ($i=0; $i < count($todaBase); $i++) { 
            echo "<tr>
                    <th>".$todaBase[$i]['contrato']."</th>
                    <th>".$todaBase[$i]['nombre']."</th>
                    <th>".$todaBase[$i]['identificacion']."</th>
                    <th>".$todaBase[$i]['SAP']."</th>
                    <th>".$todaBase[$i]['ifinanciero']."</th>
                    <th>".$todaBase[$i]['valorPagado']."</th>
                    <th>".$todaBase[$i]['fecha_abogados']."</th>
                  </tr> ";
          }
          ?>
      </tbody>
    </table>    
