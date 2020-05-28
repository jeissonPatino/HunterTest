<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CarteraFng_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getProcesosVigentes(){
        $this->db->select('DISTINCT [G717_V11].[NroProcesoJudicialSAP] as SAP
                          ,[G717_V11].[NombreDeudor] as cliente
                          ,[G717_V11].[NroIdentificacion] as identificacion
                          ,[G717_V11].[TipoIdentificacion] as TipoIdentificacion
                          ,[G717_V11].[IntermediarioFinanciero] as banco
                          ,[G717_V11].[Despacho] as jusgado
                          ,[G717_V11].[RadicadoExpediente] as radicado
                          ,[G717_V11].[CiudadDespacho] as ciudad
                          ,[G717_V11].[Abogado] as abogado
                          ');
        // filtros de abogados y gestores
        $this->db->join('InformacionCredito', 'G717_V11.Id = InformacionCredito.Id');
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }
        $this->db->group_by('[G717_V11].[NroProcesoJudicialSAP]
                          ,[G717_V11].[NombreDeudor] 
                          ,[G717_V11].[NroIdentificacion] 
                          ,[G717_V11].[TipoIdentificacion]
                          ,[G717_V11].[IntermediarioFinanciero] 
                          ,[G717_V11].[Despacho] 
                          ,[G717_V11].[RadicadoExpediente] 
                          ,[G717_V11].[CiudadDespacho] 
                          ,[G717_V11].[Abogado] ');
        $this->db->order_by('[NombreDeudor]', 'DESC');
        $query = $this->db->get('G717_V11');


        return $query->result();
    }

    function gettotalProcesosVigentes(){
        $this->db->select('[NroProcesoJudicialSAP] as SAP
                          ,[NombreDeudor] as cliente
                          ,[NroIdentificacion] as identificacion
                          ,[TipoIdentificacion] as TipoIdentificacion
                          ,[IntermediarioFinanciero] as banco
                          ,[Despacho] as jusgado
                          ,[RadicadoExpediente] as radicado
                          ,[CiudadDespacho] as ciudad
                          ,[Abogado] as abogado');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        
        $query = $this->db->get('G717_V11');


        return $query->num_rows();
    }

    function getProcesosIrrecuperables(){
        $this->db->select('InformacionCredito.G719_C17423 as liquidacion, [G717_V12].[NroProcesoJudicialSAP] as SAP
                          ,[NombreDeudor] as cliente
                          ,[NroIdentificacion] as identificacion
                          ,[TipoIdentificacion] as TipoIdentificacion
                          ,[FechaFacturaSentenciaIrrecuperable] as Fecha_Factura
                          ,[NroFacturaSentenciaIrrecuperable] as No_Factura
                          ');

        $this->db->join('InformacionCredito', 'G717_V12.Id = InformacionCredito.Id');
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }
        $this->db->group_by('InformacionCredito.G719_C17423, [G717_V12].[NroProcesoJudicialSAP] 
                          ,[NombreDeudor]
                          ,[NroIdentificacion] 
                          ,[TipoIdentificacion]
                          ,[FechaFacturaSentenciaIrrecuperable] 
                          ,[NroFacturaSentenciaIrrecuperable] ');
        $this->db->order_by('[FechaFacturaSentenciaIrrecuperable]', 'DESC');
        $query = $this->db->get('G717_V12');

        return $query->result();
    }

    function gettotalProcesosIrrecuperables(){
        $this->db->select('[NroProcesoJudicialSAP] as SAP
                          ,[NombreDeudor] as cliente
                          ,[NroIdentificacion] as identificacion
                          ,[TipoIdentificacion] as TipoIdentificacion
                          ,[FechaFacturaSentenciaIrrecuperable] as Fecha_Factura
                          ,[NroFacturaSentenciaIrrecuperable] as No_Factura');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('[FechaFacturaSentenciaIrrecuperable]', 'DESC');
        $query = $this->db->get('G717_V12');

        return $query->num_rows();
    }


    function getProcesosVendidos(){
        $this->db->select('InformacionCredito.G719_C17423 as liquidacion, [G717_V13].[NroProcesoJudicialSAP] as SAP
                          ,[NombreDeudor] as cliente
                          ,[NroIdentificacion] as identificacion
                          ,[TipoIdentificacion] as TipoIdentificacion
                          ,[G717_V13].[G719_C17073] as Fecha_de_Venta');
        
        $this->db->join('InformacionCredito', 'G717_V13.Id = InformacionCredito.Id');
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }


        $this->db->group_by('InformacionCredito.G719_C17423,[G717_V13].[NroProcesoJudicialSAP]
                          ,[NombreDeudor] 
                          ,[NroIdentificacion]
                          ,[TipoIdentificacion]
                          ,[G717_V13].[G719_C17073]');
        $this->db->order_by('[Fecha_de_Venta]', 'DESC');
        $query = $this->db->get('G717_V13');

        return $query->result();
    }

    function gettotalProcesosVendidos(){
        $this->db->select('[NroProcesoJudicialSAP] as SAP
                          ,[NombreDeudor] as cliente
                          ,[NroIdentificacion] as identificacion
                          ,[TipoIdentificacion] as TipoIdentificacion
                          ,[NroProcesoJudicialSAP] as No_contrato
                          ,[G719_C17073] as Fecha_de_Venta');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('[Fecha_de_Venta]', 'DESC');
        $query = $this->db->get('G717_V13');

        return $query->num_rows();
    }



    function getDatosbusquedaAvanzada($filtro = null){
       
        $this->db->select('G719_C17423 as LIQUIDACION
                          ,NombreDeudor AS DEUDOR
                          ,NroIdentificacion AS IDENTIFICACION
                          ,[TipoIdentificacion] as TipoIdentificacion
                          ,NombreIF AS INTERMEDIARIO
                          ,NroProcesoJudicialSAP AS PROCESO_SAP
                          ,G719_C17424 AS VALOR_PAGADO
                          ,Nombre_b AS ROL
                          ,Ciudad AS CIUDAD_DOMICILIO ');
        $this->db->from('InformacionCliente');
        //$this->db->join('InformacionCliente' , 'InformacionCliente.Id = G717_V17.Id', 'LEFT');
        $this->db->join('ClienteObligacion' , 'dbo.InformacionCliente.Id = dbo.ClienteObligacion.InformacionClientesId');
        $this->db->join('InformacionCredito' , 'dbo.ClienteObligacion.NumeroContratoId = dbo.InformacionCredito.Id');
        $this->db->join('IntermediarioFinanciero' , 'dbo.IntermediarioFinanciero.Id = dbo.InformacionCredito.IntermediarioFinanciero','LEFT');
        $this->db->join('ParametroGeneral' , 'dbo.ParametroGeneral.Id = dbo.ClienteObligacion.Rol','LEFT');  
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $this->db->join('AcuerdosPago', ' FechaPagoUltimaCuota = InformacionCredito.Id', 'LEFT');
        $this->db->join('Factura', 'NumeroContratoId = InformacionCredito.Id', 'LEFT');
        $this->db->join('G734', 'G734.G734_C17241 = InformacionCredito.Id', 'LEFT');

        $this->db->where('InformacionCredito.NroProcesoJudicialSAP IS NOT NULL');
        $this->db->where("InformacionCredito.NroProcesoJudicialSAP != '' ");

       
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
            if( $this->session->userdata('codigo_abogado') != NULL){
                $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
            }else{
                $this->db->where('InformacionCredito.Abogado IS NOT NULL');
                $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }
        /*$this->db->where('InformacionCredito.EstadoObligacion IS NULL');*/
        $this->db->where('dbo.ClienteObligacion.Rol', 1786);
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
                            ,NombreDeudor 
                            ,NroIdentificacion 
                            ,[TipoIdentificacion]
                            ,NombreIF 
                            ,NroProcesoJudicialSAP
                            ,G719_C17424 
                            ,Nombre_b,Ciudad');
        $query = $this->db->get();
        return $query->result();
    }
    


    function getDatosbusquedaAvanzada2(){
        $this->db->select('DISTINCT G719_C17423 as LIQUIDACION  
                          ,G717_V17.NombreDeudor AS DEUDOR
                          ,G717_V17.NroIdentificacion AS IDENTIFICACION
                          ,[G717_V17].[TipoIdentificacion] as TipoIdentificacion
                          ,G717_V17.NombreIF AS INTERMEDIARIO
                          ,G717_V17.NroProcesoJudicialSAP AS PROCESO_SAP
                          ,G719_C17424 AS VALOR_PAGADO
                          ,G717_V17.Rol AS ROL
						              ,Ciudad AS CIUDAD_DOMICILIO
                          ,G717_V17.Id
                          ,G717_V17.Id');
        $this->db->from('G717_V17');
        $this->db->join('InformacionCliente' , 'InformacionCliente.Id = G717_V17.Id', 'LEFT');
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $this->db->join('InformacionCredito' , 'InformacionCredito.Id = G717_V17.Id', 'LEFT');

        $this->db->where('InformacionCredito.NroProcesoJudicialSAP IS NOT NULL');
        $this->db->where("InformacionCredito.NroProcesoJudicialSAP != '' ");

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }
       

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
        $this->db->select('distinct '.$ConsInte__b .' AS ConsInte__b, '.$campoNombre . ' AS descripcion');
        $this->db->from($tabla);
        $this->db->order_by($campoNombre, 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function getListasLisop($codigo){
        $this->db->select('Id , Nombre_b');
        $this->db->from('ParametroGeneral');
        $this->db->where('ConsInte__OPCION_b', $codigo);
        $this->db->order_by('Nombre_b', 'ASC');
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
      $this->db->select('[Id]
                ,[NombreDeudor] as nombre
                ,[NroIdentificacion] as identificacion
                ,[TipoIdentificacion] as TipoIdentificacion
                ,G717_V33.[NoContrato] as contrato
                ,InformacionCredito.G719_C17423 as liquidacion
                ,G717_V33.[ValorPagado] as valor_pagado
                ,[Rol] as intermediario
                ,[Nombre_b] as quien_sabe,
                ,G717_V33.G719_C17071 as fecha
                ,NombreIF as financiera
                ,InformacionCredito.NroProcesoJudicialSAP as sap
                , InformacionCredito.Id as id
                ');
        $this->db->join('InformacionCredito', 'G717_V33.Id = InformacionCredito.Id');

    
        $this->db->where('InformacionCredito.G719_C17071 IS NOT NULL');
        $this->db->where('InformacionCredito.SaldoFNG = 0');
        $this->db->where('InformacionCredito.G719_C17073 IS NULL');
        $this->db->where('InformacionCredito.NroProcesoJudicialSAP IS NOT NULL');
        $this->db->where("InformacionCredito.NroProcesoJudicialSAP != '' ");

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

       
        $this->db->order_by('[NombreDeudor]', 'DESC');
        $query = $this->db->get('G717_V33');

       return $query->result();
  }

// Se traen las fecha de venta CISA  Jeisson Patiño 

  function getfechasyear(){
      $this->db->select('YEAR(Ven_fecha_venta) as year');
      $this->db->from('InformacionCredito');
      $this->db->join('Parametros_cisa','G719_C17073 = Ven_fecha_venta','LEFT');
      $this->db->where('Ven_fecha_venta is not null');
      $this->db->group_by('YEAR(Ven_fecha_venta)');
      $this->db->order_by('YEAR(Ven_fecha_venta)', 'DESC');
      $query = $this->db->get('');
      return $query->result();
  }



  function getfechasMes($fecha){
      $this->db->select("distinct month(Ven_fecha_venta) as 'month',
                          case when month (Ven_fecha_venta) = 1 then 'Enero'
                          when month (Ven_fecha_venta) = 2 then 'Febrero'
                          when month (Ven_fecha_venta) = 3 then 'Marzo'
                          when month (Ven_fecha_venta) = 4 then 'Abril'
                          when month (Ven_fecha_venta) = 5 then 'Mayo'
                          when month (Ven_fecha_venta) = 6 then 'Junio'
                          when month (Ven_fecha_venta) = 7 then 'Julio'
                          when month (Ven_fecha_venta) = 8 then 'Agosto'
                          when month (Ven_fecha_venta) = 9 then 'Septiembre'
                          when month (Ven_fecha_venta) = 10 then 'Octubre'
                          when month (Ven_fecha_venta) = 11 then 'Noviembre'
                          when month (Ven_fecha_venta) = 12 then 'Diciembre'
                          end as nombre");
      $this->db->from("InformacionCredito");
      $this->db->join('Parametros_cisa','G719_C17073 = Ven_fecha_venta','LEFT');
      $this->db->where('YEAR(G719_C17073)',$fecha);
      $this->db->where('Ven_fecha_venta is not null');
      $this->db->group_by('Ven_fecha_venta');
      $this->db->order_by('MONTH(Ven_fecha_venta)', 'DESC');
      $query = $this->db->get('');
      return $query->result();
  }

// Datos por Fecha de venta Cisa Jeisson Patiño 
  function getDatosFechaVentaCisa($anio,$mes){

      $this->db->select("NombreDeudor as 'DEUDOR',
                        TipoIdentificacion as 'TipoIdentificacion', 
                        NroIdentificacion as 'Identificacion', 
                        Ciudad as 'Ciudad', 
                        NombreIF as 'IF', 
                        G719_C17423 as 'Liquidacion',
                        NroProcesoJudicialSAP as 'ProcesoSAP',
                        ValorPagado as 'ValorPago', 
                        Nombre_b as 'ROL',
                        convert(date,G719_C17073) as 'FechaVenta'");
      $this->db->from('InformacionCliente');
      $this->db->join('Ciudad', 'CiudadDomicilio = Id','LEFT');
      $this->db->join('ClienteObligacion', 'InformacionClientesId = Id','LEFT');
      $this->db->join('InformacionCredito', 'Id = NumeroContratoId','LEFT');
      $this->db->join('Parametros_cisa','G719_C17073 = Ven_fecha_venta','LEFT');
      $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
      $this->db->join('ParametroGeneral', 'Rol = Id','LEFT');

      $this->db->where('InformacionCredito.Abogado IS NOT NULL and 
                        InformacionCredito.G719_C17347 IS NOT NULL and 
                        InformacionCredito.FRG IS NOT NULL AND 
                        InformacionCredito.G719_C17073 IS NOT NULL'
                      );
      $this->db->where('year(G719_C17073)',$anio);
      $this->db->where('month(G719_C17073) in ('.$mes.')');
      $this->db->where('G719_C17073 is not null');
      $this->db->order_by('G719_C17073', 'DESC');
      $query = $this->db->get();
        return $query->result();
    }

}

?>