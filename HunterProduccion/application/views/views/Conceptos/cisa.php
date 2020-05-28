<section class="content-header">
    <h1>
        APLICACIÓN FACTURAS - CISA
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">CISA</li>
    </ol>
</section>

<section class="content">

	 <div class="box">
        <div class="box-body">
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-left">
                    <!--<li class="active"><a id="tab2" href="#descargue" data-toggle="tab">Descarga información CISA</a></li>-->
                    <li class="active"><a id="tab1" href="#cargue" data-toggle="tab">Carga Honorarios CISA</a></li>
                    
                    <li><a id="tab3" href="#cargue2" data-toggle="tab">Carga Soporte</a></li>
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
                                            <option value="NoContrato">No. Contrato</option>
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

                    <!-- ESTE ES EL BLOQUE QUE DESCARGA LA INFORMACIÓN -->  
                    <div class="chart tab-pane" id="descargue" style="position: relative; height: auto;">
                        <div class="box-header with-border">
                          <h3 class="box-title">
                            Descarga de información en Hunter</h3>
                        </div>
                        <form class="form-horizontal" id="DescargueMasivo" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Filtros</label>
                                    <div class="col-sm-9">
                                        <select id="cmbFiltrosMaxDescargue" name="cmbFiltrosMaxDescargue" class="form-control">
                                            <option value="NoContrato">No. Contrato</option>
                                            <option value="G719_C17423">No. Liquidacion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Archivo a Procesar</label>
                                    <div class="col-sm-9">
                                      <input type="file"  id="FilExcellDescargue" name="FilExcellDescargue"  class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default">Cancelar</button>
                                <button type="button" id="gestoresAsignacionMavoDescargue" class="btn btn-primary">Subir Excel</button>
                            </div><!-- /.box-footer -->
                        </form>
                        <div class="row" id="mostrarPorcentajeDescargue" style="display: none;">
                            <div class="col-lg-2">
                               
                            </div>
                            <div class="col-lg-8">
                                <p style="text-align:center;">Porcentaje de subida</p>
                                <div class="progress" id="containerPogresBarDescargue" >
                                    <div id="progressbarComercialDescargue" class="progress-bar progress-bar-striped active " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                    50%
                                  </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                               
                            </div>
                        </div>
                        <div class="box" id="cargueOculto" style="display: none;">
                            <div class="box-header with-border">
                              <h3 class="box-title">Resultados de la consulta</h3>
                            </div>
                            <table class="table table-hover table-bordered" id="tablaRara" >
                              <thead>
                                    <tr>
                                        <th>No. Contrato</th>
                                        <th>Fecha tramite</th>
                                        <th>Valor a pagar</th>
                                        <th>Valor pagado</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table> 
                        </div><!-- /.box -->
                    </div>

                    <div class="chart tab-pane" id="cargue2" style="position: relative; height: auto;">
                        <div class="box-header with-border">
                          <h3 class="box-title">
                            Carga de información en Hunter</h3>
                        </div>
                        <form class="form-horizontal" id="enviomasivo2" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Filtros</label>
                                    <div class="col-sm-9">
                                        <select id="cmbFiltrosMax2" name="cmbFiltrosMax2" class="form-control">
                                            <option value="NoContrato">No. Contrato</option>
                                            <option value="G719_C17423">No. Liquidacion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Archivo a Procesar</label>
                                    <div class="col-sm-9">
                                      <input type="file"  id="FilExcell2" name="FilExcell2"  class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset2" class="btn btn-default">Cancelar</button>
                                <button type="button" id="gestoresAsignacionMavo2" class="btn btn-primary">Subir Excel</button>
                            </div><!-- /.box-footer -->
                        </form>
                        <div class="row" id="mostrarPorcentaje" style="display: none;">
                            <div class="col-lg-2">
                               
                            </div>
                            <div class="col-lg-8">
                                <p style="text-align:center;">Porcentaje de subida</p>
                                <div class="progress" id="containerPogresBar2" >
                                    <div id="progressbarComercial2" class="progress-bar progress-bar-striped active " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
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


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>


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
                url: '<?php echo base_url(); ?>Conceptos/cargar_CISA',  
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


        $("#gestoresAsignacionMavoDescargue").click(function(){
            var otherForm = $("#DescargueMasivo");
            var formData = new FormData($("#DescargueMasivo")[0]);
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
              
                      $("#progressbarComercialDescargue").attr('aria-valuenow', percentComplete);
                      $("#progressbarComercialDescargue").attr('style', "width: "+percentComplete+"%");
                      $("#progressbarComercialDescargue").html(percentComplete + '%');
                    }
                  }, false);

                  return xhr;
                },
                url: '<?php echo base_url(); ?>Conceptos/descargarValoresSubrogacion',  
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend : function() {
                    /*$.blockUI({ message: $("#containerPogresBar") });*/
                    $("#mostrarPorcentajeDescargue").show();
                    
                    $("#progressbarComercialDescargue").addClass('progress-bar-striped');
                    $("#progressbarComercialDescargue").addClass('active');
                },
                //una vez finalizado correctamente
                success: function(data){
                    if($.fn.dataTable.isDataTable( '#tablaRara' )){
                        $("#tablaRara").dataTable().fnDestroy();
                    }

                    $("#tablaRara").DataTable({
                        "aaData": data,
                        "aoColumns": [
                          { mData: "Ncontrato" },
                          { mData: "fecha"},
                          { mData: "valor" },
                          { mData: "valor_pagado"}
                      
                        ],
                        "oLanguage": {
                                  "sLengthMenu": "_MENU_ Registros por página",
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
                              "processing": true,
                             // "ajax": "<?php// echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
                              "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                          var id = aData.id;
                          $(nRow).attr("id",id);
                          $(nRow).attr("class",'trobligacionDatosIniciales');
                          return nRow;
                           
                        },
                        "fnDrawCallback": function (oSettings, json) {
                          
                        },
                        "bJQueryUI": true,
                        "bProcessing": true,
                        "bSort": true,
                        "bSortClasses": false,
                        "bDeferRender": true,
                        "sPaginationType": "simple",
                        "iDisplayLength": 20,
                        "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
                        "dom": 'Bfrtip',
                        "buttons": [
                             'excel'
                        ]
                    });
                    otherForm[0].reset();
                    $("#cargueOculto").show();
                    //window.location.reload(true);
                },
                complete: function(){
                  
                  otherForm[0].reset();


                  $("#progressbarComercialDescargue").removeClass('progress-bar-striped');
                  $("#progressbarComercialDescargue").removeClass('active');
                  $("#progressbarComercialDescargue").attr('aria-valuenow', '0');
                  $("#progressbarComercialDescargue").attr('style', "width: 0%");
                  $("#mostrarPorcentajeDescargue").hide();
                },
                //si ha ocurrido un error
                error: function(){
                  /*$.unblockUI();*/
                    otherForm[0].reset();
            
                    $("#progressbarComercialDescargue").removeClass('progress-bar-striped');
                    $("#progressbarComercialDescargue").removeClass('active');
                    $("#progressbarComercialDescargue").attr('aria-valuenow', '0');
                    $("#progressbarComercialDescargue").attr('style', "width: 0%");
                    $("#mostrarPorcentajeDescargue").hide();
                    alertify.error('Ocurrio un error, intenta mas tarde');
                }
            }); 
        });


        $("#gestoresAsignacionMavo2").click(function(){
            var otherForm = $("#enviomasivo2");
            var formData = new FormData($("#enviomasivo2")[0]);
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
              
                      $("#progressbarComercial2").attr('aria-valuenow', percentComplete);
                      $("#progressbarComercial2").attr('style', "width: "+percentComplete+"%");
                      $("#progressbarComercial2").html(percentComplete + '%');
                    }
                  }, false);

                  return xhr;
                },
                url: '<?php echo base_url(); ?>Conceptos/cargar_CISA_soporte',  
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend : function() {
                    /*$.blockUI({ message: $("#containerPogresBar") });*/
                    $("#mostrarPorcentaje2").show();
                    
                    $("#progressbarComercial2").addClass('progress-bar-striped');
                    $("#progressbarComercial2").addClass('active');
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


                  $("#progressbarComercial2").removeClass('progress-bar-striped');
                  $("#progressbarComercial2").removeClass('active');
                  $("#progressbarComercial2").attr('aria-valuenow', '0');
                  $("#progressbarComercial2").attr('style', "width: 0%");
                  $("#mostrarPorcentaje2").hide();
                },
                //si ha ocurrido un error
                error: function(){
                  /*$.unblockUI();*/
                    otherForm[0].reset();
            
                    $("#progressbarComercial2").removeClass('progress-bar-striped');
                    $("#progressbarComercial2").removeClass('active');
                    $("#progressbarComercial2").attr('aria-valuenow', '0');
                    $("#progressbarComercial2").attr('style', "width: 0%");
                    $("#mostrarPorcentaje2").hide();
                    alertify.error('Ocurrio un error, intenta mas tarde');
                }
            }); 
        });

	});
</script>



