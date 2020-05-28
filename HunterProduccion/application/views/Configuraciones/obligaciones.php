<section class="content-header">
    <h1>
        ELIMINAR OBLIGACIONES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Eliminar Obligaciones</li>
    </ol>
</section>

<div class="box" id="cargueMasivo" >
		<div class="box-header with-border">
			<h3 class="box-title">Eliminación por cargue masivo</h3>
		</div>
    <div class="box-body">
    	 	<form class="form-horizontal" action="<?php echo base_url(); ?>configuraciones/eliminarObligaciones" method="POST" id="formCargeMasivoAbogados" enctype="multipart/form-data">
           
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
            <button type="button" id="btncarguedos" class="btn btn-primary">Eliminar Obligaciones</button>
      	</div><!-- /.box-footer -->
  	</div><!-- /.box -->
</div>

<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>

<script type="text/javascript">
	$(function () {
		$("#btncarguedos").click(function(){

			validador = 0;

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
	                        url: '<?php echo base_url(); ?>configuraciones/eliminarObligaciones',  
	                        type: 'POST',
	                        data: formData,
	                        cache: false,
	                        contentType: false,
	                        processData: false,
	                        dataType: "json",
	                        beforeSend : function() {
	                            /*$.blockUI({ message: $("#containerPogresBar") });*/
	                            $("#mostrarPorcentaje").show();
	                           
	                           // $("#FilExcell").prop('disabled', true);
	                     

	                            $("#ResetForm1").prop('disabled', true);
	                            $("#btncarguedos").prop('disabled', true);


	                            $("#progressbarComercial").addClass('progress-bar-striped');
	                            $("#progressbarComercial").addClass('active');
	                        },
	                        //una vez finalizado correctamente
	                        success: function(data){
	                          	if(data.valid == "1"){
		                          	if(data.total === 0){
		                          		alertify.success("Registros eliminados "+ data.total);
		                          	}else{
		                          		alertify.success("Registros eliminados  "+ data.total);
		                          	}
	                              	otherForm[0].reset();
	                            }
	                        },
	                        complete: function(){
	                          
	                         
	                          $("#FilExcell").prop('disabled', false);
	                        


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
	                       
	                            $("#FilExcell").prop('disabled', false);
	                       


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

