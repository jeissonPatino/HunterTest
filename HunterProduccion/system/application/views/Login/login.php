<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hunter | Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/ionicons-master/css/ionicons.min.css">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/alertify.core.css">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/alertify.default.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            #bg{
                position:fixed;
                top:0;
                left:0;
                z-index:-1;
            }
            @media (max-width: 700px) { 
                 #logoHunter{
                    width: 100%;
                    height: auto;
                }
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <img id="bg" src="<?php echo base_url();?>assets/img/fondo_Nal.png"  alt="background" /> 
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><img src="<?php echo base_url();?>assets/img/HunterCRMLogo.png" id="logoHunter"></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Datos de inicio de session</p>
                <form action="<?php echo base_url();?>login/logwraw" id="formLogin" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" required value="<?php if(isset($usuario)){ echo $usuario; } ?>" name="usuario" placeholder="Usuario">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" required name="password" placeholder="Contraseña">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Recuerdame
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <a href="#">Olvide mi contraseña</a><br>
                <br>
                <div class="login-logo">
                    <a href="#"><img src="<?php echo base_url();?>assets/img/dyaologo.png">
                </div><!-- /.login-logo -->
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>

        <script src="<?php echo base_url();?>assets/dist/js/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
        <script type="text/javascript">
            $.validator.setDefaults({
                submitHandler: function() { 
                     $("#formLogin").submit();
                }
            });
            $(function(){
               <?php 
                if(isset($MSG)){
               ?>
                  alertify.error("<?php echo $MSG; ?>");     
               <?php        
                }else if(isset($MSG2)){

               ?>
                  alertify.success("<?php echo $MSG2; ?>");     
               <?php    
                }
               ?>

               $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });

               
            });


            window.onload = function() {
             
                function bgadj(){
                         
                    var element = document.getElementById("bg");
                     
                    var ratio =  element.width / element.height;   
                     
                    if ((window.innerWidth / window.innerHeight) < ratio){
                     
                        element.style.width = 'auto';
                        element.style.height = '100%';
                         
                        <!-- si la imagen es mas ancha que la ventana la centro -->
                        if (element.width > window.innerWidth){
                         
                            var ajuste = (window.innerWidth - element.width)/2;
                             
                            element.style.left = ajuste+'px';
                         
                        }
                     
                    }
                    else{  
                     
                        element.style.width = '100%';
                        element.style.height = 'auto';
                        element.style.left = '0';
             
                    }
                     
                }
            //llamo a la función bgadj() por primera vez al terminar de cargar la página -->
                bgadj();
            //osvuelvo a llamar a la función  bgadj() al redimensionar la ventana -->
                window.onresize = function() {
                    bgadj();
             
                }
             
            }
        </script>
    </body>
</html>
