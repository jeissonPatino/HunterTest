<?php 
if (!defined('BASEPATH'))exit('No direct script access allowed');
class EnvioCorreo extends CI_Controller {

    function __construct() {
       /* parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('email');
        $this->load->database();*/

       // $this->load-> library('database');

    }
    function email(){
        set_time_limit(1200);
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        #use PHPMailer\PHPMailer\PHPMailer;
        #use PHPMailer\PHPMailer\Exception;
        #use PHPMailer\PHPMailer\SMTP;
        //Load Composer's autoloader
        //require 'vendor/autoload.php';

        require 'Application/libraries/PHPMailer/src/PHPMailer.php';
        require 'Application/libraries/PHPMailer/src/Exception.php';
        require 'Application/libraries/PHPMailer/src/SMTP.php';


        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
          $Mail = new PHPMailer();
          $Mail->IsSMTP(); // Use SMTP
          $Mail->Host        = "smtp-mail.outlook.com"; // Sets SMTP server
          $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
          $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
          //$Mail->SMTPSecure  = "tls"; //Secure conection
          $Mail->Port        = 587; // set the SMTP port
          $Mail->Username    = 'daci12000@hotmail.com'; // SMTP account username
          $Mail->Password    = 'Al3jandr0$$'; // SMTP account password
          $Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
          $Mail->CharSet     = 'UTF-8';
          $Mail->Encoding    = '8bit';
          $Mail->Subject     = 'Test Email Using Gmail';
          $Mail->ContentType = 'text/html; charset=utf-8\r\n';
          $Mail->From        = 'daci12000@hotmail.com';
         // $Mail->FromName    = 'GMail Test';
          $Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

          $Mail->AddAddress( 'adriana.bobes@softtek.com' ); // To:
          $Mail->isHTML( TRUE );
          $Mail->Body    = 'asdasd';
          $Mail->AltBody = 'asdasdasd';
          $Mail->Send();
          $Mail->SmtpClose();

          if ( $Mail->IsError() ) { 
            echo "ERROR<br /><br />";
          }
          else {
            echo "OK<br /><br />";
          }
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }


    }
}
 ?>