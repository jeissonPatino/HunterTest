 <?php
# < alfonso.chavez@softtek.com >
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Cronjobs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        #$this->load->model('Configuraciones_Model');
    }

    public function cron_envia_mails() {
    	$mensaje = "";
        date_default_timezone_set('America/Bogota');
        ini_set('memory_limit', '-1');
        
        $archivo_log="C:\\xampp\\htdocs\\".date("Y-m-d")."-logmails-fng.txt";
        if(!file_exists($archivo_log)){
            $mensaje.= date("Y-m-d H:i:s")." Se ha creado el Archivo $archivo_log".PHP_EOL;
        }
        

        #PROCESO DE ENVIAR EMAILS.

        $mensaje.= date("Y-m-d H:i:s")." Tarea programada ejecutada con éxito.".PHP_EOL;
        if( $archivo=fopen($archivo_log, "a") ){
            fwrite($archivo, $mensaje);
            fclose($archivo);
        }
        exit(0);
    }

}
?>
