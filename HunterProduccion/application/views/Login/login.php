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
         <!--Estilo aplicaos CSS-->
       

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
         <style type="text/css">
            
            @media (max-width: 700px) { 
                 #logoHunter{
                    width: 100%;
                    height: auto;
                }
            }

            .button {
                  display: inline-block;
                  border-radius: 4px;
                  background-color: #101084;
                  border: none;
                  color: #FFFFFF;
                  text-align: center;
                  font-size: 20px;
                  padding: 10px;
                  width: 110px;
                  transition: all 0.5s;
                  cursor: pointer;
                  margin: 1px;
                }

                .button span {
                  cursor: pointer;
                  display: inline-block;
                  position: relative;
                  transition: 0.5s;
                }

                .button span:after {
                  content: '\00bb';
                  position: absolute;
                  opacity: 0;
                  top: 0;
                  right: -20px;
                  transition: 0.5s;
                }

                .button:hover span {
                  padding-right: 25px;
                }

                .button:hover span:after {
                  opacity: 1;
                  right: 0;
                }
                
                        
                #logoHunter:hover{
                    -webkit-transform:scale(1.3);
                    transform:scale(1.2);}
                
                 }
                 #esdato{
                     border-radius: 10px
                }

            </style>

    </head>
    <body class="hold-transition login-page" style="background: #ffffff;">
	
	<table style="background: #ffffff;">
	
		<tr class="row-md-12">
		
			<th class="col-md-5">
				<img  id="bg"  src="<?php echo base_url();?>assets/img/fondo_login2.jpg"  > 
			</th>
			<th class="col-md-2 col-md-offset-4">
				<div class="login-box">
					<div class="login-box-body" id="eslogin">
						<a href="#"><img src="<?php echo base_url();?>assets/img/HunterCRMLogo.png" id="logoHunter"></a>
					<p class="login-box-msg" style="color: black"><b>Datos de inicio de session</b></p>
					<form action="<?php echo base_url();?>login/logwraw" id="formLogin" method="post">
						<div class="form-group has-feedback">
							<input type="text" id="esdato" class="form-control" required value="<?php if(isset($usuario)){ echo $usuario; } ?>" name="usuario" placeholder="Usuario">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<input type="password" id="esdato" class="form-control" required name="password" placeholder="Contraseña">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="row">
							<div class="col-xs-8">
								<div  class="checkbox icheck">
									<label style="color: black">
										<input  style="lighting-color: black " type="checkbox" ><b> Recuerdame</b>
									</label>
								</div>
							</div><!-- /.col -->
							<div class="col-xs-4">
								<button class="button" ><span>Ingresar </span>
							</div><!-- /.col -->
						</div>
					</form>
					<a style="color: black" href="#"><b>Olvide mi contraseña</a><br>
					<br>
					<div class="login-logo">
						<a href="#"><img src="<?php echo base_url();?>assets/img/logo_fng.png" ></a>
					</div>
				</div><!-- /.login-box-body -->
				</div><!-- /.login-box -->
			</th>
		
		</tr>
	
       
      </table> 
	 
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
                     
                        element.style.width = '90%';
                        element.style.height = '18%';
                         
                        <!-- si la imagen es mas ancha que la ventana la centro -->
                        if (element.width > window.innerWidth){
                         
                            var ajuste = (window.innerWidth - element.width)/2;
                             
                            element.style.left = ajuste+'px';
                         
                        }
                     
                    }
                    else{  
                     
                        element.style.width = '90%';
                        element.style.height = '18%';
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
