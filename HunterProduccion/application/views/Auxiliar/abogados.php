<section class="content-header">
    <h1>
      ABOGADOS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Abogados</li>
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
							<Label >CC Abogado</Label>
							<input type="text" class="form-control" placeholder="CC Abogado"  id="cedula" name="cedula" required disabled>
						</div>

						<div class="form-group">
							<Label>Nombre</Label>
							<input type="text" class="form-control" placeholder="Nombre"  id="nombre" name="nombre" required disabled>
						</div>
						<div class="form-group">
							<Label>Teléfono</Label>
							<input type="text" class="form-control" placeholder="Teléfono"  id="txtTelefono"  name="txtTelefono" disabled>
						</div>
						<div class="form-group">
							<Label>Celular</Label>
							<input type="text" class="form-control" placeholder="Celular"  id="celular"  name="celular" disabled>
						</div>

						<div class="form-group">
							<Label>Correo Electrónico</Label>
							<input type="text" class="form-control" placeholder="Correo Electronico"  id="correo" name="correo" disabled>
						</div>
						<div class="form-group">
							<Label>Dirección</Label>
							<input type="text" class="form-control" placeholder="Dirección"  id="TxtDireccion"  name="TxtDireccion" disabled>
						</div>
						<div class="form-group">
							<label>Frg:</label>
							<select id="cmbFrgs" name="cmbFrgs" disabled  class="form-control">
								<option value="0">Seleccione</option>
								<?php 
									foreach ($frg as $key) {
										echo "<option value='".$key->G729_ConsInte__b."'>".utf8_encode($key->Frg)."</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Firma de abogado</label>
							<select id="cambFirmas" name="cambFirmas" disabled  class="form-control">
								<option value="0">Seleccione</option>
								<?php 
									foreach ($firmas as $key) {
										echo "<option value='".$key->G728_ConsInte__b."'>".utf8_encode($key->nombres)."</option>";
									}
								?>
							</select>
						</div>

					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Abogados</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Nombre</th>
										<th style="text-align:center;">Cédula</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($abogados as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->Nombre).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.$key->cedula.'</td>
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
	                "sPaginationType": "simple",
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
			$("#cedula").prop('disabled', false);
			$("#nombre").prop('disabled', false);
			$("#celular").prop('disabled', false);
			$("#correo").prop('disabled', false);
			$("#cmbFrgs").prop('disabled', false);
			$("#TxtDireccion").prop('disabled', false);
			$("#txtTelefono").prop('disabled', false);
			$("#cambFirmas").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#cedula").prop('disabled', false);
			$("#nombre").prop('disabled', false);
			$("#celular").prop('disabled', false);
			$("#correo").prop('disabled', false);
			$("#cmbFrgs").prop('disabled', false);
			$("#cambFirmas").prop('disabled', false);
			$("#TxtDireccion").prop('disabled', false);
			$("#txtTelefono").prop('disabled', false);



			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
			$("#delete").attr('disabled', true);
		});

		$("#cancel").click(function(){
			$("#cedula").prop('disabled', true);
			$("#nombre").prop('disabled', true);
			$("#celular").prop('disabled', true);
			$("#correo").prop('disabled', true);
			$("#cmbFrgs").prop('disabled', true);
			$("#cambFirmas").prop('disabled', true);

			$("#TxtDireccion").prop('disabled', true);
			$("#txtTelefono").prop('disabled', true);

			$("#cedula").val("");
			$("#celular").val("");
			$("#nombre").val("");	
			$("#correo").val("");
			$("#delete").attr('disabled', true);


			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#Save").attr('disabled', true);
			$("#SMLV").val('');
			$("#edit").attr('disabled', true);
		});

		

		$("#delete").click(function(){
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
		    	if (e) {
	         	 	$.ajax({
		            	url: '<?php echo base_url();?>auxiliar/eliminarDatos',  
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
			            	url: '<?php echo base_url();?>auxiliar/guardarAbogads',  
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
		$("#cambFirmas option").filter(function() {
			    //may want to use $.trim in here
		    return $(this).val() == 0; 
		}).prop('selected', true);
		$("#cmbFrgs option").filter(function() {
			    //may want to use $.trim in here
		    return $(this).val() == 0; 
		}).prop('selected', true);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosAbodado/'+varid, {format: "json"}, function(data) { 
			

			$("#cmbFrgs option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].frg; 
			}).prop('selected', true);

			$("#cambFirmas option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].firma; 
			}).prop('selected', true);


			
			$("#cedula").val(data[0].cedula);
			$("#celular").val(data[0].celular);
			$("#nombre").val(data[0].nombre);	
			$("#correo").val(data[0].correo);
			$("#const_int_").val(data[0].id);

			$("#txtTelefono").val(data[0].telefono);
			$("#TxtDireccion").val(data[0].direccion);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);
			$("#cancel").attr('disabled', false);
		});
	}
</script>
