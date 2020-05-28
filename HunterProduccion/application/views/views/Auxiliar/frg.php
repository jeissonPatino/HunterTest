<section class="content-header">
    <h1>
        FRG
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Frg</li>
    </ol>
</section>

<section class="content">
	<div class="box">
        <div class="box-body">
                  
			<a class="btn btn-app" id="agregar">
				<i class="fa fa-plus"></i> Agregar
			</a>
			<a class="btn btn-app" id="edit" disabled>
				<i class="fa fa-edit"></i> Editar
			</a>
			<a class="btn btn-app"  id="delete" disabled>
				<i class="fa fa-trash"></i> Eliminar
			</a>
			<a class="btn btn-app" id="Save" disabled>
				<i class="fa fa-save"></i> Guardar
			</a>
			<a class="btn btn-app" id="cancel" disabled>
				<i class="fa fa-close"></i> Cancelar
			</a>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->

	<!-- Salario Minimo -->
	<div class="box">
		<div class="box-header with-border">
			
		</div>
		<div class="box-body">
			<div class="row-fuid">
				<div class="col-md-4">
					<form id="FrmAbogados" method="post">
						<input type="hidden" id="const_int_" name="id" value="0">
					
						<div class="form-group">
							<Label >FRG</Label>
							<input type="text" class="form-control" placeholder="FRG"  id="frg" name="frg" required disabled>
						</div>
						<div class="form-group">
							<Label>Dirección</Label>
							<input type="text" class="form-control" placeholder="Dirección"  id="direccion" name="direccion" required disabled>
						</div>
						<div class="form-group">
							<Label>Ciudad</Label>
							<select id="selCiudades" name ="selCiudades" class="form-control" disabled>
								<option value="0">Seleccione una ciudad</option>
								<?php 
									foreach ($ciudades as $key) {
										echo "<option value='".$key->id."'>".utf8_encode($key->ciudad)."</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<Label>Teléfono</Label>
							<input type="text" class="form-control" placeholder="Teléfono"  id="telefono" name="telefono" required disabled>
						</div>
						<div class="form-group">
							<Label>Nombre persona contacto</Label>
							<input type="text" class="form-control" placeholder="Nombre persona contacto"  id="contacto" name="contacto" required disabled>
						</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">FRG</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">FRG</th>
										<th style="text-align:center;">Teléfono</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($frg as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->Id.');">'.utf8_encode($key->Frg).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->Id.');">'.utf8_encode($key->telefono).'</td>
												  </tr>';
										}
									?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Correos de Contacto FRG</h3>
							<div class="box-tools">
								
							</div>
							<div class="box">
						        <div class="box-body">
						                  
									<a class="btn btn-app" id="JOseAgrega" data-toggle='modal' data-target='#Modal-parametros-reporte1' data-backdrop='static' data-keyboard='false'>
										<i class="fa fa-plus"></i> Agregar
									</a>
									
						    	</div><!-- /.box-body -->
	  						</div><!-- /.box -->
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblaCorreos">
								<thead>
									<tr>
										<th style="text-align:center;">Nombres</th>
										<th style="text-align:center;">Correo</th>
										<th style="text-align:center;"></th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-parametros-reporte1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda">Configuración Correos FRG</h4>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="valorFng" value="0"/>
                <div class="row">
                	<div class="col-md-1"></div>
                	<div class="col-md-5">
                		<label for="txtTiempoAsignacion">Nombres</label>
                		<input type="text" class="form-control" required id="txtNombres" placeholder="Nombres">
                	</div>
                	<div class="col-md-3">
	                	<div class="input-group">
							<label for="txtMeta">Correo</label>
	                		<input type="mail" class="form-control" required id="txtCorreo" placeholder="Correo">
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


<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">


	$.validator.setDefaults({
	    submitHandler: function() { 
	         $("#FrmAbogados").submit();
	    }
	});

	$(function(){

		$("#tblAbogados").DataTable({
				"oLanguage": {
	                "sLengthMenu": "_MENU_ registros por página ",
	                "sZeroRecords": "0 resultados en el criterio de busqueda",
	                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
	                "sInfoEmpty": "0 a 0 de 0 registros",
	                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
	                "sSearch": "Buscar:",
	                "sPaginationType": "full_numbers",
	                "oPaginate": {
				        "sNext": ">>",
				        "sPrevious": "<<"
			      	}
	            },
	            "sPaginationType": "simple",
	           "iDisplayLength": 10,
	           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
	    });

		$("#JOseAgrega").prop('disabled', true);

		$("#agregar").click(function(){
			$("#selCiudades").prop('disabled', false);
			$("#telefono").prop('disabled', false);
			$("#contacto").prop('disabled', false);
			$("#frg").prop('disabled', false);
			$("#direccion").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#selCiudades").prop('disabled', false);
			$("#telefono").prop('disabled', false);
			$("#contacto").prop('disabled', false);
			$("#frg").prop('disabled', false);
			$("#direccion").prop('disabled', false);


			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#selCiudades").prop('disabled', true);
			$("#telefono").prop('disabled', true);
			$("#contacto").prop('disabled', true);
			$("#frg").prop('disabled', true);
			$("#direccion").prop('disabled', true);
			$("#selCiudades").val(0);
	
			$("#departamento").val(" ");
			$("#ciudad").val(" ");
			$("#const_int_").val(0);


			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			$("#Save").attr('disabled', true);
	
		});

		$("#guardarParametros1").click(function(){
			if($("#txtNombres").val().length < 1){
				alertify.error("Es necesario escribir el Nombre de quien recibe!");
				$("#txtNombres").focus();
			}else if($("#txtCorreo").val().length < 1){
				alertify.error("Es necesario escribir el correo!");
				$("#txtCorreo").focus();
			}else{
				alertify.confirm("¿Ésta seguro de esta operacion?", function (e) {
			    	if (e) {
			    		$.ajax({
			            	url: '<?php echo base_url();?>auxiliar/crearCorreoFng',  
			            	type: 'POST',
				            data: { frg : $("#valorFng").val(), Nombres: $("#txtNombres").val(), Correo: $("#txtCorreo").val()},
				            //una vez finalizado correctamente
				            success: function(data){
				            	if(data == 'Si'){
				            		alertify.success('Datos guardados correctamente');
				            		$("#txtNombres").val("");
				            		$("#txtCorreo").val("");
				            		reloadDatos($("#valorFng").val());
				            		$('#Modal-parametros-reporte1').modal('hide');
				            	}else{
				            		alertify.error('Un error a ocurrido');
				            	}
				            },
				            //si ha ocurrido un error
				            error: function(){
				                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
				            }
				        });
			    	}else{

			    	}
			    });
			}
			
		});

		$("#delete").click(function(){

			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
		    	if (e) {
	         	 	 
	                $.ajax({
		            	url: '<?php echo base_url();?>auxiliar/eliminarGastosFrg',  
		            	type: 'POST',
			            data: { id : $("#const_int_").val() },
			            //una vez finalizado correctamente
			            success: function(data){
			            	if(data == '1'){
			            		alertify.success('Datos eliminados correctamente');
			            		window.location.reload(true);
			            	}else{
			            		alertify.error('Un error a ocurrido');
			            	}
			               
			                
			            },
			            //si ha ocurrido un error
			            error: function(){
			                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
			            }
			        });
			    } else {
			        // user clicked "cancel"
			    }
			});
            
		});

		$("#Save").click(function(){
			alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
		    	if (e) {
					var form = $("#FrmAbogados");
					if(form.valid()){
			  			var formData = new FormData($("#FrmAbogados")[0]);
			          	$.ajax({
			            	url: '<?php echo base_url();?>auxiliar/guardarGastosFrg',  
			            	type: 'POST',
				            data: formData,
			            	cache: false,
			            	contentType: false,
			            	processData: false,
				            //una vez finalizado correctamente
				            success: function(data){
				            	if(data == '1'){
				            		form[0].reset();
				            		alertify.success('Datos ingresados correctamente');
				            		window.location.reload(true);
				            	}else{
				            		alertify.error('Un error a ocurrido');
				            	}
				               
				                
				            },
				            //si ha ocurrido un error
				            error: function(){
				                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
				            }
				        });
				  	}else{
				  		alertify.error('No deben haber campos vacios, por favor rellena el formulario!!');
				  	}
				} else {
				        // user clicked "cancel"
			    }	
			});		
		});
	});

	$("#selpaises").change(function(){
		
		$.getJSON('<?php echo base_url();?>auxiliar/getFiltrosComboEtapas/'+$(this).val(), {format: "json"}, function(data) { 
			var etapa = '';
			$.each(data, function(i, item) {
				etapa += '<option value="'+ item.id +'">'+ item.descripcion +'</option>';
			});
			$("#selEtapas").html(etapa);
		});
	});

	function getdatos(varid){

		$("#selCiudades").prop('disabled', true);
		$("#telefono").prop('disabled', true);
		$("#contacto").prop('disabled', true);
		$("#frg").prop('disabled', true);
		$("#direccion").prop('disabled', true);

		$("#JOseAgrega").prop('disabled', true);

		$("#selCiudades").val(0);
		$("#telefono").val("");
		$("#contacto").val("");
		$("#frg").val("");
		$("#direccion").val("");
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosfrgbyId/'+varid, {format: "json"}, function(data) { 

			//$("#selpaises").val(data[0].Tipo_de_proceso);

			$("#selCiudades option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].ciudad; 
			}).prop('selected', true);

			$("#valorFng").val(varid);

			$("#telefono").val(data[0].telefono);
			//$("#selEtapas").val(data[0].Etapa);	
			$("#contacto").val(data[0].contacto);
			$("#frg").val(data[0].Frg);
			$("#direccion").val(data[0].direccion);
			$("#const_int_").val(data[0].id);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);
			$("#JOseAgrega").prop('disabled', false);

			$("#cancel").attr('disabled', true);
			$("#Save").attr('disabled', true);
		});


		reloadDatos(varid);
		
	}

	function reloadDatos(varid){
		$.getJSON('<?php echo base_url();?>auxiliar/getCorreosFrg/'+varid, {format: "json"}, function(dataAqui) { 
			if($.fn.dataTable.isDataTable( '#tblaCorreos' )){
				$("#tblaCorreos").dataTable().fnDestroy();
			}


			var tblaCorreos = $("#tblaCorreos").DataTable({
					"aaData": dataAqui,
					"aoColumns": [
						{ mData: "Nombres" },
						{ mData: "Correo"},
						{ mData: "buttones"}
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
					   $(".eliminador").click(function(){
					   		var frg =  $(this).attr('datos');
					   		alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
						    	if (e) {
					    
					                $.ajax({
						            	url: '<?php echo base_url();?>auxiliar/eliminarCorreoFng/'+frg,  
						            	type: 'POST',
							    
							            success: function(data){
							            	if(data == 'Si'){
							            		alertify.success('Datos eliminados correctamente');
							            		reloadDatos(frg);
							            	}else{
							            		alertify.error('Un error a ocurrido');
							            	}
							            
							            },
							            //si ha ocurrido un error
							            error: function(){
							                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
							            }
							        });
							    } else {
							        // user clicked "cancel"
							    }
							});
					   });
					},
					"bJQueryUI": true,
					"bProcessing": true,
					"bSort": true,
					"bSortClasses": false,
					"bDeferRender": true,
					"sPaginationType": "simple",
		           	"iDisplayLength": 10,
		           	"aLengthMenu": [[10, 20, 40, 100], [10, 20, 40, 100]]
		    });
		});
	}
</script>
