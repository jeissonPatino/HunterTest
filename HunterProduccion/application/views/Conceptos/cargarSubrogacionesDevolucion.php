<section class="content-header">
    <h1>
        Configuración F. Devolución M. Subrogación FRG
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Configuración - F. DEVOLUCIÓN M. SUBROGACIÓN FRG</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">¿Qué tipo de Cargue desea hacer?</h3>
		</div>
        <div class="box-body">
    	 	<div class="row">
    	 		<div class="col-sm-2">
    	 			
    	 		</div>
    	 		<div class="col-sm-4">
    	 			<label>
              	<input type="checkbox" name="optionsRadios" id="masivo" value="option1">Cargue masivo por excel
            </label>
    	 		</div>
    	 		<div class="col-sm-4">
    	 			<label>
              	<input type="checkbox" name="optionsRadios" id="unouno" value="option2">Uno a uno
            </label>	
    	 		</div>
    	 		<div class="col-sm-2">
    	 			
    	 		</div>
    	 	</div>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->


<div class="box" id="cargueMasivo" style="display:none;">
		<div class="box-header with-border">
			<h3 class="box-title">Cargue masivo</h3>
		</div>
    <div class="box-body">
    	 	<form class="form-horizontal" action="<?php echo base_url(); ?>asignacion/carguemasABogados" method="POST" id="formCargeMasivoAbogados" enctype="multipart/form-data">
            <div class="form-group">
              	<label for="inputEmail3" class="col-sm-2 control-label">Asignado por:</label>
              	<div class="col-sm-10">
                	  <select id="cmbFiltros" name="filtro" class="form-control">
                        <option value="G719_C17423">No. Liquidacion</option>
                  	</select>
              	</div>
            </div>
            <div class="form-group">
              	<label for="FilExcell" class="col-sm-2 control-label">Archivo a Subir</label>
              	<div class="col-sm-10">
                	<input type="file" id="FilExcell" name="FilExcell" class="form-control">
              	</div>
          	</div>
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
    	  <div class="box-footer">
            <button type="reset" id="ResetForm1" class="btn btn-default" >Cancelar</button>
            <button type="button" id="btncarguedos" class="btn btn-primary">Cargar devolución Subrogación</button>
      	</div><!-- /.box-footer -->
  	</div><!-- /.box -->
</div>



  	<div class="box" id="cargueunoaunoSki" style="display:none;">
    		<div class="box-header with-border">
    			<h3 class="box-title">Asignación por cargue uno a uno</h3>
    		</div>
        <form class="form-horizontal" id="formSOlo" action="<?php echo base_url(); ?>asignacion/carguemasABogados" method="POST" enctype="multipart/form-data">
        <div class="box-body">
        	 	
                <div class="form-group">
            	      <label for="inputEmail3" class="col-sm-2 control-label">Seleccionar Filtro</label>
                  	<div class="col-sm-10">
                  	    <select id="cmbFiltros2" name="cmbFiltros2" class="form-control">
                            <option value="G719_C17423">No. Liquidacion</option>
                      	</select>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">No. liquidación</label>
                    <div class="col-sm-10">
                        <input type="text"  name="txtnumeroSap" id="txtnumeroSap" class="form-control"> 
                    </div>
                </div>
                    
        				<div class="form-group">
      					    <label for="inputEmail3" class="col-sm-5 control-label">Fecha devolución FRG memorial de subrogación por errores</label>
                  	<div class="col-sm-7">
                    		<div class="input-group">
      							        <div class="input-group-addon">
      								         <i class="fa fa-calendar"></i>
      							        </div>
      							         <input type="text" class="form-control datemask" name="fechas"  id="fechas" placeholder= "dd/mm/yyyy">
            						</div><!-- /.input group -->
                  	</div>
    				    </div><!-- /.form group -->
        </div><!-- /.box -->   
    	  <div class="box-footer">
            <button type="button" class="btn btn-default">Cancelar</button>
            <button type="button" id="botonSolo" class="btn btn-primary">Cargar devolución Subrogación</button>
      	</div><!-- /.box-footer -->
        </form> 
    </div>

</section>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">

	$(function () {
  		$("#masivo").click(function(){
  			 $("#cargueMasivo").show();
  			 $("#cargueunoaunoSki").hide();
  				
  		});

  		$("#unouno").click(function(){
  			 $("#cargueMasivo").hide();
  			 $("#cargueunoaunoSki").show()
  		});

      $("#botonSolo").click(function(){
         var validador = 0;
          
          if($("#txtnumeroSap").val().length < 1){
              alertify.error('Debe escribir el número de liquidacion');
              validador = 1;
          }

          if(validador == 0){
              alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                if (e) {

                    var otherForm = $("#formSOlo");
                    $.ajax({
                        url: '<?php echo base_url(); ?>conceptos/guardarUnoaUnoDevolucion',  
                        type: 'POST',
                        data: { filtro :  $("#cmbFiltros2").val(), 
                                liquidacion :  $("#txtnumeroSap").val(), 
                                fechadevolucion: $("#fechas").val()},
                        success : function(data){
                            
                            alertify.success(data);
                            otherForm[0].reset();
                            
                        }
                    });
                } else {
                     
                } 
              });
          }

      });

      $("#btncarguedos").click(function(){
         
          var validador = 0;
          if($("#cmbAbogadosMas").val() == '0'){
              alertify.error('Debe seleccionar un abogado, para signarle los casos');
              validador = 1;
          }

          if($("#FilExcell").val().length < 1){
              alertify.error('Debe seleccionar un Archivo, para cargar');
              validador = 1;
          }

          if(validador == 0){
              alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                  if (e) {
                    var otherForm = $("#formCargeMasivoAbogados");
                    var formData = new FormData($("#formCargeMasivoAbogados")[0]);
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
                        url: '<?php echo base_url(); ?>conceptos/cargarDevolucionesSubrogacionesMasiva',  
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend : function() {
                            /*$.blockUI({ message: $("#containerPogresBar") });*/
                            $("#mostrarPorcentaje").show();
                            $("#cmbFiltros").prop('disabled', true);
                            $("#FilExcell").prop('disabled', true);
                            $("#cmbAbogadosMas").prop('disabled', true);

                            $("#ResetForm1").prop('disabled', true);
                            $("#btncarguedos").prop('disabled', true);


                            $("#progressbarComercial").addClass('progress-bar-striped');
                            $("#progressbarComercial").addClass('active');
                        },
                        //una vez finalizado correctamente
                        success: function(data){

                             alertify.success("Registros cargados  "+ data.total +", registros procesados  "+ data.acertados + ",registros no procesados " + data.noExisten);
                              otherForm[0].reset();
                            
                        },
                        complete: function(){
                          
                          $("#cmbFiltros").prop('disabled', false);
                          $("#FilExcell").prop('disabled', false);
                          $("#cmbAbogadosMas").prop('disabled', false);


                          $("#ResetForm1").prop('disabled', false);
                          $("#btncarguedos").prop('disabled', false);



                          $("#progressbarComercial").removeClass('progress-bar-striped');
                          $("#progressbarComercial").removeClass('active');
                          $("#progressbarComercial").attr('aria-valuenow', '0');
                          $("#progressbarComercial").attr('style', "width: 0%");
                          $("#mostrarPorcentaje").hide();
                        },
                        //si ha ocurrido un error
                        error: function(){
                          /*$.unblockUI();*/
                            $("#cmbFiltros").prop('disabled', false);
                            $("#FilExcell").prop('disabled', false);
                            $("#cmbAbogadosMas").prop('disabled', false);


                            $("#ResetForm1").prop('disabled', false);
                            $("#btncarguedos").prop('disabled', false);

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
