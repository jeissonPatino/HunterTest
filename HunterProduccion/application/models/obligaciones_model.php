<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Obligaciones_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getDatosersonales($codigo){
        $this->db->select('NombreDeudor as Deudor, NroIdentificacion as identificacion,
                            [tipo_identificacion] as tipo_identificacion,
                           TelefonoDomicilio as TelefonoD, TelefonoOficina as TelefonoO,
                           DireccionDomicilio as DireccionD, a.Ciudad as ciudadD, CiudadDomicilio, CiudadOficina,
                           DireccionOficina as DireccionO, b.Ciudad as CiudadO,
                           Celular as Celular, CelularAdicional as CelularA,
                           CorreoElectronico as Mail, NroObligacionesDeudor as Nobligaciones, Id as idusuario,
                           dir_Adicional, c.Ciudad as ciudad_ad, tele_adicional, ciudad_adicional');
        $this->db->join('Ciudad as a', 'a.Id = CiudadDomicilio', 'LEFT');
        $this->db->join('Ciudad as b', 'b.Id = CiudadOficina', 'LEFT');
        $this->db->join('Ciudad as c', 'c.Id = ciudad_adicional', 'LEFT');
        $this->db->where('NroIdentificacion', $codigo); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('InformacionCliente');
        return $query->result();
    }

    
    function getIdUsuario($codigo){
        $this->db->select('Id');
        $this->db->where('NroIdentificacion', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('InformacionCliente');
        return $query->row()->Id;
    }

    function validarIdUsuario($codigo){
        $codigo =  str_replace("'", " ", $codigo);
        $codigo = str_replace(" ", '', $codigo);
        $this->db->select('*');
        $this->db->where('NroIdentificacion', $codigo); //esto es por si toca filtrarlo por eso lo dejo
        $query = $this->db->get('InformacionCliente');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
 
    }

    function getLiquidaciones($idCliente){
        $this->db->select(' G719_C17423 as liquidacion');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');


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

        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('ClienteObligacion');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }

    function getLiquidacionesNumero($idCliente){
        $this->db->select(' G719_C17423 as liquidacion');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
        $this->db->where('G719_C17423 IS NOT NULL');
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('ClienteObligacion');
        return $query->num_rows();
    }

    function getLiquidacionesNumero_S($idCliente){
        $this->db->select('G719_C17423');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('ClienteObligacion');
        return $query->result();
    }


    function getContratos($idCliente){

        $this->db->select(' InformacionClientesId AS ID_CLIENTE, 
                            NumeroContratoId As No_CONTRATO,  
                            Rol AS ROL ,
                            NoContrato as OBLIGACION,
                            G719_C17423 as liquidacion,
                            NombreIF as financiero ');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');


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

        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('ClienteObligacion');
        return $query->result();
    }

    function getObligacionesUsuario($idCliente){
         $this->db->select('InformacionClientesId AS ID_CLIENTE, 
                            NumeroContratoId As No_CONTRATO,  
                            Rol AS ROL ,
                            NoContrato as OBLIGACION,
                            NroIdentificacion as identificacion,
                            NombreDeudor as Deudor,
                            Id,
                            Nombre_b');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('ParametroGeneral', 'Id = Rol');
        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('ClienteObligacion');
        return $query->result();


    }
	
	function getNumObligacionesUsuario($idCliente){
         $this->db->select('InformacionClientesId AS ID_CLIENTE, 
                            NumeroContratoId As No_CONTRATO,  
                            Rol AS ROL ,
                            NoContrato as OBLIGACION,

                            NroIdentificacion as identificacion,
                            NombreDeudor as Deudor,
                            Nombre_b');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('ParametroGeneral', 'Id = Rol');
        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('ClienteObligacion');
        return $query->num_rows();

    }


    function getObligaciones(){
        $this->db->select('NoContrato AS No_CONTRATO, G719_C17423 as liquidacion, Id ');
        $query = $this->db->get('InformacionCredito');
        return $query->result();

    }

   /*function getLiquidacionesParaOtra(){
        $this->db->select('DISTINCT G719_C17423 as liquidacion, Id ');
        $this->db->where('G719_C17423 IS NOT NULL');
        $query = $this->db->get('InformacionCredito');
        return $query->result();

    }*/

   
    function getIdObligacion($contrato){
        $this->db->select(' Id AS Contrato');
        $this->db->from('InformacionCredito');
        $this->db->where('NoContrato', $contrato);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row()->Contrato;    
        }else{
            return 0;
        }
        
    }

    function getIdObligacionByLiquidacion($liquidacion){
        $this->db->select('Id AS Contrato');
        $this->db->from('InformacionCredito');
        $this->db->where("G719_C17423 LIKE '%".$liquidacion."%' ");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row()->Contrato;    
        }else{
            return 0;
        }
    }


    function getDatosObligaciones($idtabla){
        
        $this->db->select("NoContrato AS Contrato, 
                            G719_C17423 as liquidacion,
                            G719_C17424 as Vlorpagado, 
                            FechaPagoGarantia as fgarantia, 
                            IntermediarioFinanciero as intermediario,
                            NombreIF as financiero, 
                            NPorcentajeCobertura as Cobertura, 
                            FRG as FRG, 
                            NroProcesoJudicialSAP as SAP,  
                            Despacho as Despacho,
                            b.Nombre_b as claseProceso , 
                            a.Nombre_b as estadoP,
                            SaldoFNG as saldo,
                            TasaInteresMora as interespormora,  
                            G719_C17222 as GastoJudiciales,
                            G719_C17052 as porcentajeAbogado, 
                            G719_C17295 as ultimoavnoFecha,
                            NroProcesoJudicialSAP as Judiciable,
                            ClaseProceso as procesoGu, 
                            Ciudad as ciudaddespacho,
                            case 
                            when (NroProcesoJudicialSAP is not null and Abogado is null) THEN 'SIN ABOGADO ASIGNADO'
                            WHEN (NroProcesoJudicialSAP is not null and Abogado is not null) THEN ''
                            END  as EstadoAbogado");
        $this->db->from('InformacionCredito');
        $this->db->join('ClienteObligacion', 'Id = NumeroContratoId');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
        $this->db->join('FRG', 'Id = FRG','LEFT');
        $this->db->join('Despacho', 'Id = Despacho','LEFT');
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $this->db->join('ParametroGeneral a', 'a.Id = G719_C17420','LEFT');
        $this->db->join('ParametroGeneral b', 'b.Id = ClaseProceso','LEFT');
        $this->db->where('Id', $idtabla); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
       
        $query = $this->db->get();
        return $query->result();

    }

    
    function getColoresLiquidacicones($contrato){

        $this->db->select('DISTINCT  ColorLiquidaciones.Color, ColorLiquidaciones.ColorFunte ');
        //$this->db->from('CondicionesLiquidaciones');
        $this->db->join('ColorLiquidaciones', 'ID = CondicionesLiquidaciones.Estado', 'LEFT');
        $this->db->where('Liquidacion is not null');
        $this->db->where('Liquidacion', $contrato);
        //$this->db->order_by('CondicionesLiquidaciones.Estado','DESC');
        
        $query = $this->db->get('CondicionesLiquidaciones');
        if($query->num_rows() > 0){
            return $query->result();
        }

    }

// funciones procesos Asociados Jeisson Patiño 
   function getContratosProcesoAsociado($idCliente){

        $this->db->select(' InformacionClientesId AS ID_CLIENTE, 
                            NumeroContratoId As No_CONTRATO,  
                            Rol AS ROL ,
                            Credito as OBLIGACION,
                            liquidacion as liquidacion,
                            NombreIF as financiero ');

        $this->db->join('HistoricoProcesoAsociado', 'IdCredito = NumeroContratoId');
        $this->db->join('InformacionCredito','IdCredito = Id','LEFT');
        $this->db->join('IntermediarioFinanciero', 'Id = idIF','LEFT');


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

        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('ClienteObligacion');
        return $query->result();
    }

    function getDatosersonalesProceso ($idUsuario){
    $this->db->select("TOP 1 
                    liquidacion as contrato,
                    liquidacion as No_CONTRATO,
                    NombreDeudor as Deudor,
                    NombreIF as Inter,
                    NroIdentificacion as identificacion,
                    [tipo_identificacion] as tipo_identificacion,
                    TelefonoDomicilio as TelefonoD, 
                    TelefonoOficina as TelefonoO,
                    DireccionDomicilio as DireccionD, 
                    a.Ciudad as ciudadD, 
                    CiudadDomicilio, CiudadOficina,
                    DireccionOficina as DireccionO, 
                    b.Ciudad as CiudadO,
                    Celular as Celular, 
                    CelularAdicional as CelularA,
                    CorreoElectronico as Mail, 
                    NroObligacionesDeudor as numeroLiquidaciones, 
                    Id as idusuario,
                    dir_Adicional, 
                    c.Ciudad as ciudad_ad, 
                    tele_adicional, 
                    ciudad_adicional ");
        $this->db->join('ClienteObligacion ', 'NumeroContratoId = IdCredito', 'LEFT');
        $this->db->join('InformacionCliente ', 'InformacionClientesId = Id', 'LEFT');
        $this->db->join('G719 ', 'Id = NumeroContratoId', 'LEFT');
        $this->db->join('Ciudad as a', 'a.Id = CiudadDomicilio', 'LEFT');
        $this->db->join('Ciudad as b', 'b.Id = CiudadOficina', 'LEFT');
        $this->db->join('Ciudad as c', 'c.Id = ciudad_adicional', 'LEFT');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero', 'LEFT');  
        $this->db->where('NroIdentificacion', $idUsuario);
        $query = $this->db->get('HistoricoProcesoAsociado');
        return $query->result();
    }

    function getLiquidacionesNumeroAsociado($idCliente){
        $this->db->select(' liquidacion as liquidacion');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('HistoricoProcesoAsociado', 'Id = IdCredito');
        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
        $this->db->where('liquidacion IS NOT NULL');
        $this->db->group_by('liquidacion');
        $query = $this->db->get('ClienteObligacion');
        return $query->num_rows();
    }

    function getLiquidacionesNumero_SProcesoAsociado($idCliente){
        $this->db->select(' liquidacion as liquidacion');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('HistoricoProcesoAsociado', 'Id = IdCredito');
        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
        $this->db->where('liquidacion IS NOT NULL');
        $this->db->group_by('liquidacion');
        $query = $this->db->get('ClienteObligacion');
        return $query->result();    
    }

    function getDatosObligacionesProcesoAsociado($idtabla){
        
        $this->db->select("NoContrato AS Contrato, 
                            liquidacion as liquidacion,
                            G719_C17424 as Vlorpagado, 
                            FechaPagoGarantia as fgarantia, 
                            idIF as intermediario,
                            NombreIF as financiero, 
                            NPorcentajeCobertura as Cobertura, 
                            FRG as FRG, 
                            ProcJudicial as SAP,  
                            Despacho as Despacho,
                            b.Nombre_b as claseProceso , 
                            a.Nombre_b as estadoP,
                            SaldoFNG as saldo,
                            TasaInteresMora as interespormora,  
                            G719_C17222 as GastoJudiciales,
                            G719_C17052 as porcentajeAbogado, 
                            G719_C17295 as ultimoavnoFecha,
                            NroProcesoJudicialSAP as Judiciable,
                            ClaseProceso as procesoGu, 
                            Ciudad as ciudaddespacho,
                            case 
                            when (ProcJudicial is not null and Abogado is null) THEN 'SIN ABOGADO ASIGNADO'
                            WHEN (ProcJudicial is not null and Abogado is not null) THEN ''
                            END  as EstadoAbogado");
        $this->db->from('HistoricoProcesoAsociado');
        $this->db->join('InformacionCredito', 'IdCredito = Id','LEFT');
        $this->db->join('ClienteObligacion', 'Id = NumeroContratoId');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
        $this->db->join('FRG', 'Id = IdFRG','LEFT');
        $this->db->join('Despacho', 'Id = Despacho','LEFT');
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $this->db->join('ParametroGeneral a', 'a.Id = G719_C17420','LEFT');
        $this->db->join('ParametroGeneral b', 'b.Id = ClaseProceso','LEFT');
        $this->db->where('Id', $idtabla); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
       
        $query = $this->db->get();
        return $query->result();

    }


    function getLiquidacionesProcesoAsociado($idCliente){
        $this->db->select(' TOP 1 G719_C17423 as liquidacion');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('HistoricoProcesoAsociado', 'Id = IdCredito','LEFT');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');


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

        $this->db->where('InformacionClientesId', $idCliente); //esto es por si toca filtrarlo por eso lo dejo
        $this->db->where('Rol', 1786);
        $this->db->group_by('G719_C17423');
        $query = $this->db->get('ClienteObligacion');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }


}
