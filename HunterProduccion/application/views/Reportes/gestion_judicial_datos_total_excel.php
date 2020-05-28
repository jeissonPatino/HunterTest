<?php 
      
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=gestion_judicial.xls");
?>

<!-- aqui se muestra el resultado en las barras -->
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
          
        </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          
          <table class="table table-hover table-bordered" id="tablacontratos">
            <thead>
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
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($gestiones_deglosado); $i++) { 
            echo "<tr>
                    <th>".$gestiones_deglosado[$i]['contrato']."</th>
                    <th>".$gestiones_deglosado[$i]['nombre']."</th>
                    <th>".$gestiones_deglosado[$i]['tipo_identificacion']."</th>
                    <th>".$gestiones_deglosado[$i]['identificacion']."</th>
                    <th>".$gestiones_deglosado[$i]['SAP']."</th>
                    <th>".$gestiones_deglosado[$i]['ifinanciero']."</th>
                    <th>".$gestiones_deglosado[$i]['valorPagado']."</th>
                    <th>".$gestiones_deglosado[$i]['fecha_abogado']."</th>
          					<th>".$gestiones_deglosado[$i]['fecha_memorial_subroga']."</th> 
          					<th>".$gestiones_deglosado[$i]['gestionado']."</th>
          					<th>".$gestiones_deglosado[$i]['fecha_informe']."</th>
          					<th>".$gestiones_deglosado[$i]['fecha_gestion']."</th>
          					<th>".$gestiones_deglosado[$i]['frg']."</th>
          					<th>".$gestiones_deglosado[$i]['nom_ejecutor']."</th>
                  </tr> ";
          }
          ?>
              
            </tbody>
          </table>    
        