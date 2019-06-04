<section class="content-header">
    <h1>
       SUBGESTIONES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Subgestiones</li>
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
							<Label >Estado del cliente</Label>
							<select id="selResultado" name ="selResultado" class="form-control" disabled>
								<option value="0">Resultado de la Comunicación</option>
								<option value="1780">LOCALIZADO</option>
								<option value="1781">ILOCALIZADO</option>
							</select>
						</div>
						<div class="form-group">
							<Label>Gestión</Label>
							<select id="selgestiones" name ="selgestiones" class="form-control" disabled>
								<option value="0">Rol</option>
								<?php 
									foreach ($gestiones as $key) {
										echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
									}
								?>
							</select>
							
						</div>
						<div class="form-group">
							<Label>Subgestión</Label>
							<input type="text" class="form-control" placeholder="Subgestion"  id="etapa" name="etapa" required disabled>
						</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">SUBGESTIONES</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Estado del cliente</th>
										<th style="text-align:center;">Gestión</th>
										<th style="text-align:center;">Subgestión</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($subgestiones as $key) {
											echo '<tr style="cursor:pointer;">
											<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->comunicacion).'</td>
													<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->gestion).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->enunciado).'</td>
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
	                "sLengthMenu": "_MENU_ registros por pagina",
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
			$("#selgestiones").prop('disabled', false);
			
			$("#selResultado").prop('disabled', false);
			$("#etapa").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#selgestiones").prop('disabled', false);
			
			$("#selResultado").prop('disabled', false);
			$("#etapa").prop('disabled', false);
			$("#delete").attr('disabled', true);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#selgestiones").prop('disabled', true);
			
			$("#selResultado").prop('disabled', true);
			$("#etapa").prop('disabled', true);

			$("#selgestiones").val(0);
	
			$("#selgestiones").val(0);
			$("#etapa").val(" ");
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
		            	url: '<?php echo base_url();?>auxiliar/eliminarSubgestion',  
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
			var form = $("#FrmAbogados");
			if(form.valid()){
				alertify.confirm("¿Esta seguro de esta operación?", function (e) {
	    			if (e) {
			  			var formData = new FormData($("#FrmAbogados")[0]);
			          	$.ajax({
			            	url: '<?php echo base_url();?>auxiliar/guardarSubgestion',  
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
				    } else {
				        // user clicked "cancel"
			    	}
			   	});	
		  	}else{
		  		alertify.error('No deben haber campos vacios, por favor rellena el formulario!!');
		  	}	
		});
	});

	

	function getdatos(varid){

		$("#selgestiones").prop('disabled', true);
		
		$("#departamento").prop('disabled', true);
		$("#ciudad").prop('disabled', true);

		$("#selpaises").val(0);
		$("#selEtapas").val(0);
		$("#departamento").val(" ");
		$("#ciudad").val(" ");
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosSubgestion/'+varid, {format: "json"}, function(data) { 

			//$("#selpaises").val(data[0].Tipo_de_proceso);

			$("#selResultado option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].comn; 
			}).prop('selected', true);


			$("#selgestiones option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].gestion; 
			}).prop('selected', true);
		

			$("#etapa").val(data[0].subgestion);
			//$("#selEtapas").val(data[0].Etapa);	
			
			$("#const_int_").val(data[0].id);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', true);
		});
	}
</script>
