<section class="content-header">
    <h1>
        ASIGNACIÓN - ABOGADOS 
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Asignación - Abogados</li>
    </ol>
</section>

<section class="content">

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">¿Qué tipo de asignación desea hacer?</h3>
      <?php echo cambiar(' ') ?>
		</div>
        <div class="box-body">
    	 	<div class="row">
    	 		
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
    	 		<div class="col-sm-4">
             
          </div>
    	 	</div>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->


<div class="box" id="cargueMasivo" style="display:none;">
		<div class="box-header with-border">
			<h3 class="box-title">Asignación por cargue masivo</h3>
		</div>
    <div class="box-body">
    	 	<form class="form-horizontal" action="<?php echo base_url(); ?>asignacion/carguemasABogados" method="POST" id="formCargeMasivoAbogados" enctype="multipart/form-data">
            <div class="form-group">
              	<label for="inputEmail3" class="col-sm-2 control-label">Asignado por:</label>
              	<div class="col-sm-10">
                	<select id="cmbFiltros" name="filtro" class="form-control">
                      <option value="NroProcesoJudicialSAP">No. Proceso SAP</option>
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
            <button type="button" id="btncarguedos" class="btn btn-primary">Asignar Abogado</button>
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
                        <option value="NroProcesoJudicialSAP">No. Proceso SAP</option>
                  	</select>
              	</div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">No. Proceso SAP</label>
                <div class="col-sm-10">
                    <input type="text"  name="txtnumeroSap" id="txtnumeroSap" class="form-control"> 
                </div>
            </div>
                
    	      <div class="form-group">
              	<label for="inputEmail3" class="col-sm-2 control-label">Abogado</label>
              	<div class="col-sm-10">
                	<select name="cmbabogados" id="cmbabogados" class="form-control">
                      <option value="0">Seleccione un abogado</option>
                        <?php
                         foreach ($otroAbogad as $key) {
                            echo "<option value='".$key->id."''>".utf8_encode($key->Nombre)."</option>";
                        }
                        ?>
                  	</select>
              	</div>
            </div>

    				<div class="form-group">
  					    <label for="inputEmail3" class="col-sm-2 control-label">Fecha de asignación</label>
              	<div class="col-sm-10">
                		<div class="input-group">
  							        <div class="input-group-addon">
  								         <i class="fa fa-calendar"></i>
  							        </div>
  							         <input type="text" class="form-control" id="txtfecha" name="fechas" required placeholder= "dd/mm/yyyy">
        						</div><!-- /.input group -->
              	</div>
				    </div><!-- /.form group -->
        
    </div><!-- /.box -->   
	  <div class="box-footer">
        <button type="button" class="btn btn-default">Cancelar</button>
        <button type="button" id="botonSolo" class="btn btn-primary">Asignar Abogado</button>
  	</div><!-- /.box-footer -->
    </form> 
</div>



<?php
    function cambiar ($div){
        $n_div= str_replace(" ","-",$div);
        $n_div=str_replace("á","a",$n_div);
        $n_div=str_replace("é","e",$n_div);
        $n_div=str_replace("í","i",$n_div);
        $n_div=str_replace("ó","o",$n_div);
        $n_div=str_replace("ú","u",$n_div);
        $n_div=str_replace("ä","a",$n_div);
        $n_div=str_replace("ë","e",$n_div);
        $n_div=str_replace("ï","i",$n_div);
        $n_div=str_replace("ö","o",$n_div);
        $n_div=str_replace("ü","u",$n_div);
        $n_div=str_replace("ñ", "n", $n_div);
        $n_div=str_replace("Ñ", "N", $n_div);
        //al final retornamos la cadena limpia y pura
        return $n_div;

    }
?>

</section>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">

	$(function () {


      $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-mm-dd",
            titleFormat: "dd/mm/yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };


      $("#txtfecha").datepicker({
          language: "es",
          autoclose: true,
          todayHighlight: true
      });

  		$("#masivo").click(function(){
  			  $("#cargueMasivo").show();
  			  $("#cargueunoaunoSki").hide();
  			  $("#carguePoliza").hide();
  		});

  		$("#unouno").click(function(){
  			 $("#cargueMasivo").hide();
  			 $("#cargueunoaunoSki").show();
         $("#carguePoliza").hide();
  		});

      $("#poliza").click(function(){
          $("#cargueMasivo").hide();
          $("#cargueunoaunoSki").hide();
          $("#carguePoliza").show();
      });

      $("#botonSolo").click(function(){
         var validador = 0;
          if($("#cmbabogados").val() == '0'){
              alertify.error('Debe seleccionar un abogado, para signarle los casos');
              validador = 1;
          }

          if($("#txtnumeroSap").val().length < 1){
              alertify.error('Debe escribir el número del proceso');
              validador = 1;
          }

          if($("#txtfecha").val().length < 1){
              alertify.error('Debe escribir la fecha en la que se asigno el abogado!');
              validador = 1;
          }

          if(validador == 0){
              alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                if (e) {
                    var otherForm = $("#formSOlo");
                    $.ajax({
                        url: '<?php echo base_url(); ?>asignacion/SUperCargueABogados',  
                        type: 'POST',
                        data: { txtnumeroSap :  $("#txtnumeroSap").val(), cmbAbogados: $("#cmbabogados").val(), filtro : $("#cmbFiltros2").val(), txtfecha :  $("#txtfecha").val()},
                        success : function(data){
                            if(data == 1){
                                alertify.success("Registro guardado!");
                                otherForm[0].reset();
                            }else if(data == 'NOP'){
                                alertify.error("El número SAP no es valido!");
                               // otherForm[0].reset();
                            }
                        }
                    });
                } else {
                      // user clicked "cancel"
                } 
              });
          }

      });

      $("#btncarguedos").click(function(){
         
          var validador = 0;
          
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
                        url: '<?php echo base_url(); ?>asignacion/carguemasAbogadosSuperFNG',  
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
                          if(data.valid == "1"){
                             alertify.success("La cantidad  de registros son "+ data.registros +", asignados "+ data.total + ", " + data.noexisten + " no se pudieron asignar porque no existen en la base de datos ");
                              otherForm[0].reset();
                            }
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
    

      $("#btncarguedos2").click(function(){
         
          var validador = 0;
          

          if($("#FilExcell2").val().length < 1){
              alertify.error('Debe seleccionar un Archivo, para cargar');
              validador = 1;
          }

          if(validador == 0){
              alertify.confirm("¿Esta seguro de esta operación?", function (e) {
                  if (e) {
                    var otherForm = $("#formCargeMasivoAbogados2");
                    var formData = new FormData($("#formCargeMasivoAbogados2")[0]);
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
                        url: '<?php echo base_url(); ?>asignacion/carguemasPoliza',  
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend : function() {
                            /*$.blockUI({ message: $("#containerPogresBar") });*/
                            $("#mostrarPorcentaje").show();
                            $("#cmbFiltros2").prop('disabled', true);
                            $("#FilExcell2").prop('disabled', true);
                            
                            $("#ResetForm1").prop('disabled', true);
                            $("#btncarguedos2").prop('disabled', true);


                            $("#progressbarComercial2").addClass('progress-bar-striped');
                            $("#progressbarComercial2").addClass('active');
                        },
                        //una vez finalizado correctamente
                        success: function(data){
                          if(data.valid == "1"){
                             alertify.success("La cantidad  de registros son "+ data.registros +", asignados "+ data.total + ", " + data.noexisten + " no se pudieron asignar porque no existen en la base de datos ");
                              otherForm[0].reset();
                            }
                        },
                        complete: function(){
                          
                          $("#cmbFiltros2").prop('disabled', false);
                          $("#FilExcell2").prop('disabled', false);
                          


                          $("#ResetForm12").prop('disabled', false);
                          $("#btncarguedos2").prop('disabled', false);



                          $("#progressbarComercial2").removeClass('progress-bar-striped');
                          $("#progressbarComercial2").removeClass('active');
                          $("#progressbarComercial2").attr('aria-valuenow', '0');
                          $("#progressbarComercial2").attr('style', "width: 0%");
                          $("#mostrarPorcentaje2").hide();
                        },
                        //si ha ocurrido un error
                        error: function(){
                          /*$.unblockUI();*/
                            $("#cmbFiltros2").prop('disabled', false);
                            $("#FilExcell2").prop('disabled', false);
                         


                            $("#ResetForm12").prop('disabled', false);
                            $("#btncarguedos2").prop('disabled', false);

                            $("#progressbarComercial2").removeClass('progress-bar-striped');
                            $("#progressbarComercial2").removeClass('active');
                            $("#progressbarComercial2").attr('aria-valuenow', '0');
                            $("#progressbarComercial2").attr('style', "width: 0%");
                            $("#mostrarPorcentaje2").hide();
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
