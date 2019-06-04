<section class="content-header">
    <h1>
        FRG - ASIGNACIÓN GESTORES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Asignacion - FRG gestores.</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">¿Qué tipo de asignación desea hacer?</h3>
		</div>
        <div class="box-body">
    	 	<div class="row">
    	 		<div class="col-sm-2">
    	 			
    	 		</div>
    	 		<div class="col-sm-4">
    	 			<label>
                      	<input type="radio" name="optionsRadios" id="masivo" value="option1">
                      		Cargue masivo por excel
                    </label>
    	 		</div>
    	 		<div class="col-sm-4">
    	 			<label>
                      	<input type="radio" name="optionsRadios" id="unouno" value="option2">
                  			Uno a uno
                    </label>	
    	 		</div>
    	 		<div class="col-sm-2">
    	 			
    	 		</div>
    	 	</div>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->


  	<div class="box" id="cargueMasivo" style="display:none;">
		<div class="box-header with-border">
			<h3 class="box-title">Asignación por cargue masivo</h3>
		</div>
		<form class="form-horizontal" id="enviomasivo" >
			<div class="box-body">
    	 	
                <div class="form-group">
                  	<label for="inputEmail3" class="col-sm-2 control-label">Seleccionar Filtro</label>
                  	<div class="col-sm-10">
                    	<select id="cmbFiltrosMax" name="cmbFiltrosMax" class="form-control">
	                          <option value="IDENTIFICACION">Identificación</option>
							              <option value="G719_C17026">No. Contrato</option>
                            <option value="G719_C17423">No. Liquidacion</option>
							              <option value="NOMBRE">Nombre Cliente</option>
                      	</select>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="inputPassword3" class="col-sm-2 control-label">Archivo a Subir</label>
                  	<div class="col-sm-10">
                    	<input type="file"  id="FilExcell" name="FilExcell"  class="form-control">
                  	</div>
            	</div>
            	

				<div class="form-group">
  					    <label for="inputEmail3" class="col-sm-2 control-label">Fecha de asignación</label>
                	   <div class="col-sm-10">
                		    <div class="input-group">
							   <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
							   </div>
							   <input type="text" class="form-control datemask"  name="fechas" disabled required value="<?php echo date("d/m/Y"); ?>" placeholder= "dd/mm/yyyy">
							</div><!-- /.input group -->
						</div>
					</div>


				<div class="form-group">
                  	<label for="inputEmail3" class="col-sm-2 control-label">Gestor</label>
                  	<div class="col-sm-10">
                    	<select id="cmbGetsoresMax" name="cmbGetsoresMax" class="form-control">
							<option value="0">Selecciones un Gestor</option>
	                        <?php 
								foreach ($getsores as $key ){
									echo '<option value="'.$key->id.'">'.utf8_encode($key->nombre).'</option>';
								}
							?>
                      	</select>
                  	</div>
                </div>
            
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="reset" class="btn btn-default">Cancelar</button>
				<button type="button" id="gestoresAsignacionMavo" class="btn btn-primary">Asignar Gestor(es)</button>
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
			<h3 class="box-title">Asignación por cargue uno a uno</h3>
		</div>
		<form class="form-horizontal" id="ebvioSolo">
			<div class="box-body">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Seleccionar Filtro</label>
						<div class="col-sm-10">
							<select id="cmbFiltros" class="form-control">
								<option value="IDENTIFICACION">Identificación</option>
								<option value="G719_C17026">No. Contrato</option>
                <option value="G719_C17423">No. Liquidacion</option>
								<option value="NOMBRE">Nombre Cliente</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Digite Filtro</label>
						<div class="col-sm-10">
							<input type="text" id="exampleInputFile" class="form-control" placeholder="Filtro">
						</div>
					</div>
					
					<div class="form-group">
  					    <label for="inputEmail3" class="col-sm-2 control-label">Fecha de asignación</label>
                	   <div class="col-sm-10">
                		    <div class="input-group">
							   <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
							   </div>
							   <input type="text" class="form-control datemask"  name="fechas" disabled required value="<?php echo date("d/m/Y"); ?>" placeholder= "dd/mm/yyyy">
							</div><!-- /.input group -->
						</div>
					</div>

					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Gestor</label>
						<div class="col-sm-10">
							<select id="cmbGetsores" name="cmbGetsores" class="form-control">
								<option value="0">Selecciones un Gestor</option>
								<?php 
									foreach($otrosgestores as $key){
										echo '<option value="'.$key->id.'">'.utf8_encode($key->nombre).'</option>';
									}
								?>
							</select>
						</div>
					</div>
				
			</div><!-- /.box-body -->
			<div class="box-footer">
				<button type="reset" class="btn btn-default">Cancelar</button>
				<button type="button" id="botonSolo" class="btn btn-primary">Asignar Gestor(es)</button>
			</div><!-- /.box-footer -->
		</form>
  	</div><!-- /.box -->

</section>
<<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
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

      $("#botonSolo").click(function(){
         var validador = 0;
          if($("#cmbGetsores").val() == '0'){
              alertify.error('Debe seleccionar un gestor, para signarle los casos');
              validador = 1;
          }

          if($("#exampleInputFile").val().length < 1){
              alertify.error('Debe escribir el valor a filtrar');
              validador = 1;
          }

          if(validador == 0){
              alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                if (e) {
                    var otherForm = $("#ebvioSolo");
                    $.ajax({
                        url: '<?php echo base_url(); ?>asignacion/cargueGestores',  
                        type: 'POST',
                        data: { exampleInputFile :  $("#exampleInputFile").val(), cmbGetsores: $("#cmbGetsores").val(), cmbFiltros : $("#cmbFiltros").val() },
                        success : function(data){
                            if(data == 1){
                                alertify.success("Registro guardado!");
                                otherForm[0].reset();
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
          if($("#cmbGetsoresMax").val() == '0'){
              alertify.error('Debe seleccionar un Gestor, para signarle los casos');
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
                        url: '<?php echo base_url(); ?>asignacion/carguemasGestores',  
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend : function() {
                            /*$.blockUI({ message: $("#containerPogresBar") });*/
                            $("#mostrarPorcentaje").show();
                            $
                            $("#progressbarComercial").addClass('progress-bar-striped');
                            $("#progressbarComercial").addClass('active');
                        },
                        //una vez finalizado correctamente
                        success: function(data){
                          if(data.valid == "1"){
                              alertify.success("La cantidad  de registros son "+ data.registros +", asignados "+ data.total + ", " + data.noexisten + " no se pudieron asignar porque no existen en la base de datos " );
                                  otherForm[0].reset();
                              }
                            
                            
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

