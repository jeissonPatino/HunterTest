{
"data" : [
<?php 
    $i = 0;
    foreach($clientes as $key){
        if($i != 0){
           echo ',';
        }
        $deudor = trim(utf8_encode($key->DEUDOR));
        $nombre = substr($deudor, 0, 3);
?>
{
    "DEUDOR" :  "<span style='display: none;'><?=utf8_encode($nombre); ?></span>"<?=$deudor; ?>,
    "tipo_identificacion" : <?=$key->tipo_identificacion; ?> ,
    "IDENTIFICACION" : <?=$key->IDENTIFICACION; ?> ,
    "INTERMEDIARIO" : <?=utf8_encode($key->INTERMEDIARIO); ?> ,
    "OBLIGACION" : <?=$key->LIQUIDACION; ?>,
    "PROCESO_SAP" : <?=$key->PROCESO_SAP; ?> ,
    "VALOR_PAGADO" : <?= number_format($key->VALOR_PAGADO,  0, '.',','); ?> ,
    "ROL" : <?=$key->ROL; ?> ,
    "CIUDAD_DOMICILIO" :  <?=utf8_encode($key->CIUDAD_DOMICILIO); ?>
}
<?php              
      $i++;
    }
?>
]
}


