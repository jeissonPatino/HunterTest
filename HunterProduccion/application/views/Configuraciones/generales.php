<section class="content-header">
    <h1>
        CONFIGURACIÓN SALARIO
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Configuración Salario</li>
    </ol>
</section>

<section class="content">
	<div class="box">
        <div class="box-body">
                  
			<a class="btn btn-app" id="agregar">
				<i class="fa fa-plus"></i> Agregar
			</a>
			<a class="btn btn-app" id="edit">
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
			<h3 class="box-title">Configuración Salario</h3>
		</div>
		<div class="box-body">
			<div class="row-fuid">
				<div class="col-md-6">
					<div class="input-group">
						<input type="hidden" id="const_int_" name="id" value="0">
						<span class="input-group-addon">Salario MLV</span>
						<input type="text" class="form-control numerosSolos" placeholder="SMLV"  id="SMLV"disabled>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Registros</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Salario Mínimo Actual</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($minimo as $key) {
											echo '<tr><td class="tdMinimo" id="jodace" codigo="'.$key->G758_C17367.'" iddeesta="'.$key->G758_ConsInte__b.'">$ '.number_format($key->G758_C17367).'</td></tr>';
										}
									?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			<div class="row-fluid">
				<div class="col-md-12">
					<p>Para editar un registro, usted puede seleccionarlo de la tabla y cambiar su valor o utilizar el botón editar.</p>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

<script type="text/javascript">
	$(function(){
		$("#agregar").click(function(){
			$("#SMLV").prop('disabled', false);
			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			
		});

		$("#edit").click(function(){
			$("#SMLV").prop('disabled', false);
			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
			$("#delete").attr('disabled', true);
		});

		$("#cancel").click(function(){
			$("#SMLV").prop('disabled', true);
			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#Save").attr('disabled', true);
			$("#SMLV").val('');
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', true);
		});

		$("#delete").click(function(){
			//alert($("#const_int_").val());
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
			            	url: '<?php echo base_url();?>configuraciones/eliminardatos',  
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
			if($("#SMLV").val().length < 1 ){
				alert("Es necesario escribir un valor para el salario minimo");
				$("#SMLV").focus();
			}else{
				alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
			    	if (e) {
	           
						$.ajax({
							url     : '<?php echo base_url();?>configuraciones/guardarDatos',
							type    : 'POST',
							data    : { minimo: $("#SMLV").val() , id: $("#const_int_").val()},
							success : function(data){
								if(data == '1'){
									alertify.success('Datos ingresados correctamente');
									window.location.reload();
								}
							}
						});
					}else{

					}
				});
			}
		});

		$(".tdMinimo").click(function(){
			$("#SMLV").val($(this).attr('codigo'));
			$("#const_int_").val($(this).attr('iddeesta'));
			$("#cancel").attr('disabled', true);
			$("#Save").attr('disabled', true);
			$("#agregar").attr('disabled', true);
			$("#delete").attr('disabled', false);
		});
	});
</script>
