<?php 
      
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gestion_judicial.xls");
?>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <table class="table table-hover table-bordered" id="tablacontratos">
      <thead>
        <tr>
           <tr>
                <th>No. Liquidaci&oacute;n</th>
                <th>Deudor</th>
                <th>Tipo Identificaci&oacute;n</th>
                <th>No. Identificaci&oacute;n</th>
                
                <th>SAP</th>
                <th>IF</th>
                <th>Valor Pagado</th>
                <th>Fecha asignaci&oacute;n abogado</th>
        				<th>Fecha env&iacute;o memorial subrogaci&oacute;n</th>
        				<th>Gesti&oacute;n</th>
        				<th>Fecha de informe</th>
        				<th>Fecha de gesti&oacute;n</th>
        				<th>FRG</th>
        				<th>Nombre ejecutor</th>
              </tr> 
        </tr> 
      </thead>
      <tbody>
        
          <?php for ($i=0; $i < count($todaBase); $i++) { 
            echo "<tr>
                    <th>".$todaBase[$i]['contrato']."</th>
                    <th>".$todaBase[$i]['nombre']."</th>
                    <th>".$todaBase[$i]['tipo_identificacion']."</th>
                    <th>".$todaBase[$i]['identificacion']."</th>
                    
                    <th>".$todaBase[$i]['SAP']."</th>
                    <th>".$todaBase[$i]['ifinanciero']."</th>
                    <th>".$todaBase[$i]['valorPagado']."</th>
                    <th>".$todaBase[$i]['fecha_abogado']."</th>
					<th>".$todaBase[$i]['fecha_memorial_subroga']."</th> 
					<th>".$todaBase[$i]['gestionado']."</th>
					<th>".$todaBase[$i]['fecha_informe']."</th>
					<th>".$todaBase[$i]['fecha_gestion']."</th>
					<th>".$todaBase[$i]['frg']."</th>
					<th>".$todaBase[$i]['nom_ejecutor']."</th>
                  </tr> ";
          }
          ?>
      </tbody>
    </table>    
