
<a href="#" class="dropdown-toggle" title="Tareas" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-success"><?php echo $count;?></span>
</a>
<ul class="dropdown-menu">
    <li class="header">Tienes <?php echo $count;?> tareas pendientes</li>
    <li>
    <!-- inner menu: contains the actual data -->
        <ul class="menu">
            <?php foreach ($tareas as $key) { 
                $fecha = explode(' ', $key->fecha_ejecucion)[0];
                $hora  = explode(' ', $key->hora_ejecucion);

                $fecha = explode('-', $fecha);

    
            ?>
                    <li><!-- start message -->
                        <a href="<?php echo base_url();?>tareas/detalleTarea/<?php echo $key->G738_ConsInte__b;?>">
                           
                            <h4>
                                Liquidación N° <?php echo $key->contrato_ejecucion;?> 
                 
                            </h4>
                            <p><?php echo $key->descripcion;?></p>
                            <p><small><i class="fa fa-clock-o"></i>Fecha Ejecución : <?php echo $fecha[2]."/".$fecha[1]."/".$fecha[0];?></small></p>
                            <p>&nbsp;&nbsp;&nbsp;<small><i class="fa fa-clock-o"></i>Hora Ejecución : <?php echo $hora[1];?></small></p>
                        </a>
                    </li><!-- end message -->
            <?php } ?>

        </ul>
    </li>
    <li class="footer">
        <a href="#">Ver Todas las Tareas</a>
    </li>
</ul>
            