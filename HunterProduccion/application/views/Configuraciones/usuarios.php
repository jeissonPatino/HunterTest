<section class="content-header">
    <h1>
        Usuarios
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Usuarios</li>
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
			<h3 class="box-title">Usuarios</h3>
		</div>
		<div class="box-body">
			<div class="row-fuid">
				<div class="col-md-4">
					<form id="FrmAbogados" method="post">
						<input type="hidden" id="const_int_" name="id" value="0">
						
						<div class="form-group">
							<Label>Nombre</Label>
							<input type="text" class="form-control" placeholder="Nombre"  id="txtNombre" name="txtNombre" required disabled>
						</div>
						<div class="form-group">
							<Label>Cédula</Label>
							<input type="text" class="form-control" placeholder="Cédula"  id="txtIdentifiaccaion" name="txtIdentifiaccaion" disabled>
						</div>
						<div class="form-group">
							<Label>Cargo</Label>
							<select id="selCargo" name="selCargo" class="form-control" disabled>
								<option value="0">Seleccione</option>
								<option value="ABOGADO">ABOGADO</option>
								<option value="FNG">FNG</option>
								<option value="FRG">FRG</option>
								<option value="GESTOR">GESTOR</option>
							</select>
						</div>
						<div class="form-group">
							<Label>FRG</Label>
							<select id="selFrg" name="selFrg" class="form-control" disabled>
								<option value="0">Seleccione</option>
								<?php 
									foreach ($frgs as $key) {
										echo '<option value="'.$key->G729_ConsInte__b.'">'.utf8_encode($key->Frg).'</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<Label>Usuario</Label>
							<input type="text" class="form-control" placeholder="Usuario"  id="txtUsuario" name="txtUsuario" required disabled>
						</div>
						<div class="form-group">
							<Label>Contraseña</Label>
							<input type="password" class="form-control" placeholder="Contraseña"  id="txPassword" name="txPassword" required disabled>
						</div>
						<div class="form-group">
							<Label>Repetir Contraseña</Label>
							<input type="password" class="form-control" placeholder="Repetir Contraseña"  id="txPasswordR" name="txPasswordR" required disabled>
						</div>
						<h3 class="box-title">Permisos</h3>
						<div class="box">
							<div class="box-header">
								
								<div class="box-tools">
								</div>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Asignación</h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="abogados" disabled value="1">
														Abogados
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="gestores" disabled value="1">
														Gestores
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Configuración</h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="abogadosC" disabled value="1">
														Abogados
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="acuerdos" disabled value="1">
														Acuerdos de pago
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="salario" disabled value="1">
														Salario
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="etapas" disabled value="1">
														Etapas
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="gastos" disabled value="1">
														Gastos Judiciales
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="subgestiones" disabled value="1">
														Subgestiones
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="cargar_fecha_terminacion_permisos_" disabled value="1">
														Cargar Fecha de Envío Terminación Proceso
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="Eliminar_Facturas_permisos_" disabled value="1">
														Eliminar Facturas
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="GestionarDatosClientes" disabled value="1">
														Gestionar Datos Clientes
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="EliminarGestores_EliminarAbogados" disabled value="1">
														Eliminar Gestores y Abogados
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="Logeliminar_Datos" disabled value="1">
														Log Eliminación
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="actuaciones" disabled value="1">
														Actuaciones
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="ciudades" disabled value="1">
														Ciudades
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="despachos" disabled value="1">
														Despachos
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="facturas" disabled value="1">
														Facturas
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="frg" disabled value="1">
														FRG
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="usuarios" disabled value="1">
														Usuarios
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="obligaciones" disabled value="1">
														Eliminar Obligaciones
													</label>
												</div>


												<div class="checkbox">
													<label>
														<input type="checkbox" name="firmas_abogados_permiso_" disabled value="1">
														Firmas de abogados
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="configurar_valores_conceptos_permisos_" disabled value="1">
														Configurar valores por concepto
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="cargar_devolucion_subrogaciones_permisos_" disabled value="1">
														Cargar Devolución Subrogaciones
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="cargar_envio_subrogaciones_permisos_" disabled value="1">
														Cargar Envío Subrogaciones
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="Exportar_datos_adicionales_permisos_" disabled value="1">
														Exportar datos adicionales
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="Eliminar_Gestiones_judiciales_permisos_" disabled value="1">
														Eliminar Gestiones Judiciales/Extrajudicial
													</label>
												</div>
												

											</div>
										</div>
									</div>
								</div>


								<div class="box">
									<div class="box-header">
										<h3 class="box-title">APLICACIÓN FACTURA</h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="subrogacion_permiso_" disabled value="1">
														Subrogaciones
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="Sentencia_irrecuperable_permiso_" disabled value="1">
														Sentencia irrecuperable
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="cisa_permiso_" disabled value="1">
														CISA
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="gastos_judiciales_permiso_" disabled value="1">
														Gastos judiciales
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Gestión cartera</h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="carteraextrajudicial" disabled value="1">
														Gestión Extrajudicial
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="carteraexfuncionarios" disabled value="1">
														Cartera Exfuncionarios
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="carterajudicial" disabled value="1">
														Gestión Judicial
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Históricos</h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="historicoextrajudicial" disabled value="1">
														Gestión Extrajudicial
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="checkbox" name="historicomedidascautelares" disabled value="1">
														Medidas Cautelares
													</label>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="historicojudicial" disabled value="1">
														Gestión Judicial
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="box">
									<div class="box-header">
										<h3 class="box-title">Reportes</h3>
										<div class="box-tools">
										</div>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_1" disabled value="1">
														Asignación de abogados
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_2" disabled value="1">
														Gestión Extrajudicial Mensual
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_3" disabled value="1">
														Subrogaciones efectivas
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_4" disabled value="1">
														Soporte CISA
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_5" disabled value="1">
														Radicación memoriales de subrogación
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_6" disabled value="1">
														Gestión judicial
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_7" disabled value="1">
														Reporte de medidas cautelares prácticadas
													</label>
												</div>
												
											</div>
											<div class="col-lg-6">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="reporte_8" disabled value="1">
														Reporte de medidas cautelares efectivas
													</label>
												</div>
												
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>
					</form>


				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Registros</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tablaUsuarios">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Nombres</th>
										<th>Identificación</th>
										<th>Cargo</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">

				</div>
				<div class="col-md-4">

				</div>
				<div class="col-md-4">

				</div>
			</div>
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

<script type="text/javascript">
	 var validoContrasea = 0;
	$(function(){

		$("#tablaUsuarios").DataTable({
			"aaData": <?php echo $usuarios; ?>,
			"aoColumns": [
				{ mData: "codigo" },
				{ mData: "nombres" },
				{ mData: "identificacion" },
				{ mData: "cargo" }
			],
		 	"lengthChange": false,
			"bJQueryUI": true,
			"bProcessing": true,
			"bSort": true,
		 	"aaSorting":[[0,"asc"]],
			"bSortClasses": false,
			"bDeferRender": true,
			"sPaginationType": "simple",
			"autoWidth": false,
			"oLanguage": {
				"sLengthMenu": "_MENU_.",
				"sZeroRecords": "No hay registros",
				"sInfo": "_START_ a _END_ de _TOTAL_ registros",
				"sInfoEmpty": "0 a 0 de 0 registros",
				"sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				"sSearch": "Buscar",
				"oPaginate": {
					"sNext": ">>",
					"sPrevious": "<<"
				}
				
			},
			"iDisplayLength": 10,
			"aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]],
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				var id = aData.id;
				$(nRow).attr("codigo",id);
				$(nRow).attr("class",'trobligacion');
				
				return nRow;
			   
			},
			"fnDrawCallback": function (oSettings, json) {
			   //Aqui va el comando para activar los otros botones
			  
				$(".trobligacion").dblclick(function(){
				
               		getdatosAqui($(this).attr('codigo'));
                });
			   
			}
	    });


		$("#agregar").click(function(){
			validoContrasea = 0;

			$("#txtUsuario").prop('disabled', false);
			$("#txtNombre").prop('disabled', false);
			$("#txtIdentifiaccaion").prop('disabled', false);
			$("#selCargo").prop('disabled', false);
			$("#txPassword").prop('disabled', false);
			$("#txPasswordR").prop('disabled', false);

			$('input[name=abogados]').prop('disabled', false);
			$('input[name=gestores]').prop('disabled', false);
			$('input[name=abogadosC]').prop('disabled', false);
			$('input[name=actuaciones]').prop('disabled', false);
			$('input[name=acuerdos]').prop('disabled', false);
			$('input[name=ciudades]').prop('disabled', false);
			$('input[name=salario]').prop('disabled', false);
			$('input[name=despachos]').prop('disabled', false);
			$('input[name=etapas]').prop('disabled', false);
			$('input[name=facturas]').prop('disabled', false);
			$('input[name=gastos]').prop('disabled', false);
			$('input[name=obligaciones]').prop('disabled', false);

			$('input[name=frg]').prop('disabled', false);
			$('input[name=subgestiones]').prop('disabled', false);
			$('input[name=usuarios]').prop('disabled', false);
			$('input[name=carteraextrajudicial]').prop('disabled', false);
			$('input[name=carterajudicial]').prop('disabled', false);
			$('input[name=carteraexfuncionarios]').prop('disabled', false);
			$('input[name=historicoextrajudicial]').prop('disabled', false);
			$('input[name=historicojudicial]').prop('disabled', false);
			$('input[name=historicomedidascautelares]').prop('disabled', false);

			$('input[name=reporte_1]').prop('disabled', false);
			$('input[name=reporte_2]').prop('disabled', false);
			$('input[name=reporte_3]').prop('disabled', false);
			$('input[name=reporte_4]').prop('disabled', false);
			$('input[name=reporte_5]').prop('disabled', false);
			$('input[name=reporte_6]').prop('disabled', false);
			$('input[name=reporte_7]').prop('disabled', false);
			$('input[name=reporte_8]').prop('disabled', false);


			$('input[name=subrogacion_permiso_]').prop('disabled', false);
			$('input[name=Sentencia_irrecuperable_permiso_]').prop('disabled', false);
			$('input[name=cisa_permiso_]').prop('disabled', false);
			$('input[name=gastos_judiciales_permiso_]').prop('disabled', false);

			$('input[name=cargar_fecha_terminacion_permisos_]').prop('disabled', false);
			$('input[name=Eliminar_Facturas_permisos_]').prop('disabled', false);
			$('input[name=GestionarDatosClientes]').prop('disabled', false); 

			$('input[name=EliminarGestores_EliminarAbogados]').prop('disabled', false);
			
			$('input[name=Logeliminar_Datos]').prop('disabled', false);

			$('input[name=firmas_abogados_permiso_]').prop('disabled', false);
			$('input[name=configurar_valores_conceptos_permisos_]').prop('disabled', false);
			$('input[name=cargar_devolucion_subrogaciones_permisos_]').prop('disabled', false);
			$('input[name=cargar_envio_subrogaciones_permisos_]').prop('disabled', false);


			$('input[name=Exportar_datos_adicionales_permisos_]').prop('disabled', false);
			$('input[name=Eliminar_Gestiones_judiciales_permisos_]').prop('disabled', false);


			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			
		});

		$("#edit").click(function(){
			validoContrasea = 1;

			$("#txtUsuario").prop('disabled', false);
			$("#txtNombre").prop('disabled', false);
			$("#txtIdentifiaccaion").prop('disabled', false);
			$("#selCargo").prop('disabled', false);
			$("#txPassword").prop('disabled', false);
			$("#txPasswordR").prop('disabled', false);

			
			if($("#selCargo").val() == 'FRG'){
				$("#selFrg").prop('disabled', false);
			}else{
				$("#selFrg").prop('disabled', true);	
			}
			

			$('input[name=abogados]').prop('disabled', false);
			$('input[name=gestores]').prop('disabled', false);
			$('input[name=abogadosC]').prop('disabled', false);
			$('input[name=actuaciones]').prop('disabled', false);
			$('input[name=acuerdos]').prop('disabled', false);
			$('input[name=ciudades]').prop('disabled', false);
			$('input[name=salario]').prop('disabled', false);
			$('input[name=despachos]').prop('disabled', false);
			$('input[name=etapas]').prop('disabled', false);
			$('input[name=facturas]').prop('disabled', false);
			$('input[name=gastos]').prop('disabled', false);
			$('input[name=frg]').prop('disabled', false);
			$('input[name=obligaciones]').prop('disabled', false);

			$('input[name=subgestiones]').prop('disabled', false);
			$('input[name=usuarios]').prop('disabled', false);
			$('input[name=carteraextrajudicial]').prop('disabled', false);
			$('input[name=carterajudicial]').prop('disabled', false);
			$('input[name=carteraexfuncionarios]').prop('disabled', false);
			$('input[name=historicoextrajudicial]').prop('disabled', false);
			$('input[name=historicojudicial]').prop('disabled', false);
			$('input[name=historicomedidascautelares]').prop('disabled', false);
			
			$('input[name=reporte_1]').prop('disabled', false);
			$('input[name=reporte_2]').prop('disabled', false);
			$('input[name=reporte_3]').prop('disabled', false);
			$('input[name=reporte_4]').prop('disabled', false);
			$('input[name=reporte_5]').prop('disabled', false);
			$('input[name=reporte_6]').prop('disabled', false);
			$('input[name=reporte_7]').prop('disabled', false);
			$('input[name=reporte_8]').prop('disabled', false);

			$('input[name=cargar_fecha_terminacion_permisos_]').prop('disabled', false);
			$('input[name=Eliminar_Facturas_permisos_]').prop('disabled', false);
			$('input[name=GestionarDatosClientes]').prop('disabled', false);


			$('input[name=EliminarGestores_EliminarAbogados]').prop('disabled', false);

			$('input[name=Logeliminar_Datos]').prop('disabled', false);
			
			$('input[name=subrogacion_permiso_]').prop('disabled', false);
			$('input[name=Sentencia_irrecuperable_permiso_]').prop('disabled', false);
			$('input[name=cisa_permiso_]').prop('disabled', false);
			$('input[name=gastos_judiciales_permiso_]').prop('disabled', false);

			$('input[name=firmas_abogados_permiso_]').prop('disabled', false);
			$('input[name=configurar_valores_conceptos_permisos_]').prop('disabled', false);
			$('input[name=cargar_devolucion_subrogaciones_permisos_]').prop('disabled', false);
			$('input[name=cargar_envio_subrogaciones_permisos_]').prop('disabled', false);

			$('input[name=Exportar_datos_adicionales_permisos_]').prop('disabled', false);
			$('input[name=Eliminar_Gestiones_judiciales_permisos_]').prop('disabled', false);


			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
			$("#delete").attr('disabled', true);
		});

		$("#cancel").click(function(){
			
			validoContrasea = 0;

			$("#txtUsuario").prop('disabled', true);
			$("#txtNombre").prop('disabled', true);
			$("#txtIdentifiaccaion").prop('disabled', true);
			$("#selCargo").prop('disabled', true);
			$("#txPassword").prop('disabled', true);
			$("#txPasswordR").prop('disabled', true);
			$("#selFrg").prop('disabled', true);
			$('input[name=abogados]').prop('disabled', true);
			$('input[name=gestores]').prop('disabled', true);
			$('input[name=abogadosC]').prop('disabled', true);
			$('input[name=actuaciones]').prop('disabled', true);
			$('input[name=acuerdos]').prop('disabled', true);
			$('input[name=ciudades]').prop('disabled', true);
			$('input[name=salario]').prop('disabled', true);
			$('input[name=despachos]').prop('disabled', true);
			$('input[name=etapas]').prop('disabled', true);
			$('input[name=facturas]').prop('disabled', true);
			$('input[name=gastos]').prop('disabled', true);
			$('input[name=frg]').prop('disabled', true);
			$('input[name=obligaciones]').prop('disabled', true);
			$('input[name=subgestiones]').prop('disabled', true);
			$('input[name=usuarios]').prop('disabled', true);
			$('input[name=carteraextrajudicial]').prop('disabled', true);
			$('input[name=carterajudicial]').prop('disabled', true);
			$('input[name=carteraexfuncionarios]').prop('disabled', true);
			$('input[name=historicoextrajudicial]').prop('disabled', true);
			$('input[name=historicojudicial]').prop('disabled', true);
			$('input[name=historicomedidascautelares]').prop('disabled', true);

			$('input[name=cargar_fecha_terminacion_permisos_]').prop('disabled', true);
			$('input[name=Eliminar_Facturas_permisos_]').prop('disabled', true);
			$('input[name=GestionarDatosClientes]').prop('disabled', true);


			$('input[name=EliminarGestores_EliminarAbogados]').prop('disabled', true);

			$('input[name=Logeliminar_Datos]').prop('disabled', true);

			$('input[name=reporte_1]').prop('disabled', true);
			$('input[name=reporte_2]').prop('disabled', true);
			$('input[name=reporte_3]').prop('disabled', true);
			$('input[name=reporte_4]').prop('disabled', true);
			$('input[name=reporte_5]').prop('disabled', true);
			$('input[name=reporte_6]').prop('disabled', true);
			$('input[name=reporte_7]').prop('disabled', true);
			$('input[name=reporte_8]').prop('disabled', true);

			$('input[name=subrogacion_permiso_]').prop('disabled', true);
			$('input[name=Sentencia_irrecuperable_permiso_]').prop('disabled', true);
			$('input[name=cisa_permiso_]').prop('disabled', true);
			$('input[name=gastos_judiciales_permiso_]').prop('disabled', true);

			$('input[name=firmas_abogados_permiso_]').prop('disabled', true);
			$('input[name=configurar_valores_conceptos_permisos_]').prop('disabled', true);
			$('input[name=cargar_devolucion_subrogaciones_permisos_]').prop('disabled', true);
			$('input[name=cargar_envio_subrogaciones_permisos_]').prop('disabled', true);

			$('input[name=Exportar_datos_adicionales_permisos_]').prop('disabled', true);
			$('input[name=Eliminar_Gestiones_judiciales_permisos_]').prop('disabled', true);

			$("#txtUsuario").val('');
			$("#txtNombre").val('');
			$("#txtIdentifiaccaion").val('');
			$("#selCargo").val('');
			$("#txPassword").val('');
			$("#txPasswordR").val('');
			$("#selFrg").val('');

			$('input[name=abogados]').prop('checked', false);
			$('input[name=gestores]').prop('checked', false);
			$('input[name=abogadosC]').prop('checked', false);
			$('input[name=actuaciones]').prop('checked', false);
			$('input[name=acuerdos]').prop('checked', false);
			$('input[name=ciudades]').prop('checked', false);
			$('input[name=salario]').prop('checked', false);
			$('input[name=despachos]').prop('checked', false);
			$('input[name=etapas]').prop('checked', false);
			$('input[name=facturas]').prop('checked', false);
			$('input[name=gastos]').prop('checked', false);
			$('input[name=frg]').prop('checked', false);
			$('input[name=obligaciones]').prop('checked', false);

			$('input[name=subgestiones]').prop('checked', false);
			$('input[name=usuarios]').prop('checked', false);
			$('input[name=carteraextrajudicial]').prop('checked', false);
			$('input[name=carterajudicial]').prop('checked', false);
			$('input[name=carteraexfuncionarios]').prop('checked', false);
			$('input[name=historicoextrajudicial]').prop('checked', false);
			$('input[name=historicojudicial]').prop('checked', false);
			$('input[name=historicomedidascautelares]').prop('checked', false);

			$('input[name=reporte_1]').prop('checked', false);
			$('input[name=reporte_2]').prop('checked', false);
			$('input[name=reporte_3]').prop('checked', false);
			$('input[name=reporte_4]').prop('checked', false);
			$('input[name=reporte_5]').prop('checked', false);
			$('input[name=reporte_6]').prop('checked', false);
			$('input[name=reporte_7]').prop('checked', false);
			$('input[name=reporte_8]').prop('checked', false);

			$('input[name=subrogacion_permiso_]').prop('checked', false);

			$('input[name=Sentencia_irrecuperable_permiso_]').prop('checked', false);
			$('input[name=cisa_permiso_]').prop('checked', false);
			$('input[name=gastos_judiciales_permiso_]').prop('checked', false);

			$('input[name=firmas_abogados_permiso_]').prop('checked', false);
			$('input[name=configurar_valores_conceptos_permisos_]').prop('checked', false);
			$('input[name=cargar_devolucion_subrogaciones_permisos_]').prop('checked', false);
			if(selCargo == FRG){
				$('input[name=cargar_envio_subrogaciones_permisos_]').prop('disabled', true);
			}
			if(selCargo == FNG){
				$('input[name=cargar_devolucion_subrogaciones_permisos_]').prop('disabled', true);
			}
			$('input[name=cargar_envio_subrogaciones_permisos_]').prop('checked', false);

			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#Save").attr('disabled', true);
			$("#SMLV").val('');
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#delete").click(function(){
			//alert($("#const_int_").val());
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
			            	url: '<?php echo base_url();?>configuraciones/eliminarUsuario',  
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
			
			if(validoContrasea = 0){
				if($("#txPassword").val().length < 1 ){
					alert("Es necesario escribir la Contraseña");
					$("#txPassword").focus();
				}else if($("#txPasswordR").val().length < 1 ){
					alert("Es necesario repetir las contraseñas");
					$("#txPasswordR").focus();
				}else if($("#txPasswordR").val() != $("#txPassword").val()){
					alert("Las contraseñas no coinciden!!");
					$("#txPasswordR").val('');
					$("#txPasswordR").focus();
				}else{
					guardarDatos();
				}	
			}else{
				if($("#txPassword").val().length > 0 ){
					if($("#txPasswordR").val().length < 1 ){
						alert("Es necesario repetir las contraseñas");
						$("#txPasswordR").focus();
					}else if($("#txPasswordR").val() != $("#txPassword").val()){
						alert("Las contraseñas no coinciden!!");
						$("#txPasswordR").val('');
						$("#txPasswordR").focus();
					}else{
						guardarDatos();
					}	
				}else{
					guardarDatos();
				}
			}

			
		});

		$("#selCargo").change(function(){
			if($(this).val() == 'FRG'){
				$("#selFrg").prop('disabled', false);
			}else{
				$("#selFrg").prop('disabled', true);	
			}
		});
		
	});
	
	function guardarDatos(){
		if($("#txtNombre").val().length < 1 ){
			alert("Es necesario escribir el nombre");
				$("#txtNombre").focus();
		}else if($("#selCargo").val() == "0" ){
			alert("Es necesario elegir el cargo");
			$("#selCargo").focus();
		}else if($("#txtUsuario").val().length < 1 ){
			alert("Es necesario escribir el usuario");
			$("#txtUsuario").focus();
		}else{
			alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
		    	if (e) {
           			var formData = new FormData($("#FrmAbogados")[0]);
					$.ajax({
						url     : '<?php echo base_url();?>configuraciones/guardarusuario',
						type    : 'POST',
					 	data:  formData,
					 	processData: false,
						contentType: false,
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
	}
	
	function getdatosAqui(codigo){
		var varid = codigo;
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);
			$("#selFrg").val(0);
			$.getJSON('<?php echo base_url();?>configuraciones/getDatosUsuario/'+varid, {format: "json"}, function(data) { 
				

				$("#const_int_").val(varid);
				
                $("#selCargo option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].cargo; 
				}).prop('selected', true);
                
                
                $("#selFrg option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].USUARI_LlaveExte_b; 
				}).prop('selected', true);
                
               

				if(data[0].cargar_fecha_terminacion_permisos_ == '1'){
                	$('input[name=cargar_fecha_terminacion_permisos_]').attr('checked', true);
                }	
                if(data[0].Eliminar_Facturas_permisos_ == '1'){
                	$('input[name=Eliminar_Facturas_permisos_]').attr('checked', true);
                }

                if(data[0].GestionarDatosClientes == '1'){
                	$('input[name=GestionarDatosClientes]').attr('checked', true);
                }

                if(data[0].EliminarGestores == '1'){
                	$('input[name=EliminarGestores_EliminarAbogados]').attr('checked', true);
                }

                if(data[0].Logeliminacion == '1'){
                	$('input[name=Logeliminar_Datos]').attr('checked', true);
                }

                if(data[0].firmas_abogados_permiso_ == '1'){
                	$('input[name=firmas_abogados_permiso_]').attr('checked', true);
                }	
                if(data[0].configurar_valores_conceptos_permisos_ == '1'){
                	$('input[name=configurar_valores_conceptos_permisos_]').attr('checked', true);
                }
                if(data[0].cargar_devolucion_subrogaciones_permisos_ == '1'){
                	$('input[name=cargar_devolucion_subrogaciones_permisos_]').attr('checked', true);
                }
                if(data[0].cargar_envio_subrogaciones_permisos_ == '1'){
                	$('input[name=cargar_envio_subrogaciones_permisos_]').attr('checked', true);
                }

                

                if(data[0].USUARI_asignacion_abogados_p == '1'){
                	$('input[name=abogados]').attr('checked', true);
                }	
                if(data[0].USUARI_asignacion_gestores_p == '1'){
                	$('input[name=gestores]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_abogados_p == '1'){
                	$('input[name=abogadosC]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_actuaciones_p == '1'){
                	$('input[name=actuaciones]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_acuerdos_p == '1'){
                	$('input[name=acuerdos]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_ciudades_p == '1'){
                	$('input[name=ciudades]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_salario_p == '1'){
                	$('input[name=salario]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_despachos_p == '1'){
                	$('input[name=despachos]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_etapas_p == '1'){
                	$('input[name=etapas]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_facturas_p == '1'){
                	$('input[name=facturas]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_gastos_p == '1'){
                	$('input[name=gastos]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_FRG_p == '1'){
                	$('input[name=frg]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_subgestiones_p == '1'){
                	$('input[name=subgestiones]').attr('checked', true);
                }
                if(data[0].USUARI_configuracion_usuarios_p == '1'){
                	$('input[name=usuarios]').attr('checked', true);
                }
                if(data[0].USUARI_gestion_extrajudicial_p == '1'){
                	$('input[name=carteraextrajudicial]').attr('checked', true);
                }
                if(data[0].USUARI_gestion_judicial_p == '1'){
                	$('input[name=carterajudicial]').attr('checked', true);
                }
                if(data[0].USUARI_gestion_exfuncionarios_p == '1'){
                	$('input[name=carteraexfuncionarios]').attr('checked', true);
                }
                if(data[0].USUARI_historico_extrajudicial_p == '1'){
                	$('input[name=historicoextrajudicial]').attr('checked', true);
                }
                if(data[0].USUARI_historico_judicial_p == '1'){
                	$('input[name=historicojudicial]').attr('checked', true);
                }
                if(data[0].USUARI_historico_medidas_p == '1'){
                	$('input[name=historicomedidascautelares]').attr('checked', true);
                }
               

                if(data[0].USUARI_configuracion_eliminarObligaciones_p == '1'){
                	$('input[name=obligaciones]').prop('checked', true);
                }


                if(data[0].Rep_asignacion_abogados_permiso_ == '1'){
                	$('input[name=reporte_1]').attr('checked', true);
                }
                if(data[0].Rep_gestion_judicial_mensual_permiso_ == '1'){
                	$('input[name=reporte_2]').attr('checked', true);
                }
                if(data[0].Rep_subrogaciones_efectivas_permiso_ == '1'){
                	$('input[name=reporte_3]').attr('checked', true);
                }
                if(data[0].Rep_soporte_cisa_permiso_ == '1'){
                	$('input[name=reporte_4]').attr('checked', true);
                }
                if(data[0].Rep_radicacion_memorial_permiso_ == '1'){
                	$('input[name=reporte_5]').attr('checked', true);
                }
                if(data[0].Rep_gestion_judicial_permiso_ == '1'){
                	$('input[name=reporte_6]').attr('checked', true);
                }
                if(data[0].Rep_reporte_medidas_cautelares_permiso_ == '1'){
                	$('input[name=reporte_7]').attr('checked', true);
                }
                if(data[0].Rep_medidas_cautelares_efectivas_permiso_ == '1'){
                	$('input[name=reporte_8]').attr('checked', true);
                }
                

                if(data[0].subrogacion_permiso_ == '1'){
                	$('input[name=subrogacion_permiso_]').attr('checked', true);
                }
                if(data[0].Sentencia_irrecuperable_permiso_ == '1'){
                	$('input[name=Sentencia_irrecuperable_permiso_]').attr('checked', true);
                }
                if(data[0].cisa_permiso_ == '1'){
                	$('input[name=cisa_permiso_]').attr('checked', true);
                }
                if(data[0].gastos_judiciales_permiso_ == '1'){
                	$('input[name=gastos_judiciales_permiso_]').attr('checked', true);
                }

                if(data[0].Exportar_datos_adicionales_permisos_ == '1'){
                	$('input[name=Exportar_datos_adicionales_permisos_]').attr('checked', true);
                }
                if(data[0].Eliminar_Gestiones_judiciales_permisos_ == '1'){
                	$('input[name=Eliminar_Gestiones_judiciales_permisos_]').attr('checked', true);
                }


               

                $("#txtUsuario").val(data[0].codigo);
				$("#txtNombre").val(data[0].nombres);
				$("#txtIdentifiaccaion").val(data[0].identificacion);
				
			
				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', false);
				$("#delete").attr('disabled', false);

				$("#cancel").attr('disabled', true);
				$("#Save").attr('disabled', true);
			});
	}
</script>
