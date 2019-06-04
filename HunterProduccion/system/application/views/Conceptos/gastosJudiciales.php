<section class="content-header">
    <h1>
        APLICACIÓN FACTURAS - Gastos Judiciales
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Gastos Judiciales</li>
    </ol>
</section>

<section class="content">

	 <div class="box">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><a id="tab1" href="#cargue" data-toggle="tab">Carga Gastos Judiciales</a></li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- ESTE ES EL BLOQUE QUE CARGA LA INFORMACIÓN -->  
                    <div class="chart tab-pane active" id="cargue" style="position: relative; height: auto;">
                        <div class="box-header with-border">
                          <h3 class="box-title">
                            Carga de información en Hunter</h3>
                        </div>
                        <form class="form-horizontal" id="enviomasivo" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Filtros</label>
                                    <div class="col-sm-9">
                                        <select id="cmbFiltrosMax" name="cmbFiltrosMax" class="form-control">
                                            <option value="G719_C17026">No. Contrato</option>
                                            <option value="G719_C17423">No. Liquidacion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Archivo a Procesar</label>
                                    <div class="col-sm-9">
                                      <input type="file"  id="FilExcell" name="FilExcell"  class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default">Cancelar</button>
                                <button type="button" id="gestoresAsignacionMavo" class="btn btn-primary">Subir Excel</button>
                            </div><!-- /.box-footer -->
                        </form>
                        <div class="row" id="mostrarPorcentaje" style="display: none;">
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
                    </div>
                </div>
            </div><!-- /.nav-tabs-custom -->  
        </div> 
    </div>  
</section>
 


<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>



<script type="text/javascript">

	$(function () {
  	
        $("#gestoresAsignacionMavo").click(function(){
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
                url: '<?php echo base_url(); ?>Conceptos/cargar_GastosJudiciales',  
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
                    alertify.success("La cantidad  de registros son "+ data.total +", guardados "+ data.acertados + ", " + data.noExisten + " no se pudieron guardar porque no existen en la base de datos ");
            		
                    otherForm[0].reset();
                    //$("#cargueOculto").show();
                    //window.location.reload(true);
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
      	});

	});
</script>



