<section class="content-header">
    <h1>
        CONFIGURACIÓN - GESTIONAR DATOS CLIENTES
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
                    <li class="active"><a id="tab1" href="#DatosNoEfecttivos" data-toggle="tab">Depuración Clientes Datos No Efectivos</a></li>
                    <li><a id="tab2" href="#cargaMasiva" data-toggle="tab">Carga Masiva Datos Clientes</a></li>
                    <li><a id="tab3" href="#GenerarInformes" data-toggle="tab">Generar informes</a></li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Este Se carga la depuracion de la informacion de los clientes -->  
                    <div class="box-body">
                        <div class="row-fuid">
                            <div class="col-md-12">
                                    <div class="box-header">
                                        <div class="Row">
                                            <div>
                                                <button class="btn btn-danger btn-ms" id="EliminarDatosNoEfectivos" title="Eliminación de Datos No Efectivos"><i class="fa fa-trash-o"></i>&nbsp;Depurar No Efectivos</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box box-info">
                                        <div class="col">
                                            <div class="box table-responsive no-padding">
                                                <table class="table table-hover table-bordered" id="DatosNoEfecttivos">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th>No. Identificación</th>
                                                            <th>Dirección domicilio</th>
                                                            <th>Calificación Dir. Domicilio</th>
                                                            <th>Ciudad domicilio</th>
                                                            <th>Calificación Ciudad domicilio</th>
                                                            <th>Dirección oficina</th>
                                                            <th>Calificación Dirección oficina</th>
                                                            <th>Ciudad oficina</th>
                                                            <th>Calificación Ciudad oficina</th>
                                                            <th>Teléfono domicilio</th>
                                                            <th>Calificación Teléfono domicilio</th>
                                                            <th>Teléfono oficina</th>
                                                            <th>Calificación Teléfono oficina</th>
                                                            <th>Celular</th>
                                                            <th>Calificación Celular</th>
                                                            <th>Celular adicional</th>
                                                            <th>Calificación Celular adicional</th>
                                                            <th>Correo electrónico</th>
                                                            <th>Calificación Correo electrónico</th>
                                                            <th>Dirección adicional</th>
                                                            <th>Calificación Dirección adicional</th>
                                                            <th>Ciudad adicional</th>
                                                            <th>Calificación Ciudad adicional</th>
                                                            <th>Teléfono adicional</th>
                                                            <th>Calificación Teléfono adicional</th>
                                                            <th>Fecha</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="cargaMasiva" style="position: relative; height: auto;">
                        <div class="box-header with-border">
                          <h3 class="box-title">
                            Carga Masiva Datos Clientes</h3>
                        </div>
                        <form class="form-horizontal" id="enviomasivo" >
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Archivo Cargar</label>
                                    <div class="col-sm-9">
                                      <input type="file"  id="FilExcell2" name="FilExcell2"  class="form-control">
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset2" class="btn btn-default">Cancelar</button>
                                <button type="button" id="CargaDatosMasiva" class="btn btn-primary" >Subir Excel</button>
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
                    </div><!-- termina el cargue masivo vista -->
                    <div id="GenerarInformes" style="display: none;">
                    <div class="box-header with-border" id ="tituloinformes" >
                        <h3 class="box-title">Generación de informes</h3>
                    </div>
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-left">
                            <li class="active"><a id="tab4" href="#DatosNoEfectivosInformes" data-toggle="tab">Informe Datos No Efectivos</a></li>
                            <li><a id="tab5" href="#DatosEfecttivosInformes" data-toggle="tab">Informe Datos Efectivos</a></li>
                            <li><a id="tab6" href="#DatosGestionados" data-toggle="tab">Informe Datos No Gestionado</a></li>
                        </ul>
                        <div class="tab-content no-padding"> 
                            <div class="box-body">
                                <div class="row-fuid">
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="col" >
                                                <div class="box table-responsive no-padding"
                                                id ="barra1">
                                                    <table class="table table-hover table-bordered" id="DatosNoEfectivosInformes">
                                                        <thead>
                                                            <tr>
                                                             
                                                                <th>No. Identificación</th>
                                                                <th>Dirección domicilio</th>
                                                                <th>Calificación Dir. Domicilio</th>
                                                                <th>Ciudad domicilio</th>
                                                                <th>Calificación Ciudad domicilio</th>
                                                                <th>Dirección oficina</th>
                                                                <th>Calificación Dirección oficina</th>
                                                                <th>Ciudad oficina</th>
                                                                <th>Calificación Ciudad oficina</th>
                                                                <th>Teléfono domicilio</th>
                                                                <th>Calificación Teléfono domicilio</th>
                                                                <th>Teléfono oficina</th>
                                                                <th>Calificación Teléfono oficina</th>
                                                                <th>Celular</th>
                                                                <th>Calificación Celular</th>
                                                                <th>Celular adicional</th>
                                                                <th>Calificación Celular adicional</th>
                                                                <th>Correo electrónico</th>
                                                                <th>Calificación Correo electrónico</th>
                                                                <th>Dirección adicional</th>
                                                                <th>Calificación Dirección adicional</th>
                                                                <th>Ciudad adicional</th>
                                                                <th>Calificación Ciudad adicional</th>
                                                                <th>Teléfono adicional</th>
                                                                <th>Calificación Teléfono adicional</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content no-padding"> 
                            <div class="box-body" >
                                <div class="row-fuid">
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="col">
                                                <div class="box table-responsive no-padding" id ="barra2" style="display: none">
                                                    <table class="table table-hover table-bordered" id="DatosEfecttivosInformes" style="display: none">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>No. Identificación</th>
                                                                <th>Dirección domicilio</th>
                                                                <th>Calificación Dir. Domicilio</th>
                                                                <th>Ciudad domicilio</th>
                                                                <th>Calificación Ciudad domicilio</th>
                                                                <th>Dirección oficina</th>
                                                                <th>Calificación Dirección oficina</th>
                                                                <th>Ciudad oficina</th>
                                                                <th>Calificación Ciudad oficina</th>
                                                                <th>Teléfono domicilio</th>
                                                                <th>Calificación Teléfono domicilio</th>
                                                                <th>Teléfono oficina</th>
                                                                <th>Calificación Teléfono oficina</th>
                                                                <th>Celular</th>
                                                                <th>Calificación Celular</th>
                                                                <th>Celular adicional</th>
                                                                <th>Calificación Celular adicional</th>
                                                                <th>Correo electrónico</th>
                                                                <th>Calificación Correo electrónico</th>
                                                                <th>Dirección adicional</th>
                                                                <th>Calificación Dirección adicional</th>
                                                                <th>Ciudad adicional</th>
                                                                <th>Calificación Ciudad adicional</th>
                                                                <th>Teléfono adicional</th>
                                                                <th>Calificación Teléfono adicional</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content no-padding" > 
                            <div class="box-body">
                                <div class="row-fuid">
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="col">
                                                <div class="box table-responsive no-padding"id ="barra3" style="display: none">
                                                    <table class="table table-hover table-bordered" id="DatosGestionados" style="display: none">
                                                        <thead>
                                                            <tr>
                                                                
                                                                <th>No. Identificación</th>
                                                                <th>Dirección domicilio</th>
                                                                <th>Calificación Dir. Domicilio</th>
                                                                <th>Ciudad domicilio</th>
                                                                <th>Calificación Ciudad domicilio</th>
                                                                <th>Dirección oficina</th>
                                                                <th>Calificación Dirección oficina</th>
                                                                <th>Ciudad oficina</th>
                                                                <th>Calificación Ciudad oficina</th>
                                                                <th>Teléfono domicilio</th>
                                                                <th>Calificación Teléfono domicilio</th>
                                                                <th>Teléfono oficina</th>
                                                                <th>Calificación Teléfono oficina</th>
                                                                <th>Celular</th>
                                                                <th>Calificación Celular</th>
                                                                <th>Celular adicional</th>
                                                                <th>Calificación Celular adicional</th>
                                                                <th>Correo electrónico</th>
                                                                <th>Calificación Correo electrónico</th>
                                                                <th>Dirección adicional</th>
                                                                <th>Calificación Dirección adicional</th>
                                                                <th>Ciudad adicional</th>
                                                                <th>Calificación Ciudad adicional</th>
                                                                <th>Teléfono adicional</th>
                                                                <th>Calificación Teléfono adicional</th>
                                                                <th>Fecha</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
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
<script type="text/javascript">

	$(function () {


        $("#tab1").click(function(){
            $("#DatosNoEfecttivos").show();
            $("#DatosNoEfecttivos_wrapper").show();
            $("#EliminarDatosNoEfectivos").show();
            $("#cargaMasiva").hide();
            $("#GenerarInformes").hide();
             
        });
         $("#tab2").click(function(){
            
            $("#GenerarInformes").hide();
            $("#DatosNoEfecttivos").hide();
            $("#DatosNoEfecttivos_wrapper").hide();
            $("#EliminarDatosNoEfectivos").hide();
            $("#cargaMasiva").show();
                
        });
         $("#tab3").click(function(){
            $("#GenerarInformes").show();
            $("#DatosNoEfecttivos").hide();
            $("#DatosNoEfecttivos_wrapper").hide();
            $("#EliminarDatosNoEfectivos").hide();
            $("#cargaMasiva").hide();
        });


        $("#tab4").click(function(){
            $("#DatosNoEfectivosInformes").show();
            $("#DatosNoEfectivosInformes_wrapper").show();
            $("#DatosGestionados").hide();
            $("#DatosGestionados_wrapper").hide();
            $("#DatosEfecttivosInformes").hide();
            $("#DatosEfecttivosInformes_wrapper").hide();
            $("#barra1").show();
            $("#barra2").hide();
            $("#barra3").hide();
           

        });

        $("#tab5").click(function(){
            $("#DatosEfecttivosInformes").show();
            $("#DatosEfecttivosInformes_wrapper").show();
            $("#DatosGestionados").hide();
            $("#DatosGestionados_wrapper").hide();
            $("#DatosNoEfectivosInformes").hide();
            $("#DatosNoEfectivosInformes_wrapper").hide();
            $("#barra1").hide();
            $("#barra2").show();
            $("#barra3").hide();

        });

        $("#tab6").click(function(){
            $("#DatosGestionados").show();
            $("#DatosGestionados_wrapper").show();
            $("#DatosEfecttivosInformes").hide();
             $("#DatosEfecttivosInformes_wrapper").hide();
            $("#DatosNoEfectivosInformes").hide();
            $("#DatosNoEfectivosInformes_wrapper").hide();
            $("#barra1").hide();
            $("#barra2").hide();
            $("#barra3").show();


        });

         $("#DatosNoEfecttivos").DataTable({
            "aaData": <?php echo $ResultadoNoEfectivos; ?>, 
            "aoColumns": [

                                { mData: "identificacion" },
                                { mData: "direccionDomicilio" },
                                { mData: "cal_direccionDomicilio"},
                                { mData: "ciudadDomicilio" },
                                { mData: "cal_ciudadDomicilio"},
                                { mData: "direccionOficina" },
                                { mData: "cal_direccionOficina"},
                                { mData: "ciudadOficina" },
                                { mData: "cal_ciudadOficina"},
                                { mData: "telefonoDomicilio" },
                                { mData: "cal_telefonoDomicilio"},
                                { mData: "tefonoOficina" },
                                { mData: "cal_tefonoOficina"},
                                { mData: "celular" },
                                { mData: "cal_celular"},
                                { mData: "celularAdicional" },
                                { mData: "cal_celularAdicional"},
                                { mData: "mail" },
                                { mData: "cal_mail"},
                                { mData: "dir_Adicional" },
                                { mData: "cal_dir_Adicional"},
                                { mData: "ciudad_adicional" },
                                { mData: "cal_ciudad_adicional"},
                                { mData: "tele_adicional" },
                                { mData: "cal_tele_adicional"},
                                { mData: "fecha_modificacion"}
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
             "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var id = aData.NumeroId;
                    $(nRow).attr("dato",id);
                    $(nRow).attr("class",'trobligacion');
                    return nRow;
                   
                },
                "fnDrawCallback": function (oSettings, json) {
                   //Aqui va el comando para activar los otros botones
                   $(".trobligacion").dblclick(function(){
                        var dato = $(this).attr('dato').replace(' ', '');
                        window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+dato+"/17";
                   });
                },
            "buttons":[{
                              extend: 'csv',
                              text: 'Excel',
                              charset: 'utf-8',
                              fieldSeparator : ';',
                              extension: '.csv'
                          }],
            "processing": true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "bSortClasses": false,
            "bDeferRender": true,
            "sPaginationType": "simple",
             "iDisplayLength": 20,
             "aaSorting":[[1,"asc"]],
             "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
             
          });
         // Datos no Efectivos Informes

            $("#DatosNoEfectivosInformes").DataTable({
            "aaData": <?php echo $ResultadoNoEfectivoInforme; ?>, 
            "aoColumns": [

                                { mData: "Identificacion" },
                                { mData: "Direccion_domicilio" },
                                { mData: "Calificacion_Dir_Domicilio"},
                                { mData: "Ciudad_domicilio" },
                                { mData: "Calificacion_Ciudad_domicilio"},
                                { mData: "Direccion_oficina" },
                                { mData: "Calificacion_Direccion_oficina"},
                                { mData: "Ciudad_oficina" },
                                { mData: "Calificacion_Ciudad_oficina"},
                                { mData: "Telefono_domicilio" },
                                { mData: "Calificacion_Telefono_domicilio"},
                                { mData: "Telefono_oficina" },
                                { mData: "Calificacion_Telefono_oficina"},
                                { mData: "Celular" },
                                { mData: "Calificacion_Celular"},
                                { mData: "Celular_adicional" },
                                { mData: "Calificacion_Celular_adicional"},
                                { mData: "Correo_electronico" },
                                { mData: "Calificacion_Correo_electronico"},
                                { mData: "Direccion_adicional" },
                                { mData: "Calificacion_Direccion_adicional"},
                                { mData: "Ciudad_adicional" },
                                { mData: "Calificacion_Ciudad_adicional"},
                                { mData: "Telefono_adicional" },
                                { mData: "Calificacion_Telefono_adicional"},
                                { mData: "Fecha_modificacion"}
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
             "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var id = aData.NumeroId;
                    $(nRow).attr("dato",id);
                    $(nRow).attr("class",'trobligacion');
                    return nRow;
                   
                },
                "fnDrawCallback": function (oSettings, json) {
                   //Aqui va el comando para activar los otros botones
                   $(".trobligacion").dblclick(function(){
                        var dato = $(this).attr('dato').replace(' ', '');
                        window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+dato+"/17";
                   });
                },
            "buttons":[{
                              extend: 'csv',
                              text: 'Excel',
                              charset: 'utf-8',
                              fieldSeparator : ';',
                              extension: '.csv'
                          }],
            "processing": true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "bSortClasses": false,
            "bDeferRender": true,
            "sPaginationType": "simple",
             "iDisplayLength": 20,
             "aaSorting":[[1,"asc"]],
             "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
             
          });

         // Datos Efectivos Informes

        $("#DatosEfecttivosInformes").DataTable({
            "aaData": <?php echo $ResultadoEfectivoInforme; ?>, 
            "aoColumns": [

                                { mData: "Identificacion" },
                                { mData: "Direccion_domicilio" },
                                { mData: "Calificacion_Dir_Domicilio"},
                                { mData: "Ciudad_domicilio" },
                                { mData: "Calificacion_Ciudad_domicilio"},
                                { mData: "Direccion_oficina" },
                                { mData: "Calificacion_Direccion_oficina"},
                                { mData: "Ciudad_oficina" },
                                { mData: "Calificacion_Ciudad_oficina"},
                                { mData: "Telefono_domicilio" },
                                { mData: "Calificacion_Telefono_domicilio"},
                                { mData: "Telefono_oficina" },
                                { mData: "Calificacion_Telefono_oficina"},
                                { mData: "Celular" },
                                { mData: "Calificacion_Celular"},
                                { mData: "Celular_adicional" },
                                { mData: "Calificacion_Celular_adicional"},
                                { mData: "Correo_electronico" },
                                { mData: "Calificacion_Correo_electronico"},
                                { mData: "Direccion_adicional" },
                                { mData: "Calificacion_Direccion_adicional"},
                                { mData: "Ciudad_adicional" },
                                { mData: "Calificacion_Ciudad_adicional"},
                                { mData: "Telefono_adicional" },
                                { mData: "Calificacion_Telefono_adicional"},
                                { mData: "Fecha_modificacion"}
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
             "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var id = aData.NumeroId;
                    $(nRow).attr("dato",id);
                    $(nRow).attr("class",'trobligacion');
                    return nRow;
                   
                },
                "fnDrawCallback": function (oSettings, json) {
                   //Aqui va el comando para activar los otros botones
                   $(".trobligacion").dblclick(function(){
                        var dato = $(this).attr('dato').replace(' ', '');
                        window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+dato+"/17";
                   });
                },
            "buttons":[{
                              extend: 'csv',
                              text: 'Excel',
                              charset: 'utf-8',
                              fieldSeparator : ';',
                              extension: '.csv'
                          }],
            "processing": true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "bSortClasses": false,
            "bDeferRender": true,
            "sPaginationType": "simple",
             "iDisplayLength": 20,
             "aaSorting":[[1,"asc"]],
             "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
             
          });

         // Datos No Gestionados 
         $("#DatosGestionados").DataTable({
            "aaData": <?php echo $DatoSinGestionar; ?>, 
            "aoColumns": [

                                { mData: "Identificacion" },
                                { mData: "Direccion_domicilio" },
                                { mData: "Calificacion_Dir_Domicilio"},
                                { mData: "Ciudad_domicilio" },
                                { mData: "Calificacion_Ciudad_domicilio"},
                                { mData: "Direccion_oficina" },
                                { mData: "Calificacion_Direccion_oficina"},
                                { mData: "Ciudad_oficina" },
                                { mData: "Calificacion_Ciudad_oficina"},
                                { mData: "Telefono_domicilio" },
                                { mData: "Calificacion_Telefono_domicilio"},
                                { mData: "Telefono_oficina" },
                                { mData: "Calificacion_Telefono_oficina"},
                                { mData: "Celular" },
                                { mData: "Calificacion_Celular"},
                                { mData: "Celular_adicional" },
                                { mData: "Calificacion_Celular_adicional"},
                                { mData: "Correo_electronico" },
                                { mData: "Calificacion_Correo_electronico"},
                                { mData: "Direccion_adicional" },
                                { mData: "Calificacion_Direccion_adicional"},
                                { mData: "Ciudad_adicional" },
                                { mData: "Calificacion_Ciudad_adicional"},
                                { mData: "Telefono_adicional" },
                                { mData: "Calificacion_Telefono_adicional"},
                                { mData: "Fecha_modificacion"}
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
             "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    var id = aData.NumeroId;
                    $(nRow).attr("dato",id);
                    $(nRow).attr("class",'trobligacion');
                    return nRow;
                   
                },
                "fnDrawCallback": function (oSettings, json) {
                   //Aqui va el comando para activar los otros botones
                   $(".trobligacion").dblclick(function(){
                        var dato = $(this).attr('dato').replace(' ', '');
                        window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+dato+"/17";
                   });
                },
            "buttons":[{
                              extend: 'csv',
                              text: 'Excel',
                              charset: 'utf-8',
                              fieldSeparator : ';',
                              extension: '.csv'
                          }],
            "processing": true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "bSortClasses": false,
            "bDeferRender": true,
            "sPaginationType": "simple",
             "iDisplayLength": 20,
             "aaSorting":[[1,"asc"]],
             "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
             
          });


        $("#EliminarDatosNoEfectivos").click(function(){
                alertify.confirm("¿Esta seguro que desea eliminar los datos con Calificación No Efectivo ?", function (e) {
                    if (e) {
                            $.ajax({
                                url       : '<?php echo base_url();?>configuraciones/DepurarDatosNoEfectivos',
                                type      : 'POST',
                              
                                success   : function(data){
                                    
                                   if(data == 1){

                                      $("#DatosNoEfecttivos").val('');
                                     
                                      alertify.success("Se realizo la depuración de los datos no efectivos");
                                   }else{
                                      alertify.error("No se puede realizar la depuracion");
                                     
                                   }
                                }
                            });
                        }
                }); 

            });

        $("#CargaDatosMasiva").click(function(){

          var validador = 0;
          if($("#FilExcell2").val().length < 1){
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
                      
                              $("#containerPogresBar2").attr('aria-valuenow', percentComplete);
                              $("#containerPogresBar2").attr('style', "width: "+percentComplete+"%");
                              $("#containerPogresBar2").html(percentComplete + '%');
                            }
                          }, false);

                          return xhr;

                        },
                        url: '<?php echo base_url(); ?>configuraciones/CargarMasivaDatosCLientes', 
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
                  } else {
                      // user clicked "cancel"
                  } 
              });
          }
          
      });

});
</script>
