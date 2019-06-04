<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Extrajudicial_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getClientesNuevos(){
        $this->db->select('[G717_C17240] as deudor
					      ,[G717_C17005] as identificacion
					      ,[G717_V1].[G719_C17030] as intemediario
					      ,[G717_V1].[G719_C17034] as valor
					      ,[G717_V1].[G719_C17032] as fecha
					      ,[G717_V1].[G719_ConsInte__b]
                          ,G719.G719_C17026 as contrato
                          ,G719.G719_C17423 as liquidacion
					      ,[G717_ConsInte__b]
					      ,[G742_ConsInte__b]
					      ,[G737_ConsInte__b]
					      ,[G737_C17183]');
        // filtros de abogados y gestores
        $this->db->join('G719', 'G717_V1.G719_ConsInte__b = G719.G719_ConsInte__b');
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

        /**/
        $this->db->order_by('[G717_V1].[G717_C17240]', 'ASC');
        $query = $this->db->get('G717_V1');


        return $query->result();
    }

    function gettotalClientesNuevos(){
        $this->db->select('[G717_C17240] as deudor
					      ,[G717_C17005] as identificacion
					      ,[G719_C17030] as intemediario
					      ,[G719_C17034] as valor
					      ,[G719_C17032] as fecha
					      ,[G719_ConsInte__b]
					      ,[G717_ConsInte__b]
					      ,[G742_ConsInte__b]
					      ,[G737_ConsInte__b]
					      ,[G737_C17183]');
        $query = $this->db->get('G717_V1');


        return $query->num_rows();
    }

    function getClientesDatoNuevo(){
    	$this->db->select('DISTINCT [G717_C17240] as Nombre
					      ,[G717_C17005] as identificacion
					      ,[G743_C17257] as direccion
					      ,[G743_C17256] as telefono
					      ,[G743_C17258] as ciudad
					      ,[G717_ConsInte__b]
					      ,[G743_ConsInte__b]');
        // filtros de abogados y gestores
        $this->db->join('G737', 'G737.G737_C17181 = G717_V2.G717_ConsInte__b');
        $this->db->join('G719', 'G737.G737_C17182 = G719.G719_ConsInte__b');

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


        
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V2');


        return $query->result();

    	
    }

    function getTotalClientesDatoNuevo(){
    	$this->db->select('[G717_C17240] as Nombre');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G717_V2');


        return $query->num_rows();

    	
    }

    function getClientesacuerdoPago(){
    	$this->db->select('[G717_C17240] as Nombre
					      ,[G717_C17005] as identificacion
					      ,[G717_V5].[G719_C17026] as contrato
                ,G719.G719_C17423 as liquidacion
					      ,[G726_C17111] as fecha_legal
					      ,G726_ConsInte__b as id');
        $this->db->join('G719', 'G717_V5.G719_ConsInte__b = G719.G719_ConsInte__b');

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

        
        $this->db->order_by('[G726_C17111]', 'DESC');
        $query = $this->db->get('G717_V5');


        return $query->result();
    }
	
	function getDatosAcuerdosdePago($codigo){
		$this->db->select('[G719_C17026] as contrato
					      ,G726_C17109 as liquidacion
					      ,G726_C17110 as consignacion_ant
						  ,G726_C17111 as legalizacion
						  ,G726_C17112 as valor
						  ,G726_C17113 as plazo
						  ,G726_C17223 as cuota
						  ,G726_C17224 as primeracuota
						  ,G726_C17225 as ultimaCuota
						  ,G726_c17419 as interes
					      ,G726_ConsInte__b as id
						  ,G726_C17237 as codigo');
		$this->db->join('G719', 'G726_C17237 = G719_ConsInte__b');
        $this->db->where('G726_ConsInte__b', $codigo);
        $query = $this->db->get('G726');


        return $query->result();
	}

    function getTotalClientesacuerdoPago(){
    	$this->db->select('[G717_C17240] as Nombre');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V5');


        return $query->num_rows();
    }

    function getClientesSingestionquincedias(){
    	$this->db->select('G717_V6.[G717_C17240] as deudor
					      ,G717_V6.[G717_C17005] as identificacion
					      ,[G742_ConsInte__b]
					      ,[G717_V6].[G719_ConsInte__b]
					      ,[G742_C17244] 
					      ,[G737_C17183]
					      ,[G717_V6].[G719_C17026] as contrato
                ,G719.G719_C17423 as liquidacion
					      ,[G717_V6].[G719_C17034] as valor_pagado
					      ,[G730_C17126] as financiera
                ,[G717_V6].G719_C17039 AS PROCESO_SAP
                ,[G717_V6].LISOPC_Nombre____b AS ROL
                ,[G717_V6].G718_C17015 AS CIUDAD_DOMICILIO 
					      ');
        $this->db->join('G719', 'G717_V6.G719_ConsInte__b = G719.G719_ConsInte__b');


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

        
        $this->db->order_by('G717_V6.[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V6');

        return $query->result();
    }

     function getTotalClientesSingestionquincedias(){
    	$this->db->select('[G717_C17240] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V6');


        return $query->num_rows();
    }



    function getMisclietesVigentes(){
    	$this->db->select('[G717_ConsInte__b]
					      ,[G717_C17240] as deudor
					      ,[G717_C17005] as identificacion
					      ,G717_V7.[G719_ConsInte__b]
					      ,G717_V7.[G719_C17026] as contrato
                ,G719.G719_C17423 as liquidacion
                ,G719.G719_C17032 as garantia
					      ,G717_V7.[G719_C17034] as valor
					      ,[G737_ConsInte__b]
					      ,[G737_C17183]
					      ');
        $this->db->join('G719', 'G717_V7.G719_ConsInte__b = G719.G719_ConsInte__b');

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
        
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V7');

        return $query->result();
    }

    function getTotalMisClientesVigentes(){
    	$this->db->select('[G717_C17240] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V7');
        return $query->num_rows();
    }


    function getExfuncionarios(){
    	$this->db->select('[G717_ConsInte__b]
					      ,[G717_C17240] as nombre
					      ,[G717_C17005] as identificacion
					      ,G717_V31.[G719_ConsInte__b]
					      ,G717_V31.[G719_C17026] as contrato
                ,G719.G719_C17423 as liquidacion
					      ,G717_V31.[G719_C17034] as valor_pagado
					      ,[G737_C17183] 
					      ,[LISOPC_Nombre____b] as rol
					      ');
        $this->db->from('G717_V31');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->join('G719', 'G717_V31.G719_ConsInte__b = G719.G719_ConsInte__b');

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
        
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    function getTotalExfuncionarios(){
    	$this->db->select('[G717_C17240] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V31');
        return $query->num_rows();
    }


    function getObligaciones_Vendidas(){
    	$this->db->select('[G717_C17240] as nombre
					      ,[G717_C17005] as identificacion
					      ,G717_V32.[G719_C17026] as contrato
                ,G719.G719_C17423 as liquidacion
					      ,G717_V32.[G719_C17034] as valor_pagado
					      ,[G730_C17126] 
					      ,G717_V32.[G719_C17073] as fecha_venta
					      ,[G737_C17183]
					      ');
        $this->db->join('G719', 'G717_V32.G719_ConsInte__b = G719.G719_ConsInte__b');

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

        
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V32');

        return $query->result();
    }

    function getTotalObligaciones_Vendidas(){
    	$this->db->select('[G717_C17240] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V32');
        return $query->num_rows();
    }

    function getObligacionesPazSalvo(){
    	$this->db->select('[G717_ConsInte__b]
					      ,[G717_C17240] as nombre
					      ,[G717_C17005] as identificacion
					      ,G717_V33.[G719_C17026] as contrato
                ,G719.G719_C17423 as liquidacion
					      ,G717_V33.[G719_C17034] as valor_pagado
					      ,[G737_C17183] as intermediario
					      ,[LISOPC_Nombre____b] as quien_sabe,
                ,G717_V33.G719_C17071 as fecha
                ,G730_C17126 as financiera
					      ');
        $this->db->join('G719', 'G717_V33.G719_ConsInte__b = G719.G719_ConsInte__b');
        $this->db->where('G719.G719_C17071 IS NOT NULL');
        $this->db->where('G719.G719_C17035 = 0');
        $this->db->where('G719.G719_C17073 IS NULL');


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

        
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V33');

        return $query->result();
    }

    function gettotalObligacionesPazSalvo(){
    	$this->db->select('[G717_C17240] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V33');
        return $query->num_rows();
    }

    function getvistav3(){
        $this->db->select('G717_V3.[G717_C17240] as nombre
                          ,G717_V3.[G717_C17005] as identificacion
                          ,G717_V3.[G719_C17034] as valor_pagado
                          ');
        $this->db->join('G719', 'G717_V3.G719_ConsInte__b = G719.G719_ConsInte__b');
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

        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V3.[G719_C17034]', 'DESC');
        $query = $this->db->get('G717_V3');
        return  $query->result();
    }

    
    function getvistav24(){
        $this->db->select('G717_V24.[G717_C17240] as nombre
                          ,G717_V24.[G717_C17005] as identificacion
                          ,G717_V24.[G719_C17034] as valor_pagado
                          ');

        $this->db->join('G719', 'G717_V24.G719_ConsInte__b = G719.G719_ConsInte__b');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V24.[G719_C17034]', 'DESC');
        $query = $this->db->get('G717_V24');
        return  $query->result();
    }

    function getvistav26(){
        $this->db->select('G717_V26.[G717_C17240] as nombre
                          ,G717_V26.[G717_C17005] as identificacion
                          ,G717_V26.[G719_C17034] as valor_pagado
                          ');

        $this->db->join('G719', 'G717_V26.G719_ConsInte__b = G719.G719_ConsInte__b');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V26.[G719_C17034]', 'DESC');
        $query = $this->db->get('G717_V26');
        return  $query->result();
    }

    function getvistav27(){
        $this->db->select('G717_V27.[G717_C17240] as nombre
                          ,G717_V27.[G717_C17005] as identificacion
                          ,G717_V27.[G719_C17034] as valor_pagado
                          ');
        $this->db->join('G719', 'G717_V27.G719_ConsInte__b = G719.G719_ConsInte__b');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V27.[G719_C17034]', 'DESC');
        $query = $this->db->get('G717_V27');
        return  $query->result();
    }

    function getvistav28(){
        $this->db->select('G717_V28.[G717_C17240] as nombre
                          ,G717_V28.[G717_C17005] as identificacion
                          ,G717_V28.[G719_C17034] as valor_pagado
                          ');
        $this->db->join('G719', 'G717_V28.G719_ConsInte__b = G719.G719_ConsInte__b');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V28.[G719_C17034]', 'DESC');
        $query = $this->db->get('G717_V28');
        return  $query->result();
    }

}
?>