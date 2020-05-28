<section class="content-header">
    <h1>
        CLIENTES - DATOS ADICIONALES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Clientes datos adicionales</li>
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
						<input type="hidden" id="const_int_user" name="ID_PERSONAS" value="0">
						<div class="form-group">
							<Label>Correo</Label>
							<input type="text" class="form-control" placeholder="Correo"  id="correo" required name="CORREO_ELECTRONICO" disabled>
						</div>
						<div class="form-group">
							<Label>Teléfono</Label>
							<input type="text" class="form-control" placeholder="Teléfono"  id="telefono" required name="TELEFONO" disabled>
						</div>

						<div class="form-group">
							<Label>Dirección</Label>
							<input type="text" class="form-control" placeholder="Dirección"  id="direccion" name="DIRECCION" required disabled>
						</div>

						<div class="form-group">
							<Label>Ciudad</Label>
							<select class="form-control" id="ciudad" required name="CIUDAD" disabled>
								<?php 
									foreach ($ciudades as $key) {
										echo '<option value="'.$key->id.'">'.$key->ciudad.'</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<Label>Calificación</Label>
							<select class="form-control" id="calificacion" required name="CALIFICACION" disabled>
								<option value="0">Calificación</option>
								<?php 
									foreach ($calificacion as $key) {
										echo "<option value='".$key->Id."'>".utf8_encode($key->Nombre_b)."</option>";
									}
								?>
							</select>
						</div>

						<div class="form-group">
							<Label>Descripción</Label>
							<input type="text" class="form-control" placeholder="Descripción"  id="descripcion" name="DESCRIPCION" required disabled>
						</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Clientes</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Nombre </th>
										<th style="text-align:center;">Celular</th>
										<th style="text-align:center;">Ciudad</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($personas as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->idusuario.');">'.utf8_encode($key->Deudor).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->idusuario.');">'.utf8_encode($key->TelefonoD).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->idusuario.');">'.utf8_encode($key->ciudadD).'</td>
												  </tr>';
										}
									?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

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



		$("#agregar").click(function(){
			if($("#const_int_user").val() == 0){
				alertify.error("Seleccione un cliente, para agregar datos!");
			}else{
				$("#ciudad").prop('disabled', false);
				$("#calificacion").prop('disabled', false);
				$("#direccion").prop('disabled', false);
				$("#correo").prop('disabled', false);
				$("#telefono").prop('disabled', false);
				$("#descripcion").prop('disabled', false);

				$("#cancel").attr('disabled', false);
				$("#Save").attr('disabled', false);
				$(this).attr('disabled', true);
				$("#edit").attr('disabled', true);
				$("#delete").attr('disabled', true);
			}
			
		});

		$("#edit").click(function(){
			$("#ciudad").prop('disabled', false);
			$("#calificacion").prop('disabled', false);
			$("#direccion").prop('disabled', false);
			$("#correo").prop('disabled', false);
			$("#telefono").prop('disabled', false);
			$("#descripcion").prop('disabled', false);


			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#ciudad").prop('disabled', true);
			$("#calificacion").prop('disabled', true);
			$("#direccion").prop('disabled', true);
			$("#correo").prop('disabled', true);
			$("#telefono").prop('disabled', true);
			$("#descripcion").prop('disabled', true);

			$("#ciudad").val(0);
			$("#calificacion").val(" ");
			$("#direccion").val(" ");
			$("#telefono").val(" ");
			$("#descripcion").val(" ");
			$("#const_int_").val(0);


			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			$("#Save").attr('disabled', true);
	
		});

		

		$("#delete").click(function(){
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
				            	url: '<?php echo base_url();?>auxiliar/eliminarDatosAdicionales',  
				            	type: 'POST',
					            data: { ID_PERSONAS : $("#const_int_user").val() },
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
			            	url: '<?php echo base_url();?>auxiliar/guardarDatosadicionales',  
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

	

	function getdatos(varid){

		$("#ciudad").prop('disabled', true);
		$("#calificacion").prop('disabled', true);
		$("#direccion").prop('disabled', true);
		$("#correo").prop('disabled', true);
		$("#telefono").prop('disabled', true);
		$("#descripcion").prop('disabled', true);

		$("#ciudad").val(0);
		$("#calificacion").val(" ");
		$("#direccion").val(" ");
		$("#telefono").val(" ");
		$("#descripcion").val(" ");
		$("#const_int_").val(0);


		$.getJSON('<?php echo base_url();?>auxiliar/getDatosadicionales/'+varid, {format: "json"}, function(data) { 

			//$("#selpaises").val(data[0].Tipo_de_proceso);
			if(data.length > 0){
				$("#ciudad option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].CIUDAD; 
				}).prop('selected', true);

			
				$("#calificacion option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].CALIFICACION; 
				}).prop('selected', true);

				$("#correo").val(data[0].CORREO_ELECTRONICO);
				$("#direccion").val(data[0].DIRECCION);	
				$("#descripcion").val(data[0].DESCRIPCION);
				$("#telefono").val(data[0].TELEFONO);
				$("#const_int_").val(data[0].id);
				$("#const_int_user").val(varid);

				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', false);
				$("#delete").attr('disabled', false);

				$("#cancel").attr('disabled', true);
				$("#Save").attr('disabled', true);

			}else{

				$("#ciudad").val(0);
				$("#calificacion").val(0);


				$("#correo").val('');
				$("#direccion").val('');	
				$("#descripcion").val('');
				$("#telefono").val("");
				$("#const_int_").val(0);
				$("#const_int_user").val(varid);


				$("#ciudad").prop('disabled', false);
				$("#calificacion").prop('disabled', false);
				$("#direccion").prop('disabled', false);
				$("#correo").prop('disabled', false);
				$("#telefono").prop('disabled', false);
				$("#descripcion").prop('disabled', false);



				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', true);
				$("#delete").attr('disabled', true);

				$("#cancel").attr('disabled', false);
				$("#Save").attr('disabled', false);
			}
				
		});
	}
</script>
