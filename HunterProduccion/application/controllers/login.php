<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
	$this->load->model('autenticacion_model');
    }
    
    public function index()
    {

        if($this->session->userdata('login_ok')){
            redirect('home', 'refresh');
        }else{
            $this->load->view('Login/login');
        }
    }


    function logwraw()
    {
        //dyalogo1
        /* @var $_POST type */
        if (isset($_POST['usuario'])){
            $mail = utf8_decode($_POST['usuario']);
            $contrasena = $this->encriptaPassword($_POST['password']); //md5($_POST['password']);

            //echo $contrasena;
            if ($this->autenticacion_model->verificaUsuario($mail, $contrasena)){
                    $row = $this->autenticacion_model->getdatosUsuario($mail);
                    $datasession=null;
                    foreach ($row as $fila) {
                        //echo "Ciudad ".$fila->emp_ciudad;
                       $datasession = array(
                                            'codigo'                    => $mail,
                                            'nombres'                   => $fila->USUARI_Nombre____b,
                                            'identificacion'            => $fila->USUARI_ConsInte__b,
                                            'fecha'                     => $fila->USUARI_FechCrea__b,
                                            'tpo_usuario'               => $fila->USUARI_Cargo_____b,
                                            'codigo_abogado'            => $fila->G723_ConsInte__b,
                                            'frg'                       => $fila->USUARI_LlaveExte_b,
                                            'login_ok'                  => TRUE,
                                            'USUARI_asignacion_abogados_p'          => $fila->USUARI_asignacion_abogados_p
                                            ,'USUARI_asignacion_gestores_p'         => $fila->USUARI_asignacion_gestores_p
                                            ,'USUARI_configuracion_abogados_p'      => $fila->USUARI_configuracion_abogados_p
                                            ,'USUARI_configuracion_actuaciones_p'   => $fila->USUARI_configuracion_actuaciones_p
                                            ,'USUARI_configuracion_acuerdos_p'      => $fila->USUARI_configuracion_acuerdos_p
                                            ,'USUARI_configuracion_ciudades_p'      => $fila->USUARI_configuracion_ciudades_p
                                            ,'USUARI_configuracion_salario_p'       => $fila->USUARI_configuracion_salario_p
                                            ,'USUARI_configuracion_despachos_p'     => $fila->USUARI_configuracion_despachos_p
                                            ,'USUARI_configuracion_etapas_p'        => $fila->USUARI_configuracion_etapas_p
                                            ,'USUARI_configuracion_facturas_p'      => $fila->USUARI_configuracion_facturas_p
                                            ,'USUARI_configuracion_gastos_p'        => $fila->USUARI_configuracion_gastos_p
                                            ,'USUARI_configuracion_FRG_p'           => $fila->USUARI_configuracion_FRG_p
                                            ,'USUARI_configuracion_subgestiones_p'  => $fila->USUARI_configuracion_subgestiones_p 
                                            ,'USUARI_configuracion_usuarios_p'      => $fila->USUARI_configuracion_usuarios_p
                                            ,'USUARI_gestion_extrajudicial_p'       => $fila->USUARI_gestion_extrajudicial_p
                                            ,'USUARI_gestion_judicial_p'            => $fila->USUARI_gestion_judicial_p
                                            ,'USUARI_gestion_exfuncionarios_p'      => $fila->USUARI_gestion_exfuncionarios_p
                                            ,'USUARI_historico_extrajudicial_p'     => $fila->USUARI_historico_extrajudicial_p
                                            ,'USUARI_historico_judicial_p'          => $fila->USUARI_historico_judicial_p
                                            ,'USUARI_historico_medidas_p'           => $fila->USUARI_historico_medidas_p
                                            ,'USUARI_reportes_p'                    => $fila->USUARI_reportes_p
                                            ,'USUARI_configuracion_eliminarObligaciones_p' => $fila->USUARI_configuracion_eliminarObligaciones_p
                                            ,'Rep_asignacion_abogados_permiso_' => $fila->Rep_asignacion_abogados_permiso_
                                            ,'Rep_gestion_judicial_mensual_permiso_' => $fila->Rep_gestion_judicial_mensual_permiso_
                                            ,'Rep_subrogaciones_efectivas_permiso_' => $fila->Rep_subrogaciones_efectivas_permiso_
                                            ,'Rep_soporte_cisa_permiso_' => $fila->Rep_soporte_cisa_permiso_
                                            ,'Rep_radicacion_memorial_permiso_' => $fila->Rep_radicacion_memorial_permiso_
                                            ,'Rep_gestion_judicial_permiso_' => $fila->Rep_gestion_judicial_permiso_
                                            ,'Rep_reporte_medidas_cautelares_permiso_' => $fila->Rep_reporte_medidas_cautelares_permiso_
                                            ,'Rep_medidas_cautelares_efectivas_permiso_' => $fila->Rep_medidas_cautelares_efectivas_permiso_
                                            ,'firmas_abogados_permiso_' => $fila->firmas_abogados_permiso_
                                            ,'configurar_valores_conceptos_permisos_' => $fila->configurar_valores_conceptos_permisos_
                                            ,'cargar_devolucion_subrogaciones_permisos_' => $fila->cargar_devolucion_subrogaciones_permisos_
                                            ,'cargar_envio_subrogaciones_permisos_' => $fila->cargar_envio_subrogaciones_permisos_
                                            ,'subrogacion_permiso_' => $fila->subrogacion_permiso_
                                            ,'Sentencia_irrecuperable_permiso_' => $fila->Sentencia_irrecuperable_permiso_
                                            ,'cisa_permiso_' => $fila->cisa_permiso_
                                            ,'gastos_judiciales_permiso_' => $fila->gastos_judiciales_permiso_
                                            ,'Exportar_datos_adicionales_permisos_' => $fila->Exportar_datos_adicionales_permisos_
                                            ,'Eliminar_Gestiones_judiciales_permisos_' => $fila->Eliminar_Gestiones_judiciales_permisos_
                                            ,'cargar_fecha_terminacion_permisos_' => $fila->cargar_fecha_terminacion_permisos_
                                            ,'Eliminar_Facturas_permisos_' => $fila->Eliminar_Facturas_permisos_
                                             ,'GestionarDatosClientes' => $fila->GestionarDatosClientes
                                             ,'EliminarGestores' => $fila->EliminarGestores
                                             ,'Logeliminacion' => $fila->Logeliminacion
                                            );  
                    }			
                    $this->session->set_userdata($datasession);
                    //echo "logueado";
                    redirect('home', 'refresh');
                    
            } else {
                $data = array("usuario"=> $_POST['usuario'], "MSG" =>"Ups!! Usuario y/o Password incorrecto" );
                $this->load->view('Login/login', $data);
            }
            //
        } else {
            //$this->load->view('Login/Login_user_view');
        }
    }

    public function salir(){
        $this->session->sess_destroy();
        $this->load->view('Login/login');
        //header("Location: http://kuanto.info");
    }
	
	public function salirT(){
        $this->session->sess_destroy();
     
        //header("Location: http://kuanto.info");
    }
	
    function right($str, $length) {
       
         return substr($str, -$length);
    } 
    
    public function encriptaPassword($pass){

        $strCad =   "".chr(33).chr(41).chr(90).chr(94).chr(77).chr(33).chr(65).chr(183)."'".chr(83).chr(68).chr(33).chr(64).chr(41).chr(35).chr(40).chr(36).chr(36).chr(35).chr(64).chr(35).chr(41).chr(95).chr(33).chr(64).chr(68).chr(70).chr(65).chr(36)."CZ".chr(35).chr(60)."AJDA".chr(62).chr(60)."ASD".chr(33).chr(64).chr(35)."M".chr(35)."N".chr(36).chr(37)."N".chr(94)."M".chr(38)."N".chr(42)."K".chr(40)."s".chr(91) .chr(92).chr(124).chr(93).chr(91).chr(47).chr(46).chr(96).chr(45).chr(43).chr(61).chr(33)."2M2xz".chr(94)."a12_%#@&\|\/".chr(46)."`'[]=-{}-1#".chr(36)."f%A%__#A!_CA?()+_!@#".chr(36)."";

        $clave = "";
        $pass2 = "";
        $CAR = "";
        $Codigo = "";
        $strLen = "";

        
       // echo $strCad;

        if (is_null($pass) || $pass == ""){
            $pass = $strCad;

        }else{
            if(strlen($pass) > 126){
                echo "La palabra es muy larga para encriptar";   

            }

            if(strlen($pass) < 10){
                $strLen = "00".strlen($pass);
                
            }

            if(strlen($pass) > 10 && strlen($pass) < 100){
                $strLen = "0".strlen($pass);
            }
                                  
            if(strlen($pass) >= 100){
                $strLen = strlen($pass);
            }
            
            
            $pass = $pass . substr($strCad, strlen($pass), strlen($strCad)) . $strLen;
       
        }


        $clave = chr(33).chr(123).chr(37).chr(125).chr(252).chr(40).chr(38).chr(41).chr(64).chr(47).chr(42).chr(64).chr(96).chr(94).chr(64).chr(35).chr(36).chr(33).chr(95).chr(91).chr(93);
        $pass2 = "";

       
        $jose = '';
		
		for($i = 0; $i < strlen($pass); $i++){

            $CAR =  substr($pass, $i, 1);

            $Codigo = substr($clave, (($i - 1) % strLen($clave)) + 1, 1);
           
			if($Codigo == ''){
                //echo "<br> ".'aja';
                $Codigo = substr($clave, 0, 1);
            }
            //echo "<br> ITERACCION ".$i." CAR => ".$CAR." , Codigo => ".$this->vaores($Codigo);
            //echo "<br> Este es el que va => ".  $this->right("0". dechex(ord($Codigo) ^ ord($CAR)), 2);
            $pass2 = $pass2 . $this->right("0". dechex(ord($Codigo) ^ ord($CAR)), 2);

        } 
        return strtoupper($pass2);
     
    }   


/*
    //esto es para recuperar la contraseña
    public function recuperarPassword(){
        $mail = $_POST['mail']; 
        $final = explode('@', $mail);

        $email_subject = "Solicitud de cambio de contraseña";
        
        $email_message = "Por favor  has click en el siguiente enlace, en el podras modificar tus credenciales de acceso al sitio \n";
        $email_message .= "   Has click en el siguiente enlace (si no abre automaticamente, solo copialo y pegalo en tu navegador) \n ";
        $email_message .= "http://kuanto.info/login/modificar/".$final[0]."/".$final[1]." \n";
        $email_message .= "Esperamos la estes pasando bien y disfrutes de tu comunidad de construccion http://kuanto.info ... \n";
        $email_message .= "Atentamente \n";
        $email_message .= "Teknocom S de RL de CV.\n";


        $this->EnvioMensajesal($mail, $email_subject, $email_message);
        redirect('login', 'refresh');
    }

    public function modificar($mail, $proxi){
        $datos = array('email' => $mail."@".$proxi);
        return $this->load->view('Login/changePassword', $datos);
    }

    public function recuperarPasss(){
        $mail = $_POST['mail'];
        $this->load->model('autenticacion_model');
        $password  = $_POST['password'];
        //echo $mail;
        $row = $this->Autenticacion_Model->getdatosUsuario($mail);
        while($fila = mysql_fetch_array($row)){
            //echo $fila['emp_id'];
            $this->load->model('users_model');
            $datos = array( 'emp_password' => md5($password));
            if($this->Users_Model->updateUsers($datos, $fila['emp_id'])){
                $data = array("mail"=>  $mail, "MSG2" =>"Felicitaciones, tu contraseña se ha modificado exitosamente!!!" );
                $this->load->view('Login/Login_user_view', $data);
            }
               
        }

    }
    */
}
?>