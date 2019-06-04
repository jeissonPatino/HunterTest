<section class="content-header">
    <h1>
        CARTERA FNG - PROCESOS VIGENTES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
        <li><a href="<?php echo base_url();?>cartera_fng/gestionJudicial">Procesos Vigentes</a></li>
        <li><a href="<?php echo base_url();?>cartera_fng/datosJudiciales/<?php echo $identificacion; ?>">Datos obligacion </a></li>
     	<li class="active">Información Procesos Vigentes</li>
    </ol>
</section>

<style type="text/css">
  a {
    cursor: pointer;
  }
</style>
<section class="content">
	<div class="box">
        <div class="box-body">
        	<div>
        		<button class="btn btn-primary">Registrar Medida</button>
        		<br><br>
        	</div>
        	<div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-left">
              		<li class="active"><a href="#revenue-chart" data-toggle="tab">Etapas</a></li>
                 
           
                </ul>
                <div class="tab-content no-padding">
                  	<!-- Morris chart - Sales -->
                  	<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: auto;">
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                    		<div class="row">
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                      			<div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(1, 'Demanda');"><img src="<?php echo base_url();?>assets/img/botones/Demanda.png"></a>
                            </div>
                      			<div class="col-md-2">
                                <a onclick="javascript: getDatosWizard('10', 'Embargo');"><img src="<?php echo base_url();?>assets/img/botones/Embargo.png"></a>
                            </div>
                      			<div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(11,'Secuestro');"><img src="<?php echo base_url();?>assets/img/botones/Secuestro.png"></a>
                            </div>
                      			<div class="col-md-2">
                                
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                    		</div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                            <div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(2, 'Notificación');"><img src="<?php echo base_url();?>assets/img/botones/Notificacion.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a   onclick="javascript: getDatosWizard(9, 'Liquidación de créditos y costas' );"><img src="<?php echo base_url();?>assets/img/botones/Liquidacion.png"></a>
                            </div>

                            <div class="col-md-2">
                                <a   onclick="javascript: getDatosWizard(12, 'Avalúo');"><img src="<?php echo base_url();?>assets/img/botones/Avaluo.png"></a>
                            </div>
                            <div class="col-md-2">
                               
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                           
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                               &nbsp;
                            </div>

                            <div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(3, 'Contestacion Demanda y/o excepciones');"><img src="<?php echo base_url();?>assets/img/botones/Contestacion_demanda.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(8, 'Segunda Instancia');"><img src="<?php echo base_url();?>assets/img/botones/Segunda_Instancia.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(13, 'Remate');"><img src="<?php echo base_url();?>assets/img/botones/Remate.png"></a>
                            </div>
                            <div class="col-md-2">
                                
                            </div>

                            <div class="col-md-2">
                                
                            </div>
                            
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(4, 'Subrogacion');"><img src="<?php echo base_url();?>assets/img/botones/Subrogacion.png"></a>
                            </div>
                            
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(7, 'Sentencia');"><img src="<?php echo base_url();?>assets/img/botones/Sentencia.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(14, 'Impulso Procesal');"><img src="<?php echo base_url();?>assets/img/botones/Impulso_Procesal.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(17, 'Terminación');"><img src="<?php echo base_url();?>assets/img/botones/Terminacion.png"></a>
                            </div>

                            <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                               &nbsp;
                            </div>
                            <div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(5, 'Audiencia');"><img src="<?php echo base_url();?>assets/img/botones/Audiencia.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a onclick="javascript: getDatosWizard(6, 'Acuerdo Pago FNG');"><img src="<?php echo base_url();?>assets/img/botones/Acuerdo_Pago.png"></a>
                            </div>
                            
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(15, 'Desistimiento Táctico');" ><img src="<?php echo base_url();?>assets/img/botones/Desistimiento_Tactico.png"></a>
                            </div>
                            <div class="col-md-2">
                                <a  onclick="javascript: getDatosWizard(16, 'Venta de Cartera');"><img src="<?php echo base_url();?>assets/img/botones/Venta_Cartera.png"></a>
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                            <div class="col-md-1">
                                
                            </div>
                        </div>

                  	</div>
                  	
                </div>
          	</div><!-- /.nav-tabs-custom -->	 
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->
</section><!-- /.content -->


<div class="modal fade" tabindex="-1" role="dialog" id="Modal-Demanda">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="tituloModal">Actuaciones - Demanda</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-8" >
                        <div class="form-group" id="modalBody">
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Fecha Trámite</label>
                            <input type="text" class="form-control datemask" id="txtFecha" placeholder="Fecha Tramite">
                        </div>

                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea class="form-control" rows="3" id="txtObservaciones" placeholder="Observaciones"></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="GuardarBtn" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">
    $(function(){
        

        $("#GuardarBtn").click(function(){
            var confirmado =  confirm("¿Esta seguro que desea guardar el registro?");
            if(confirmado == true){
                
                $.ajax({
                    url       : '<?php echo base_url();?>cartera_fng/guardardatosWizard',
                    type      : 'POST',
                    data      : {
                                  actuacion : $('input:radio[name=optionsRadios]:checked').val() ,
                                  contrato  : <?php echo $numeroContrato;?> ,
                                  txtFechaTramite : $("#txtFecha").val(),
                                  TipoProceso  : 1 ,
                                  txtObservaciones : $("#txtObservaciones").val()
                                },
                    success   : function(data){
                       if(data == 1){
                          alertify.success("Gestión Judicial guardada satisfactoriamente");
                          $("#Modal-Demanda").modal('hide');
                       }else{
                          alertify.error("Gestión Judicial, No se pudo guardar");
                         
                       }
                    }
                });
            }else{

            }
        })
    });

    function getDatosWizard(consInteEtapaSeleccionada, nombreEtapa){
        $.ajax({
            url      : "<?php echo base_url();?>cartera_fng/eventoBotonEtapa",
            type     : "POST",
       
            data     : { consInteEtapaSeleccionada : consInteEtapaSeleccionada },
            success  : function(data){
                $("#tituloModal").html("Actuaciones - "+nombreEtapa);
                /*var estaGaver = '';
                $.each(data, function(i, item) {
                   // $("#txtNumeroContrato").val(item.Contrato);
                    estaGaver += '<div class="radio">';
                    estaGaver += '<label>';
                    estaGaver += '<input type="radio" name="optionsRadios" id="optionsRadios1" value="'+ item.G724_ConsInte__b +'">';
                    estaGaver +=  item.G724_C17105;
                    estaGaver += '</label>';
                    estaGaver += '</div>';
                });*/
                $("#modalBody").html(data);
                $("#tituloModal").html("Actuaciones - "+nombreEtapa);
                $("#Modal-Demanda").modal();
            }
        });
       
        
    }
</script>

