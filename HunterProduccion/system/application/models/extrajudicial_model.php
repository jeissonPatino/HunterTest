<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Extrajudicial_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	    function getClientesNuevos(){
        $this->db->select('deudor, 
						identificacion, 
						intemediario, 
						valor,
						fecha, 
						liquidacion,
						[G737_C17183]'); 
						
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') 
		{
          if( $this->session->userdata('codigo_abogado') != NULL)
		  {
              $this->db->where('G719_C17153', $this->session->userdata('codigo_abogado'));
          }else
		  {
              $this->db->where('G719_C17153 IS NOT NULL');
              $this->db->where('G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') 
		{
            if($this->session->userdata('identificacion') != NULL)
			{
                $this->db->where('G719_C17347', $this->session->userdata('identificacion'));
            }else
			{
                $this->db->where('G719_C17347 IS NOT NULL');
                $this->db->where('G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') 
		{
            if($this->session->userdata('frg') != NULL)
			{
                 $this->db->where('G719_C17029', $this->session->userdata('frg'));
            }else
			{
                $this->db->where('G719_C17029 IS NOT NULL');
                $this->db->where('G719_C17029', $this->session->userdata('frg'));
            }
        }

        $query = $this->db->get('QryViClientesNuevos');

        return $query->result();
    }
	
	/* funcion vieja clientes nuevos
    function getClientesNuevos(){
        $this->db->select('[G717_C17240] as deudor
					      ,[G717_C17005] as identificacion
					      ,[G717_V1].[G719_C17030] as intemediario
					      ,[G717_V1].[G719_C17034] as valor
					      ,[G717_V1].[G719_C17032] as fecha
					      ,[G717_V1].[G719_ConsInte__b]
                          ,G719.G719_C17423 as liquidacion
					      ,[G717_ConsInte__b]
					      ,[G742_ConsInte__b]
					      ,[G737_ConsInte__b]
					      ,[G737_C17183]');
        // filtros de abogados y gestores
        $this->db->join('G719', 'G717_V1.G719_ConsInte__b = G719.G719_ConsInte__b');
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') 
		{
          if( $this->session->userdata('codigo_abogado') != NULL)
		  {
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }else
		  {
              $this->db->where('G719.G719_C17153 IS NOT NULL');
              $this->db->where('G719.G719_C17153', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') 
		{
            if($this->session->userdata('identificacion') != NULL)
			{
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }else
			{
                $this->db->where('G719.G719_C17347 IS NOT NULL');
                $this->db->where('G719.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') 
		{
            if($this->session->userdata('frg') != NULL)
			{
                 $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }else
			{
                $this->db->where('G719.G719_C17029 IS NOT NULL');
                $this->db->where('G719.G719_C17029', $this->session->userdata('frg'));
            }
        }

        
        $this->db->group_by('[G717_C17240]
                ,[G717_C17005]
                ,[G717_V1].[G719_C17030] 
                ,[G717_V1].[G719_C17034] 
                ,[G717_V1].[G719_C17032] 
                ,[G717_V1].[G719_ConsInte__b]
                ,G719.G719_C17423 
                ,[G717_ConsInte__b]
                ,[G742_ConsInte__b]
                ,[G737_ConsInte__b]
                ,[G737_C17183]');
        $this->db->order_by('[G717_V1].[G717_C17240]', 'ASC');
        $query = $this->db->get('G717_V1');


        return $query->result();
    }
*/
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
					      ,[G743_ConsInte__b], G743_C17267 
                          , G719_C17423 as liquidacion
                          ');
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

    function getCLentes_titular_datoNuevo(){
        $this->db->select('DISTINCT [G717_C17240] as Nombre
                          ,[G717_C17005] as identificacion
                          ,direccionDomicilio as direccion
                          ,telefono
                          ,ciudad
                           , G719_C17423 as liquidacion
                          ,G717_ConsInte__b');
        // filtros de abogados y gestores
        $this->db->join('G737', 'G737.G737_C17181 = G717_V2_SV3.G717_ConsInte__b');
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
        $query = $this->db->get('G717_V2_SV3');


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

        $this->db->group_by('[G717_C17240]
                ,[G717_C17005]
                ,G719.G719_C17423 
                ,[G726_C17111]
                ,G726_ConsInte__b');
        $this->db->order_by('[G726_C17111]', 'DESC');
        $query = $this->db->get('G717_V5');


        return $query->result();
    }
	
	function getDatosAcuerdosdePago($codigo){
		$this->db->select(' [G719_C17423] as contrato
                            ,G726_C17109 as liquidacion
                            ,G726_C17110 as consignacion_ant
                            ,G726_C17111 as legalizacion
                            ,G726_C17112 as valor
                            ,G726_C17113 as plazo
                            ,G726_C17223 as cuota
                            ,G726_C17224 as primeracuota
                            ,G726_C17225 as ultimaCuota
                            ,G726_C17419 as interes
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

        $this->db->group_by('G717_V6.[G717_C17240]
                ,G717_V6.[G717_C17005]
                ,[G742_ConsInte__b]
                ,[G717_V6].[G719_ConsInte__b]
                ,[G742_C17244] 
                ,[G737_C17183]
                ,G719.G719_C17423
                ,[G717_V6].[G719_C17034] 
                ,[G730_C17126] 
                ,[G717_V6].G719_C17039
                ,[G717_V6].LISOPC_Nombre____b
                ,[G717_V6].G718_C17015
                ');
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
        
        $this->db->group_by('[G717_ConsInte__b]
                            ,[G717_C17240]
                            ,[G717_C17005] 
                            ,G717_V7.[G719_ConsInte__b]
                            ,G719.G719_C17423 
                            ,G719.G719_C17032 
                            ,G717_V7.[G719_C17034]
                            ,[G737_ConsInte__b]
                            ,[G737_C17183]');
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

        $this->db->group_by('[G717_C17240]
                ,[G717_C17005]
                ,G719.G719_C17423 
                ,G717_V32.[G719_C17034]
                ,[G730_C17126] 
                ,G717_V32.[G719_C17073]
                ,[G737_C17183]
                ');
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
    	$this->db->select('DISTINCT G719.G719_C17423 as liquidacion,
					             ,[G717_C17240] as nombre
					             ,[G717_C17005] as identificacion
    
					             ,G717_V33.[G719_C17034] as valor_pagado
					             ,G717_V33.[G737_C17183] as intermediario
                        ,G717_V33.G719_C17071 as fecha
                        ,G730_C17126 as financiera
					      ');
        $this->db->join('G719', 'G717_V33.G719_ConsInte__b = G719.G719_ConsInte__b');
        $this->db->join('G737', 'G719.G719_ConsInte__b = G737.G737_C17182');
        $this->db->where('G719.G719_C17071 IS NOT NULL');
        $this->db->where('G719.G719_C17035 = 0');
        $this->db->where('G719.G719_C17073 IS NULL');
        $this->db->where('G737.G737_C17183 = 1786');


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

        $this->db->group_by('G719.G719_C17423,
                ,[G717_C17240]
                ,[G717_C17005]
                
                ,G717_V33.[G719_C17034]
                ,G717_V33.[G737_C17183]
                ,G717_V33.G719_C17071 
                ,G730_C17126
                ');
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

    function getLiquidaciones(){
        $this->db->select('G719_C17423 as liquidacion');
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('G719');
        return $query->result();
    }


    function getDatosbusquedaAvanzada($filtro = null){
        $this->db->select('G719_C17423 as LIQUIDACION
                          ,G717_C17240 AS DEUDOR
                          ,G717_C17005 AS IDENTIFICACION
                          ,G730_C17126 AS INTERMEDIARIO
                          ,G719_C17039 AS PROCESO_SAP
                          ,G719_C17424 AS VALOR_PAGADO
                          ,LISOPC_Nombre____b AS ROL
						              ,G718_C17015 AS CIUDAD_DOMICILIO ');
        $this->db->from('G717');
        //$this->db->join('G717' , 'G717.G717_ConsInte__b = G717_V17.G717_ConsInte__b', 'LEFT');
        $this->db->join('G737' , 'dbo.G717.G717_ConsInte__b = dbo.G737.G737_C17181');
        $this->db->join('G719' , 'dbo.G737.G737_C17182 = dbo.G719.G719_ConsInte__b');
        $this->db->join('G730' , 'dbo.G730.G730_ConsInte__b = dbo.G719.G719_C17030','LEFT');
        $this->db->join('LISOPC' , 'dbo.LISOPC.LISOPC_ConsInte__b = dbo.G737.G737_C17183','LEFT');  
		    $this->db->join('G718', 'G718_ConsInte__b = G719_C17041', 'LEFT');
        $this->db->join('G726', ' G726_C17237 = G719.G719_ConsInte__b', 'LEFT');
        $this->db->join('G744', 'G744_C17280 = G719.G719_ConsInte__b', 'LEFT');
        $this->db->join('G734', 'G734.G734_C17241 = G719.G719_ConsInte__b', 'LEFT');

       
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

       // $this->db->where('G719.G719_C17423 IS NULL');
         $this->db->where('dbo.G737.G737_C17183', 1786);
        if(count($filtro) > 0){
            foreach($filtro as $fil => $value)
            {
                $fil =  str_replace("'", " ", $fil);
                $value =  str_replace("'", " ", $value);
                $value = str_replace(" ", '', $value);
                if($value != '')
                  $this->db->where($fil, $value);
            }
        }
        $this->db->group_by('G719_C17423 
                            ,G717_C17240 
                            ,G717_C17005 
                            ,G730_C17126 
                            ,G719_C17039
                            ,G719_C17424 
                            ,LISOPC_Nombre____b,G718_C17015');
        $query = $this->db->get();
        return $query->result();
    }
    


    function getDatosbusquedaAvanzada2(){
        $this->db->select('DISTINCT G719_C17423 as LIQUIDACION 
                          ,G717_V17.G717_C17240 AS DEUDOR
                          ,G717_V17.G717_C17005 AS IDENTIFICACION
                          ,G717_V17.G730_C17126 AS INTERMEDIARIO
                          ,G719_C17424 AS VALOR_PAGADO
                          ,G717_V17.G737_C17183 AS ROL
                          ,G719_C17039 AS PROCESO_SAP
						              ,G718_C17015 AS CIUDAD_DOMICILIO
                          ,G717_V17.G717_ConsInte__b
                          ,G717_V17.G719_ConsInte__b');
        $this->db->from('G717_V17');
        $this->db->join('G717' , 'G717.G717_ConsInte__b = G717_V17.G717_ConsInte__b', 'LEFT');
        $this->db->join('G718', 'G718_ConsInte__b = G719_C17041', 'LEFT');
        $this->db->join('G719' , 'G719.G719_ConsInte__b = G717_V17.G719_ConsInte__b', 'LEFT');

        

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
       
        $this->db->group_by('G719_C17423 
                            ,G717_C17240 
                            ,G717_C17005 
                            ,G730_C17126 
                            ,G719_C17039
                            ,G719_C17424 
                            ,LISOPC_Nombre____b 
                            ,G718_C17015 
                            ,G717_ConsInte__b
                            ,G719_ConsInte__b');
        $query = $this->db->get();
        return $query->result();
    }

}
?>