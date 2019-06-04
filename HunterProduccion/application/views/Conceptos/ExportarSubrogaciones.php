<?php
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=subrogaciones.xls");
?>
<table class="table table-hover table-bordered" width="50%">
    <thead>
        <tr>
            <th>No. Contrato</th>
            <th>Fecha tramite</th>
            <th>Valor a pagar</th>
            <th>Valor pagado</th>
        </tr>   
    </thead>
    <tbody>
    	<?php for($i = 0; $i < count($datosa_enviar); $i++) {
    		 echo "<tr>
			            <th>".$datosa_enviar[$i]['Ncontrato']."</th>
			            <td>".$datosa_enviar[$i]['fecha']."</td>
			            <td>$ ".number_format($datosa_enviar[$i]['valor'], 0, ',', '.')."</td>
			            <td>$ ".number_format($datosa_enviar[$i]['valor_pagado'], 0, ',', '.')."</td>
			        </tr>  ";
    	}
    	?>
    </tbody>
</table>  