<section class="content-header">
    <h1>
        Configuración de reportes
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Configuración de reportes</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Reportes</h3>
		</div>
		<div class="box-body">
			<table class="table table-hover" id="tablaUsuarios">
				<thead>
					<tr>
						<th>Reporte</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($reportes as $key) {
							echo "<tr>
									<td>".utf8_encode($key->rep_nombre)."</td>
									<td>ACTIVO</td>";
							if($key->rep_param == 0){
								echo "<td></td>";
							}else{
								echo "<td><button class='btn btn-primary' idreporte='".$key->rep_id."' data-toggle='modal' data-target='#Modal-parametros-".$key->rep_orden."' data-backdrop='static' 
   data-keyboard='false' onclick='cambiarReporte(".$key->rep_id.")'>Parametrizar</button></td>
								</tr>";	
							}
							
						}
						
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda">INFORME EVAL. FRG - Asignación de abogados</h4>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="valorReporte" value="0"/>
                <div class="row">
                	<div class="col-md-1"></div>
                	<div class="col-md-5">
                		<label for="txtTiempoAsignacion">Tiempo asignación Días</label>
                		<input type="text" class="form-control ParametrosNumber" id="txtTiempoAsignacion" placeholder="Tiempo asignación Días">
                	</div>
                	<div class="col-md-3">
	                	<div class="input-group">
							<label for="txtMeta">Meta (%)</label>
	                		<input type="text" class="form-control ParametrosNumber" id="txtMeta" placeholder="Meta">
						</div>
                	</div>
                	<div class="col-md-1"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="guardarParametros1" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte3">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda">INFORME EVAL. FRG - Subrogaciones efectivas</h4>
            </div>
            <div class="modal-body">
				<form class="form-horizontal" id="enviomasivo" >
					<input type="hidden" id="valorReporte" value="0"/>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<label for="txtNumeroObligaciones">Meta anual (%)</label>
							<input type="text" class="form-control ParametrosNumber" id="txtNumeroObligaciones" placeholder="Meta anual (%)">
						</div>
						<div class="col-md-6">
							<?php //echo date('Y');?>
							<div class="form-group">
								<label for="inputPassword3">Cargar Base para medición</label>
								<div class="input-group">
									<input type="file"  id="FilExcell" name="FilExcell"  class="form-control">
								</div><!-- /.input group -->
							</div><!-- /.form group -->
						</div>
						<div class="col-md-1"></div>
					</div>
					<div class="row" id="mostrarPorcentaje" style="display: none;">
						<div class="col-lg-2">
							
						</div>
						<div class="col-lg-8">
							<p style="text-align:center;">Porcentaje de subida</p>
							<div class="progress" id="containerPogresBar" >
								<div id="progressbarComercial" class="progress-bar progress-bar-striped active " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
								50%
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							
						</div>
					</div>
				</form>

				<div class="row" >
					<div class="col-lg-12">
						<table class="table table-hover table-bordered" id="tblRapidezs">
							<thead>
								<tr>
									<td> No. contrato </td>
									<td> No. de proceso SAP </td>
									<td> FRG </td>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="guardarParametros3" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte5">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda">INFORME EVAL. ABOGADOS - Radicación memoriales de subrogación</h4>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="valorReporte" value="0"/>
                <div class="row">
                	<div class="col-md-1"></div>
          
                	<div class="col-md-3">
	                	<div class="input-group">
							<label for="txtNumeroObligaciones">Meta (%)</label>
	                		<input type="text" class="form-control ParametrosNumber" id="txtMetaAbogados" placeholder="Meta">
						</div>
                	</div>
                	<div class="col-md-3">
						<div class="input-group">
							<label for="txtNumeroObligaciones">Días trancurridos</label>
	                		<input type="text" class="form-control ParametrosNumber" id="txtDiasTrancurridos" placeholder="Días trancurridos">
						</div>
                	</div>
                	<div class="col-md-1"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="guardarParametros5" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual   -->
<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="tit">INFORMES FRG - Gestión Extrajudicial Mensual </h4>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="valorReporte" value="0"/>
                <div class="row">
                	<div class="col-md-1"></div>
          
                	<div class="col-md-6">
	                	<div class="input-group">
							<label for="lblMetaCantidadGestiones">Cantidad gestiones de cobranza extrajudicial</label>
	                		<input type="text" class="form-control ParametrosNumber" id="txtMetaCantidadGestiones" placeholder="Meta">
						</div>
                	</div>
                	<div class="col-md-1"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="guardarParametros2" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Manuel Ochoa - Softtek - 19/11/2015 - FIN - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual   -->


<!-- Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual   -->
<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte7">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="tit">INFORMES ABOGADOS - Gestión judicial </h4>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="valorReporte" value="0"/>
                <div class="row">
                	<div class="col-md-1"></div>
          
                	<div class="col-md-6">
	                	<div class="input-group">
							<label for="lblMetaCantidadGestiones">Cantidad gestiones judiciales</label>
	                		<input type="text" class="form-control ParametrosNumber" id="txtMetaCantidadGestionesRep7" placeholder="Meta">
						</div>
                	</div>
                	<div class="col-md-1"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="guardarParametros7" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Manuel Ochoa - Softtek - 19/11/2015 - FIN - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual   -->

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte4">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda">INFORME EVAL. FRG - Soporte CISA</h4>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="valorReporte" value="0"/>
                <div class="row">
                	<div class="col-md-3">
	                	<div class="input-group">
							<label for="txtNombreVenta">Nombre venta</label>
	                		<input type="text" class="form-control" id="txtNombreVenta" placeholder="Nombre venta">
						</div>
                	</div>
					<div class="col-md-2">
	                	<div class="input-group">
							<label for="txtFechaVenta">Fecha venta</label>
	                		<input type="text" class="form-control" id="txtFechaVenta" placeholder="Fecha venta">
						</div>
                	</div>
					<div class="col-md-3">
	                	<div class="input-group">
							<label for="txtFechaNotificacion">Fecha Notificación</label>
	                		<input type="text" class="form-control" id="txtFechaNotificacion" placeholder="Fecha Notificación">
						</div>
                	</div>
                	<div class="col-md-2">
	                	<div class="input-group">
							<label for="txtMetaCISA">Plazo</label>
	                		<input type="text" class="form-control ParametrosNumber" id="txtMetaCISA" placeholder="Plazo">
						</div>
                	</div>
                	<div class="col-md-1">
						<label for="txtNumeroObligaciones" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<button class="btn btn-primary" id="guardarParametros4" type="button">Guardar</button>
					</div>
                </div>
				</br>
				</br>
				<div class="row">
					<div class="col-md-12" style="text-align:center;">
						<table class="table table-hover table-border">
							<thead>
								<th>Nombre venta</th>
								<th>Fecha venta</th>
								<th>Fecha de notificación</th>
								<th>Plazo entrega soportes</th>
								<th>Plazo</th>
							</thead>
							<tbody id="CISA">

							<tbody>
						<table>
					</div>
				</div>
				 
            </div>
            <div class="modal-footer">
				
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/bajadas/Jzip.js"></script>
<!--<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>


<script src="<?php echo base_url();?>assets/plugins/jquery-number/jquery.number.js"></script>
<script type="text/javascript">
	$(function(){

		$.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-mm-dd",
            titleFormat: "dd/mm/yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

		$("#txtFechaVenta").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate',function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('#txtFechaNotificacion').datepicker('setStartDate', startDate);
	    }); 

	    $("#txtFechaNotificacion").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true
        });


		$(".ParametrosNumber").number( true, 0 );
		$("#guardarParametros1").click(function(){
			if($("#txtTiempoAsignacion").val().length < 1){
				alertify.error("Por favor escriba el tiempo de asignación");
				$("#txtTiempoAsignacion").focus();
			}else if($("#txtMeta").val().length < 1){
				alertify.error('Por favor escriba el porcentaje para la meta');
				$("#txtMeta").focus();
			}else{
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametros",
					data  : { 
							meta : $("#txtMeta").val(),
							ejecucionTiempo:  $("#txtTiempoAsignacion").val(),
							idRporte : $("#valorReporte").val()
							},
					success : function (data){
						if(data == "1"){
							alertify.success("Registro guardado!");
							$("#txtMeta").val('');
							$("#txtTiempoAsignacion").val('');
							$("#valorReporte").val(0);
							$("#Modal-parametros-reporte1").modal("hide");
						}else{
							alertify.error("No se pudo guardar el registro!");
						}
						
					}
				});
			}
		});

		//Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
		$("#guardarParametros2").click(function(){
			if($("#txtMetaCantidadGestiones").val().length < 1){
				alertify.error("Por favor escriba la cantidad de gestiones");
				$("#txtMetaCantidadGestiones").focus();
			}else{
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametros",
					data  : { 
							meta : $("#txtMetaCantidadGestiones").val(),
							ejecucionTiempo: null,
							idRporte : $("#valorReporte").val()
							},
					success : function (data){
						if(data == "1"){
							alertify.success("Registro guardado!");
							$("#txtMetaCantidadGestiones").val('');
							$("#valorReporte").val(0);
							$("#Modal-parametros-reporte2").modal("hide");
						}else{
							alertify.error("No se pudo guardar el registro!");
						}
						
					}
				});
			}
		});
		//Manuel Ochoa - Softtek - 19/11/2015 - FIN - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
		
		//Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES ABOGADOS - Gestión judicial
		$("#guardarParametros7").click(function(){
			if($("#txtMetaCantidadGestionesRep7").val().length < 1){
				alertify.error("Por favor escriba la cantidad de gestiones");
				$("#txtMetaCantidadGestionesRep7").focus();
			}else{
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametros",
					data  : { 
							meta : $("#txtMetaCantidadGestionesRep7").val(),
							ejecucionTiempo: null,
							idRporte : $("#valorReporte").val()
							},
					success : function (data){
						if(data == "1"){
							alertify.success("Registro guardado!");
							$("#txtMetaCantidadGestionesRep7").val('');
							$("#valorReporte").val(0);
							$("#Modal-parametros-reporte7").modal("hide");
						}else{
							alertify.error("No se pudo guardar el registro!");
						}
						
					}
				});
			}
		});
		//Manuel Ochoa - Softtek - 19/11/2015 - FIN - Configuracion INFORMES ABOGADOS - Gestión judicial		
		
		$("#guardarParametros3").click(function(){
			var idRep = "4";
			if($("#txtNumeroObligaciones").val().length < 1){
				alertify.error("Por favor escriba el numero de obligaciones que se necesitan para lograr la meta");
				$("#txtNumeroObligaciones").focus();


			}if($("#FilExcell").val().length > 1){
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametros",
					data  : { 
							numeroObligaciones:  $("#txtNumeroObligaciones").val(),
							idRporte : idRep
							},
					success : function (data){
												
					}
				});

				var otherForm = $("#enviomasivo");
				var formData = new FormData($("#enviomasivo")[0]);
				$.ajax({
					xhr: function()
					{
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = Math.round(evt.loaded * 100 / evt.total);
							$("#progressbarComercial").attr('aria-valuenow', percentComplete);
							$("#progressbarComercial").attr('style', "width: "+percentComplete+"%");
							$("#progressbarComercial").html(percentComplete + '%');
						}
					}, false);

					return xhr;
					},
					url: '<?php echo base_url(); ?>configuraciones/guardarBaseMemoriales',  
					type: 'POST',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					beforeSend : function() {
						$("#mostrarPorcentaje").show();
						$("#progressbarComercial").addClass('progress-bar-striped');
						$("#progressbarComercial").addClass('active');
					},
					//una vez finalizado correctamente
					success: function(data){
						if(data.valid == 1){
							alertify.success("La cantidad  de registros son "+ data.registros +", guardados "+ data.total + ", " + data.baseAnte + " fueron actualizados ");
							otherForm[0].reset();	
						}else if(data.valid == 0){
							alertify.error(data.message);
							otherForm[0].reset();
						}
						
						
						
					},
					complete: function(){
					
					otherForm[0].reset();


					$("#progressbarComercial").removeClass('progress-bar-striped');
					$("#progressbarComercial").removeClass('active');
					$("#progressbarComercial").attr('aria-valuenow', '0');
					$("#progressbarComercial").attr('style', "width: 0%");
					$("#Modal-parametros-reporte3").modal("hide");
					$("#mostrarPorcentaje").hide();
					},
					//si ha ocurrido un error
					error: function(){
					/*$.unblockUI();*/
						otherForm[0].reset();
						
						$("#progressbarComercial").removeClass('progress-bar-striped');
						$("#progressbarComercial").removeClass('active');
						$("#progressbarComercial").attr('aria-valuenow', '0');
						$("#progressbarComercial").attr('style', "width: 0%");
						$("#mostrarPorcentaje").hide();
						$("#Modal-parametros-reporte3").modal("hide");
						alertify.error('Ocurrio un error, intenta mas tarde');
					}
				}); 
			}else{
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametros",
					data  : { 
							numeroObligaciones:  $("#txtNumeroObligaciones").val(),
							idRporte : idRep
							},
					success : function (data){
						if(data == "1"){
							alertify.success("Registro guardado!");
							$("#txtNumeroObligaciones").val('');
							$("#valorReporte").val(0);
							$("#Modal-parametros-reporte3").modal("hide");
						}else{
							alertify.error("No se pudo guardar el registro!");
						}
						
					}
				});
			}
		});

		$("#guardarParametros5").click(function(){
			if($("#txtMetaAbogados").val().length < 1){
				alertify.error("Por favor escriba el numero de obligaciones que se necesitan para lograr la meta");
				$("#txtMetaAbogados").focus();
			}else if($("#txtDiasTrancurridos").val().length < 1){
				alertify.error("Por favor escriba el numero de dias trancurridos para la radicación del memorial");
				$("#txtDiasTrancurridos").focus();
			}else{
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametros",
					data  : { 
							metaabogados:  $("#txtMetaAbogados").val(),
							diastrancurridos:  $("#txtDiasTrancurridos").val(),
							idRporte : $("#valorReporte").val()
							},
					success : function (data){
						if(data == "1"){
							alertify.success("Registro guardado!");
							$("#txtMetaAbogados").val('');
							$("#valorReporte").val(0);
							$("#Modal-parametros-reporte5").modal("hide");
						}else{
							alertify.error("No se pudo guardar el registro!");
						}
						
					}
				});
			}
		});

		$("#guardarParametros4").click(function(){
			if($("#txtNombreVenta").val().length < 1){
				alertify.error("Por favor escriba el Nombre de la venta");
				$("#txtNombreVenta").focus();
			}else if($("#txtFechaVenta").val().length < 1){
				alertify.error('Por favor escriba fecha de la venta');
				$("#txtFechaVenta").focus();
			}else if($("#txtFechaNotificacion").val().length < 1){
				alertify.error('Por favor escriba fecha de la notificación');
				$("#txtFechaNotificacion").focus();
			}else if($("#txtMetaCISA").val().length < 1){
				alertify.error('Por favor escriba la Meta');
				$("#txtMetaCISA").focus();
			}else{
				debugger;
				$.ajax({
					type  : "POST",
					url   : "<?php echo base_url();?>configuraciones/guardarParametrosCisa",
					data  : { 
							txtNombreVenta:  $("#txtNombreVenta").val(),
							txtFechaVenta : $("#txtFechaVenta").val(),
							txtMetaCISA : $("#txtMetaCISA").val(),
							txtFechaNotificacion : $("#txtFechaNotificacion").val()
							},
					success : function (data){
						if(data == "1"){
							alertify.success("Registro guardado!");
							$("#txtFechaVenta").val('');
							$("#txtNombreVenta").val('');
							$("#txtFechaNotificacion").val('');
							$("#valorReporte").val(0);
							$("#txtMetaCISA").val(0);
							$("#Modal-parametros-reporte4").modal("hide");
						}else{
							alertify.error("No se pudo guardar el registro!");
						}
						
					}
				});
			}
		});

		
	});
	
	function deleteParametro(id){

		alertify.confirm("¿Esta seguro de esta operación?", function (e) {
      		if (e) {

				$.ajax({
					type   : 'GET',
					url    : '<?php echo base_url();?>configuraciones/eliminarParamerosCIsa/'+id,
					success : function (data){
						if(data == "1"){
							alertify.success("Registro eliminado!");
							$("#txtFechaVenta").val('');
							$("#txtNombreVenta").val('');
							$("#txtFechaNotificacion").val('');
							$("#valorReporte").val(0);
							$("#Modal-parametros-reporte4").modal("hide");
						}else{
							alertify.error("No se pudo eliminar el registro!");
						}
					}
					
				});
			}else{

			}
		});
	}

	function cambiarReporte(id){
		if(id == 5){
			$("#valorReporte").val(id);
			$.getJSON('<?php echo base_url();?>configuraciones/getFechasVentas', {format: "json"}, function(data) { 
				var tr='';
				$.each(data, function(i,item){
					tr +='<tr>';
					tr +='<td>'+ item.Ven_nombre + '</td>';
					tr +='<td>'+ item.Ven_fecha_venta + '</td>';
					tr +='<td>'+ item.Ven_fecha_notificacion + '</td>';
					tr +='<td>'+ item.Ven_fecha_Maxima + '</td>';
					tr +='<td>'+ item.Ven_meta + '</td>';
					tr +='<td><button pramaetro="'+ item.ven_id +'" title="Eliminar fecha venta" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash" ></i></button></td>';

					tr +='</tr>';
				});
				$("#CISA").html(tr);
				$(".btnDelete").click(function(){
					deleteParametro($(this).attr('pramaetro'));
				});

			});
		}else if(id == 4){
			
			$.getJSON('<?php echo base_url();?>configuraciones/GetdatosReporte/'+id, {format: "json"}, function(data) { 
				$("#txtMeta").val(data.meta);
				$("#txtTiempoAsignacion").val(data.tiempo);
				$("#txtNumeroObligaciones").val(data.obligaciones);
				$("#txtMetaAbogados").val(data.meta);
				$("#txtDiasTrancurridos").val(data.tiempo);
			});

			$.getJSON('<?php echo base_url();?>configuraciones/getBaseSurbogaciones/', {format: "json"}, function(data) { 
					if($.fn.dataTable.isDataTable( '#tblRapidezs' )){
	    				$("#tblRapidezs").dataTable().fnDestroy();
	    			}
	    			debugger;
	    			var tblRapidezs = $("#tblRapidezs").DataTable({
							"aaData": data,
							"aoColumns": [
								{ mData: "contrato" },
								{ mData: "sap" },
								{ mData: "frg"}
							],
							"oLanguage": {
				                "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            "processing": true,
				           //	"ajax": "<?php //echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {

							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							},
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				           	"iDisplayLength": 10,
				           	"aLengthMenu": [[10, 20, 40, 100], [10, 20, 40, 100]],
				           	"dom": 'Bfrtip',
				           	"buttons": [
					             'excel'
					        ]
				    });
			});
		//Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
		}else if(id == 3){

			$("#valorReporte").val(id);
			$.getJSON('<?php echo base_url();?>configuraciones/GetdatosReporte/'+id, {format: "json"}, function(data) { 
				$("#txtMetaCantidadGestiones").val(data.meta);
			});
		//Manuel Ochoa - Softtek - 19/11/2015 - FIN - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
		
		//Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES ABOGADOS - Gestión judicial
		}else if(id == 8){
			$("#valorReporte").val(id);
			$.getJSON('<?php echo base_url();?>configuraciones/GetdatosReporte/'+id, {format: "json"}, function(data) { 
				$("#txtMetaCantidadGestionesRep7").val(data.meta);
			});
		//Manuel Ochoa - Softtek - 19/11/2015 - FIN - Configuracion INFORMES ABOGADOS - Gestión judicial		
		}else{
			$("#valorReporte").val(id);
			$.getJSON('<?php echo base_url();?>configuraciones/GetdatosReporte/'+id, {format: "json"}, function(data) { 
				$("#txtMeta").val(data.meta);
				$("#txtTiempoAsignacion").val(data.tiempo);
				$("#txtNumeroObligaciones").val(data.obligaciones);
				$("#txtMetaAbogados").val(data.meta);
				$("#txtDiasTrancurridos").val(data.tiempo);
			});
		}
		
	}
</script>