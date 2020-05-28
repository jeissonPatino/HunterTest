<!-- ACB2 -->
<section class="content-header">
    <h1>CARGA MASIVA LIQUIDACIONES CON ACUERDO DE PAGO</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Asignación - Abogados</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Asignación de cargue masivo</h3>
        </div>
        <div class="row with-border">
            <div class="col-lg-11">
                <p><b>Nota:</b> Para realizar un cargue masivo de los registros de liquidaciones con acuerdos de pago, por favor descargue y llene el documento en formato Excel, luego debe ingresar los registros solicitados a partir de la fila (3), tenga en cuenta NO modificar la estructura de la plantilla y seguir estas indicaciones:</p>
                <ul>
                    <li>Los campos de fechas ingresarlos en formato AAAA-MM-DD.</li>
                    <li>El Plazo de acuerdo de pago es un número de meses.</li>
                    <li>Los cuatro campos son de carácter obligatorio.</li>
                </ul>
                <p>Una vez haya llenado el documento Excel, en el formulario más abajo seleccione el archivo y presione el botón <b>Realizar carga masiva</b></p>
            </div>
            <div class="col-lg-1">
                <a href="<?php echo base_url();?>assets/plantillas/Formato-carga-masiva.xlsx" class="btn btn-success" download>
                    <span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> XLS
                </a>
            </div>
        </div>
    </div>

    <div class="box" id="cargueMasivo">
        <div class="box-body">
            <form id="formCargeMasivoAbogados" class="form-horizontal" action="<?php echo base_url(); ?>extrajudicial/procesoCargueMasivoAcuerdos" method="POST" enctype="multipart/form-data">
                <!--
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="archivo_excel" class="col-sm-4 control-label">Archivo a Subir</label>
                            <div class="col-sm-8">
                                <input type="file" id="archivo_excel" name="archivo_excel" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Fecha de asignación</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="fecha" id="fecha" class="form-control datemask" value="<?php echo date("Y-m-d"); ?>" placeholder= "yyyy-mm-dd" required disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btncarguedos" class="btn btn-primary">Realizar carga masiva</button>
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="archivo_excel" class="col-sm-4 control-label">Archivo a Subir</label>
                            <div class="col-sm-8">
                                <input type="file" id="archivo_excel" name="archivo_excel" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btncarguedos" class="btn btn-primary">Realizar carga masiva</button>
                    </div>
                </div>                
                <div class="row">
                    <div id="resultado_proceso" class="col-lg-12">
                        &nbsp;
                    </div>
                </div>
            </form>
            <div class="row" id="mostrarPorcentaje" style="display:none;">
                <div class="col-lg-2">&nbsp;</div>
                <div class="col-lg-8">
                    <p style="text-align:center;">Porcentaje de subida</p>
                    <div class="progress" id="containerPogresBar" >
                        <div id="progressbarComercial" class="progress-bar progress-bar-striped active " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">50%</div>
                    </div>
                </div>
                <div class="col-lg-2">&nbsp;</div>
            </div>
        </div>
    </div>
</section>



<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">
    
    $(function(){
        $("#btncarguedos").click(function(){
            if( $("#archivo_excel").val().length>0 ){
                alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                    if (e) {
                        var otherForm = $("#formCargeMasivoAbogados");
                        var formData = new FormData($("#formCargeMasivoAbogados")[0]);
                        $.ajax({
                            xhr: function(){
                                var xhr = new window.XMLHttpRequest();
                                //Upload progress
                                xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                                        // console.log(percentComplete);
                                        $("#progressbarComercial").attr('aria-valuenow', percentComplete);
                                        $("#progressbarComercial").attr('style', "width: "+percentComplete+"%");
                                        $("#progressbarComercial").html(percentComplete + '%');
                                    }
                                }, false);
                                return xhr;
                            },
                            url: '<?php echo base_url(); ?>extrajudicial/procesoCargueMasivoAcuerdos',  
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            beforeSend : function(){
                                /*$.blockUI({ message: $("#containerPogresBar") });*/
                                $("#mostrarPorcentaje").show();
                                //$("#archivo_excel, #btncarguedos").prop('disabled', true);
                                $("#progressbarComercial").addClass('progress-bar-striped');
                                $("#progressbarComercial").addClass('active');
                            },
                            //una vez finalizado correctamente
                            success: function(data){
                                if(data.estado == "1"){
                                    alertify.success( data.mensaje );
                                    otherForm[0].reset();
                                }else{
                                    alertify.error( data.mensaje );
                                }
                                var masInfo =data.mensaje+='<a onclick="$(\'#resultado_proceso\').html(\'\')" style=\'cursor:pointer\' >Cerrar</a>';
                                $("#resultado_proceso").html(data.mensaje);

                                /*if(data.valid == "1"){
                                    alertify.success("La cantidad  de registros son "+ data.registros +", asignados "+ data.total + ", " + data.noexisten + " no se pudieron asignar porque no existen en la base de datos ");
                                    otherForm[0].reset();
                                }else{
                                    alertify.error("aaaaaaaaa");
                                }*/
                            },
                            complete: function(){
                                //$("#archivo_excel, #btncarguedos").prop('disabled', true);
                                $("#progressbarComercial").removeClass('progress-bar-striped');
                                $("#progressbarComercial").removeClass('active');
                                $("#progressbarComercial").attr('aria-valuenow', '0');
                                $("#progressbarComercial").attr('style', "width: 0%");
                                $("#mostrarPorcentaje").hide();
                            },
                            //si ha ocurrido un error
                            error: function(){
                                //$("#archivo_excel, #btncarguedos").prop('disabled', true);
                                $("#progressbarComercial").removeClass('progress-bar-striped');
                                $("#progressbarComercial").removeClass('active');
                                $("#progressbarComercial").attr('aria-valuenow', '0');
                                $("#progressbarComercial").attr('style', "width: 0%");
                                $("#mostrarPorcentaje").hide();
                                alertify.error('Ocurrio un error, intenta mas tarde.');
                            }
                        });
                    }
                });
            }else{
                alertify.error( 'Debe seleccionar un Archivo, para cargar.' );
                return false;
            }
        });
    });
</script>