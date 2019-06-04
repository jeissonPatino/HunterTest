 <?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Achb extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }


    public function pruebas(){
        $this->load->library('email');
		$mail_config['smtp_host'] 		= 'smtp-mail.outlook.com';//'smtp.gmail.com';
		$mail_config['smtp_port'] 		= '587';
		$mail_config['smtp_user'] 		= 'jeison_9503@hotmail.com';
		$mail_config['_smtp_auth'] 		= TRUE;
		$mail_config['smtp_pass'] 		= '*/3005089502*/';
		$mail_config['smtp_crypto'] 	= 'tls';
		$mail_config['protocol'] 		= 'smtp';
		$mail_config['mailtype'] 		= 'html';
		$mail_config['send_multipart'] 	= FALSE;
		$mail_config['charset'] 		= 'utf-8';
		$mail_config['wordwrap'] 		= TRUE;
		$this->email->initialize($mail_config);
		$this->email->set_newline("\r\n");
		$this->email->from('alfonso.chb@gmail.com','Gateway Restaurent Contact');
		$this->email->to('alfonso.chb@gmail.com'); 
		$this->email->subject('Gateway Restaurent Contact Enquiry');
		$this->email->message("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");  
		$send = $this->email->send();
		if($send) {
			#echo json_encode("send");
			echo "Siiiiiiiiii";
		}else{
			$error = $this->email->print_debugger(array('headers'));
			#echo json_encode($error);
			echo "Nooooooooo";
		}
		echo $this->email-> print_debugger();
		die("FIN");
    }


    public function enviar_email(){
    	date_default_timezone_set('Etc/UTC');
       	$this->load->library('email');
       	$config = array(
       		'smtp_crypto' 	=> 'tls',
            'protocol'      => 'smtp', //Indicamos el protocolo a utilizar
            'smtp_host'     => 'smtp-mail.outlook.com', //El servidor de correo que utilizaremos
            'smtp_user'     => 'jeison_9503@hotmail.com', //Nuestro usuario
            'smtp_pass'     => '*/3005089502*/', //Nuestra contraseña
            'smtp_port'     => '587', //El puerto que utilizará el servidor smtp
            'charset'       => 'utf-8', //El juego de caracteres a utilizar
            'newline'    	=> '\r\n',
            '_smtp_auth'	=> TRUE,
            'wordwrap'      => TRUE, //Permitimos que se puedan cortar palabras
            'validate'      => true //El email debe ser valido 
        );
        
        #require 'PHPMailerAutoload.php';
        $cuerpoCorreo = '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    	<html>
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Alertas Hunter</title></head>
        <body>aaaaaaaaaaaaaaaaaaaaa</body>
        </html>';
       	//Cargamos la librería email
        $this->email->initialize($config);//Establecemos esta configuración
        $this->email->set_newline("\r\n");
        $this->email->from('alertas.hunter@fng.gov.co', 'aaaaaaaaaaaaaaaaaa');//Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->to('alfonso.chb@gmail.com', 'bbbbbbbbbbbbbb'); //Ponemos el o los destinatarios para los que va el email en este caso al ser un formulario de contacto te lo enviarás a ti mismo
        $this->email->subject("asuntooooooooooooooooooo"); //Definimos el asunto del mensaje
        $this->email->message( $cuerpoCorreo );//Definimos el mensaje a enviar
        if($this->email->send()){
            echo "Email enviado correctamente";
        }else{
            echo "No se a enviado el email";
        }
        echo $this->email->print_debugger();
        die("FIN");
    }


    public function mail(){
    	$this->load->library('My_PHPMailer');
		try {
            $Mail = new PHPMailer(true);
            $Mail->IsSMTP(); // Use SMTP
            $Mail->Host        = "smtp-mail.outlook.com"; // Sets SMTP server
            $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
            $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
              //$Mail->SMTPSecure  = "tls"; //Secure conection
            $Mail->Port        = 587; // set the SMTP port
            $Mail->Username    = 'jeison_9503@hotmail.com'; // SMTP account username
            $Mail->Password    = '*/3005089502*/'; // SMTP account password
            $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
            $Mail->CharSet     = 'UTF-8';
            $Mail->Encoding    = '8bit';
            $Mail->Subject     = 'Test Email Using Gmail';
            $Mail->ContentType = 'text/html; charset=utf-8\r\n';
            $Mail->From        = 'daci12000@hotmail.com';
             // $Mail->FromName    = 'GMail Test';
            $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line
            $Mail->AddAddress( 'alfonso.chb@gmail.com' ); // To:
            $Mail->isHTML( TRUE );
            $Mail->Body    = "Cuerpo del correoooooooooooooooooooooooooooooo";
            $Mail->AltBody = 'asdasdasd';
            $Mail->Send();
            $Mail->SmtpClose();
            if ( $Mail->IsError() ) { 
                echo "ERROR";
            }else {
                echo "OKkkkkk";
            }
        }catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $Mail->ErrorInfo;
        }
    }



}
?>
