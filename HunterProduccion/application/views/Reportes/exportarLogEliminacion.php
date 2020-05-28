<?php
    header("Content-type: application/vnd.ms-excel; charset=utf-8");
   header("Content-Disposition: attachment; filename=Log_de_Eliminacion.xls"); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<table class="table table-hover table-bordered" id ="Extra">

        <thead>
            <tr >
                <th style="text-align:center;">Eliminacion Gestion Extrajudicial</th>
            </tr>
            <tr>
                <th style="text-align:center;">Nombre de Usuario que Elimin&oacute;</th>     
                <th style="text-align:center;">No. Identificaci&oacute;n</th>
                <th style="text-align:center;">Cargo Usuario</th>
                <th style="text-align:center;">Fecha de Eliminaci&oacute;n</th>
                <th style="text-align:center;">No. Liquidaci&oacute;n Eliminada</th>
            </tr>
        </thead>    

    <tbody>
        <?php
        $data =  json_decode($ResultadoExtrajudicial);
                    foreach($data as $key){

                            echo "<tr>
                                    <td>".$key->NombreUsuario."</td>
                                    <td>".$key->Identificacion."</td>
                                    <td>".$key->Cargo."</td>
                                    <td>".$key->Fechaeliminacion."</td>
                                    <td>".$key->NumeroLiquidacioneliminado."</td>
                                </tr>";
                    }    
                ?> 
    </tbody>
</table>   
       
<table class="table table-hover table-bordered">
    <tr>
        <tr>
            <tr>
                <thead>
                    <tr>
                        <th style="text-align:center;">Eliminacion Gestion Judicial</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Nombre de Usuario que Elimin&oacute;</th>     
                        <th style="text-align:center;">No.Identificaci&oacute;n</th>
                        <th style="text-align:center;">Cargo Usuario</th>
                        <th style="text-align:center;">Fecha de ELiminaci&oacute;n</th>
                        <th style="text-align:center;">No. Liquidaci&oacute;n Eliminada</th>
                    </tr>
                </thead>
            </tr>
        </tr>
    </tr>
    <tbody>
        <?php
        $datos =  json_decode($ResultadoJudicial);
                    foreach($datos as $key){

                            echo "<tr>
                                    <td>".$key->NombreUsuario."</td>
                                    <td>".$key->Identificacion."</td>
                                    <td>".$key->Cargo."</td>
                                    <td>".$key->Fechaeliminacion."</td>
                                    <td>".$key->NumeroLiquidacioneliminado."</td>
                                </tr>";
                    }    
                ?>
    </tbody>
</table>    
<table class="table table-hover table-bordered">
    <tr>
         <tr>
            <tr>
                <tr>
                    <th style="text-align:center;" >Eliminacion Usuarios</th>
                </tr>
                <thead>
                    <tr>
                      <th style="text-align:center;">Nombre de Usuario que Elimin&oacute;</th>     
                      <th style="text-align:center;">No.Identificaci&oacute;n</th>
                      <th style="text-align:center;">Cargo Usuario</th>
                      <th style="text-align:center;">Fecha de ELiminaci&oacute;n</th>
                      <th style="text-align:center;">Usuario Eliminado</th>
                      <th style="text-align:center;">No. Identifiaci&oacute;n Usuario Eliminado</th>
                      <th style="text-align:center;">Cargo Usuario eliminado</th>
                    </tr>
                </thead>    
            </tr> 
        </tr> 
    </tr> 
    <tbody>
        <?php
        $datoss =  json_decode($ResultadoUsuarios);
                    foreach($datoss as $key){

                            echo "<tr>
                                    <td>".$key->NombreUsuario."</td>
                                    <td>".$key->Identificacion."</td>
                                    <td>".$key->Cargo1."</td>
                                    <td>".$key->Fechaeliminacion."</td>
                                    <td>".$key->UsuEliminado."</td>
                                    <td>".$key->NoId."</td>
                                    <td>".$key->Cargo."</td>
                                </tr>";
                    }    
                ?> 
    </tbody>
</table>   