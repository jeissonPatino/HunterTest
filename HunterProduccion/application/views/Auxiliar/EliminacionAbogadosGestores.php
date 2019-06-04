<section class="content-header">
    <h1>
        configuracion - Gestionar Datos Clientes
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Gestionar Datos Clientes</li>
    </ol>
</section>

<section class="content">

	 <div class="box">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><a id="tab1" href="#DatosAbogados" data-toggle="tab">Eliminar Abogados</a></li>
                    <li><a id="tab2" href="#DatosGestores" data-toggle="tab">Eliminar Gestores</a></li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Este Se carga la depuracion de la informacion de los clientes -->  
                    <div class="box-body">
                        <div class="row-fuid">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="col">
                                     	<div class="col-md-12" id="DatosAbogados">
		                                	<div class="box-header">
		                                    	<div class="row">
		                                        	<div>
		                                            	<button class="btn btn-app"  id="delete" disabled>
															<i class="fa fa-trash"></i> Eliminar
														</button>
														<button class="btn btn-app" id="cancel" disabled>
															<i class="fa fa-close"></i> Cancelar
														</button>
		                                        	</div>
		                                    	</div>
		                                	</div>
		                               		<div class="box box-info">
		                                    	<div class="box-header with-border">
													<h3 class="box-title">Abogados</h3>

												</div>
												<div class="table" >
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
														</form>
													</div>
													<div class="col-md-8">
													 	<div class="box table-responsive no-padding">
		                                            		<table class="table table-hover table-bordered" id="TablaAbogados">
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
														</div>
													</div>
												</div>
											</div>
										</div>   
                                	</div><!-- /.box-body -->
                            	</div><!-- /.box-body -->
                        	</div>
                    	</div>
                	</div>
                    <div class="box-body">
                        <div class="row-fuid">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="col">
                                     	<div class="col-md-12" id="DatosGestores" style="display: none">
		                                	<div class="box-header">
		                                    	<div class="row">
		                                        	<div>
		                                            	<button class="btn btn-app"  id="delete1" disabled>
															<i class="fa fa-trash"></i> Eliminar
														</button>
														<button class="btn btn-app" id="cancel" disabled>
															<i class="fa fa-close"></i> Cancelar
														</button>
		                                        	</div>
		                                    	</div>
		                                	</div>
		                               		<div class="box box-info">
		                                    	<div class="box-header with-border">
													<h3 class="box-title">Gestores</h3>
												</div>
												<div class="table" >
													<div class="col-md-4">
														<form id="FrmAbogados" method="post">
															<input type="hidden" id="const_int_" name="id" value="0">
															<div class="form-group">
																<Label>Nombre</Label>
																<input type="text" class="form-control" placeholder="Nombre"  id="txtNombre1" name="txtNombre1" required disabled>
															</div>
															<div class="form-group">
																<Label>Cédula</Label>
																<input type="text" class="form-control" placeholder="Cédula"  id="txtIdentifiaccaion1" name="txtIdentifiaccaion1" disabled>
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
																	<select id="selFrg1" name="selFrg1" class="form-control" disabled>
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
																<input type="text" class="form-control" placeholder="Usuario"  id="txtUsuario1" name="txtUsuario1" required disabled>
															</div>
														</form>
													</div>
													<div class="col-md-8">
													 	<div class="box table-responsive no-padding">
		                                            		<table class="table table-hover table-bordered" id="TablaGestores">
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
														</div>
													</div>
												</div>
											</div>
										</div>   
                                	</div><!-- /.box-body -->
                            	</div><!-- /.box-body -->
                        	</div>
                    	</div>
                	</div>
            	</div>
        	</div>
    	</div>
	</div> 
</section>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">
	$(function () {

        $("#tab1").click(function(){
            $("#DatosAbogados").show();
            $("#DatosGestores").hide();

        });
        $("#tab2").click(function(){
        	$("#DatosAbogados").hide();
            $("#DatosGestores").show();
        });

        // Tabla datos de los abogados

        $("#TablaAbogados").DataTable({
            "aaData": <?php echo $AbogadosEliminar; ?>, 
            "aoColumns": [
                        { mData: "codigo" },
                        { mData: "nombres" },
                        { mData: "identificacion" },
                        { mData: "cargo" },
            ],
            "oLanguage": {
                      "sLengthMenu": "_MENU_ registros por página",
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

        // Tabla datos de los gestores

        $("#TablaGestores").DataTable({
            "aaData": <?php echo $GestoresEliminar; ?>, 
            "aoColumns": [
                        { mData: "codigo" },
                        { mData: "nombres" },
                        { mData: "identificacion" },
                        { mData: "cargo" },
            ],
            "oLanguage": {
                      "sLengthMenu": "_MENU_ registros por página",
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

        $("#delete").click(function(){
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

		$("#delete1").click(function(){
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


		function getdatosAqui(codigo){
		var varid = codigo;
			$("#delete").attr('disabled', false);
			$("#delete1").attr('disabled', false);
			$("#selFrg").val(0);
			$("#selFrg1").val(0);
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
                
                $("#selFrg1 option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].USUARI_LlaveExte_b; 
				}).prop('selected', true);

                $("#txtUsuario").val(data[0].codigo);
				$("#txtNombre").val(data[0].nombres);
				$("#txtIdentifiaccaion").val(data[0].identificacion);

				$("#txtUsuario1").val(data[0].codigo);
				$("#txtNombre1").val(data[0].nombres);
				$("#txtIdentifiaccaion1").val(data[0].identificacion);

		});
	}
});
</script>
