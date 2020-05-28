<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Extrajudicial_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getClientesNuevos(){
        $this->db->select('[NombreDeudor] as deudor
					      ,[NroIdentificacion] as identificacion
					      ,[G717_V1].[IntermediarioFinanciero] as intemediario
					      ,[G717_V1].[ValorPagado] as valor
					      ,[G717_V1].[FechaPagoGarantia] as fecha
					      ,[G717_V1].[Id]
                          ,InformacionCredito.G719_C17423 as liquidacion
					      ,[Id]
					      ,[Id]
					      ,[Id]
					      ,[Rol]');
        // filtros de abogados y gestores
        $this->db->join('InformacionCredito', 'G717_V1.Id = InformacionCredito.Id');
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

        /**/
        $this->db->group_by('[NombreDeudor]
                ,[NroIdentificacion]
                ,[G717_V1].[IntermediarioFinanciero] 
                ,[G717_V1].[ValorPagado] 
                ,[G717_V1].[FechaPagoGarantia] 
                ,[G717_V1].[Id]
                ,InformacionCredito.G719_C17423 
                ,[Id]
                ,[Id]
                ,[Id]
                ,[Rol]');
        $this->db->order_by('[G717_V1].[NombreDeudor]', 'ASC');
        $query = $this->db->get('G717_V1');


        return $query->result();
    }

    function gettotalClientesNuevos(){
        $this->db->select('[NombreDeudor] as deudor
					      ,[NroIdentificacion] as identificacion
					      ,[IntermediarioFinanciero] as intemediario
					      ,[ValorPagado] as valor
					      ,[FechaPagoGarantia] as fecha
					      ,[Id]
					      ,[Id]
					      ,[Id]
					      ,[Id]
					      ,[Rol]');
        $query = $this->db->get('G717_V1');


        return $query->num_rows();
    }

    function getClientesDatoNuevo(){
    	$this->db->select('DISTINCT [NombreDeudor] as Nombre
					      ,[NroIdentificacion] as identificacion
					      ,[G743_C17257] as direccion
					      ,[G743_C17256] as telefono
					      ,[G743_C17258] as ciudad
					      ,[Id]
					      ,[G743_ConsInte__b], G743_C17267 
                          , G719_C17423 as liquidacion
                          ');
        // filtros de abogados y gestores
        $this->db->join('ClienteObligacion', 'ClienteObligacion.InformacionClientesId = G717_V2.Id');
        $this->db->join('InformacionCredito', 'ClienteObligacion.NumeroContratoId = InformacionCredito.Id');

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
        $query = $this->db->get('G717_V2');


        return $query->result();

    	
    }

    function getCLentes_titular_datoNuevo(){
        $this->db->select('DISTINCT [NombreDeudor] as Nombre
                          ,[NroIdentificacion] as identificacion
                          ,direccionDomicilio as direccion
                          ,telefono
                          ,ciudad
                           , G719_C17423 as liquidacion
                          ,Id');
        // filtros de abogados y gestores
        $this->db->join('ClienteObligacion', 'ClienteObligacion.InformacionClientesId = G717_V2_SV3.Id');
        $this->db->join('InformacionCredito', 'ClienteObligacion.NumeroContratoId = InformacionCredito.Id');

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
        $query = $this->db->get('G717_V2_SV3');


        return $query->result();

    }

    function getTotalClientesDatoNuevo(){
    	$this->db->select('[NombreDeudor] as Nombre');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G717_V2');


        return $query->num_rows();

    	
    }

    function getClientesacuerdoPago(){
    	$this->db->select('[NombreDeudor] as Nombre
                          ,[NroIdentificacion] as identificacion
                ,InformacionCredito.G719_C17423 as liquidacion
                          ,[FechaConsignacionAnticipo] as fecha_legal
                          ,Id as id');
        $this->db->join('InformacionCredito', 'G717_V5.Id = InformacionCredito.Id');

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

        $this->db->group_by('[NombreDeudor]
                ,[NroIdentificacion]
                ,InformacionCredito.G719_C17423 
                ,[FechaConsignacionAnticipo]
                ,Id');
        $this->db->order_by('[FechaConsignacionAnticipo]', 'DESC');
        $query = $this->db->get('G717_V5');


        return $query->result();
    }
	
	function getDatosAcuerdosdePago($codigo){
		$this->db->select(' [G719_C17423] as contrato
                            ,NumeroContrato as liquidacion
                            ,FechaLiquidacion as consignacion_ant
                            ,FechaConsignacionAnticipo as legalizacion
                            ,FechaLegalizacion as valor
                            ,ValorRecaudo as plazo
                            ,PlazoAcuerdoPago as cuota
                            ,ValorCuotaAcuerdo as primeracuota
                            ,FechaPagoPrimeraCuota as ultimaCuota
                            ,TasaInteresCorrienteAcuerdoPago as interes
                            ,Id as id
						          ,FechaPagoUltimaCuota as codigo');
		$this->db->join('InformacionCredito', 'FechaPagoUltimaCuota = Id');
        $this->db->where('Id', $codigo);
        $query = $this->db->get('AcuerdosPago');


        return $query->result();
	}

    function getTotalClientesacuerdoPago(){
    	$this->db->select('[NombreDeudor] as Nombre');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V5');


        return $query->num_rows();
    }

    function getClientesSingestionquincedias(){
    	$this->db->select('G717_V6.[NombreDeudor] as deudor
					      ,G717_V6.[NroIdentificacion] as identificacion
					      ,[Id]
					      ,[G717_V6].[Id]
					      ,[NumeroContrato] 
					      ,[Rol]
                ,InformacionCredito.G719_C17423 as liquidacion
					      ,[G717_V6].[ValorPagado] as valor_pagado
					      ,[NombreIF] as financiera
                ,[G717_V6].NroProcesoJudicialSAP AS PROCESO_SAP
                ,[G717_V6].Nombre_b AS ROL
                ,[G717_V6].Ciudad AS CIUDAD_DOMICILIO 
					      ');
        $this->db->join('InformacionCredito', 'G717_V6.Id = InformacionCredito.Id');


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

        $this->db->group_by('G717_V6.[NombreDeudor]
                ,G717_V6.[NroIdentificacion]
                ,[Id]
                ,[G717_V6].[Id]
                ,[NumeroContrato] 
                ,[Rol]
                ,InformacionCredito.G719_C17423
                ,[G717_V6].[ValorPagado] 
                ,[NombreIF] 
                ,[G717_V6].NroProcesoJudicialSAP
                ,[G717_V6].Nombre_b
                ,[G717_V6].Ciudad
                ');
        $this->db->order_by('G717_V6.[NombreDeudor]', 'DESC');
        $query = $this->db->get('G717_V6');

        return $query->result();
    }

     function getTotalClientesSingestionquincedias(){
    	$this->db->select('[NombreDeudor] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V6');


        return $query->num_rows();
    }



    function getMisclietesVigentes(){
    	$this->db->select('[Id]
					      ,[NombreDeudor] as deudor
					      ,[NroIdentificacion] as identificacion
					      ,G717_V7.[Id]
                ,InformacionCredito.G719_C17423 as liquidacion
                ,InformacionCredito.FechaPagoGarantia as garantia
					      ,G717_V7.[ValorPagado] as valor
					      ,[Id]
					      ,[Rol]
					      ');
        $this->db->join('InformacionCredito', 'G717_V7.Id = InformacionCredito.Id');

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
        
        $this->db->group_by('[Id]
                            ,[NombreDeudor]
                            ,[NroIdentificacion] 
                            ,G717_V7.[Id]
                            ,InformacionCredito.G719_C17423 
                            ,InformacionCredito.FechaPagoGarantia 
                            ,G717_V7.[ValorPagado]
                            ,[Id]
                            ,[Rol]');
        $this->db->order_by('[NombreDeudor]', 'DESC');
        $query = $this->db->get('G717_V7');

        return $query->result();
    }

    function getTotalMisClientesVigentes(){
    	$this->db->select('[NombreDeudor] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V7');
        return $query->num_rows();
    }


    function getExfuncionarios(){
    	$this->db->select('[Id]
					      ,[NombreDeudor] as nombre
					      ,[NroIdentificacion] as identificacion
					      ,G717_V31.[Id]
					      ,G717_V31.[NoContrato] as contrato
					      ,G717_V31.[ValorPagado] as valor_pagado
					      ,[Rol] 
					      ,[Nombre_b] as rol
					      ');
        $this->db->from('G717_V31');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->join('InformacionCredito', 'G717_V31.Id = InformacionCredito.Id');

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
        $query = $this->db->get();

        return $query->result();
    }

    function getTotalExfuncionarios(){
    	$this->db->select('[NombreDeudor] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V31');
        return $query->num_rows();
    }


    function getObligaciones_Vendidas(){
    	$this->db->select('[NombreDeudor] as nombre
					      ,[NroIdentificacion] as identificacion
                ,InformacionCredito.G719_C17423 as liquidacion
					      ,G717_V32.[ValorPagado] as valor_pagado
					      ,[NombreIF] 
					      ,G717_V32.[G719_C17073] as fecha_venta
					      ,[Rol]
					      ');
        $this->db->join('InformacionCredito', 'G717_V32.Id = InformacionCredito.Id');

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

        $this->db->group_by('[NombreDeudor]
                ,[NroIdentificacion]
                ,InformacionCredito.G719_C17423 
                ,G717_V32.[ValorPagado]
                ,[NombreIF] 
                ,G717_V32.[G719_C17073]
                ,[Rol]
                ');
        $this->db->order_by('[NombreDeudor]', 'DESC');
        $query = $this->db->get('G717_V32');

        return $query->result();
    }

    function getTotalObligaciones_Vendidas(){
    	$this->db->select('[NombreDeudor] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V32');
        return $query->num_rows();
    }

    function getObligacionesPazSalvo(){
    	$this->db->select('DISTINCT InformacionCredito.G719_C17423 as liquidacion,
					             ,[NombreDeudor] as nombre
					             ,[NroIdentificacion] as identificacion
    
					             ,G717_V33.[ValorPagado] as valor_pagado
					             ,G717_V33.[Rol] as intermediario
                        ,G717_V33.G719_C17071 as fecha
                        ,NombreIF as financiera
					      ');
        $this->db->join('InformacionCredito', 'G717_V33.Id = InformacionCredito.Id');
        $this->db->join('ClienteObligacion', 'InformacionCredito.Id = ClienteObligacion.NumeroContratoId');
        $this->db->where('InformacionCredito.G719_C17071 IS NOT NULL');
        $this->db->where('InformacionCredito.SaldoFNG = 0');
        $this->db->where('InformacionCredito.G719_C17073 IS NULL');
        $this->db->where('ClienteObligacion.Rol = 1786');


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

        $this->db->group_by('InformacionCredito.G719_C17423,
                ,[NombreDeudor]
                ,[NroIdentificacion]
                
                ,G717_V33.[ValorPagado]
                ,G717_V33.[Rol]
                ,G717_V33.G719_C17071 
                ,NombreIF
                ');
        $this->db->order_by('[NombreDeudor]', 'DESC');
        $query = $this->db->get('G717_V33');

        return $query->result();
    }

    function gettotalObligacionesPazSalvo(){
    	$this->db->select('[NombreDeudor] ');
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('G717_V33');
        return $query->num_rows();
    }

    function getvistav3(){
        $this->db->select('G717_V3.[NombreDeudor] as nombre
                          ,G717_V3.[NroIdentificacion] as identificacion
                          ,G717_V3.[ValorPagado] as valor_pagado
                          ');
        $this->db->join('InformacionCredito', 'G717_V3.Id = InformacionCredito.Id');
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

        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V3.[ValorPagado]', 'DESC');
        $query = $this->db->get('G717_V3');
        return  $query->result();
    }

    
    function getvistav24(){
        $this->db->select('G717_V24.[NombreDeudor] as nombre
                          ,G717_V24.[NroIdentificacion] as identificacion
                          ,G717_V24.[ValorPagado] as valor_pagado
                          ');

        $this->db->join('InformacionCredito', 'G717_V24.Id = InformacionCredito.Id');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V24.[ValorPagado]', 'DESC');
        $query = $this->db->get('G717_V24');
        return  $query->result();
    }

    function getvistav26(){
        $this->db->select('G717_V26.[NombreDeudor] as nombre
                          ,G717_V26.[NroIdentificacion] as identificacion
                          ,G717_V26.[ValorPagado] as valor_pagado
                          ');

        $this->db->join('InformacionCredito', 'G717_V26.Id = InformacionCredito.Id');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V26.[ValorPagado]', 'DESC');
        $query = $this->db->get('G717_V26');
        return  $query->result();
    }

    function getvistav27(){
        $this->db->select('G717_V27.[NombreDeudor] as nombre
                          ,G717_V27.[NroIdentificacion] as identificacion
                          ,G717_V27.[ValorPagado] as valor_pagado
                          ');
        $this->db->join('InformacionCredito', 'G717_V27.Id = InformacionCredito.Id');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V27.[ValorPagado]', 'DESC');
        $query = $this->db->get('G717_V27');
        return  $query->result();
    }

    function getvistav28(){
        $this->db->select('G717_V28.[NombreDeudor] as nombre
                          ,G717_V28.[NroIdentificacion] as identificacion
                          ,G717_V28.[ValorPagado] as valor_pagado
                          ');
        $this->db->join('InformacionCredito', 'G717_V28.Id = InformacionCredito.Id');
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
        
        // $this->db->where('USUARI_Codigo____b', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->order_by('G717_V28.[ValorPagado]', 'DESC');
        $query = $this->db->get('G717_V28');
        return  $query->result();
    }

    function getLiquidaciones(){
        $this->db->select('G719_C17423 as liquidacion');
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('InformacionCredito');
        return $query->result();
    }


    function getDatosbusquedaAvanzada($filtro = null){
        $this->db->select('G719_C17423 as LIQUIDACION
                          ,NombreDeudor AS DEUDOR
                          ,NroIdentificacion AS IDENTIFICACION
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
                          ,G717_V17.NombreIF AS INTERMEDIARIO
                          ,G719_C17424 AS VALOR_PAGADO
                          ,G717_V17.Rol AS ROL
                          ,NroProcesoJudicialSAP AS PROCESO_SAP
						              ,Ciudad AS CIUDAD_DOMICILIO
                          ,G717_V17.Id
                          ,G717_V17.Id');
        $this->db->from('G717_V17');
        $this->db->join('InformacionCliente' , 'InformacionCliente.Id = G717_V17.Id', 'LEFT');
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $this->db->join('InformacionCredito' , 'InformacionCredito.Id = G717_V17.Id', 'LEFT');

        

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
       
        $this->db->group_by('G719_C17423 
                            ,NombreDeudor 
                            ,NroIdentificacion 
                            ,NombreIF 
                            ,NroProcesoJudicialSAP
                            ,G719_C17424 
                            ,Nombre_b 
                            ,Ciudad 
                            ,Id
                            ,Id');
        $query = $this->db->get();
        return $query->result();
    }

}
?>