<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="<?php echo base_url();?>assets/img/HunterCRMLogo.png" style=" width: 100%; height: auto;" id="logoHunter"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?php echo base_url();?>assets/img/HunterCRMLogo.png" style=" width: 100%; height: auto;" id="logoHunter"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                 <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown messages-menu" id="menuTask">

                </li>    
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo utf8_encode($this->session->userdata('nombres'));  ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                                <?php echo utf8_encode($this->session->userdata('nombres')); ?>
                                <?php 
                                    $fecha = $this->session->userdata('fecha');
                                    $meses = array('Ene', 'Feb', 'marzo', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
                                    $otra = explode('-',$fecha);
                                    $num = $otra[1] - 1;
                                   
                                    echo "<small>Miembro desde ". $meses[$num]." ". $otra[0]."</small>";
                                ?>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Acerca de</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url();?>login/salir" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                
            </ul>
        </div>
    </nav>
</header>

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