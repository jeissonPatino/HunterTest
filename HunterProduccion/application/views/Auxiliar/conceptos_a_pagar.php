<section class="content-header">
    <h1>
        
        CONCEPTOS Y VALORES A PAGAR
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Conceptos y valores a pagar</li>
    </ol>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-5">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">¿Cómo desea cargar los conceptos?</h3>
				</div>
		        <div class="box-body">
		    	 	<div class="row">
		    	 		<div class="col-sm-1">
		    	 			
		    	 		</div>
		    	 		<div class="col-sm-7">
		    	 			<label>
		                      	<input type="checkbox" name="optionsRadios" id="masivo" value="option1">
		                      		Cargue masivo por excel
		                    </label>
		    	 		</div>
		    	 		<div class="col-sm-4">
		    	 			<label>
		                      	<input type="checkbox" name="optionsRadios" id="unouno" value="option2">
		                  			Uno a uno
		                    </label>	
		    	 		</div>
		    	 	</div>
		    	</div><!-- /.box-body -->
		  	</div><!-- /.box -->


		  	<div class="box" id="cargueMasivo" style="display:none;">
				<div class="box-header with-border">
					<h3 class="box-title">Cargue masivo</h3>
				</div>
				<form class="form-horizontal" id="enviomasivo" >
					<div class="box-body">
		    	 	
		                <div class="form-group">
		                  	<label for="inputEmail3" class="col-sm-3 control-label">Seleccionar concepto</label>
		                  	<div class="col-sm-9">
		                    	<select id="cmbFiltrosMax" name="cmbFiltrosMax" class="form-control">
		                    		<option value="0">Seleccione</option>
		                          	<option value="AUX001">Subrogaciones</option>
					              	<option value="AUX002">Sentencia irrecuperable</option>
		                            <option value="AUX003">Bonificaciones CISA</option>
					              	<option value="AUX004">Honorarios CISA</option>
					              	<option value="AUX005">Gastos judiciales</option>
		                      	</select>
		                  	</div>
		                </div>
		                <div class="form-group">
		                  	<label for="inputPassword3" class="col-sm-3 control-label">Archivo a Subir</label>
		                  	<div class="col-sm-9">
		                    	<input type="file"  id="FilExcell" name="FilExcell"  class="form-control">
		                  	</div>
		            	</div>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Cancelar</button>
						<button type="button" id="gestoresAsignacionMavo" class="btn btn-primary">Guardar Datos</button>
					</div><!-- /.box-footer -->
				</form>
				<div class="row" id="mostrarPorcentaje" style="display:none;">
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
		  	</div><!-- /.box -->



		  	<div class="box" id="cargueunoauno" style="display:none;">
				<div class="box-header with-border">
					<h3 class="box-title">Cargue uno a uno</h3>
				</div>
				<form class="form-horizontal" id="ebvioSolo">
					<input type="hidden" name="id_subrogacione" id="id_subrogacione" value='0'/>
					<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Seleccionar concepto</label>
								<div class="col-sm-9">
									<select id="cmbFiltros" class="form-control">
										<option value="0">Seleccione</option>
										<option value="AUX001">Subrogaciones</option>
						              	<option value="AUX002">Sentencia irrecuperable</option>
			                            <option value="AUX003">Bonificaciones CISA</option>
						              	<option value="AUX004">Honorarios CISA</option>
						              	<option value="AUX005">Gastos judiciales</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Año</label>
								<div class="col-sm-9">
									<input type="text" id="txtAnho" class="form-control" placeholder="Año">
								</div>
							</div>
							
							<div class="form-group">
						    	<label for="inputPassword3" class="col-sm-3 control-label">Valor</label>
								<div class="col-sm-9">
									<input type="text" id="txtValor" class="form-control" placeholder="Valor">
								</div>
							</div>	
							<div class="form-group">
						    	<label for="inputPassword3" class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-9">
									<select id="selEstado" class="form-control">
										<option value="ACTIVO">ACTIVO</option>
										<option value="INACTIVO">INACTIVO</option>
									</select>
								</div>
							</div>			
					</div><!-- /.box-body -->
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Cancelar</button>
						<button type="button" id="botonSolo" class="btn btn-primary">Guardar Datos</button>
					</div><!-- /.box-footer -->
				</form>
		  	</div><!-- /.box -->

		</div>
		<div class="col-md-7">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">CONCEPTOS</h3>
					<div class="box-tools">
						
					</div>
				</div><!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered" id="tablaUsuarios">
						<thead>
							<tr>
								<th>Año</th>
								<th>Concepto</th>
								<th>Total a pagar</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($conceptos as $key){ 
									$valores = $key->vcp_total_pago;
									$valores = str_replace('.', '', $valores);
								?>
								<tr class="conceptos" concepto="<?php echo $key->vcp_id;?>">
									<td><?php echo $key->vcp_anho; ?> </td>
									<td><?php echo $key->concepto; ?></td>
									<td>$ <?php echo number_format($valores,0,',', '.'); ?></td>
									<td><?php echo $key->vcp_estado; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		
	</div>
</section>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">

	$(function () {
  		$("#masivo").click(function(){
  			 $("#cargueMasivo").show();
  			 $("#cargueunoauno").hide();
  				
  		});

  		$("#unouno").click(function(){
  			 $("#cargueMasivo").hide();
  			 $("#cargueunoauno").show()
  		});

		$(".conceptos").click(function(){
			$("#cargueMasivo").hide();
			$("#cargueunoauno").show();
			$.ajax({
				url  : '<?php  echo base_url();?>conceptos/getDatosByID/'+$(this).attr('concepto'),
				type : 'POST',
				dataType: 'json',
				success : function(data){
					//$("#cmbFiltros").val();
					$("#cmbFiltros option").filter(function() {
							//may want to use $.trim in here
						return $(this).val() == data.vcp_codigo; 
					}).prop('selected', true);
					$("#txtAnho").val(data.vcp_anho);
					$("#txtValor").val(data.vcp_total_pago);
					$("#selEstado option").filter(function() {
							//may want to use $.trim in here
						return $(this).val() == data.vcp_estado; 
					}).prop('selected', true);
					$("#id_subrogacione").val(data.vcp_id);
				}
			});
		});

  		$("#tablaUsuarios").DataTable({
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
	       	"aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]],
	       	"aaSorting":[[1,"asc"]],
	    });

      $("#botonSolo").click(function(){
         var validador = 0;
          if($("#cmbFiltros").val() == '0'){
              alertify.error('Debe seleccionar un concepto, para signarle los casos');
              validador = 1;
          }

          if($("#txtValor").val().length < 1){
              alertify.error('Debe escribir el valor');
              validador = 1;
          }

          if($("#txtAnho").val().length < 1){
              alertify.error('Debe escribir el Año');
              validador = 1;
          }


          if(validador == 0){
              alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                if (e) {
                    var otherForm = $("#ebvioSolo");
                    $.ajax({
                        url: '<?php echo base_url(); ?>Conceptos/guardarConceptos',  
                        type: 'POST',
                        data: { id_subrogacione : $("#id_subrogacione").val(), anho :  $("#txtAnho").val(), valor: $("#txtValor").val(), concepto : $("#cmbFiltros").val() , estado : $("#selEstado").val()},
                        success : function(data){
                            if(data == 1){
                                alertify.success("Registro guardado!");
                                otherForm[0].reset();
                                window.location.reload(true);
                            }
                        }
                    });
              } else {
                      // user clicked "cancel"
                  } 
              });
          }

      });

        $("#gestoresAsignacionMavo").click(function(){
         
          var validador = 0;
          if($("#cmbFiltrosMax").val() == '0'){
              alertify.error('Debe seleccionar un concepto');
              validador = 1;
          }

          if($("#FilExcell").val().length < 1){
              alertify.error('Debe seleccionar un Archivo, para cargar');
              validador = 1;
          }

          if(validador == 0){
                 alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                  if (e) {
                    var otherForm = $("#enviomasivo");
                    var formData = new FormData($("#enviomasivo")[0]);
                    $.ajax({
                        xhr: function()
                        {
                          var xhr = new window.XMLHttpRequest();

                          //Upload progress
                          xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                              var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                              //Do something with upload progress
                              // console.log(percentComplete);
                      
                              $("#progressbarComercial").attr('aria-valuenow', percentComplete);
                              $("#progressbarComercial").attr('style', "width: "+percentComplete+"%");
                              $("#progressbarComercial").html(percentComplete + '%');
                            }
                          }, false);

                          return xhr;
                        },
                        url: '<?php echo base_url(); ?>Conceptos/guardarConceptosExcel',  
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend : function() {
                            /*$.blockUI({ message: $("#containerPogresBar") });*/
                            $("#mostrarPorcentaje").show();
                            $("#progressbarComercial").addClass('progress-bar-striped');
                            $("#progressbarComercial").addClass('active');
                        },
                        //una vez finalizado correctamente
                        success: function(data){
                         
                            alertify.success("La cantidad  de registros son "+ data.registros +", guardados "+ data.total + ", " + data.fallaron + " no se pudieron guardar " );
                            otherForm[0].reset();
                            window.location.reload(true);
                        },
                        complete: function(){
                          
                          otherForm[0].reset();


                          $("#progressbarComercial").removeClass('progress-bar-striped');
                          $("#progressbarComercial").removeClass('active');
                          $("#progressbarComercial").attr('aria-valuenow', '0');
                          $("#progressbarComercial").attr('style', "width: 0%");
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
                            alertify.error('Ocurrio un error, intenta mas tarde');
                        }
                    });
                  } else {
                      // user clicked "cancel"
                  } 
              });
          }

      });

	});
</script>

