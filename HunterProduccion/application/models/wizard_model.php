<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wizard_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getdatosWizard($codigo){
        $this->db->select('G724_ConsInte__b, G724_C17105 ');
        $this->db->where('G724_C17103', $codigo); 
        $query = $this->db->get('G724');
        return $query->result();
    }

    function guardardatos($tabla, $datos){
        return $this->db->insert($tabla, $datos);
    }

    function editarDatos($tabla, $datos, $id, $dtabla){
        $this->db->where($dtabla, $id);
        return $this->db->update($tabla, $datos);
    }

    function borrarDatos($tabla, $id, $dtabla){
        $this->db->where($dtabla, $id);
        return $this->db->delete($tabla);
    }

    function getDeudores($contrato){
        $this->db->select(' G717_ConsInte__b as id,  G717_C17240 as deudor');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b ','LEFT');
        //$this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183','LEFT');
        $this->db->join('G717', 'G717_ConsInte__b = G737_C17181','LEFT'); 
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');

        return $query->result();
    }

    function getco_Deudores($contrato){
        $this->db->select(' G717_ConsInte__b as id,  G717_C17240 as deudor');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b ');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183');
        $this->db->join('G717', 'G717_ConsInte__b = G737_C17181'); 
        $this->db->where('G719_ConsInte__b', $contrato); 
        $this->db->where('G737_C17183 != 1786'); 
        $query = $this->db->get('G719');

        return $query->result();
    }

    function getRolDeudor($contrato, $usuario){
        $this->db->select('LISOPC_Nombre____b');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b ');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183');
        $this->db->join('G717', 'G717_ConsInte__b = G737_C17181'); 
        $this->db->where('G719_ConsInte__b', $contrato); 
        $this->db->where('G717_ConsInte__b', $usuario); 
        $query = $this->db->get('G719');

        return $query->row()->LISOPC_Nombre____b;
    }

   

    function getGestionIlocalizado($gestion){
        $this->db->select('G732_ConsInte__b as gestion, G732_c17131 as enunciado ');
        $this->db->where('G732_C17130', $gestion); 
        $query = $this->db->get('G732');
        return $query->result();

    }

    function getSubgestiones($gestion){
        $this->db->select('G732_ConsInte__b as id, G732_C17131 as enunciado ');
        $this->db->where('G732_C17130', $gestion); 
        $query = $this->db->get('G732');
        return $query->result();
    }

    function getSubgestionestabla(){
        $this->db->select('G732_ConsInte__b as id, G732_C17131 as enunciado, a.LISOPC_Nombre____b as gestion, b.LISOPC_Nombre____b as comunicacion ');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G732_C17130'); 
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G732_C17129'); 
        $query = $this->db->get('G732');
        return $query->result();
    }

     function getSubgestionestablaById($id){
        $this->db->select('G732_ConsInte__b as id, G732_C17131 as enunciado, G732_C17130 as gestion , G732_C17129 ');
        $this->db->where('G732_ConsInte__b', $id);
        $query = $this->db->get('G732');
        return $query->result();
    }


    function getgestionExtrajudicial($contrato){
        $this->db->select(' G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G742_C17242 as fechaIngreso ,
                            G742_C17243 as Niidea,
                            G742_C17244 as contrato,
                            G742_C17245 as users,
                            G742_C17426 as tarea,
                            G742_C17246 as observaciones,
                            a.LISOPC_Nombre____b as mediocomunicacion,
                            b.LISOPC_Nombre____b as resultadocomunicacion,
                            c.LISOPC_Nombre____b as gestion,
                            G732_C17131 as subgestion');
       
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G742_C17249', 'left');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G742_C17250', 'left');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G742_C17251', 'left');
        $this->db->join('G732', 'G732_ConsInte__b = G742_C17252', 'left');
        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425', 'left');
        $this->db->where('G742_C17244', $contrato); 
        $query = $this->db->get('G742');
        return $query->result();
    }

    function getgestionExtrajudicialFecha($fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select  ('G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G742_C17242 as fechaIngreso,
                            G742_C17243 as Niidea,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G742_C17245 as users,
                            G742_C17246 as observaciones,
                            a.LISOPC_Nombre____b as mediocomunicacion,
                            b.LISOPC_Nombre____b as resultadocomunicacion,
                            c.LISOPC_Nombre____b as gestion,
                            G730_C17126 as financiero,
                            G732_C17131 as subgestion,
                            G729_C17121 as FRG');
							
       
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G742_C17249');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G742_C17250');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G742_C17251');
        $this->db->join('G732', 'G732_ConsInte__b = G742_C17252', 'left');
        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425');
        $this->db->join('G719', 'G719_ConsInte__b = G742_C17244');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = G719_C17029','LEFT');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = G742_Usuario');


        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }
        $this->db->where(" G742_C17242 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");        
        $query = $this->db->get('G742');
        return $query->result();
    }

function getGestionExtrajudicialTotalEliminar($numeroLiquidacion){
        
        $this->db->select('top 3000 G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G742_C17242 as fechaIngreso ,
                            G742_C17243 as Niidea,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G742_C17245 as users,
                            G742_C17246 as observaciones,
                            a.LISOPC_Nombre____b as mediocomunicacion,
                            b.LISOPC_Nombre____b as resultadocomunicacion,
                            c.LISOPC_Nombre____b as gestion,
                            G730_C17126 as financiero,
                            G732_C17131 as subgestion,
                            G729_C17121 as FRG');
       
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G742_C17249');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G742_C17250');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G742_C17251');
        $this->db->join('G732', 'G732_ConsInte__b = G742_C17252', 'left');
        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425');
        $this->db->join('G719', 'G719_ConsInte__b = G742_C17244');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = G719_C17029','LEFT');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = G742_Usuario');
        
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }
        $this->db->where('G719_C17423',  $numeroLiquidacion);     
        $this->db->order_by('G742_C17242','DESC');
        $query = $this->db->get('G742');
        
        return $query->result();
    }

    function getgestionExtrajudicialtotal_SAP($resultadocomunicacion = NULL, $gestion = NULL, $subgestion = NULL, $fechaInicial = NULL, $fechaFinal = NULL){

        $this->db->select(' top 10000 G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G742_C17242 as fechaIngreso ,
                            G742_C17243 as Niidea,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            USUARI_Nombre____b  as users,
                            G742_C17246 as observaciones,
                            G742_C17249 as mediocomunicacion,
                            G742_C17250 as resultadocomunicacion,
                            G742_C17251 as gestion,
                            G719_C17030 as financiero,
                            G742_C17252 as subgestion');
       

        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425');
        $this->db->join('G719', 'G719_ConsInte__b = G742_C17244');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = G742_Usuario');

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }


        if($resultadocomunicacion != NULL && $resultadocomunicacion != '' && $resultadocomunicacion != 0){
            $this->db->where('G742_C17250',  $resultadocomunicacion);     
        }

        if($gestion != NULL && $gestion != '' && $gestion != 0){
            $this->db->where('G742_C17251',  $gestion);
        }

        if($subgestion != NULL && $subgestion != '' && $subgestion != 0){
            $this->db->where('G742_C17252', $subgestion );
        }

        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G742_C17242 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }


        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G742_C17242',  $fechaInicial);   

        }

        $this->db->order_by('G742_C17242','DESC');

        $query = $this->db->get('G742');
        return $query->result();
    }




    function getgestionExtrajudicialtotalById($id){
        $this->db->select(' G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G742_C17242 as fechaIngreso ,
                            G742_C17243 as Niidea,
                            G742_C17244 as contrato,
                            G742_C17245 as users,
                            G742_C17246 as observaciones,
                            a.LISOPC_Nombre____b as mediocomunicacion,
                            b.LISOPC_Nombre____b as resultadocomunicacion,
                            c.LISOPC_Nombre____b as gestion,
                            G732_C17131 as subgestion');
       
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G742_C17249');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G742_C17250');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G742_C17251');
        $this->db->join('G732', 'G732_ConsInte__b = G742_C17252', 'left');
        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425');
        $this->db->where('G742_ConsInte__b', $id); 
        $query = $this->db->get('G742');
        return $query->result();
    }


    function getgestioJudicial($contrato){
        $this->db->select(' G735_ConsInte__b as id, 
                            G724_C17105 as actuacion ,
                            G735_C17138 as contrato,
                            G735_C17139 as txtFechaTramite,
                            G735_C17140 as users,
                            a.LISOPC_Nombre____b as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa' );
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G735_C17143');
        $this->db->join('G724', 'G724_ConsInte__b = G735_C17137');
        $this->db->where('G735_C17138', $contrato); 
        $query = $this->db->get('G735');
        return $query->result();
    }

   function getgestioJudicialTotal($fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select(' G735_ConsInte__b as id, 
                            G724_C17105 as actuacion ,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G735_C17139 as txtFechaTramite,
                            USUARI_Nombre____b as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa,
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G730_C17126 as financiero,
                            b.LISOPC_Nombre____b as claseProceso,
                            G729_C17121 as FRG' );

        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G735_C17143','LEFT');
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('G724', 'G724_ConsInte__b = G735_C17137');


        $this->db->join('G719', 'G719_ConsInte__b = G735_C17138');
        $this->db->join('G737', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = G719_C17029','LEFT');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = G735_Usuario');

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }
         if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }


        $this->db->where('G737.G737_C17183', 1786);
        $this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        return $query->result();
    }


    function getgestioJudicialTotal_SAP($proceso = NULL, $etapa = NULL, $actuaciones = NULL, $fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select(' G735_ConsInte__b as id, 
                            G735_C17137 as actuacion ,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G735_C17139 as txtFechaTramite,
                            G735_C17140 as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G735_C17142 as Etapa,
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G719_C17030 as financiero,
                            G735_C17143 as claseProceso' );

        $this->db->join('G719', 'G719_ConsInte__b = G735_C17138');
        $this->db->join('G737', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');


        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }

        if($proceso != NULL && $proceso != '' && $proceso != 0){
            $this->db->where('G735_C17143',  $proceso);     
        }

        if($etapa != NULL && $etapa != '' && $etapa != 0){
            $this->db->where('G735_C17142',  $etapa);
        }

        if($actuaciones != NULL && $actuaciones != '' && $actuaciones != 0){
            $this->db->where('G735_C17137', $actuaciones );
        }

        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G735_C17141',  $fechaInicial);   
        }
        $this->db->where('G737.G737_C17183', 1786);
        $this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        return $query->result();
    }

    function getgestioJudicialById($contra){
        $this->db->select(' G735_ConsInte__b as id, 
                            G724_C17105 as actuacion ,
                            G735_C17138 as contrato,
                            G735_C17139 as txtFechaTramite,
                            G735_C17140 as users,
                            LISOPC_Nombre____b as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa' );
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('G724', 'G724_ConsInte__b = G735_C17137');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G735_C17143');
        
        $this->db->where('G735_ConsInte__b', $contra); 
        $query = $this->db->get('G735');
        return $query->result();
    }

    function getMedidasCautelares($contrato){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17151 as contrato,
                            G736_C17283 as FechaInforme,
                            G731_C17128 as Medida,
                            resultadoMedida' );
        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->where('G736_C17151', $contrato); 
        $query = $this->db->get('G736');
        return $query->result();
    }

    function getMedidasCautelaresTotal($medida = NULL){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G736_C17283 as FechaInforme,
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G730_C17126 as financiero,
                            G731_C17128 as Medida,
                            resultadoMedida,
                            G729_C17121 as FRG' );

        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->join('G719', 'G719_ConsInte__b = G736_C17151');
        $this->db->join('G737', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = G719_C17029','LEFT');


        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }

        if($medida != NULL && $medida != '' && $medida != 0){
            $this->db->where('G736_C17150', $medida);
        }
        $this->db->where('G737.G737_C17183', 1786);
        $query = $this->db->get('G736');
        return $query->result();
    }


    function getMedidasCautelaresTotal_SAP($medida = NULL, $fechaInicial = NULL, $fechaFinal = NULL){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G736_C17283 as FechaInforme,
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G719_C17030 as financiero,
                            G736_C17150 as Medida,
                            resultadoMedida' );
        $this->db->join('G719', 'G719_ConsInte__b = G736_C17151');
        $this->db->join('G737', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }

        if($medida != NULL && $medida != '' && $medida != 0){
            $this->db->where('G736_C17150', $medida);
        }

        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G736_C17283 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G736_C17283',  $fechaInicial);   
        }
        
        $this->db->where('G737.G737_C17183', 1786);
        $query = $this->db->get('G736');
        return $query->result();
    }


    function getMedidasCautelaresById($id){
         $this->db->select(' G736_ConsInte__b as id, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17151 as contrato,
                            G736_C17283 as FechaInforme,
                            G731_C17128 as Medida' );
        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->where('G736_ConsInte__b', $id); 
        $query = $this->db->get('G736');
        return $query->result();
    }

    function getCodeudores($contrato){
        $this->db->select(' G717_ConsInte__b as id,
                            G717_C17005 as Identificacion, 
                            tipo_identificacion as tipo_identificacion,
                            G717_C17240 as nombre, 
                            G717_C17154 as Numero_obligaciones');
       
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183 ');
        $this->db->join('G717', 'G717_ConsInte__b = G737_C17181');
        $this->db->where('G737_C17182', $contrato); 
        $this->db->where('LISOPC_ConsInte__b != 1786'); 
        $query = $this->db->get('G737');
        if($query->num_rows() > 0){
           return $query->result();
       }else{
        return 0;
       }
        
    }
	
	

    function gerAcuerdoPago($contrato){
        $this->db->select(' G726_C17237 as CONTRATO, 
                            G726_C17110 as FECHA_CONSIGNACION_ANTICIPO, 
                            G726_C17111 as FECHA_DE_LEGALIZACION,
                            G726_C17112 as VALOR_DEL_ACUERDO,
                            G726_C17113 as PLAZO_ACUERDO_DE_PAGO,
                            G726_C17223 as VALOR_CUOTA_DEL_ACUERDO,
                            G726_C17224 as FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA,
                            G726_C17109 as FECHA_LIQUIDACION,
                            G726_C17225 as FECHA_ULTIMACUOTA,
                            G726_C17419 as TASAINTERES,
                            G726_ConsInte__b as id');
    
        $this->db->where('G726_C17237', $contrato); 
        $query = $this->db->get('G726');
        return $query->result();
    }

    function gerAcuerdoPagoById($contrato){
        $this->db->select(' G719_C17026 as CONTRATO, 
                            G726_C17110 as FECHA_CONSIGNACION_ANTICIPO, 
                            G726_C17111 as FECHA_DE_LEGALIZACION,
                            G726_C17112 as VALOR_DEL_ACUERDO,
                            G726_C17113 as PLAZO_ACUERDO_DE_PAGO,
                            G726_C17223 as VALOR_CUOTA_DEL_ACUERDO,
                            G726_C17224 as FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA,
                            G726_C17109 as FECHA_LIQUIDACION,
                            G726_C17225 as FECHA_ULTIMACUOTA,
                            G726_C17419 as TASAINTERES,
                            G726_ConsInte__b as id');
        $this->db->from('G726');
        $this->db->join('G719', 'G719_ConsInte__b = G726_C17237');
        $this->db->where('G726_ConsInte__b', $contrato); 
        $query = $this->db->get();
        return $query->result();
    }

    function getGarantias($contrato){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare,
                            G719_C17026 as contrato,
                            G719_C17425 as vPagado');
        $this->db->join('G719','G734_C17241 = G719_ConsInte__b');
        $this->db->where('G734_C17241', $contrato); 
        $query = $this->db->get('G734');
        return $query->result();
    }


    /// Procesos Asociados Jeisson Patiño 24 01 2019
    function getProcesoAsociado($idUsuario){
        $this->db->select(' 
                            G717_ConsInte__b idUsuario,
                            G717_C17005 as identificacion,
                            liquidacion,
                            a.LISOPC_Nombre____b AS Proceso,
                            b.LISOPC_Nombre____b AS EstadoProceso
                            ');
        $this->db->from('HistoricoProcesoAsociado');
        $this->db->join('G719','IdCredito = G719_ConsInte__b','LEFT');
        $this->db->join('LISOPC as a','IdClaseProc = a.LISOPC_ConsInte__b','LEFT');
        $this->db->join('LISOPC as b','IdEstProceso = b.LISOPC_ConsInte__b');
        $this->db->join('G737','IdCredito = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('G717_ConsInte__b', $idUsuario); 
        $query = $this->db->get();
        return $query->result();
    }


    function getGarantiasxLiquidacion($liquidacion){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare,
                            G719_C17026 as contrato,
                            G719_C17425 as vPagado');
        $this->db->join('G719','G734_C17241 = G719_ConsInte__b');
        $this->db->where('G719_C17423', $liquidacion); 
        $query = $this->db->get('G734');
        return $query->result();
    }

    


    function getLiquidacionN($contrato){
        $this->db->select('G719_C17423 as eso');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        if($query->num_rows() > 0){
            return $query->row()->eso;
        }else{
            return 0;
        }
        
    }

    function getcontratosXLiquidacion($contrato){
        $this->db->select('G719_ConsInte__b');
        $this->db->where('G719_C17423', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
        
    }


    function getGarantiasById($contrato){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare');
        $this->db->where('G734_ConsInte__b', $contrato); 
        $query = $this->db->get('G734');
        return $query->result();
    }

    function getFacturasbyid($contrato){
        $this->db->select(' G744_C17262 as FECHA_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            G744_C17263 as N_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            G744_C17264 as FECHA_AUTO_DE_SUBROGACION,
                            G744_C17265 as N_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            G744_C17266 as FECHA_SENTENCIA_IRRECUPERABLE,
                            G744_C17267 as FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            G744_C17270 as N_DE_FACTURAS_SOPORTES_CISA,
                            G744_C17285 as FECHA_LIQUIDACION_CREDITO,
                            G744_C17286 as FECHA_AUTO_IRRECUPERABLE,
                            b.LISOPC_Nombre____b As SOPORTE,
                            G744_C17276 as VALOR_FACTURADO_AUTO_DE_SUBROGACION, 
                            G744_C17268 as FECHA_FACTURA_SOPORTES_CISA, 
                            G744_C17277 as VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE,
                            G744_C17278 as VALOR_FACTURADO_SOPORTES_CISA,
                            a.LISOPC_Nombre____b As RENUNCIA_Y_PAZ_Y_SALVO_O_CESION,
                            G744_C17280 as N_CONTRATO,
                            G744_C17269 as HONORARIOS_VENTA_CISA,
                            G744_C17423 as N_Factura_honorarios_venta_CISA,
                            G744_C17424 as Fecha_de_factura_honorarios_venta_CISA,
                            G744_ConsInte__b ,
                            Fecha_recepcion_soporte,
                            Fecha_aprobacion_soporte');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G744_C17279 ', 'LEFT');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G744_C17275 ', 'LEFT');        
        $this->db->where('G744_ConsInte__b', $contrato); 
        $query = $this->db->get('G744');
        return $query->result();
    }

    function getFacturas($contrato){
        $this->db->select(' G744_C17262 as FECHA_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            G744_C17263 as N_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            G744_C17264 as FECHA_AUTO_DE_SUBROGACION,
                            
                            G744_C17265 as N_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            G744_C17266 as FECHA_SENTENCIA_IRRECUPERABLE,
                            G744_C17267 as FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            G744_C17270 as N_DE_FACTURAS_SOPORTES_CISA,
                            G744_C17285 as FECHA_LIQUIDACION_CREDITO,
                            G744_C17286 as FECHA_AUTO_IRRECUPERABLE,
                            G744_C17275 as SOPORTE,
                            G744_C17276 as VALOR_FACTURADO_AUTO_DE_SUBROGACION, 
                            G744_C17268 as FECHA_FACTURA_SOPORTES_CISA, 
                            G744_C17277 as VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE,
                            G744_C17278 as VALOR_FACTURADO_SOPORTES_CISA,
                            G744_C17279 as RENUNCIA_Y_PAZ_Y_SALVO_O_CESION,
                            G744_C17280 as N_CONTRATO,
                            G744_C17269 as HONORARIOS_VENTA_CISA,
                            G744_C17423 as N_Factura_honorarios_venta_CISA,
                            G744_C17424 as Fecha_de_factura_honorarios_venta_CISA,
                            G744_ConsInte__b,
                            Fecha_recepcion_soporte,
                            Fecha_aprobacion_soporte ');
                            
        $this->db->where('G744_C17280', $contrato); 
        $query = $this->db->get('G744');
        return $query->result();
    }

    function getinformacionJudicial($contrato){
        $this->db->select('G719_C17043 AS Radicado_o_expediente, 
                           G719_C17044 AS Fech_demanda, 
                           G719_C17045 AS Fecha_admision_demanda,
                           G719_C17046 AS Fecha_mandamiento_de_pago,
                           G719_C17222 As Total_gastos_judiciales,
                           G719_C17426 As abogado_if,
                           G719_ConsInte__b as id,
                           G719_C17427 as fechaenvioterminacion');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    
    }

    function getInformacionAbogado($contrato){
        
        $this->db->select(' G723_C17099 as Abogado,
                            G723_C17100 as celular,
                            G723_C17101 as correo,
                            direccion,
                            telefono,
                            G719_C17051 as Fecha_asignacion_abogado,
                            G719_C17054 as No_Poliza,
                            G719_C17056 as Fecha_de_aprobacion_de_Poliza,
                            G719_C17055 as Fecha_de_vencimiento,
                            G729_C17121 as frg,
                            G728_C17116 as firma,
                            G719_C17220 as promotor');
		$this->db->join('G723', 'G723_ConsInte__b = G719_C17153', 'LEFT');
        //Firma_abogados,  G729_C17121 G729_ConsInte__b
        $this->db->join('G728', 'G728_ConsInte__b = Firma_abogados', 'LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = Frg_ConsInte__b', 'LEFT');

        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    }

    function getPazYsalvo($contrato){
        
        $this->db->select(' G719_C17071 AS Fecha_de_expedicion_del_paz_y_salvo,
                            G719_C17070 AS Paz_y_salvo,
                            G719_C17073 AS Fecha_venta');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    }

    function getSubrogacion($contrato){
        
        $this->db->select(' G719_C17048 AS Fecha_envio_memorial_de_subrogacion_al_FRG,
                            G719_C17049 AS Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores,
                            G719_C17050 AS Fecha_envio_memorial_de_subrogacion_corregido,
                            G719_C17212 AS Fecha_radicacion_memorial,
                            G719_C17213 As Fecha_pronunciamiento,
                            a.G724_C17105  AS Decision,
                            G719_C17218 AS Fecha_impugnacion_decision_final,
                            b.G724_C17105 As Nombre_clase_de_impugnacion,
                            c.G724_C17105 As decicion_Final,
                            Fecha_decision_final');
        $this->db->join('G724 a', 'G719_C17214 = a.G724_ConsInte__b', 'LEFT');
        $this->db->join('G724 b', 'G719_C17215 = b.G724_ConsInte__b', 'LEFT');
        $this->db->join('G724 c', 'G719_C17216 = c.G724_ConsInte__b', 'LEFT');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    }

    function getSubrogacionByCOntrato($contrato){
        
        $this->db->select('G719_C17212 AS Fecha_radicacion_memorial');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->row()->Fecha_radicacion_memorial;
    }

    function getSubrogacionParaDecicionFinal($contrato){
        
        $this->db->select('G719_C17218 AS Fecha_inpugnacion');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->row()->Fecha_inpugnacion;
    }

    function getDatosAdicionales($clienteId){
       
        $this->db->select(' G743_C17256 AS Telefono,
                            G743_C17257 AS Direccion,
                            G718_C17015 AS Ciudad,
                            G743_C17363 AS Correo_electronico,
                            G743_C17260 AS Descripcion,
                            G743_C17361 AS Fecha,
                            G743_ConsInte__b as id,
                            a.LISOPC_Nombre____b As Calificacion_correo,
                            b.LISOPC_Nombre____b As Calificacion_telefono,
                            c.LISOPC_Nombre____b As Calificacion_direccion,
                            d.LISOPC_Nombre____b As Calificacion_ciudad,
                            e.LISOPC_Nombre____b As Calificacion_descripcion,
                            G719_C17423 as obligacion,
                            G717_C17240 as deudor,
                            G743_C17269 as rol');
        $this->db->join('G718', 'G718_ConsInte__b = G743_C17258', 'LEFT');
   

        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G743_C17262 ', 'LEFT');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G743_C17263 ', 'LEFT');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G743_C17264 ', 'LEFT');
        $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = G743_C17265 ', 'LEFT');
        $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = G743_C17266 ', 'LEFT');
        $this->db->join('G719', 'G719_ConsInte__b = G743_C17267 ', 'LEFT');
        $this->db->join('G717', 'G717_ConsInte__b = G743_C17268 ', 'LEFT');
        $this->db->where('G743_C17261', $clienteId); 
        $query = $this->db->get('G743');
        return $query->result();
    }

    function getDatosAdicionalesByid($id){
        $this->db->select(' G743_C17256 AS Telefono,
                            G743_C17257 AS Direccion,
                            G718_C17015 AS Ciudad,
                            G743_C17363 AS Correo_electronico,
                    
                            G743_C17260 AS Descripcion,
                            G743_C17361 AS Fecha,
                            G743_ConsInte__b as id,
                            a.LISOPC_Nombre____b As Calificacion_correo,
                            b.LISOPC_Nombre____b As Calificacion_telefono,
                            c.LISOPC_Nombre____b As Calificacion_direccion,
                            d.LISOPC_Nombre____b As Calificacion_ciudad,
                            e.LISOPC_Nombre____b As Calificacion_descripcion');
        $this->db->join('G718', 'G718_ConsInte__b = G743_C17258', 'LEFT');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G743_C17262 ', 'LEFT');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G743_C17263 ', 'LEFT');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G743_C17264 ', 'LEFT');
        $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = G743_C17265 ', 'LEFT');
        $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = G743_C17266 ', 'LEFT');

        $this->db->where('G743_ConsInte__b', $id); 
        $query = $this->db->get('G743');
        return $query->result();
    }


    function getSalariomin(){
        $this->db->select('G758_C17367 as minimo');
        $query = $this->db->get('G758');
        return $query->row()->minimo;
    }

    function validarSAP($sap){
        $this->db->select('G719_ConsInte__b');
        $this->db->where('G719_C17039', $sap);
        $query = $this->db->get('G719');

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function validarObligacion($contrato){
        $this->db->select('G719_ConsInte__b');
        $this->db->where('G719_C17026', $contrato);
        $query = $this->db->get('G719');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function validarLiquidacion($liquidacion){
        $this->db->select('G719_ConsInte__b');
        $this->db->where('G719_C17423', $liquidacion);
        $query = $this->db->get('G719');

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function getNumeroContrato($liquidacion){
        $this->db->select('G719_C17026 as NumeroContrato');
        $this->db->where('G719_C17423', $liquidacion);
        $query = $this->db->get('G719');

        
        if($query->num_rows() > 0){
            return $query->row()->NumeroContrato;
        }else{
            return "0";
        }

    }



    function getgestionExtrajudicialtotal_SAP_Final($fechaInicial = NULL, $fechaFinal = NULL, $id){
        $this->db->select('TOP 1 G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17034 as Vlorpagado,
                            G742_C17242 as fechaIngreso ,
                            G742_C17243 as Niidea,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G742_C17245 as users,
                            G742_C17246 as observaciones,
                            G742_C17249 as mediocomunicacion,
                            G742_C17250 as resultadocomunicacion,
                            G742_C17251 as gestion,
                            G719_C17030 as financiero,
                            G742_C17252 as subgestion,
                            G723_C17099 as abogado,
                            G719_C17051 as fechaabogado,
                            G719_C17054 as poliza,
                            G719_C17056 as fecha_aprovacion,
                            G719_C17055 as fecha_vencimiento
                            G742_C17244');
       

        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425');
        $this->db->join('G719', 'G719_ConsInte__b = G742_C17244');
        $this->db->join('G723', 'G723_ConsInte__b =  G719_C17153', 'LEFT');
        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G742_C17242 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G742_C17242',  $fechaInicial);   
        }
        $this->db->where('G742_C17244',  $id);   
        $this->db->order_by('G742_C17242','DESC');

        $query = $this->db->get('G742');
        
        if( $query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }


    function getgestioJudicialTotal_SAP_Final($fechaInicial = NULL, $fechaFinal = NULL, $idContrato){

        $this->db->select('TOP 1 G735_ConsInte__b as id, 
                            G735_C17137 as actuacion ,
                            G735_C17139 as txtFechaTramite,
                            G735_C17140 as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G735_C17142 as Etapa,
                            G735_C17143 as claseProceso,
                            G723_C17099 as abogado,
                            G719_C17051 as fechaabogado,
                            G719_C17054 as poliza,
                            G719_C17056 as fecha_aprovacion,
                            G719_C17055 as fecha_vencimiento,
                            G719_C17039 as SAP,
                            G719_C17423 as liquidacion,
                            G719_C17212 AS Fecha_radicacion_memorial,
                            G719_C17213 As Fecha_pronunciamiento,
                            G719_C17214 AS Decision' );

        $this->db->join('G719', 'G719_ConsInte__b = G735_C17138');
        $this->db->join('G723', 'G723_ConsInte__b =  G719_C17153', 'LEFT');


        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G735_C17141',  $fechaInicial);   
        }

        $this->db->where("G735_C17138", $idContrato);
        $this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        if( $query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
    }


    function getMedidasCautelaresTotal_SAP_final($fechaInicial = NULL, $fechaFinal = NULL, $contrato){

        $this->db->select(' TOP 1 G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17283 as FechaInforme,
                            G736_C17150 as Medida,
                            resultadoMedida' );

        
        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G736_C17283 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G736_C17283',  $fechaInicial);   
        }
        $this->db->where("G736_C17151", $contrato);
        $this->db->order_by('G736_C17283','DESC');
        $query = $this->db->get('G736');
        if( $query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }


    function getgestionJudicialEliminar($liquidacion){
        $this->db->select(' G735_ConsInte__b as id, 
                            G735_C17137 as actuacion ,
                            G719_C17026 as contrato,
                            G719_C17423 as liquidacion,
                            G735_C17139 as txtFechaTramite,
                            G735_C17140 as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G735_C17142 as Etapa,
                            G717_C17240 as nombres,
                            G717_C17005 as identificacion,
                            tipo_identificacion as tipo_identificacion,
                            G719_C17039 as SAP,  
                            G719_C17424 as Vlorpagado,
                            G719_C17030 as financiero,
                            G735_C17143 as claseProceso' );

        $this->db->join('G719', 'G719_ConsInte__b = G735_C17138');
        $this->db->join('G737', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');


        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }

        if($liquidacion != NULL && $liquidacion != '' && $liquidacion != 0){
            $this->db->where('G719_C17423',  $liquidacion);     
        }

       
        $this->db->where('G737.G737_C17183', 1786);
        $this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        return $query->result();
    }

   function getDatosAdicionalesProcesoAsociado($liquidacion){
       
        $this->db->select(' G743_C17256 AS Telefono,
                            G743_C17257 AS Direccion,
                            G718_C17015 AS Ciudad,
                            G743_C17363 AS Correo_electronico,
                            G743_C17260 AS Descripcion,
                            G743_C17361 AS Fecha,
                            G743_ConsInte__b as id,
                            a.LISOPC_Nombre____b As Calificacion_correo,
                            b.LISOPC_Nombre____b As Calificacion_telefono,
                            c.LISOPC_Nombre____b As Calificacion_direccion,
                            d.LISOPC_Nombre____b As Calificacion_ciudad,
                            e.LISOPC_Nombre____b As Calificacion_descripcion,
                            G719_C17423 as obligacion,
                            G717_C17240 as deudor,
                            G743_C17269 as rol');
        $this->db->join('G719', 'G719_ConsInte__b = G743_C17267 ', 'LEFT');
        $this->db->join('HistoricoProcesoAsociado', 'IdCredito = G719_ConsInte__b ', 'LEFT');
        $this->db->join('G718', 'G718_ConsInte__b = G743_C17258', 'LEFT');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G743_C17262 ', 'LEFT');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G743_C17263 ', 'LEFT');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G743_C17264 ', 'LEFT');
        $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = G743_C17265 ', 'LEFT');
        $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = G743_C17266 ', 'LEFT');
        $this->db->join('G717', 'G717_ConsInte__b = G743_C17268 ', 'LEFT');
        $this->db->where('liquidacion', $liquidacion); 
        $query = $this->db->get('G743');
        return $query->result();
    }
     function getgestionExtrajudicialProcesoAsociado($contrato){
        $this->db->select(' G742_ConsInte__b as id, 
                            G717_C17240 as nombres,
                            G742_C17242 as fechaIngreso ,
                            G742_C17243 as Niidea,
                            G742_C17244 as contrato,
                            G742_C17245 as users,
                            G742_C17426 as tarea,
                            G742_C17246 as observaciones,
                            a.LISOPC_Nombre____b as mediocomunicacion,
                            b.LISOPC_Nombre____b as resultadocomunicacion,
                            c.LISOPC_Nombre____b as gestion,
                            G732_C17131 as subgestion');
        $this->db->join('HistoricoProcesoAsociado', ' G742_C17244 = IdCredito', 'left');
        $this->db->join('G719', 'G719_ConsInte__b = IdCredito', 'left');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G742_C17249', 'left');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G742_C17250', 'left');
        $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G742_C17251', 'left');
        $this->db->join('G732', 'G732_ConsInte__b = G742_C17252', 'left');
        $this->db->join('G717', 'G717_ConsInte__b = G742_C17425', 'left');
        $this->db->where('ProcJudicial != G719_C17039 and G742_C17244', $contrato); 
        $query = $this->db->get('G742');
        return $query->result();
    }


    function getgestioJudicialProcesoAsociado($contrato){
        $this->db->select(' G735_ConsInte__b as id, 
                            G724_C17105 as actuacion ,
                            G735_C17138 as contrato,
                            G735_C17139 as txtFechaTramite,
                            G735_C17140 as users,
                            a.LISOPC_Nombre____b as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa' );
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('HistoricoProcesoAsociado','IdCredito = G735_C17138','LEFT');
        $this->db->join('G719', 'G719_ConsInte__b = IdCredito', 'left');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G735_C17143');
        $this->db->join('G724', 'G724_ConsInte__b = G735_C17137');
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('G735');
        return $query->result();
    }

    function getMedidasCautelaresProcesoAsociado($contrato){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17151 as contrato,
                            G736_C17283 as FechaInforme,
                            G731_C17128 as Medida,
                            resultadoMedida' );
        $this->db->join('HistoricoProcesoAsociado', 'IdCredito = G736_C17151');
        $this->db->join('G719', 'G719_ConsInte__b = IdCredito', 'left');
        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('G736');
        return $query->result();
    }


    function getCodeudoresProcesoAsociado($contrato){
        $this->db->select(' TOP 1 G717_ConsInte__b as id,
                            G717_C17005 as Identificacion, 
                            tipo_identificacion as tipo_identificacion,
                            G717_C17240 as nombre, 
                            G717_C17154 as Numero_obligaciones');

        $this->db->join('G719', 'G737_C17182 = G719_ConsInte__b','LEFT');
        $this->db->join('HistoricoProcesoAsociado', 'IdCredito = G719_ConsInte__b ');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183 ');
        $this->db->join('G717', 'G717_ConsInte__b = G737_C17181');
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('IdCredito', $contrato); 
        $this->db->where('LISOPC_ConsInte__b != 1786'); 
        $query = $this->db->get('G737');
        if($query->num_rows() > 0){
           return $query->result();
       }else{
        return 0;
       }
        
    }
    

    function gerAcuerdoPagoProcesoAsociado($contrato){
        $this->db->select(' G726_C17237 as CONTRATO, 
                            G726_C17110 as FECHA_CONSIGNACION_ANTICIPO, 
                            G726_C17111 as FECHA_DE_LEGALIZACION,
                            G726_C17112 as VALOR_DEL_ACUERDO,
                            G726_C17113 as PLAZO_ACUERDO_DE_PAGO,
                            G726_C17223 as VALOR_CUOTA_DEL_ACUERDO,
                            G726_C17224 as FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA,
                            G726_C17109 as FECHA_LIQUIDACION,
                            G726_C17225 as FECHA_ULTIMACUOTA,
                            G726_C17419 as TASAINTERES,
                            G726_ConsInte__b as id');
        $this->db->join('G719', 'G726_C17237 = G719_ConsInte__b','LEFT');
        $this->db->join('HistoricoProcesoAsociado', 'IdCredito = G719_ConsInte__b','LEFT');
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('G726');
        return $query->result();
    }


    function getLiquidacionNProcesoAsociado($contrato){
        $this->db->select('liquidacion as eso');
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('HistoricoProcesoAsociado');
        if($query->num_rows() > 0){
            return $query->row()->eso;
        }else{
            return 0;
        }
        
    }

    function getGarantiasProcesoAsociado($contrato){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare,
                            IdCredito as contrato,
                            G719_C17425 as vPagado');

        $this->db->join('G719','G734_C17241 = G719_ConsInte__b');
        $this->db->join('HistoricoProcesoAsociado','IdCredito = G719_ConsInte__b');
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('G734');
        return $query->result();
    }

    function getcontratosXLiquidacionProcesoAsociado($contrato){
        $this->db->select('IdCredito');
        $this->db->where('liquidacion', $contrato); 
        $query = $this->db->get('HistoricoProcesoAsociado');
        return $query->result();
     }  

     function getFacturasProcesoAsociado($contrato){
        $this->db->select(' G744_C17262 as FECHA_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            G744_C17263 as N_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            G744_C17264 as FECHA_AUTO_DE_SUBROGACION,
                            
                            G744_C17265 as N_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            G744_C17266 as FECHA_SENTENCIA_IRRECUPERABLE,
                            G744_C17267 as FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            G744_C17270 as N_DE_FACTURAS_SOPORTES_CISA,
                            G744_C17285 as FECHA_LIQUIDACION_CREDITO,
                            G744_C17286 as FECHA_AUTO_IRRECUPERABLE,
                            G744_C17275 as SOPORTE,
                            G744_C17276 as VALOR_FACTURADO_AUTO_DE_SUBROGACION, 
                            G744_C17268 as FECHA_FACTURA_SOPORTES_CISA, 
                            G744_C17277 as VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE,
                            G744_C17278 as VALOR_FACTURADO_SOPORTES_CISA,
                            G744_C17279 as RENUNCIA_Y_PAZ_Y_SALVO_O_CESION,
                            G744_C17280 as N_CONTRATO,
                            G744_C17269 as HONORARIOS_VENTA_CISA,
                            G744_C17423 as N_Factura_honorarios_venta_CISA,
                            G744_C17424 as Fecha_de_factura_honorarios_venta_CISA,
                            G744_ConsInte__b,
                            Fecha_recepcion_soporte,
                            Fecha_aprobacion_soporte ');

        $this->db->join('HistoricoProcesoAsociado','IdCredito = G744_C17280');
        $this->db->join('G719','IdCredito = G719_ConsInte__b');    
        $this->db->where('ProcJudicial != G719_C17039');                
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('G744');
        return $query->result();
    }


    function getinformacionJudicialProcesoAsociado($contrato){
        $this->db->select('G719_C17043 AS Radicado_o_expediente, 
                           G719_C17044 AS Fech_demanda, 
                           G719_C17045 AS Fecha_admision_demanda,
                           G719_C17046 AS Fecha_mandamiento_de_pago,
                           G719_C17222 As Total_gastos_judiciales,
                           G719_C17426 As abogado_if,
                           G719_ConsInte__b as id,
                           G719_C17427 as fechaenvioterminacion');

        $this->db->join('HistoricoProcesoAsociado','IdCredito = G719_ConsInte__b'); 
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('IdCredito', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    
    }

    function getInformacionAbogadoProcesoAsociado($contrato){
        
        $this->db->select(' G723_C17099 as Abogado,
                            G723_C17100 as celular,
                            G723_C17101 as correo,
                            direccion,
                            telefono,
                            G719_C17051 as Fecha_asignacion_abogado,
                            G719_C17054 as No_Poliza,
                            G719_C17056 as Fecha_de_aprobacion_de_Poliza,
                            G719_C17055 as Fecha_de_vencimiento,
                            G729_C17121 as frg,
                            G728_C17116 as firma,
                            G719_C17220 as promotor');
        $this->db->join('G723', 'G723_ConsInte__b = G719_C17153', 'LEFT');
        $this->db->join('HistoricoProcesoAsociado','idCredito = G719_ConsInte__b'); 
        $this->db->join('G728', 'G728_ConsInte__b = Firma_abogados', 'LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = Frg_ConsInte__b', 'LEFT');
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('idCredito', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    }


    function getPazYsalvoProcesoAsociado($contrato){
        
        $this->db->select(' G719_C17071 AS Fecha_de_expedicion_del_paz_y_salvo,
                            G719_C17070 AS Paz_y_salvo,
                            G719_C17073 AS Fecha_venta');
        $this->db->join('HistoricoProcesoAsociado','idCredito = G719_ConsInte__b'); 
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('idCredito', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    }


    function getSubrogacionProcesoAsociado($contrato){
        
        $this->db->select(' G719_C17048 AS Fecha_envio_memorial_de_subrogacion_al_FRG,
                            G719_C17049 AS Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores,
                            G719_C17050 AS Fecha_envio_memorial_de_subrogacion_corregido,
                            G719_C17212 AS Fecha_radicacion_memorial,
                            G719_C17213 As Fecha_pronunciamiento,
                            a.G724_C17105  AS Decision,
                            G719_C17218 AS Fecha_impugnacion_decision_final,
                            b.G724_C17105 As Nombre_clase_de_impugnacion,
                            c.G724_C17105 As decicion_Final,
                            Fecha_decision_final');
        $this->db->join('HistoricoProcesoAsociado','idCredito = G719_ConsInte__b'); 
        $this->db->join('G724 a', 'G719_C17214 = a.G724_ConsInte__b', 'LEFT');
        $this->db->join('G724 b', 'G719_C17215 = b.G724_ConsInte__b', 'LEFT');
        $this->db->join('G724 c', 'G719_C17216 = c.G724_ConsInte__b', 'LEFT');
        $this->db->where('ProcJudicial != G719_C17039');
        $this->db->where('G719_ConsInte__b', $contrato); 
        $query = $this->db->get('G719');
        return $query->result();
    }
                           
}
