<?php
	//header("Content-type: application/vnd.ms-excel; charset=utf-8");
    //header("Content-Disposition: attachment; filename=GestionExtrajudicial.xls");	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
</head>
<body>


<head>
        
<table>
	<thead>
		<tr>
    		<th style="text-align:center;">Nombre Deudor</th>
    		<th style="text-align:center;">Tipo Identificación</th>
    		<th style="text-align:center;">No. Identificación</th>
    		<th style="text-align:center;">Ciudad Despacho</th>
    		<th style="text-align:center;">Intermediario financiero</th>
    		<th style="text-align:center;">No. Liquidación</th>
    		<th style="text-align:center;">No. Proceso SAP</th>
    		<th style="text-align:center;">Valor Pagado</th>
    		<th style="text-align:center;">Rol</th>
		</tr>
	</thead>
	<tbody>
	<?php
        for ($i=0; $i < count($data); $i++) { 
		  echo "<tr>
                    <th>".$data[$i]['deudor']."</th>
                    <th>".$data[$i]['tipo_identificacion']."</th>
                    <th>".$data[$i]['IDENTIFICACION']."</th>
                    <th>".$data[$i]['INTERMEDIARIO']."</th>
                    <th>".$data[$i]['OBLIGACION']."</th>
                    <th>".$data[$i]['PROCESO_SAP']."</th>
                    <th>".$data[$i]['VALOR_PAGADO']."</th>
                    <th>".$data[$i]['ROL']."</th>
                  </tr> ";

	?>
	</tbody>
	
</table>
</body>
</html>