<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CarteraFng_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getProcesosVigentes(){
        $this->db->select('[G717_V11].[G719_C17039] as SAP
                          ,[G717_V11].[G717_C17240] as cliente
                          ,[G717_V11].[G717_C17005] as identificacion
                          ,[G717_V11].[G719_C17030] as banco
                          ,[G717_V11].[G719_C17040] as jusgado
                          ,[G717_V11].[G719_C17043] as radicado
                          ,[G717_V11].[G719_C17041] as ciudad
                          ,[G717_V11].[G719_C17153] as abogado
                          ,G718.G718_C17015 as ciudad_despacho
                          ');
        // filtros de abogados y gestores
        $this->db->join('G719', 'G717_V11.G719_ConsInte__b = G719.G719_ConsInte__b');
        $this->db->join('G718', 'G718_ConsInte__b = G719.G719_C17041', 'LEFT');

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
        $this->db->where('G719.estado_obligacion IS NULL');
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V11');


        return $query->result();
    }

    function gettotalProcesosVigentes(){
        $this->db->select('[G719_C17039] as SAP
                          ,[G717_C17240] as cliente
                          ,[G717_C17005] as identificacion
                          ,[G719_C17030] as banco
                          ,[G719_C17040] as jusgado
                          ,[G719_C17043] as radicado
                          ,[G719_C17041] as ciudad
                          ,[G719_C17153] as abogado');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        
        $query = $this->db->get('G717_V11');


        return $query->num_rows();
    }

    function getProcesosIrrecuperables(){
        $this->db->select('[G717_V12].[G719_C17039] as SAP
                          ,[G717_C17240] as cliente
                          ,[G717_C17005] as identificacion
                          ,[G744_C17267] as Fecha_Factura
                          ,[G744_C17265] as No_Factura');

        $this->db->join('G719', 'G717_V12.G719_ConsInte__b = G719.G719_ConsInte__b');
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
        $this->db->where('G719.estado_obligacion IS NULL');
        $this->db->order_by('[G744_C17267]', 'DESC');
        $query = $this->db->get('G717_V12');

        return $query->result();
    }

    function gettotalProcesosIrrecuperables(){
        $this->db->select('[G719_C17039] as SAP
                          ,[G717_C17240] as cliente
                          ,[G717_C17005] as identificacion
                          ,[G744_C17267] as Fecha_Factura
                          ,[G744_C17265] as No_Factura');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('[G744_C17267]', 'DESC');
        $query = $this->db->get('G717_V12');

        return $query->num_rows();
    }


    function getProcesosVendidos(){
        $this->db->select('[G717_V13].[G719_C17039] as SAP
                          ,[G717_C17240] as cliente
                          ,[G717_C17005] as identificacion
                          ,[G717_V13].[G719_C17026] as No_contrato
                          ,G719.G719_C17423 as liquidacion
                          ,[G717_V13].[G719_C17073] as Fecha_de_Venta');
        
        $this->db->join('G719', 'G717_V13.G719_ConsInte__b = G719.G719_ConsInte__b');
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


        $this->db->where('G719.estado_obligacion IS NULL');
        $this->db->order_by('[Fecha_de_Venta]', 'DESC');
        $query = $this->db->get('G717_V13');

        return $query->result();
    }

    function gettotalProcesosVendidos(){
        $this->db->select('[G719_C17039] as SAP
                          ,[G717_C17240] as cliente
                          ,[G717_C17005] as identificacion
                          ,[G719_C17039] as No_contrato
                          ,[G719_C17073] as Fecha_de_Venta');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('[Fecha_de_Venta]', 'DESC');
        $query = $this->db->get('G717_V13');

        return $query->num_rows();
    }



    function getDatosbusquedaAvanzada($filtro = null){
        $this->db->select('G717_V17.G717_C17240 AS DEUDOR
                          ,G717_V17.G717_C17005 AS IDENTIFICACION
                          ,G717_V17.G730_C17126 AS INTERMEDIARIO
                          ,G717_V17.G719_C17026 AS OBLIGACION
                          ,G719.G719_C17423 as LIQUIDACION
                          ,G717_V17.G719_C17039 AS PROCESO_SAP
                          ,G717_V17.G719_C17034 AS VALOR_PAGADO
                          ,G717_V17.G737_C17183 AS ROL
						              ,G718_C17015 AS CIUDAD_DOMICILIO 
                          ,G717_V17.G717_ConsInte__b
                          ,G717_V17.G719_ConsInte__b
                          ,G717_V17.G737_ConsInte__b');
        $this->db->from('G717_V17');
        $this->db->join('G717' , 'G717.G717_ConsInte__b = G717_V17.G717_ConsInte__b', 'LEFT');
        $this->db->join('G719' , 'G719.G719_ConsInte__b = G717_V17.G719_ConsInte__b', 'LEFT');
        $this->db->join('G737' , 'G737.G737_ConsInte__b = G717_V17.G737_ConsInte__b', 'LEFT');
		    $this->db->join('G718', 'G718_ConsInte__b = G717_C17012','LEFT');
        $this->db->join('G726', ' G726_C17237 = G719.G719_ConsInte__b', 'LEFT');
        $this->db->join('G744', 'G744_C17280 = G719.G719_ConsInte__b', 'LEFT');
        
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

        $this->db->where('G719.estado_obligacion IS NULL');
        
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

        $query = $this->db->get();
        return $query->result();
    }
    


    function getDatosbusquedaAvanzada2(){
        $this->db->select('G717_V17.G717_C17240 AS DEUDOR
                          ,G717_V17.G717_C17005 AS IDENTIFICACION
                          ,G717_V17.G730_C17126 AS INTERMEDIARIO
                          ,G717_V17.G719_C17026 AS OBLIGACION
                          ,G717_V17.G719_C17039 AS PROCESO_SAP
                          ,G717_V17.G719_C17034 AS VALOR_PAGADO
                          ,G717_V17.G737_C17183 AS ROL
						              ,G718_C17015 AS CIUDAD_DOMICILIO
                          ,G717_V17.G717_ConsInte__b
                          ,G717_V17.G719_ConsInte__b
                          ,G717_V17.G737_ConsInte__b');
		    $this->db->from('G717_V17');
        $this->db->join('G717' , 'G717.G717_ConsInte__b = G717_V17.G717_ConsInte__b', 'LEFT');
		    $this->db->join('G718', 'G718_ConsInte__b = G717_C17012', 'LEFT');
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
        $this->db->where('G719.estado_obligacion IS NULL');

        $query = $this->db->get();
        return $query->result();
    }

    function getFiltrosbusqueda(){
         $this->db->select('G757_C17364 as pregunta
                          ,G757_C17365 as tabla
                          ,G757_C17370 as Filtro
                          ,G757_C17371 as Lisop
                          ,G757_C17366 as tipoDato
                          ,G757_C17368 as tablaGuion
                          ,G757_C17369 as campoGuion ');
        $this->db->from('G757');
		 $this->db->order_by('G757_C17370', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getFiltrosCombo($tabla, $ConsInte__b, $campoNombre){
        $this->db->select($ConsInte__b .' AS ConsInte__b, '.$campoNombre . ' AS descripcion');
        $this->db->from($tabla);
        $this->db->order_by($campoNombre, 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getListasLisop($codigo){
        $this->db->select('LISOPC_ConsInte__b , LISOPC_Nombre____b');
        $this->db->from('LISOPC');
        $this->db->where('LISOPC_ConsInte__OPCION_b', $codigo);
        $this->db->order_by('LISOPC_Nombre____b', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    function getdatosUsuario($codigo){
       
        $this->db->select('USUARI.USUARI_ConsInte__b as USUARI_ConsInte__b, USUARI.USUARI_Codigo____b as USUARI_Codigo____b, USUARI.USUARI_Nombre____b as USUARI_Nombre____b, USUARI.USUARI_Cargo_____b as USUARI_Cargo_____b, USUARI_FechCrea__b');
        $this->db->from('USUARI');
        $this->db->where('USUARI_Codigo____b', $codigo);
        $query = $this->db->get();
        return $query->result();
    }


    //Function para hallar los Oligaciones con PAZ Y SALVO
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
                ,G719.G719_C17039 as sap
                , G719.G719_ConsInte__b as id
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

        $this->db->where('G719.estado_obligacion IS NULL');
        $this->db->order_by('[G717_C17240]', 'DESC');
        $query = $this->db->get('G717_V33');

       return $query->result();
  }

}

?>