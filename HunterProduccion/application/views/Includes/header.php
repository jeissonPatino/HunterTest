<header class="main-header">
    <!-- estilos-->
      
    <!-- Logo -->
    <a href="<?php echo base_url();?>home" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?php echo base_url();?>assets/img/HunterCRMLogo.png" style=" width: 100%; height: auto;" id="logoHunter"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  role="navigation" >
           <span class="fechact">
                <?php  
                    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","             Octubre","Noviembre","Diciembre");
                     echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
                 ?>
                     
            </span>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                 <!-- Tasks: style can be found in dropdown.less -->
                <li></li> 
                <li class="dropdown messages-menu" id="menuTask">

                 </li>
                <li class="dropdown messages-menu" id="menuTask"> 
                        <a href="<?php echo base_url();?>login/salir" > Cerrar Sesión </a>  
                </li> 
            </ul>
        </div>
    </nav>
</header>
   <link rel="stylesheet"  href="<?php echo base_url();?>assets/bootstrap/css/estilos.css">
<script type="text/javascript">
    $(function(){
        $.ajax({
            url    : '<?php echo base_url();?>tareas/getTareas',
            type   : 'POST',
            success: function(data){
                $("#menuTask").html(data);
            }
        });
    }); 

</script>