<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Obligaciones_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getDatosersonales($codigo){
        $this->db->select('G717_C17240 as Deudor, G717_C17005 as identificacion,
                           G717_C17006 as TelefonoD, G717_C17008 as TelefonoO,
                           G717_C17007 as DireccionD, a.G718_C17015 as ciudadD, G717_C17012, G717_C17013,
                           G717_C17009 as DireccionO, b.G718_C17015 as CiudadO,
                           G717_C17010 as Celular, G717_C17011 as CelularA,
                           G717_C17017 as Mail, G717_C17154 as Nobligaciones, G717_ConsInte__b as idusuario,
                           dir_Adicional, c.G718_C17015 as ciudad_ad, tele_adicional, ciudad_adicional');
        $this->db->join('G718 as a', 'a.G718_ConsInte__b = G717_C17012', 'LEFT');
        $this->db->join('G718 as b', 'b.G718_ConsInte__b = G717_C17013', 'LEFT');
        $this->db->join('G718 as c', 'c.G718_ConsInte__b = ciudad_adicional', 'LEFT');
        $this->db->where('G717_C17005', $codigo); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G717');
        return $query->result();
    }

    
    function getIdUsuario($codigo){
        $this->db->select('G717_ConsInte__b');
        $this->db->where('G717_C17005', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717');
        return $query->row()->G717_ConsInte__b;
    }

    function validarIdUsuario($codigo){
        $codigo =  str_replace("'", " ", $codigo);
        $codigo = str_replace(" ", '', $codigo);
        $this->db->select('*');
        $this->db->where('G717_C17005', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
 
    }

    function getLiquidaciones($idCliente){
        $this->db->select(' G719_C17423 as liquidacion');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');


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

        $this->db->where('G737_C17181', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('G737_C17183', 1786);
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('G737');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }

    function getLiquidacionesNumero($idCliente){
        $this->db->select(' G719_C17423 as liquidacion');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->where('G737_C17181', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('G737_C17183', 1786);
        $this->db->where('G719_C17423 IS NOT NULL');
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('G737');
        return $query->num_rows();
    }

    function getLiquidacionesNumero_S($idCliente){
        $this->db->select('G719_C17423');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->where('G737_C17181', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('G737_C17183', 1786);
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('G737');
        return $query->result();
    }


    function getContratos($idCliente){

        $this->db->select(' G737_C17181 AS ID_CLIENTE, 
                            G737_C17182 As No_CONTRATO,  
                            G737_C17183 AS ROL ,
                            G719_C17026 as OBLIGACION,
                            G719_C17423 as liquidacion,
                            G730_C17126 as financiero ');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');


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

        $this->db->where('G737_C17181', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G737');
        return $query->result();
    }

    function getObligacionesUsuario($idCliente){
         $this->db->select('G737_C17181 AS ID_CLIENTE, 
                            G737_C17182 As No_CONTRATO,  
                            G737_C17183 AS ROL ,
                            G719_C17026 as OBLIGACION,
                            G717_C17005 as identificacion,
                            G717_C17240 as Deudor,
                            G719_ConsInte__b,
                            LISOPC_Nombre____b');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183');
        $this->db->where('G737_C17181', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G737');
        return $query->result();


    }
	
	function getNumObligacionesUsuario($idCliente){
         $this->db->select('G737_C17181 AS ID_CLIENTE, 
                            G737_C17182 As No_CONTRATO,  
                            G737_C17183 AS ROL ,
                            G719_C17026 as OBLIGACION,

                            G717_C17005 as identificacion,
                            G717_C17240 as Deudor,
                            LISOPC_Nombre____b');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183');
        $this->db->where('G737_C17181', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G737');
        return $query->num_rows();

    }


    function getObligaciones(){
        $this->db->select('G719_C17026 AS No_CONTRATO, G719_C17423 as liquidacion, G719_ConsInte__b ');
        $query = $this->db->get('G719');
        return $query->result();

    }

   /*function getLiquidacionesParaOtra(){
        $this->db->select('DISTINCT G719_C17423 as liquidacion, G719_ConsInte__b ');
        $this->db->where('G719_C17423 IS NOT NULL');
        $query = $this->db->get('G719');
        return $query->result();

    }*/

   
    function getIdObligacion($contrato){
        $this->db->select(' G719_ConsInte__b AS Contrato');
        $this->db->from('G719');
        $this->db->where('G719_C17026', $contrato);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row()->Contrato;    
        }else{
            return 0;
        }
        
    }

    function getIdObligacionByLiquidacion($liquidacion){
        $this->db->select('G719_ConsInte__b AS Contrato');
        $this->db->from('G719');
        $this->db->where("G719_C17423 LIKE '%".$liquidacion."%' ");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row()->Contrato;    
        }else{
            return 0;
        }
    }


    function getDatosObligaciones($idtabla){
        $this->db->select(' G719_C17026 AS Contrato, 
                            G719_C17423 as liquidacion,
                            G719_C17424 as Vlorpagado, 
                            G719_C17032 as fgarantia, 
                            G719_C17030 as intermediario,
                            G730_C17126 as financiero, 
                            G719_C17028 as Cobertura, 
                            G729_C17121 as FRG, 
                            G719_C17039 as SAP,  
                            G733_C17132 as Despacho,
                            b.LISOPC_Nombre____b as claseProceso , 
                            a.LISOPC_Nombre____b as estadoP,
                            G719_C17035 as saldo,
                            G719_C17037 as interespormora,  
                            G719_C17222 as GastoJudiciales,
                            G719_C17052 as porcentajeAbogado, 
                            G719_C17295 as ultimoavnoFecha,
                            G719_C17039 as Judiciable,
                            G719_C17038 as procesoGu, 
                            G718_C17015 as ciudaddespacho

                            ');
        $this->db->from('G719');
        $this->db->join('G737', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
        $this->db->join('G729', 'G729_ConsInte__b = G719_C17029','LEFT');
        $this->db->join('G733', 'G733_ConsInte__b = G719_C17040','LEFT');
        $this->db->join('G718', 'G718_ConsInte__b = G719_C17041', 'LEFT');
        $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G719_C17420','LEFT');
        $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G719_C17038','LEFT');
        $this->db->where('G719_ConsInte__b', $idtabla); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('G737_C17183', 1786);
       
        $query = $this->db->get();
        return $query->result();

    }

    


   


}
