<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Extrajudicial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("CarteraFng_Model");
        $this->load->model("Obligaciones_Model");
        $this->load->model("Wizard_Model");
        $this->load->model("Extrajudicial_Model");
        $this->load->model("Configuraciones_Model");
        
    }

    public function index() {
        if($this->session->userdata('login_ok')){
			
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
			
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/index');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }   
    }
    public function valoradeudado(){
        if($this->session->userdata('login_ok')){
            
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/valoradeudado');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }   
    }
   
       public function clientesNuevos()
	   {
        if($this->session->userdata('login_ok'))
		{
			ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesNuevos();
            $total = $this->Extrajudicial_Model->gettotalClientesNuevos();
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
       
			$datosDelarray = array();
			$i = 0;
			foreach($clientes as $key){
				$fachas = explode(" ", $key->fecha);
				$fachas = explode("-",$fachas[0]);
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);

				$datosDelarray[$i]['deudor'] =utf8_encode($deudor) ;
				$datosDelarray[$i]['identificacion'] = $key->identificacion ;
        $datosDelarray[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
				$datosDelarray[$i]['intemediario'] = utf8_encode($key->intemediario) ;
				$datosDelarray[$i]['valor'] =  "$".number_format($key->valor, 0, '.',',');
				$datosDelarray[$i]['fecha'] = $fachas[2]."/".$fachas[1]."/".$fachas[0];
                $datosDelarray[$i]['liquidacion'] = $key->liquidacion;
				$datosDelarray[$i]['G737_C17183'] = $key->G737_C17183 ;
				$i++;
			}
		$datos = array('clientes' => json_encode($datosDelarray),'procesos' => $total );
            
			$this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesNuevos', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
	   }
  /* funcion clientes nuevos vieja
    public function clientesNuevos(){
        if($this->session->userdata('login_ok')){
			ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesNuevos();
            $total = $this->Extrajudicial_Model->gettotalClientesNuevos();
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
       
			$datosDelarray = array();
			$i = 0;
			foreach($clientes as $key){
				$fachas = explode(" ", $key->fecha);
				$fachas = explode("-",$fachas[0]);
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);

				$datosDelarray[$i]['deudor'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
				$datosDelarray[$i]['identificacion'] = $key->identificacion ;
				$datosDelarray[$i]['intemediario'] = utf8_encode($key->intemediario) ;
				$datosDelarray[$i]['valor'] =  "$".number_format($key->valor, 0, '.',',');
				$datosDelarray[$i]['fecha'] = "<span style='display: none;'>".$fachas[0]."/".$fachas[1]."/".$fachas[2]."</span>".$fachas[2]."/".$fachas[1]."/".$fachas[0];
				$datosDelarray[$i]['G737_C17183'] = $key->G737_C17183 ;

                $datosDelarray[$i]['contrato'] = $key->liquidacion;
                                
				$i++;
			}
			
			$datos = array('clientes' => json_encode($datosDelarray),'procesos' => $total );
            
			$this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesNuevos', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }
*/
    public function getDatosNuevosJson(){
        if($this->session->userdata('login_ok')){
            $varaiable = $_POST['tipo'];
            $data = array();
            $i = 0;
            if($varaiable == 0){
              $this->db->select('id_log_datos, a.G718_C17015 as ciudadDomicilio , b.G718_C17015 as ciudadOficina ,tefonoOficina ,telefonoDomicilio ,celular, celularAdicional ,mail  as correo ,direccionDomicilio ,direccionOficina ,iddeusuario , G717_C17240 as deudor, G717_C17005 as identificacion , tipo_identificacion as tipo_identificacion,  fecha_modificacion ,c.LISOPC_Nombre____b As cal_ciudadDomicilio                          ,d.LISOPC_Nombre____b As cal_ciudadOficina, e.LISOPC_Nombre____b As cal_tefonoOficina
                ,f.LISOPC_Nombre____b As cal_telefonoDomicilio ,g.LISOPC_Nombre____b As cal_celular
                ,h.LISOPC_Nombre____b As cal_celularAdicional ,i.LISOPC_Nombre____b As cal_mail
                ,j.LISOPC_Nombre____b As cal_direccionDomicilio ,k.LISOPC_Nombre____b As cal_direccionOficina ,l.LISOPC_Nombre____b As cal_dir_Adicional ,m.LISOPC_Nombre____b As cal_tele_adicional       ,n.LISOPC_Nombre____b As cal_ciudad_adicional');

              $this->db->from('Log_datos_iniciales');
              $this->db->join('G718 a', 'a.G718_ConsInte__b = ciudadDomicilio', 'LEFT');
              $this->db->join('G718 b', 'b.G718_ConsInte__b = ciudadOficina', 'LEFT');
              $this->db->join('G717', 'G717.G717_ConsInte__b = iddeusuario');

              $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = cal_ciudadDomicilio ', 'LEFT');
              $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = cal_ciudadOficina ', 'LEFT');
              $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = cal_tefonoOficina ', 'LEFT');
              $this->db->join('LISOPC f', 'f.LISOPC_ConsInte__b = cal_telefonoDomicilio ', 'LEFT');
              $this->db->join('LISOPC g', 'g.LISOPC_ConsInte__b = cal_celular ', 'LEFT');
              $this->db->join('LISOPC h', 'h.LISOPC_ConsInte__b = cal_celularAdicional ', 'LEFT');
              $this->db->join('LISOPC i', 'i.LISOPC_ConsInte__b = cal_mail ', 'LEFT');
              $this->db->join('LISOPC j', 'j.LISOPC_ConsInte__b = cal_direccionDomicilio ', 'LEFT');
              $this->db->join('LISOPC k', 'k.LISOPC_ConsInte__b = cal_direccionOficina ', 'LEFT');
              $this->db->join('LISOPC l', 'l.LISOPC_ConsInte__b = cal_dir_Adicional ', 'LEFT');
              $this->db->join('LISOPC m', 'm.LISOPC_ConsInte__b = cal_tele_adicional ', 'LEFT');
              $this->db->join('LISOPC n', 'n.LISOPC_ConsInte__b = cal_ciudad_adicional ', 'LEFT');

              $query2 = $this->db->get();
              $result2 = $query2->result();


              
              $idViejo = 0;
              $idNuevo = 0;
              foreach ($result2 as $key2) {
                  $idNuevo = $key2->id_log_datos;
                  if($idNuevo != $idViejo){
                      $data[$i]['correeo'] = utf8_encode($key2->correo) ;
                      $data[$i]['telefono'] = utf8_encode($key2->telefonoDomicilio) ;
                      $data[$i]['direccion'] = utf8_encode($key2->direccionDomicilio) ;
                      $data[$i]['ciudad'] = utf8_encode($key2->ciudadDomicilio) ;
                      $data[$i]['observacion'] = NULL ;
                      $fecha = explode(' ', $key2->fecha_modificacion)[0];
                      $fecha = explode('-', $fecha);
                      $data[$i]['fecharegistro'] = $fecha[2].'/'.$fecha[1].'/'.$fecha[0] ;
                      $data[$i]['rol'] = 'Deudor' ;
                      $data[$i]['deudor'] = utf8_encode($key2->deudor) ;
                      $data[$i]['liquidacion'] = NULL ;
                      $data[$i]['identificacion'] = utf8_encode($key2->identificacion) ;
                      $data[$i]['tipo_identificacion'] = utf8_encode($key2->tipo_identificacion) ;
                      $data[$i]['ciudadOficina'] = utf8_encode($key2->ciudadOficina) ;
                      $data[$i]['tefonoOficina'] = utf8_encode($key2->tefonoOficina) ;
                      $data[$i]['celular'] = utf8_encode($key2->celular) ;
                      $data[$i]['celularAdicional'] = utf8_encode($key2->celularAdicional) ;
                      $data[$i]['direccionOficina'] = utf8_encode($key2->direccionOficina) ;

                      $data[$i]['Calificacion_correo'] =utf8_encode($key2->cal_mail);
                      $data[$i]['Calificacion_telefono'] = utf8_encode($key2->cal_telefonoDomicilio) ;
                      $data[$i]['Calificacion_direccion'] = utf8_encode($key2->cal_direccionDomicilio) ;
                      $data[$i]['Calificacion_ciudad'] = utf8_encode($key2->cal_ciudadDomicilio);


                      $data[$i]['cal_ciudadDomicilio'] = utf8_encode($key2->cal_ciudadDomicilio) ;
                      $data[$i]['cal_ciudadOficina'] =utf8_encode($key2->cal_ciudadOficina) ;
                      $data[$i]['cal_tefonoOficina'] = utf8_encode($key2->cal_tefonoOficina) ;
                      $data[$i]['cal_telefonoDomicilio'] = utf8_encode($key2->cal_telefonoDomicilio) ;
                      $data[$i]['cal_celular'] = utf8_encode($key2->cal_celular) ;
                      $data[$i]['cal_celularAdicional'] = utf8_encode($key2->cal_celularAdicional) ;
                      $data[$i]['cal_mail'] = utf8_encode($key2->cal_mail) ;
                      $data[$i]['cal_direccionDomicilio'] = utf8_encode($key2->cal_direccionDomicilio) ;
                      $data[$i]['cal_direccionOficina'] = utf8_encode($key2->cal_direccionOficina) ;
                      $data[$i]['cal_dir_Adicional'] = utf8_encode($key2->cal_dir_Adicional) ;
                      $data[$i]['cal_tele_adicional'] = utf8_encode($key2->cal_tele_adicional) ;
                      $data[$i]['cal_ciudad_adicional'] = utf8_encode($key2->cal_ciudad_adicional) ;



                     $i++;
                  }
                  $idViejo = $idNuevo;
              }  


                $this->db->select('G743_C17363 as correeo, G743_C17256 as telefono, G743_C17257 as direccion, G718_C17015 as ciudad, G743_C17260 as observacion, G743_C17361 as fecha_ingreso, G743_C17269 as rol, G717_C17240 as deudor, G717_C17005 as identificacion ,tipo_identificacion as tipo_identificacion, G719_C17423 as liquidacion, a.LISOPC_Nombre____b As Calificacion_correo, b.LISOPC_Nombre____b As Calificacion_telefono,                           c.LISOPC_Nombre____b As Calificacion_direccion, d.LISOPC_Nombre____b As Calificacion_ciudad,        e.LISOPC_Nombre____b As Calificacion_descripcion');
                $this->db->from('G743');
                $this->db->join('G718', 'G718_ConsInte__b = G743_C17258', 'LEFT');
                $this->db->join('G717', 'G717_ConsInte__b = G743_C17268', 'LEFT');
                $this->db->join('G719', 'G719_ConsInte__b = G743_C17267', 'LEFT');
                $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G743_C17262 ', 'LEFT');
                $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G743_C17263 ', 'LEFT');
                $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G743_C17264 ', 'LEFT');
                $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = G743_C17265 ', 'LEFT');
                $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = G743_C17266 ', 'LEFT');
                $query = $this->db->get();
                $clientes = $query->result();
                
                foreach($clientes as $key){
                    $data[$i]['correeo'] = utf8_encode($key->correeo) ;
                    $data[$i]['telefono'] = utf8_encode($key->telefono) ;
                    $data[$i]['direccion'] = utf8_encode($key->direccion) ;
                    $data[$i]['ciudad'] = utf8_encode($key->ciudad) ;
                    $data[$i]['observacion'] = utf8_encode($key->observacion) ;
                    $fecha = explode(' ', $key->fecha_ingreso)[0];
                    $fecha = explode('-', $fecha);
                    $data[$i]['fecharegistro'] = $fecha[2].'/'.$fecha[1].'/'.$fecha[0] ;
                    $data[$i]['rol'] = utf8_encode($key->rol) ;
                    $data[$i]['deudor'] = utf8_encode($key->deudor) ;
                    $data[$i]['liquidacion'] = utf8_encode($key->liquidacion) ;
                    $data[$i]['identificacion'] = utf8_encode($key->identificacion) ;
                    $data[$i]['tipo_identificacion'] = utf8_encode($key->tipo_identificacion) ;
                    $data[$i]['ciudadOficina'] = NULL ;
                    $data[$i]['tefonoOficina'] = NULL ;
                    $data[$i]['celular'] = NULL ;
                    $data[$i]['celularAdicional'] = NULL;
                    $data[$i]['direccionOficina'] = NULL;

                    $data[$i]['Calificacion_correo'] = utf8_encode($key->Calificacion_correo);
                    $data[$i]['Calificacion_telefono'] = utf8_encode($key->Calificacion_telefono);
                    $data[$i]['Calificacion_direccion'] = utf8_encode($key->Calificacion_direccion);
                    $data[$i]['Calificacion_ciudad'] = utf8_encode($key->Calificacion_ciudad);

                    $data[$i]['cal_ciudadDomicilio'] = NULL ;
                    $data[$i]['cal_ciudadOficina'] = NULL ;
                    $data[$i]['cal_tefonoOficina'] = NULL ;
                    $data[$i]['cal_telefonoDomicilio'] = NULL ;
                    $data[$i]['cal_celular'] = NULL ;
                    $data[$i]['cal_celularAdicional'] = NULL ;
                    $data[$i]['cal_mail'] = NULL ;
                    $data[$i]['cal_direccionDomicilio'] = NULL ;
                    $data[$i]['cal_direccionOficina'] = NULL ;
                    $data[$i]['cal_dir_Adicional'] = NULL ;
                    $data[$i]['cal_tele_adicional'] = NULL;
                    $data[$i]['cal_ciudad_adicional'] = NULL ;




                    $i++;
                } 


            }else if($varaiable == 1){

                 $this->db->select('id_log_datos, a.G718_C17015 as ciudadDomicilio , b.G718_C17015 as ciudadOficina ,tefonoOficina ,telefonoDomicilio ,celular, celularAdicional ,mail  as correo ,direccionDomicilio ,direccionOficina ,iddeusuario , G717_C17240 as deudor, G717_C17005 as identificacion , tipo_identificacion as tipo_identificacion, fecha_modificacion ,c.LISOPC_Nombre____b As cal_ciudadDomicilio                          ,d.LISOPC_Nombre____b As cal_ciudadOficina, e.LISOPC_Nombre____b As cal_tefonoOficina
                ,f.LISOPC_Nombre____b As cal_telefonoDomicilio ,g.LISOPC_Nombre____b As cal_celular
                ,h.LISOPC_Nombre____b As cal_celularAdicional ,i.LISOPC_Nombre____b As cal_mail
                ,j.LISOPC_Nombre____b As cal_direccionDomicilio ,k.LISOPC_Nombre____b As cal_direccionOficina ,l.LISOPC_Nombre____b As cal_dir_Adicional ,m.LISOPC_Nombre____b As cal_tele_adicional       ,n.LISOPC_Nombre____b As cal_ciudad_adicional');

              $this->db->from('Log_datos_iniciales');
              $this->db->join('G718 a', 'a.G718_ConsInte__b = ciudadDomicilio', 'LEFT');
              $this->db->join('G718 b', 'b.G718_ConsInte__b = ciudadOficina', 'LEFT');
              $this->db->join('G717', 'G717.G717_ConsInte__b = iddeusuario');

              $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = cal_ciudadDomicilio ', 'LEFT');
              $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = cal_ciudadOficina ', 'LEFT');
              $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = cal_tefonoOficina ', 'LEFT');
              $this->db->join('LISOPC f', 'f.LISOPC_ConsInte__b = cal_telefonoDomicilio ', 'LEFT');
              $this->db->join('LISOPC g', 'g.LISOPC_ConsInte__b = cal_celular ', 'LEFT');
              $this->db->join('LISOPC h', 'h.LISOPC_ConsInte__b = cal_celularAdicional ', 'LEFT');
              $this->db->join('LISOPC i', 'i.LISOPC_ConsInte__b = cal_mail ', 'LEFT');
              $this->db->join('LISOPC j', 'j.LISOPC_ConsInte__b = cal_direccionDomicilio ', 'LEFT');
              $this->db->join('LISOPC k', 'k.LISOPC_ConsInte__b = cal_direccionOficina ', 'LEFT');
              $this->db->join('LISOPC l', 'l.LISOPC_ConsInte__b = cal_dir_Adicional ', 'LEFT');
              $this->db->join('LISOPC m', 'm.LISOPC_ConsInte__b = cal_tele_adicional ', 'LEFT');
              $this->db->join('LISOPC n', 'n.LISOPC_ConsInte__b = cal_ciudad_adicional ', 'LEFT');

              $query2 = $this->db->get();
              $result2 = $query2->result();


              
              $idViejo = 0;
              $idNuevo = 0;
              foreach ($result2 as $key2) {
                  $idNuevo = $key2->id_log_datos;
                  if($idNuevo != $idViejo){
                      $data[$i]['correeo'] = utf8_encode($key2->correo) ;
                      $data[$i]['telefono'] = utf8_encode($key2->telefonoDomicilio) ;
                      $data[$i]['direccion'] = utf8_encode($key2->direccionDomicilio) ;
                      $data[$i]['ciudad'] = utf8_encode($key2->ciudadDomicilio) ;
                      $data[$i]['observacion'] = NULL ;
                      $fecha = explode(' ', $key2->fecha_modificacion)[0];
                      $fecha = explode('-', $fecha);
                      $data[$i]['fecharegistro'] = $fecha[2].'/'.$fecha[1].'/'.$fecha[0] ;
                      $data[$i]['rol'] = 'Deudor' ;
                      $data[$i]['deudor'] = utf8_encode($key2->deudor) ;
                      $data[$i]['liquidacion'] = NULL ;
                      $data[$i]['identificacion'] = utf8_encode($key2->identificacion) ;
                      $data[$i]['tipo_identificacion'] = utf8_encode($key2->tipo_identificacion) ;
                      $data[$i]['ciudadOficina'] = utf8_encode($key2->ciudadOficina) ;
                      $data[$i]['tefonoOficina'] = utf8_encode($key2->tefonoOficina) ;
                      $data[$i]['celular'] = utf8_encode($key2->celular) ;
                      $data[$i]['celularAdicional'] = utf8_encode($key2->celularAdicional) ;
                      $data[$i]['direccionOficina'] = utf8_encode($key2->direccionOficina) ;

                      $data[$i]['Calificacion_correo'] =utf8_encode($key2->cal_mail);
                      $data[$i]['Calificacion_telefono'] = utf8_encode($key2->cal_telefonoDomicilio) ;
                      $data[$i]['Calificacion_direccion'] = utf8_encode($key2->cal_direccionDomicilio) ;
                      $data[$i]['Calificacion_ciudad'] = utf8_encode($key2->cal_ciudadDomicilio);


                      $data[$i]['cal_ciudadDomicilio'] = utf8_encode($key2->cal_ciudadDomicilio) ;
                      $data[$i]['cal_ciudadOficina'] =utf8_encode($key2->cal_ciudadOficina) ;
                      $data[$i]['cal_tefonoOficina'] = utf8_encode($key2->cal_tefonoOficina) ;
                      $data[$i]['cal_telefonoDomicilio'] = utf8_encode($key2->cal_telefonoDomicilio) ;
                      $data[$i]['cal_celular'] = utf8_encode($key2->cal_celular) ;
                      $data[$i]['cal_celularAdicional'] = utf8_encode($key2->cal_celularAdicional) ;
                      $data[$i]['cal_mail'] = utf8_encode($key2->cal_mail) ;
                      $data[$i]['cal_direccionDomicilio'] = utf8_encode($key2->cal_direccionDomicilio) ;
                      $data[$i]['cal_direccionOficina'] = utf8_encode($key2->cal_direccionOficina) ;
                      $data[$i]['cal_dir_Adicional'] = utf8_encode($key2->cal_dir_Adicional) ;
                      $data[$i]['cal_tele_adicional'] = utf8_encode($key2->cal_tele_adicional) ;
                      $data[$i]['cal_ciudad_adicional'] = utf8_encode($key2->cal_ciudad_adicional) ;



                     $i++;
                  }
                  $idViejo = $idNuevo;
              }  



            }else if($varaiable == 2){
                $this->db->select('G743_C17363 as correeo, G743_C17256 as telefono, G743_C17257 as direccion, G718_C17015 as ciudad, G743_C17260 as observacion, G743_C17361 as fecha_ingreso, G743_C17269 as rol, G717_C17240 as deudor, G717_C17005 as identificacion , tipo_identificacion as tipo_identificacion, G719_C17423 as liquidacion, a.LISOPC_Nombre____b As Calificacion_correo, b.LISOPC_Nombre____b As Calificacion_telefono,                           c.LISOPC_Nombre____b As Calificacion_direccion, d.LISOPC_Nombre____b As Calificacion_ciudad,        e.LISOPC_Nombre____b As Calificacion_descripcion');
                $this->db->from('G743');
                $this->db->join('G718', 'G718_ConsInte__b = G743_C17258', 'LEFT');
                $this->db->join('G717', 'G717_ConsInte__b = G743_C17268', 'LEFT');
                $this->db->join('G719', 'G719_ConsInte__b = G743_C17267', 'LEFT');
                $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G743_C17262 ', 'LEFT');
                $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G743_C17263 ', 'LEFT');
                $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G743_C17264 ', 'LEFT');
                $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = G743_C17265 ', 'LEFT');
                $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = G743_C17266 ', 'LEFT');
                $query = $this->db->get();
                $clientes = $query->result();
                
                foreach($clientes as $key){
                    $data[$i]['correeo'] = utf8_encode($key->correeo) ;
                    $data[$i]['telefono'] = utf8_encode($key->telefono) ;
                    $data[$i]['direccion'] = utf8_encode($key->direccion) ;
                    $data[$i]['ciudad'] = utf8_encode($key->ciudad) ;
                    $data[$i]['observacion'] = utf8_encode($key->observacion) ;
                    $fecha = explode(' ', $key->fecha_ingreso)[0];
                    $fecha = explode('-', $fecha);
                    $data[$i]['fecharegistro'] = $fecha[2].'/'.$fecha[1].'/'.$fecha[0] ;
                    $data[$i]['rol'] = utf8_encode($key->rol) ;
                    $data[$i]['deudor'] = utf8_encode($key->deudor) ;
                    $data[$i]['liquidacion'] = utf8_encode($key->liquidacion) ;
                    $data[$i]['identificacion'] = utf8_encode($key->identificacion) ;
                    $data[$i]['tipo_identificacion'] = utf8_encode($key->tipo_identificacion) ;
                    $data[$i]['ciudadOficina'] = NULL ;
                    $data[$i]['tefonoOficina'] = NULL ;
                    $data[$i]['celular'] = NULL ;
                    $data[$i]['celularAdicional'] = NULL;
                    $data[$i]['direccionOficina'] = NULL;

                    $data[$i]['Calificacion_correo'] = utf8_encode($key->Calificacion_correo);
                    $data[$i]['Calificacion_telefono'] = utf8_encode($key->Calificacion_telefono);
                    $data[$i]['Calificacion_direccion'] = utf8_encode($key->Calificacion_direccion);
                    $data[$i]['Calificacion_ciudad'] = utf8_encode($key->Calificacion_ciudad);

                    $data[$i]['cal_ciudadDomicilio'] = NULL ;
                    $data[$i]['cal_ciudadOficina'] = NULL ;
                    $data[$i]['cal_tefonoOficina'] = NULL ;
                    $data[$i]['cal_telefonoDomicilio'] = NULL ;
                    $data[$i]['cal_celular'] = NULL ;
                    $data[$i]['cal_celularAdicional'] = NULL ;
                    $data[$i]['cal_mail'] = NULL ;
                    $data[$i]['cal_direccionDomicilio'] = NULL ;
                    $data[$i]['cal_direccionOficina'] = NULL ;
                    $data[$i]['cal_dir_Adicional'] = NULL ;
                    $data[$i]['cal_tele_adicional'] = NULL;
                    $data[$i]['cal_ciudad_adicional'] = NULL ;






                    $i++;
                } 
            }
                
            echo json_encode($data);
        }else{
            echo "No tienes permisos para ver este contenido";
        }

    }

    public function clientesDatoNuevo(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesDatoNuevo();
            $otrosCLientes = $this->Extrajudicial_Model->getCLentes_titular_datoNuevo();
            $total = $this->Extrajudicial_Model->getTotalClientesDatoNuevo();



            $data = array();
            $i = 0;
            foreach($clientes as $key){
         

                $this->db->select('G717_C17005,tipo_identificacion');
                $this->db->from('G737');
                $this->db->join('G717', 'G717_ConsInte__b = G737_C17181');
                $this->db->where('G737_C17183 = 1786');
                $this->db->where('G737_C17182', $key->G743_C17267);
                $cedula = $this->db->get();
                /*echo 'Esta '.$key->G743_C17267."</br>";
                if($cedula->num_rows() > 0)
                    echo "Tiene registro ".$key->G743_C17267."</br>" ;*/

                $deudor = trim(utf8_encode($key->Nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['Nombre'] = $deudor ;
                $data[$i]['identificacion'] = $cedula->row()->G717_C17005;
                $data[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                $data[$i]['telefono'] = $key->telefono;
                $data[$i]['ciudad'] = $key->ciudad ;
                $data[$i]['liquidacion'] = $key->liquidacion;
                $i++;
            }

            foreach($otrosCLientes as $key){

                $deudor = trim(utf8_encode($key->Nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['Nombre'] = $deudor ;
                $data[$i]['identificacion'] =$key->identificacion ;
                $data[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                $data[$i]['telefono'] = $key->telefono;
                $data[$i]['ciudad'] = $key->ciudad ;
                $data[$i]['liquidacion'] = $key->liquidacion;
                $i++;
            }
                           
            $datos = array('clientes' => json_encode($data), 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesDatoNuevos', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }

    } 

    function clientesmenosdedoce(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav3();


            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/menosdedoce', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmasdedocemenosveinticinco(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav24();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/masdedocemenosveinticinco', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmasdeveinticincomenoscincuenta(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav26();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/masdeveinticincomenoscincuenta', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmasdecincuentamenoscien(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav27();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesmasdecincuentamenoscien', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmascien(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav28();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesmascien', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    function clientesConacuerdodepago(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesacuerdoPago();
            $total = $this->Extrajudicial_Model->getTotalClientesacuerdoPago();

            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = explode(" ", $key->fecha_legal)[0];
                $fecha = explode("-", $fecha);

                $deudor = trim(utf8_encode($key->Nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['Nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                //$data[$i]['contrato'] = $key->contrato;
                $data[$i]['fecha_legal'] =$fecha[2]."/".$fecha[1]."/".$fecha[0] ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data), 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesAcuerdoPago', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    function clientesSingestionquinceDias(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesSingestionquincedias();
           // $total = $this->Extrajudicial_Model->getTotalClientesSingestionquincedias();
           
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
            

            $data = array();
            $i = 0;
            foreach($clientes as $key){
               
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['deudor'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['financiera'] = utf8_encode($key->financiera);
                $data[$i]['contrato'] = $key->liquidacion;
                $data[$i]['valor_pagado'] = '$'.number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }

            $datos = array('clientes' => json_encode($data) );

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/quincedias', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function misclientesVigentes(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getMisclietesVigentes();
           // $total = $this->Extrajudicial_Model->getTotalMisClientesVigentes();

            $data = array();
            $i = 0;
            

            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['deudor'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                $fecha = NULL;
                if(!is_null($key->garantia)){
                    $fecha = explode(" ", $key->garantia)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                 

                $data[$i]['garantia'] = $fecha ;
                $data[$i]['valor'] = '$'.number_format($key->valor, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/misclientesVigentes', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function Exfuncionarios(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getExfuncionarios();
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                 $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['contrato'] = $key->contrato;
                $data[$i]['valor_pagado'] = '$'.number_format($key->valor_pagado,0,'.',',')  ;
                $data[$i]['rol'] = utf8_encode($key->rol) ;
                $i++;
            }
            


            $datos = array('clientes' => json_encode($data) );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExfuncionarios');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/Exfuncionarios', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function ObligacinesVendidas(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getObligaciones_Vendidas();
            
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = null;
                if(!is_null($key->fecha_venta))
                $fecha = explode(" ",$key->fecha_venta)[0];
                $fecha = explode("-",$fecha);
                $fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                $data[$i]['valor_pagado'] = '$'.number_format($key->valor_pagado,0,'.',',') ;
                $data[$i]['fecha_venta'] =  $fecha;
    
                $i++;
            }

            $datos = array('clientes' => json_encode($data) );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/ObligacinesVendidas', $datos);
           $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    function PazySalvo(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getObligacionesPazSalvo();
            $total = $this->Extrajudicial_Model->gettotalObligacionesPazSalvo();

            $data = array();
            $i = 0;
            foreach($clientes as $key){ 
                $fecha = explode(" ",$key->fecha)[0];
                $fecha = explode("-",$fecha);
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = $deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                $data[$i]['valor_pagado'] = "$".number_format($key->valor_pagado, 0, '.',',') ;
                $data[$i]['financiera'] = utf8_encode($key->financiera);
                $data[$i]['fecha'] = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                $i++;
            }
            

            $datos = array('clientes' => json_encode($data), 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/PazySalvo', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function busquedaAvanzada(){

        if($this->session->userdata('login_ok')){
            //ini_set('memory_limit', '1024M'); 
//            $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
            $filtro = $this->CarteraFng_Model->getFiltrosbusqueda();
            $filtroBusquedaAvanzada = array();

            foreach ($filtro as $ke) {
              $filtroSelect = new stdClass();
              $filtroSelect->nombreFiltro = explode('-',utf8_encode($ke->Filtro))[1];
              $filtroSelect->valor ='G'.$ke->tabla.'.G'.$ke->tabla.'_C'.$ke->pregunta;
              $filtroSelect->esLisop = $ke->Lisop;
              $filtroSelect->eslista=$ke->tipoDato;
              $filtroSelect->campoLista=$ke->campoGuion;
              $filtroSelect->tabla=$ke->tablaGuion;
              array_push($filtroBusquedaAvanzada, $filtroSelect);
            }
            $filtroSelect = new stdClass();
            $filtroSelect->nombreFiltro = ' CLIENTES SIN GESTIÓN';
            $filtroSelect->valor = 'Busqueda15';
            $filtroSelect->esLisop = '';
              $filtroSelect->eslista='5';
              $filtroSelect->campoLista='';
              $filtroSelect->tabla='';
            array_push($filtroBusquedaAvanzada, $filtroSelect);

            sort($filtroBusquedaAvanzada);



            

		        $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
			      $datos = array('filtros' => $filtroBusquedaAvanzada);

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/busquedaAvanzada', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function Datosbusquedavanzadad(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M'); 
            $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
            /*$datos = array('clientes' => $clientes);
            $this->load->view('Extrajudicial/ajax_template', $datos);*/
            $datosRary = array();
           $i = 0;
           foreach($clientes as $key){
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $datosRary[$i]['DEUDOR'] = $deudor ;
                        
            $datosRary[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
             $datosRary[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
            $datosRary[$i]['INTERMEDIARIO'] =  utf8_encode($key->INTERMEDIARIO) ;
                    $datosRary[$i]['OBLIGACION'] = $key->LIQUIDACION ;
            $datosRary[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
            $datosRary[$i]['VALOR_PAGADO'] = "$".number_format($key->VALOR_PAGADO,  0, '.',',') ;
            $datosRary[$i]['ROL'] =  utf8_encode($key->ROL) ;
            $datosRary[$i]['CIUDAD_DOMICILIO'] =  utf8_encode($key->CIUDAD_DOMICILIO) ;
            $i++;
          }
          echo json_encode($datosRary);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function gestionar($identificacion, $vista=null){
        if($this->session->userdata('login_ok')){

            $clientes = $this->Obligaciones_Model->getDatosersonales($identificacion);
            $idUduario = $this->Obligaciones_Model->getIdUsuario($identificacion);
            $contratos = 0;

            $liquidaciones = $this->Obligaciones_Model->getLiquidacionesNumero_S($idUduario);
            $valores= array();
            $i=0;
            $numeroLiquidaciones = $this->Obligaciones_Model->getLiquidacionesNumero($idUduario);
            $numeroLiquidaciones2 = $this->Obligaciones_Model->getLiquidacionesNumero($idUduario);
            $obligacioes = array();

            if($numeroLiquidaciones2 < 1){
                $contratos = $this->Obligaciones_Model->getContratos($idUduario);
                if($contratos != 0){
                    foreach ($contratos as $key2) {
                        $valores[$i]['contrato'] = $key2->OBLIGACION;
                        $valores[$i]['if'] = $key2->financiero;
                        $valores[$i]['No_CONTRATO'] = $key2->No_CONTRATO;

                        $obligacioes[$i]['contrato'] = $key2->No_CONTRATO;
                        $obligacioes[$i]['if'] = 'Jose';
                        $obligacioes[$i]['No_CONTRATO'] = 2;
                        $i++;
                    }
                }
            }else{
                $contratos = $this->Obligaciones_Model->getLiquidaciones($idUduario);
                if($contratos != 0){
                    foreach ($contratos as $key2) {
                       $valores[$i]['contrato'] = $key2->liquidacion;
                       $valores[$i]['if'] = 'Jose';
                       $valores[$i]['No_CONTRATO'] = 2;

                       $obligacioes[$i]['contrato'] = $key2->liquidacion;
                       $obligacioes[$i]['if'] = 'Jose';
                       $obligacioes[$i]['No_CONTRATO'] = 2;
                       

                       $i++;
                    }
                }
            }
                
            
            //$contratos = $this->Obligaciones_Model->getLiquidaciones($idUduario);

            //if($contratos == 0){
            //    $contratos = $this->Obligaciones_Model->getContratos($idUduario);
            //}
           // $obligacioes = $this->Obligaciones_Model->getContratos($idUduario);
            $minimo = $this->Wizard_Model->getSalariomin();
            
		        $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
            $ciudades = $this->Configuraciones_Model->getCiudades();
            $calificacion = $this->CarteraFng_Model->getListasLisop(198);
            $abogados = $this->Wizard_Model->getDatosAdicionales($idUduario);
            $datosw = array();
            $i = 0;
            foreach ($abogados as $key) {

                $fecha = explode(" ", $key->Fecha)[0];
                $fecha = explode("-", $fecha);

                                        
                $datosw[$i]['id'] = $key->id;
                $datosw[$i]['obligaciones'] = utf8_encode($key->obligacion);
                $datosw[$i]['deudor'] = utf8_encode($key->deudor);
                $datosw[$i]['rol'] = utf8_encode($key->rol);

                $datosw[$i]['CORREO_ELECTRONICO'] = utf8_encode($key->Correo_electronico);
                $datosw[$i]['TELEFONO'] = utf8_encode($key->Telefono);
                $datosw[$i]['DIRECCION'] = utf8_encode($key->Direccion);
                $datosw[$i]['CIUDAD'] = utf8_encode($key->Ciudad);
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['Calificacion_correo'] = utf8_encode($key->Calificacion_correo);
                $datosw[$i]['Calificacion_telefono'] = utf8_encode($key->Calificacion_telefono);
                $datosw[$i]['Calificacion_direccion'] = utf8_encode($key->Calificacion_direccion);
                $datosw[$i]['Calificacion_ciudad'] = utf8_encode($key->Calificacion_ciudad);
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['fecha'] = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                $i++;
            }

            $datosIniciales =array();
            $j = 0;
            $iniciales = $this->Configuraciones_Model->getDatosinicialesCalificados($idUduario);
            foreach ($iniciales as $key) {
                $fecha2 = null;
                if(!is_null($key->fecha_modificacion)){
                    $fecha = explode(" ", $key->fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                }

                $datosIniciales[$j]['ciudadDomicilio'] = utf8_encode($key->ciudadDomicilio) ;
                $datosIniciales[$j]['ciudadOficina'] = utf8_encode($key->ciudadOficina) ;
                $datosIniciales[$j]['tefonoOficina'] = utf8_encode($key->tefonoOficina) ;
                $datosIniciales[$j]['telefonoDomicilio'] = utf8_encode($key->telefonoDomicilio) ; 
                $datosIniciales[$j]['celular'] = utf8_encode($key->celular) ;
                $datosIniciales[$j]['celularAdicional'] = utf8_encode($key->celularAdicional) ;
                $datosIniciales[$j]['mail'] = utf8_encode($key->mail) ;
                $datosIniciales[$j]['direccionDomicilio'] = utf8_encode($key->direccionDomicilio) ;
                $datosIniciales[$j]['direccionOficina'] = utf8_encode($key->direccionOficina) ;
                $datosIniciales[$j]['dir_Adicional'] = utf8_encode($key->dir_Adicional) ;
                $datosIniciales[$j]['tele_adicional'] = utf8_encode($key->tele_adicional) ;
                $datosIniciales[$j]['ciudad_adicional'] = utf8_encode($key->ciudad_adicional) ;
                $datosIniciales[$j]['cal_ciudadDomicilio'] = utf8_encode($key->cal_ciudadDomicilio) ;
                $datosIniciales[$j]['cal_ciudadOficina'] = utf8_encode($key->cal_ciudadOficina) ;
                $datosIniciales[$j]['cal_tefonoOficina'] = utf8_encode($key->cal_tefonoOficina) ;
                $datosIniciales[$j]['cal_telefonoDomicilio'] = utf8_encode($key->cal_telefonoDomicilio) ;
                $datosIniciales[$j]['cal_celular'] = utf8_encode($key->cal_celular) ;
                $datosIniciales[$j]['cal_celularAdicional'] = utf8_encode($key->cal_celularAdicional) ;
                $datosIniciales[$j]['cal_mail'] = utf8_encode($key->cal_mail) ;
                $datosIniciales[$j]['cal_direccionDomicilio'] = utf8_encode($key->cal_direccionDomicilio) ;
                $datosIniciales[$j]['cal_direccionOficina'] = utf8_encode($key->cal_direccionOficina) ;
                $datosIniciales[$j]['cal_dir_Adicional'] = utf8_encode($key->cal_dir_Adicional) ;
                $datosIniciales[$j]['cal_tele_adicional'] = utf8_encode($key->cal_tele_adicional) ;
                $datosIniciales[$j]['cal_ciudad_adicional'] = utf8_encode($key->cal_ciudad_adicional) ;
                $datosIniciales[$j]['fecha_modificacion'] = $fecha2 ;
                $datosIniciales[$j]['id_log_datos'] = $key->id_log_datos;
                $j++;
            }
           



            $datos = array();
            if($vista != null){
                $datos = array('iniciales'=> json_encode($datosIniciales), 'vista' => $vista, 'ciudades' => $ciudades, 'calificacion' => $calificacion,  'datosadicionales' => json_encode($datosw), 'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, /*'tipo_identificacion' => $tipo_identificacion,*/'idUsuario' => $idUduario, 'contratos' => $valores, 'numeroLiquidaciones' => $numeroLiquidaciones, 'obligaciones' =>  $obligacioes, 'masliquidaciones' => $numeroLiquidaciones2);
            }else{
                $datos = array('iniciales'=> json_encode($datosIniciales), 'datosadicionales' => json_encode($datosw), 'ciudades' => $ciudades, 'calificacion' => $calificacion,  'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, /*'tipo_identificacion' => $tipo_identificacion, */'idUsuario' => $idUduario, 'contratos' => $valores, 'numeroLiquidaciones' => $numeroLiquidaciones, 'obligaciones' =>  $obligacioes, 'masliquidaciones' => $numeroLiquidaciones2);
            }
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/gestiones', $datos);
			$this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function completarZerosLiquidacion($liquidacion){
        $totalCaracteres =strlen($liquidacion);
        $zerosConcat = 0;
        
        if ($totalCaracteres >= 8) return $liquidacion;
        else{
            $zerosConcat =  10 - $totalCaracteres;
            for ($i = 0; $i < $zerosConcat; $i++) $liquidacion = '0'.$liquidacion;
        }
        return $liquidacion;

    }


    public function buscar(){

        if($this->session->userdata('login_ok')){
             ini_set('memory_limit', '1024M');  
            if(isset($_POST['filtros'])){
                $filtros = $_POST['filtros'];
                $jose = array();    
               
                foreach ($filtros as $key) {
                    if(count($key) > 0){
                        if($key != 'No se encontro resultado'){
                            
                            $pos = strpos($key, '$');
                            if($pos === false){

                                $Jose = strpos($key, '-');
                                if($Jose === false){
                                    
                                }else{
                                    $array = explode('-', $key);
                                    if(!empty($array)){
                                      if ($array[0] == 'G719.G719_C17423') $array[1] = $this->completarZerosLiquidacion($array[1]);
                                        $jose[$array[0]] = $array[1];
                                    }

                                     
                                }


                                $Jos = strpos($key, '=>');
                                if($Jos === false){
                                
                                }else{
                                    $array = explode("=>", $key);
                                    if(count($array) > 1){
                                        if(!is_null($array[2]) && $array[2] != ''){

                                            $Jos = strpos($key, '/');
                                            if($Jos === false){
                                                $this->db->where($array[0]." BETWEEN '".$array[1]."' AND '".$array[2]."'"); 
                                            }else{
                                                $fecha1 = explode('/', $array[1]);
                                            
                                                //$jose[$array[0].' > '] = $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                                                $fecha3 =  $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                                                $fecha2 = explode('/', $array[2]);
                                                //$jose[$array[0].' < '] = $fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
                                                $fecha4 = $fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
                                                
                                                
                                                $this->db->where($array[0]." BETWEEN '".$fecha3."' AND '".$fecha4."'"); 
                                            }
                                            
                                        }else{
                                            $fecha1 = explode('/', $array[1]);
                                            $jose[$array[0]] = $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                                        }
                                    }
                                    
                                }
                            }else{
                                $array = explode('$', $key);
                                $this->db->like($array[0], trim($array[1]));
                            }

                        }
                    }
                    
                       
                }
                $value = count($jose);

                
                $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada($jose);
                
                $data = array();
                $i = 0;
                foreach($clientes as $key){
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['DEUDOR'] = $deudor ;
                

                    $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                    $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                    $data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                    $data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                    /*if($key->LIQUIDACION != '' && !is_null($key->LIQUIDACION)){
                       
                    }else{
                        $data[$i]['OBLIGACION'] = $key->OBLIGACION ;
                    }*/

                    $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                    $data[$i]['VALOR_PAGADO'] = "$".number_format($key->VALOR_PAGADO,  0, '.',',');
                    $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                    $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                    $i++;
                }
                echo json_encode($data);
            }else{
                $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
                $data = array();
                $i = 0;
                foreach($clientes as $key){
                    
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['DEUDOR'] = $deudor ;
                
                    $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION  ;
                    $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                    $data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                    $data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                    /*if($key->LIQUIDACION != '' && !is_null($key->LIQUIDACION)){
                       
                    }else{
                        $data[$i]['OBLIGACION'] = $key->OBLIGACION ;
                    }*/
                    $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                    $data[$i]['VALOR_PAGADO'] ="$".number_format($key->VALOR_PAGADO,  0, '.',',');
                    $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                    $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                    $i++;
                }
                echo json_encode($data);
            }
            
        }else{
            echo "no tienes permisos para ver esto";
        }
    }

    function buscar2(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
           
            $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
			$data = array();
			$i = 0;
            foreach($clientes as $key){
				$deudor = trim(utf8_encode($key->DEUDOR));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['DEUDOR'] = $deudor ;
                
				$data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
        $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
				$data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                
				$data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                /*if($key->LIQUIDACION != '' && !is_null($key->LIQUIDACION)){ 
                }else{
                    $data[$i]['OBLIGACION'] = $key->OBLIGACION ;
                }*/
				$data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
				$data[$i]['VALOR_PAGADO'] ="$".number_format($key->VALOR_PAGADO,  0, '.',',')  ;
				$data[$i]['ROL'] = utf8_encode($key->ROL) ;
				$data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
				$i++;
			}
            echo json_encode($data);
        }else{
            echo "no tienes permisos para ver esto";
        }
    }

       

    function buscarPor15(){
          
        $filtroFecha = $_GET['array_datos'];
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $this->load->model('Extrajudicial_Model');

            $clientes = $this->Extrajudicial_Model->getClientesSingestionquincedias($filtroFecha);
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['DEUDOR'] = $deudor ;
                
                $data[$i]['IDENTIFICACION'] = $key->identificacion ;
                $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $data[$i]['INTERMEDIARIO'] = utf8_encode($key->financiera) ;
                $data[$i]['OBLIGACION'] = $key->liquidacion ;
                $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                $data[$i]['VALOR_PAGADO'] ="$".number_format($key->valor_pagado,  0, '.',',')  ;
                $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                $i++;
            }
            echo json_encode($data);

        }else{
            echo "No tiene permisos para ver esta información!";
        }
    }
    // 
    function busquedaEstado(){

        if($this->session->userdata('login_ok')){
              
            $filtrosEstado = $this->Extrajudicial_Model->getfiltrosEstado();

            $datos = array('filtrosEstado' => $filtrosEstado);

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/busquedaGestion', $datos);
            $this->load->view('Includes/footer');

        }else{
            $this->load->view('Login/login');
        }
    }
     function busquedaGestion(){

            $datos=array();
            $tiposGestion = $this->Extrajudicial_Model->getfiltrosGestion($_POST['codigo']);

            if (!empty($tiposGestion)) {
            foreach ($tiposGestion as $key => $val) {
                $datos[] = array('id' => utf8_decode($val->G732_C17130), 'valor' => utf8_encode($val->LISOPC_Nombre____b));
            }
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode( $datos ));
    }


    function busquedaSubGestion(){

            $datos=array();
            $tiposGestion = $this->Extrajudicial_Model->getfiltrosSubgestion($_POST['codigo'],$_POST['gestion']);

            if (!empty($tiposGestion)) {
            foreach ($tiposGestion as $key => $val) {
                $datos[] = array('id' => utf8_decode($val->G732_ConsInte__b), 'valor' => utf8_encode($val->G732_C17131));
            }
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode( $datos ));
    }

    function imprimirPlano3 ($texto){
        $file = fopen("archivo.txt", "w");
        fwrite($file, $texto . PHP_EOL);
        fwrite($file, "Otra más" . PHP_EOL);
        fclose($file);
    }

    function getBusquedaGestion(){

      $arregloGestiones = $this->Extrajudicial_Model->getliquidacionPorGestion($_POST['codigo'],$_POST['gestion'],$_POST['subgestion'],$_POST['fechainicial'],$_POST['fechafinal']);
        #echo "<br><br><br>".$this->db->last_query($arregloGestiones); die ('Prueba');
        $json = array();
        $i= 0;
      foreach ($arregloGestiones as $key) {
              
              $json[$i]['ti'] = $key->ti ;
              $json[$i]['identificacion'] = utf8_encode($key->identificacion);
              $json[$i]['nombre'] =trim(utf8_encode($key->nombre));
              $json[$i]['liquidacion'] = $key->liquidacion;
              $json[$i]['intermediario'] = utf8_encode($key->intermediario);
              $json[$i]['SAP'] = $key->SAP;
              $json[$i]['rol'] = $key->rol;
              $json[$i]['Valor'] = "$ ".number_format($key->Valor, 0, ',','.');
              $json[$i]['Gestor'] = utf8_encode($key->Gestor);
              
              $fecha2 = NULL;
              $fecha3 = NULL;
              if(!is_null($key->fechaIngreso)){
                  $fecha2 = explode(" ", $key->fechaIngreso)[0];
                  $fecha2 = explode("-", $fecha2);
                  $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
              }
                                  
              $json[$i]['fechaIngreso'] =  $fecha2;
            $i++;
      } 
      $datos = array( 'ResultadoGestiones' => json_encode($json));
      #$this->imprimirPlano3(json_encode($json));
      $this->load->view('Extrajudicial/busquedaGestionDatos', $datos);
        

    }
    # (ACB2) - Cargue masivo por acuerdo de pago. 
    public function cargueMasivoAcuerdosDePago(){
        if($this->session->userdata('login_ok')){
            $data           = array('title' => 'Carga masiva liquidaciones con acuerdo de pago');
            $abogados       = $this->Configuraciones_Model->getAbogados();
            $datosFooter    = array('ul'=> 'ULasignacion' , 'li' => 'LIabogados');
            $datos          = array('abogados' => $abogados, 'otroAbogad' => $abogados );
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/cargueMasivo', $datos);
            $this->load->view('Includes/footer', $datosFooter);
            $this->load->library('My_PHPMailer');
        }else{
            $this->load->view('Login/login');
        }
    }

 

    # (ACB2) - Realiza el cargue masivo 
    public function procesoCargueMasivoAcuerdos(){
        if($this->session->userdata('login_ok')){
            $retorno = array(
                'estado' => 0, // 0=error, 1=correcto
                'mensaje' => ''
            );
            if ( isset($_FILES['archivo_excel']) and $_FILES['archivo_excel']['error']==0 ) {
                $this->load->library('excel');
                date_default_timezone_set('America/Bogota');
                ini_set('memory_limit','128M');
                $name           = $_FILES['archivo_excel']['name'];
                $tname          = $_FILES['archivo_excel']['tmp_name'];
                $obj_excel      = PHPExcel_IOFactory::load($tname);       
                $sheetData      = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
                $highestRow     = $obj_excel->getActiveSheet()->getHighestRow();
                $total_registros=0;
                $fallidos=0;
                $actualizados=0;
                $liq_fallidas='';
                foreach ($sheetData as $key => $val) {
                    if ($key>2) { // Inicia en la fila 3 del excel.
                        if ( !empty($val['A']) or !empty($val['B']) or !empty($val['C']) or !empty($val['D']) ) {
                            if ( is_numeric($val['A']) and is_numeric($val['D']) ) {
                                # Concatenar ceros a la izquierda.
                                $liquidacion = $this->completarCerosLiquidacion( $val['A'] );
                                $this->db->select('G726_ConsInte__b, G719_C17423 NUMERO_LIQUIDACION');
                                $this->db->from('G726');
                                $this->db->join('G719', 'G719_ConsInte__b = G726_C17237');
                                #$this->db->where('G726_C17109 IS NOT NULL');
                                $this->db->where('G719_C17423', $liquidacion);
                                $query  = $this->db->get();
                                $resultados = $query->result();
                                #echo "<br><br><br>".$this->db->last_query(); die ('Prueba');
                                if (count($resultados)>0) {
                                    $id = $resultados[0]->G726_ConsInte__b;
                                    # FECHA DE LA LIQUIDACION.
                                    $partesFecha=explode('-', $val['B']);
                                    $fechaLiquidacion = date("Y-m-d H:i:s");
                                    if (count($partesFecha)==3) {
                                        # La función checkdate() recibe tres parámetros, el mes, el día y el año.
                                        if (checkdate($partesFecha[1], $partesFecha[2], $partesFecha[0])) {
                                            $fechaLiquidacion = date("Y-m-d H:i:s", strtotime($val['B'].' 23:59:59'));
                                        }
                                    }
                                    # FECHA DEL ANTICIPO.
                                    $partesFecha=explode('-', $val['C']);
                                    $fechaAnticipo = date("Y-m-d H:i:s");
                                    if (count($partesFecha)==3) {
                                        # La función checkdate() recibe tres parámetros, el mes, el día y el año.
                                        if (checkdate($partesFecha[1], $partesFecha[2], $partesFecha[0])) {
                                            $fechaAnticipo = date("Y-m-d H:i:s", strtotime($val['C'].' 23:59:59'));
                                        }
                                    }
                                    $data = array(
                                        'G726_C17109' => $fechaLiquidacion, // FECHA_LIQUIDACION
                                        'G726_C17110' => $fechaAnticipo, // FECHA_CONSIG_ANTICIPO
                                        'G726_C17113' => $val['D'], // PLAZO_ACUERDO_PAGO
                                        'G726_C17224' => date("Y-m-d H:i:s", strtotime($fechaLiquidacion.' + 46 days')), // FECHA_PAGO_PRIMERA_CUOTA
                                        'G726_C17225' => date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($fechaLiquidacion.' + 46 days')).' + '.$val['D'].' months')), // FECHA_PAGO_ULTIMA_CUOTA
                                        'FECHA_EMAIL' => date("Y-m-d H:i:s", strtotime($fechaLiquidacion.' + 46 days'))
                                    );
                                    $this->db->where('G726_ConsInte__b', $id);
                                    $query = $this->db->update('G726', $data);

                                    if ( $this->db->affected_rows() ) {
                                        $actualizados++;
                                    }else{
                                        $liq_fallidas.= $liquidacion.', ';
                                        $fallidos++;
                                    }
                                }
                            }else{
                                $liq_fallidas.= !empty($val['A']) ? $val['A'].', ' : '';
                                $fallidos++;
                            }
                        }else{
                            $liq_fallidas.= !empty($val['A']) ? $val['A'].', ' : '';
                            $fallidos++;
                        }
                        $total_registros++;
                    }                
                }
                $retorno['mensaje'] .= "<p>Total de registros procesados: ".$total_registros;
                $retorno['mensaje'] .= "<br>Registros actualizados: ".$actualizados;
                $retorno['mensaje'] .= "<br>Registros fallidos: ".$fallidos;
                $retorno['mensaje'] .= "<br>Liquidaciones fallidas: ".substr($liq_fallidas, 0, -2);
                $retorno['mensaje'] .= "</p>";
                $retorno['estado'] = 1;
            }else{
                $retorno['mensaje'] = "El documento Excel no se ha cargado correctamente.";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($retorno));
        }else{
            $this->load->view('Login/login');
        }
    }

    # (ACB2) - Retorna la cadena entre 8 y 10 caracteres.
    public function completarCerosLiquidacion( $liquidacion ){
        if ( strlen($liquidacion)>=7 ) {
            return $liquidacion;
        }else{
            return str_pad(trim($liquidacion), 10, '0', STR_PAD_LEFT);
        }
    }


}




?>


