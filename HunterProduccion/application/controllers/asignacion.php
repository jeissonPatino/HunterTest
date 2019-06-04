 <?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Asignacion extends CI_Controller {

    public function __construct() {

        parent::__construct();

        
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
		$this->load->model('Obligaciones_Model');



    }
    // Se crea la funcion complearZerosProcesoSAP  Jeisson Patiño 10/01/2019

    

    public function abogadosFrg() {
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Asignacion abogados Frg');
            $abogados = $this->Configuraciones_Model->getAbogados();
			$datosFooter = array('ul'=> 'ULasignacion' , 'li' => 'LIabogados');
			
			
            $datos = array('abogados' => $abogados, 'otroAbogad' => $abogados );
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Asignacion/abogadosFrg', $datos);
            $this->load->view('Includes/footer', $datosFooter);
            $this->load->library('My_PHPMailer');
        }else{
            $this->load->view('Login/login');
        }
        

    }


    function carguemasABogados(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
            $usuarios = '';
            $filtro = $_POST['filtro'];
            $abogado = $_POST['cmbAbogados'];


            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','128M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $k = 1;
            $frg = '';
            
            $i = 1;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != ""){
                        if($this->Wizard_Model->validarSAP($value['A'])){
                            $datos = array(
                                'G719_C17153' => $abogado ,
                                'G719_C17051' => $fechaIngreso
                              );
                            $resultado = false;
                            $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], $filtro);

                            if($resultado){
                                $acertados += 1;
                                $this->db->select(' TOP 1 G717_C17240 as Deudor, G717_C17005 as identificacion,
                                                    G717_C17006 as TelefonoD, G717_C17008 as TelefonoO,
                                                    G737_C17182 As No_CONTRATO,  
                                                    G737_C17183 AS ROL ,
                                                    G719_C17423 as OBLIGACION,
                                                    G719_C17039 as SAP,  
                                                    G733_C17132 as Despacho,
                                                    G718_C17015 as ciudaddespacho,
                                                    G719_C17043 as radicado,
                                                    G729_C17121 as frg');
                                $this->db->from('G717');
                            
                                $this->db->join('G737', 'G717_ConsInte__b = G737_C17181');
                                $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
                                $this->db->join('G718', 'G718_ConsInte__b = G719_C17041', 'LEFT');
                                $this->db->join('G733', 'G733_ConsInte__b = G719_C17040', 'LEFT');
                                $this->db->join('G729', 'G729_ConsInte__b = G719_C17029', 'LEFT');
                                $this->db->where('G719_C17039', $value['A']);
                                $query  = $this->db->get();
                                $resultados = $query->result();
                                
                                foreach ($resultados as $key ) {
                                    $frg = $key->frg;
                                    $usuarios .= "<p>".$k.". ".utf8_encode($key->Deudor)." identificado con C.C. / NIT. ".$key->identificacion.", ".utf8_encode($key->Despacho)." de ".utf8_encode($key->ciudaddespacho).", expediente No. ".$key->radicado.", con No. de proceso SAP ".$key->SAP.".</p>";
                                    $k++;
                                }

                               
                                /*$tabla .= "<tr><td>".$k." ".$value['A']."</td><td><table  width=*'100%'>".$usuarios."</table></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>";*/

                            }else{
                                $fallos +=1;
                            }
                        }else{
                            $fallosExistenciales +=1;
                        }
                        
                    }else{
                        $validador += 1;
                    }

                     $i++;
                }
            }

            //$this->envioCorreoMaxibo($usuarios, $abogado, $frg);

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }

    }


    public function completarZerosProcesoSAP( $proceso ){
        if ( strlen($proceso)>=7 ) {
            return $proceso;
        }else{
            return str_pad(trim($proceso), 10, '0', STR_PAD_LEFT);
        }
    }



    function cargueABogados(){
        if($this->session->userdata('login_ok')){

            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
            $filtro = $_POST['filtro']; 
            $abogado = $_POST['cmbAbogados'];
            $sap = $_POST['txtnumeroSap'];
            $proceso = $this->completarZerosProcesoSAP($sap);

            if( $this->Wizard_Model->validarSAP($proceso)){
                $datos = array(
                                    'G719_C17153' => $abogado ,
                                    'G719_C17051' => $fechaIngreso
                                  );
                $resultado = false;
                $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $proceso, $filtro);

                if($resultado){  
                    //$this->mandarCorreo($sap, $abogado); 
                    echo "1";
                }else{
                    echo "No";
                }
            }else{
                echo 'NOP';
            }

        }else{
            $this->load->view('Login/login');
        }
    }


    

    public function gestores() {
		
		if($this->session->userdata('login_ok')){
            $data = array('title' => 'Asignar Gestores');
			$datosFooter = array('ul'=> 'ULasignacion' , 'li' => 'LIgestores');
			
			$gestores = $this->Configuraciones_Model->getGestores();
			$datos = array('getsores' => $gestores, 'otrosgestores' => $gestores);
			$this->load->view('Includes/head', $data);
			$this->load->view('Includes/header');
			$this->load->view('Includes/sidebar');
			$this->load->view('Asignacion/gestores', $datos);
			$this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
        
    }
	
	
	
    function carguemasGestores(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMax'];
            $abogado = $_POST['cmbGetsoresMax'];

			
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','256M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $validador = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }

                    if($value['A'] != ""){
						$i++;
                            $datos = array(
                                    'G719_C17347' => $abogado ,
                                    'G719_C17393' => $fechaIngreso
                                  );
                            $resultado = false;
    						if($filtro != 'G719_C17026'){
    							if($filtro == 'IDENTIFICACION' ){
                                    $idUseuraruio = false;
    								$idUseuraruio = $this->Obligaciones_Model->validarIdUsuario($value['A']);
                                    if(!$idUseuraruio){
                                        $fallosExistenciales +=1;
                                    }else{
                                        $contratos = $this->Obligaciones_Model->getContratos($idUseuraruio);
                                        foreach($contratos as $key){
                                            $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $key->No_CONTRATO, 'G719_ConsInte__b');
                                        
                                        } 
                                    }
    								
    							}else if($filtro == 'G719_C17423'){
    								$contrato = 0;
                                    $contrato = $this->Obligaciones_Model->getIdObligacionByLiquidacion($value['A']);

                                    if($contrato != 0){
                                        $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], $filtro);
                                    }else{
                                        $fallosExistenciales +=1;
                                    }
    							}
    							
    						}else{
                                $contrato = 0;
                                $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);

                                if($contrato != 0){
                                    $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], $filtro);
                                }else{
                                    $fallosExistenciales +=1;
                                }
    							
    						}
                            

                            if($resultado){
                                $acertados += 1;
                            }else{
                                $fallos += 1;
                            }
                        

                    }else{
                        $validador += 1;
                    }
                }
            }

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }

    }

    function cargueGestores(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltros'];
            $abogado = $_POST['cmbGetsores'];
            $sap = $_POST['exampleInputFile'];
			

            $datos = array(
						'G719_C17347' => $abogado ,
						'G719_C17393' => $fechaIngreso
					  );
            $resultado = false;
			if($filtro != 'G719_C17026'){
				if($filtro == 'IDENTIFICACION' ){
					$idUseuraruio = $this->Obligaciones_Model->getIdUsuario($sap);
					$contratos = $this->Obligaciones_Model->getContratos($idUseuraruio);
					foreach($contratos as $key){
						
					$resultado = $this->Wizard_Model->editarDatos('G719', $datos, $key->No_CONTRATO, 'G719_ConsInte__b');
					}
				}else if($filtro == 'G719_C17423'){
                    $contrato = 0;
                    $contrato = $this->Obligaciones_Model->getIdObligacionByLiquidacion($sap);

                    if($contrato != 0){
                        $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $sap , $filtro);
                    }else{
                        $fallosExistenciales +=1;
                    }
                }
				
			}else{
				$resultado = $this->Wizard_Model->editarDatos('G719', $datos, $sap, $filtro);
			}

            if($resultado){
               echo "1";
            }else{
               echo "No";
            }

        }else{
            $this->load->view('Login/login');
        }
    }


 	/*public function abogadosAux() {
        $data = array('title' => 'Asignacion abogados Auxiliares');
        $this->load->view('Includes/head', $data);
        $this->load->view('Includes/header');
        $this->load->view('Includes/sidebar');
        $this->load->view('Asignacion/abogadosAux');
        $this->load->view('Includes/footer');
    }
   

public function gestoresAux() {
        $data = array('title' => 'Asignar Gestores AUX');
        $this->load->view('Includes/head', $data);
        $this->load->view('Includes/header');
        $this->load->view('Includes/sidebar');
        $this->load->view('Asignacion/gestoresAux');
        $this->load->view('Includes/footer');
    }
   	





    public function frg() {
        $data = array('title' => 'Frg');
        $this->load->view('Includes/head', $data);
        $this->load->view('Includes/header');
        $this->load->view('Includes/sidebar');
        $this->load->view('Asignacion/frg');
        $this->load->view('Includes/footer');
    }


    public function frgAux() {
        $data = array('title' => 'Frg Aux');
        $this->load->view('Includes/head', $data); 
        $this->load->view('Includes/header');
        $this->load->view('Includes/sidebar');
        $this->load->view('Asignacion/frgAux');
        $this->load->view('Includes/footer');
    }


    
¨*/
    
    function carguemasPoliza(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['filtro2'];

            $name   = $_FILES['FilExcell2']['name'];
            $tname  = $_FILES['FilExcell2']['tmp_name'];
            ini_set('memory_limit','128M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != ""){
                        if($this->Wizard_Model->validarSAP($value['A'])){
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha4 = NULL;
                            $fecha5 = NULL;
                            $fecha = NULL;
                            $fechas = NULL;
                            //$anho = 2015;
                            //$actual = date('y');
                            //$anho = $actual - 1;

                            $fecha  = explode('/', $value['C']);
                            //$anho = $fecha[2];
                            $fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                            $fechas  = explode('/', $value['D']);
                            $fecha3 = $fechas[2]."-".$fechas[1]."-".$fechas[0];

                            //$fechas2  = explode('/', $value['E']);
                            //$fecha4 = $fechas2[2]."-".$fechas2[1]."-".$fechas2[0];

                           

                            $datos = array(
                                'G719_C17054' => $value['B'], //poliza ,
                                'G719_C17056' => $fecha2, //FEcha aprovacion poliza$fechaIngreso
                                'G719_C17055' => $fecha3 //FEcha cvencimiento poliza poliza$fechaIngreso
                                
                            );
                            $resultado = false;
                            $this->db->where('G719_C17039',  $value['A'] );
                            $resultado = $this->db->update('G719', $datos);
                            //$resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], $filtro);

                            if($resultado){
                                $acertados += 1;
                            }else{
                                $fallos +=1;
                            }
                        }else{
                            $fallosExistenciales +=1;
                        }
                        
                    }else{
                        $validador += 1;
                    }

                     $i++;
                }
            }

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }

    }


    function envioCorreoMaxibo($usuarios, $abogado, $frg){
         $this->load->library('My_PHPMailer');
        $abogados = $this->Configuraciones_Model->getAbogadoById($abogado);
        $correo = NULL;
        $nombre = NULL;
        foreach ($abogados as $key) {
            if(!is_null($key->correo)){
                $correo = $key->correo;
                $nombre = utf8_encode($key->Nombre);
            }
        }

$NewCorreo = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Alertas Hunter</title>
    </head>
    <body>
        <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 12px;text-align:justify;">
            <h4>Estimado(a) Dr.(a). '.$nombre.' </h4>
            
            <p> 
             El FNG le recuerda que tiene un plazo de 25 días para radicar el memorial de subrogación de el (los) cliente (s) que se relacionan a continuación, contados a partir de la fecha de recibo de este mensaje. En el evento en que no reciba el (los) memorial (es) de subrogación, le solicitamos ponerse en contacto con el '.$frg.'.
            </p>
            <p style="text-align:center;"> 
                '.$usuarios.'
            </p>
            <P>
                Le solicitamos presentar este documento en el menor tiempo posible, debido a que para el FNG es indispensable estar reconocido dentro del proceso como acreedor subrogatario. Recuerde que la radicación oportuna del memorial de subrogación es una manera de medir su gestión como abogado del FNG.  
            </P>
            <p>
                Cordialmente,
            </p>
            </br>
            <p>
                Subdirección de Procesos Judiciales</br>
                <b>FONDO NACIONAL DE GARANTÍAS S.A - FNG</b></br>
                Calle 26 A No. 13-97 Piso 25</br>
                Bogotá D.C. - Colombia</br>
                www.fng.gov.co
            </p>
            </br>
            </br>
            <p>
                MANEJO Y PROTECCIÓN DE DATOS PERSONALES - Este mensaje (incluyendo cualquier archivo adjunto) se dirige exclusivamente a su destinatario y contiene información personal confidencial y/o privilegiada que se encuentra protegida por la Ley. En consecuencia, la información aquí contenida sólo puede ser utilizada por la persona o compañía a la cual está dirigido. Si ha recibido este mensaje por error, por favor comuníquese inmediatamente con nosotros por esta misma vía y proceda a su eliminación. Recuerde que los datos personales aquí contenidos pertenecen a cada uno de sus Titulares y/o al Fondo Nacional de Garantías S.A. - FNG, y que su Tratamiento sólo se encuentra legitimado si se cuenta con autorización para un Responsable determinado y con unas finalidades previamente informadas a éste. En consecuencia queda prohibido su Tratamiento y cesión so pena de sanciones civiles, administrativas, e incluso penales. Finalmente, señalamos que es responsabilidad del destinatario protegerse de la existencia de posibles virus informáticos que pudiera llegar a tener el correo o cualquier anexo a él, razón por la cual el FNG no aceptará responsabilidad alguna por daños causados por cualquier virus transmitido en este correo.
            </p>
        </div>
    </body>
</html>';
        if(!is_null($correo)){
            $Newmail = new PHPMailer;
            //Tell PHPMailer to use SMTP
            $Newmail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $Newmail->SMTPDebug = 0;
            //Newmail for HTML-friendly debug output
            $Newmail->Debugoutput = 'html';
            //Set the hostname of the mail server
            $Newmail->Host = "192.168.1.122";
            //Set the SMTP port number - likely to be 25, 465 or 587
            $Newmail->Port = 25;
            //Whether to use SMTP authentication
            $Newmail->SMTPAuth = false;
            //Username to use for SMTP authentication
            $Newmail->Username = "alertas.hunter@fng.gov.co";
            //Password to use for SMTP authentication
            $Newmail->Password = "abcd$1234";
            //Set who the message is to be sent from
            $Newmail->setFrom('alertas.hunter@fng.gov.co', 'Alertas Hunter');
            //Set an alternative reply-to address
           // $Newmail->addReplyTo('angelica.agudelo@fng.gov.co', 'Angelica Agudelo');
            $Newmail->addReplyTo('josegiron@outlook.es', 'Jose Giron');
            //Set who the message is to be sent to
            $Newmail->addAddress($correo, $nombre);
            //Set the subject line
            

            $Newmail->Subject = 'ALERTAS HUNTER - ASIGNACIÓN  DE ABOGADOS';
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $Newmail->msgHTML($NewCorreo);
            //Replace the plain text body with one created manually
            $Newmail->AltBody = '“Antes de imprimir este e-mail, evalúa si realmente es necesario hacerlo. ¡Cuidemos el ambiente!”';
            //Attach an image file
            //$mail->addAttachment('examples/images/phpmailer_mini.png');
            $Newmail->CharSet = 'UTF-8';
            //send the message, check for errors
            if (!$Newmail->send()) {
                echo "Mailer Error A diana: " . $Newmail->ErrorInfo;
            }

        }
    }

    function supercargueFNG(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Asignacion abogados Frg');
            $abogados = $this->Configuraciones_Model->getAbogados();
            $datosFooter = array('ul'=> 'ULasignacion' , 'li' => 'LIabogadosSuer');
            
            
            $datos = array('abogados' => $abogados, 'otroAbogad' => $abogados );
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Asignacion/abogadosFrgFNG', $datos);
            $this->load->view('Includes/footer', $datosFooter);
            $this->load->library('My_PHPMailer');
        }else{
            $this->load->view('Login/login');
        }
    }

    function carguemasAbogadosSuperFNG(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
           
            
            $filtro = $_POST['filtro'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','128M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $k = 1;
            $frg = '';
            
            $i = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != ""){
                        if($this->Wizard_Model->validarSAP($value['A'])){

                            $fechaAsignacin = explode('/', $value['B']);
                            $fechaAbogado = $fechaAsignacin[2]."-".$fechaAsignacin[1]."-".$fechaAsignacin[0];

                            $abogado = $this->cambiar($value['C']);
                            $abogados = $this->Configuraciones_Model->getAbogados();
                            $abogadoFinal = NULL;

                            foreach ($abogados as $key) {
                                if(strtoupper($abogado) == strtoupper($this->cambiar(utf8_encode($key->Nombre)))){
                                    $abogadoFinal = $key->id;
                                }
                            }

                            if(!is_null($abogadoFinal)){
                                $datos = array(
                                    'G719_C17153' => $abogadoFinal ,
                                    'G719_C17051' => $fechaAbogado
                                );


                                $resultado = false;
                                $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], $filtro);

                                if($resultado){
                                    $acertados += 1;
                                }else{
                                    $fallos +=1;
                                }
                            }                            
                        }else{
                            $fallosExistenciales +=1;
                        }
                        
                    }else{
                        $validador += 1;
                    }

                     $i++;
                }
            }

            //$this->envioCorreoMaxibo($usuarios, $abogado, $frg);

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }

    }


    function SUperCargueABogados(){
        if($this->session->userdata('login_ok')){
            
            $filtro = $_POST['filtro'];
            $abogado = $_POST['cmbAbogados'];
            $sap = $_POST['txtnumeroSap'];
            $fecha = $_POST['txtfecha'];
            $proceso = $this->completarZerosProcesoSAP($sap);

            if( $this->Wizard_Model->validarSAP($proceso)){

                $datos = array(
                                    'G719_C17153' => $abogado ,
                                    'G719_C17051' => $fecha
                                  );
                $resultado = false;
                $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $proceso, $filtro);

                if($resultado){  
                    //$this->mandarCorreo($sap, $abogado); 
                    echo "1";
                }else{
                    echo "No";
                }
            }else{
                echo 'NOP';
            }

        }else{
            $this->load->view('Login/login');
        }
    }

    function cambiar ($div){
        $n_div= str_replace(" ","-",$div);
        $n_div=str_replace("á","a",$n_div);
        $n_div=str_replace("é","e",$n_div);
        $n_div=str_replace("í","i",$n_div);
        $n_div=str_replace("ó","o",$n_div);
        $n_div=str_replace("ú","u",$n_div);
        $n_div=str_replace("ä","a",$n_div);
        $n_div=str_replace("ë","e",$n_div);
        $n_div=str_replace("ï","i",$n_div);
        $n_div=str_replace("ö","o",$n_div);
        $n_div=str_replace("ü","u",$n_div);
        $n_div=str_replace("ñ", "n", $n_div);
        $n_div=str_replace("Ñ", "N", $n_div);
        //al final retornamos la cadena limpia y pura
        return $n_div;

    }
    
}

?>
