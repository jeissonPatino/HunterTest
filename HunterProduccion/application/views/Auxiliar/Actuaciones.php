<section class="content-header">
    <h1>
        Actuaciones
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Actuaciones</li>
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
							<Label >Tipo de Proceso</Label>
							<select id="selProcesos" name ="selProcesos" class="form-control" disabled>
								<option value="0">Tipo de proceso</option>
								<?php 
									foreach ($procesos as $key) {
										echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<Label>Descripción Etapa</Label>
							<select id="selEtapas" name="selEtapas" class="form-control" disabled>
								<option value="0">Etapas</option>
								
							</select>
						</div>

						
						<div class="form-group">
							<Label>Código Etapa</Label>
							<input type="text" class="form-control" placeholder="Código Etapa"  id="codigoEtapas"  name="celular" disabled>
						</div>
						
						

						<div class="form-group">
							<Label>Código actuación</Label>
							<input type="text" class="form-control" placeholder="Código actuación"  id="celular"  name="celular" disabled>
						</div>

						<div class="form-group">
							<Label>Descripción actuación</Label>
							<input type="text" class="form-control" placeholder="Descripción actuación"  id="correo" name="correo" disabled>
						</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Actuaciones</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Descripción de la actuación</th>
										<th style="text-align:center;">Código de la actuación</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($Auxiliar as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->Descripcion_actuacion).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.$key->Codigo_actuacion.'</td>
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
			$("#selProcesos").prop('disabled', false);
			$("#selEtapas").prop('disabled', false);
			$("#celular").prop('disabled', false);
			$("#correo").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#selProcesos").prop('disabled', false);
			$("#selEtapas").prop('disabled', false);
			$("#celular").prop('disabled', false);
			$("#correo").prop('disabled', false);
			$("#delete").attr('disabled', true);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#selProcesos").prop('disabled', true);
			$("#selEtapas").prop('disabled', true);
			$("#celular").prop('disabled', true);
			$("#correo").prop('disabled', true);


			$("#selProcesos").val(0);
			$("#selEtapas").val(0);
			$("#celular").val(" ");
			$("#correo").val(" ");
			$("#const_int_").val(0);
			$("#codigoEtapas").val("");


			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			$("#Save").attr('disabled', true);
			$("#SMLV").val('');
		});

		

		$("#delete").click(function(){
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
			            	url: '<?php echo base_url();?>auxiliar/eliminarActuaciones',  
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

		$("#celular").keypress(function(e){
			if(e.keyCode == 13)
		    {
		        $.ajax({
	            	url: '<?php echo base_url();?>auxiliar/validarCodigo/'+ $(this).val() +"/"+ $("#selEtapas").val(),  
	            	type: 'POST',
		            success: function(data){
		            	if(data == '1'){
		            		alertify.success('Este codigo ya esta registrado, para esta estapa');
		            		$("#celular").val("");
		            	}
		            },
		            //si ha ocurrido un error
		            error: function(){
		                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
		            }
		        });
		    }	
		 	
		});


		$("#celular").blur(function(){
				
		 	$.ajax({
            	url: '<?php echo base_url();?>auxiliar/validarCodigo/'+ $(this).val() +"/"+ $("#selEtapas").val(),  
            	type: 'POST',
	            success: function(data){
	            	if(data == '1'){
	            		alertify.success('Este codigo ya esta registrado, para esta estapa');
	            		$("#celular").val("");
	            	}
	            },
	            //si ha ocurrido un error
	            error: function(){
	                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
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
			            	url: '<?php echo base_url();?>auxiliar/guardarActuaciones',  
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

	$("#selProcesos").change(function(){
		
		$.getJSON('<?php echo base_url();?>auxiliar/getFiltrosComboEtapas/'+$(this).val(), {format: "json"}, function(data) { 
			var etapa = '';
			$.each(data, function(i, item) {
				etapa += '<option value="'+ item.id +'" codigo="'+ item.codigo + '">'+ item.descripcion +'</option>';
			});
			$("#selEtapas").html(etapa);

			$("#selEtapas").change(function(){
				$("#codigoEtapas ").val($("#selEtapas option:selected").attr('codigo'));
			});

		});
	});


	function getdatos(varid){

		$("#selProcesos").prop('disabled', true);
		$("#selEtapas").prop('disabled', true);
		$("#celular").prop('disabled', true);
		$("#correo").prop('disabled', true);

		$("#selProcesos").val(0);
		$("#selEtapas").val(0);
		$("#celular").val(" ");
		$("#correo").val(" ");
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosActuaciones/'+varid, {format: "json"}, function(data) { 

			//$("#selProcesos").val(data[0].Tipo_de_proceso);

			$("#selProcesos option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).text() == data[0].Tipo_de_proceso; 
			}).prop('selected', true);

			$.getJSON('<?php echo base_url();?>auxiliar/getFiltrosComboEtapas/'+ $("#selProcesos").val(), {format: "json"}, function(data) { 
				var etapa = '';
				$.each(data, function(i, item) {
					etapa += '<option value="'+ item.id +'"  codigo="'+ item.codigo + '">'+ item.descripcion +'</option>';
				});
				$("#selEtapas").html(etapa);
			});

			$("#selEtapas option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).text() == data[0].Etapa; 
			}).prop('selected', true);

			$("#codigoEtapas").val(data[0].codigo);

			$("#celular").val(data[0].Codigo_actuacion );
			//$("#selEtapas").val(data[0].Etapa);	
			$("#correo").val(data[0].Descripcion_actuacion);
			$("#const_int_").val(data[0].id);
			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);

			$("#cancel").attr('disabled', true);
			$("#Save").attr('disabled', true);
		});
	}
</script>
