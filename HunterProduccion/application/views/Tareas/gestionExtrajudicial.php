<?php $tipo = 0;?>
<section class="content-header">
    <h1>
        Detalle - Tarea
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">GESTIONAR - TAREAS</li>
    </ol>
</section>

<section class="content">

	<div class="box">
        <div class="box-body">
        	<div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-left">
              		  <li class="active"><a id="tab1" href="#revenue-chart" data-toggle="tab">Que quieres hacer</a></li>
                  	<li><a id="tab2" href="#revenue-chart2" data-toggle="">Localizado o Ilocalizado</a></li>
           			    <li><a id="tab3" href="#revenue-chart3" data-toggle="">Gestiones</a></li>
           			    <li><a id="tab4" href="#revenue-chart4" data-toggle="">subgestiones</a></li>
                </ul>
                <div class="tab-content no-padding">
                  	<!-- Morris chart - Sales -->
                  	<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: auto;">
                  		<div class="row">
                  			<div class="col-md-2">

                  			</div>
                  			<div class="col-md-8">
                  				<div class="form-group">
                  					<label>Deudor</label>
                  					<select class="form-control" id="SelDeudores">
                  						
                  					</select>
                  				</div>
                  			</div>
                  			<div class="col-md-2">

                  			</div>
                  		</div>
                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
                  		<div class="row" id="opcionesDeudor" style="display:none;">
                  			  <div class="col-md-3">
                            <a  onclick="javascript: getdatosTab1(1792);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-55.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                          </div>
                          <div class="col-md-3">
                            <a  onclick="javascript: getdatosTab1(1795);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-56.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                          </div>
                          <div class="col-md-3">
                            <a  onclick="javascript: getdatosTab1(1793);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-57.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                          </div>

                          <div class="col-md-3">
                            <a  onclick="javascript: getdatosTab1(1794);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-58.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                          </div>
                  		</div>
                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
            		</div>

            		<div class="chart tab-pane" id="revenue-chart2" style="position: relative; height: auto;">
            			<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
            			<div class="row" >
                  			<div class="col-md-3">
                  				&nbsp;
                  			</div>
                  			<div class="col-md-3">
                  				<a  onclick="javascript: getdatosTab2(1780);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-59.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                  			</div>
                  			<div class="col-md-3">
                  				<a  onclick="javascript: getdatosTab2(1781);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-60.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                  			</div>
                  			<div class="col-md-3">
                  				&nbsp;
                  			</div>
                  		</div>

                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>

                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
            		</div>

            		<div class="chart tab-pane" id="revenue-chart3" style="position: relative; height: auto;">
            			<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
            			<div class="row" id="localizado" style="display:none;">
                  			<div class="col-md-3">
                  				<a  onclick="javascript: getdatosTab3(1782);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-61.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                  			</div>
                  			<div class="col-md-3">
                  				<a onclick="javascript: getdatosTab3(1783);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-62.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                  			</div>
                  			<div class="col-md-3">
                  				<a onclick="javascript: getdatosTab3(1784);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-63.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                  			</div>
                  			<div class="col-md-3">
                  				<a onclick="javascript: getdatosTab3(1785);"><img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-64.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
                  			</div>
                  		</div>

                  		<div class="row" id="Ilocalizadosqui" style="display:none;">
                  			<div class="col-md-4" id="IlocalizadosquiGestiones">
                  				Subgestiones :*
                  			</div>
                  			<div class="col-md-8">
                  				<div class="form-group">
                  					<label for="txtObservaciones">Observaciones</label>
                  					<textarea class="form-control" id="txtObservacionesExtrajudiciales2"></textarea>
                  				</div>

                  			</div>
                  		</div>
                  		<div class="row" id="Ilocalizado2" style="display:none;">
                  			<div class="col-md-4">
                  				<button class="btn" id="btnguardarSaltandoUltimo">Guardar</button>
                  			</div>
                  			<div class="col-md-8">
                  				
                  			</div>
                  		</div>
                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>

                  		<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
            		</div>

            		<div class="chart tab-pane" id="revenue-chart4" style="position: relative; height: auto;">
            			<div class="row" >
                  			<div class="col-md-12">
                  				&nbsp;
                  			</div>
              
                  		</div>
            			<div class="row" >
                  			<div class="col-md-7" id="subgestionesFinales">
                  				Subgestiones :*
                  			</div>
                  			<div class="col-md-5">
                  				<div class="form-group">
                  					<label for="txtObservaciones">Observaciones</label>
                  					<textarea class="form-control" id="txtObservacionesExtrajudiciales"></textarea>
                  				</div>
                  		
                  			</div>
                  		</div>
                  		<div class="row">
                  			<div class="col-md-4">
                  				<button class="btn" id="btnGuardarExtrajudicial">Guardar</button>
                  			</div>
                  			<div class="col-md-8">
                  				
                  			</div>
                  		</div>
            		</div>
                </div>
          	</div><!-- /.nav-tabs-custom -->	
        </div> 
    </div>       
</section><!-- /.content -->

<script type="text/javascript">
var numeroContrato = 0;
var nombreContrato= '';
var comunicacion = 0;
var resultadocomunicacion = 0;
var gestion = 0;
var subgestion  = 0;
var etapa = 0;
var medidaCautelar = 0;
var ontrato = 0;
var tarea = 0;
var dondeVino = 0;
<?php 

	foreach ($tareas as $key ) {
?>		
		numeroContrato = <?php echo $key->contrato_ejecucion ;?>;
    tarea = <?php echo $key->G738_ConsInte__b; ?>;
    tipificacion = <?php echo $key->tipificacion; ?>;
    garantia = <?php echo $key->cedula; ?>;
    vista = <?php echo $key->vista; ?>;

<?php 
	}
?>
tar = {
  guardarTareas : function(){
      $.ajax({
        url     : '<?php echo base_url();?>tareas/EditarTareas/',
        type    : 'POST',
        data    : { id : tarea},
        success : function(data){
            if(data == '1'){
                tar.refrescar();
                if(tipificacion == 1){
                    window.location.href= "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+"/"+vista;
                }else{
                    window.location.href= "<?php echo base_url();?>extrajudicial/gestionar/"+garantia+"/"+vista; 
                }
            }
        }
      });
  },

  refrescar : function(){
      $.ajax({
          url    : '<?php echo base_url();?>tareas/getTareas',
          type   : 'POST',
          success: function(data){
              $("#menuTask").html(data);
          }
      });
  }

}

	$(function(){
    
    $.ajax({
      url     : '<?php echo base_url();?>auxiliar/getIdContrato/',
      type    : 'POST',
      data : { liquidacion : numeroContrato },
      success : function(data){
          if(data.length > 0){
              ontrato = data;
              $.ajax({
                  url    : '<?php echo base_url();?>cartera_fng/getdatosDeudores/'+ data,
                  dataType : 'json',
                  success  : function(data){
                      var select = '<option value="0">Seleccione un deudor</option>';
                      $.each(data, function(i, item) {
                          select += '<option value="'+ item.id +'">'+ item.deudor+'</option>';
                      });
                      
                      $("#SelDeudores").html(select);

                      $("#SelDeudores").change(function(){
                          $("#opcionesDeudor").show();
                          var Jsoe = $("#tareasEstaVaina").val();
                          $("#tareasEstaVaina").val(Jsoe + ' ' + $("#SelDeudores option:selected").text());
                      });
                  }
              });
          }
      } 
    });


    $("#btnGuardarExtrajudicial").click(function(){
      alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
          if (e) {
            debugger;
              $.ajax({
                      url       : '<?php echo base_url();?>cartera_fng/guardarExtrajudicialTarea',
                      type      : 'POST',
                      data      : {
                                    subgestion : $('input:radio[name=cafeSeleccionado]:checked').val() ,
                                    cliente  : $("#SelDeudores").val(),
                                    contrato  : ontrato ,
                                    gestion : gestion,
                                    resultadocomunicacion  : resultadocomunicacion ,
                                    mediocomunicacion : comunicacion,
                                    txtObservaciones : $("#txtObservacionesExtrajudiciales").val()
                                  },
                      success   : function(data){
                         if(data == 1){
                            //$("#Modal-Menu-Extrajudicial").modal('hide');
                           // fng.extrajudicial(numeroContrato);
                            $("#SelDeudores").val(0);
                            $("#opcionesDeudor").hide();
                            $("#txtObservacionesExtrajudiciales").val('');
                            $("input:radio[name=cafeSeleccionado]").prop("checked", false);
                            $("#tab2").attr('data-toggle',' ');
                            $("#tab3").attr('data-toggle',' ');
                            $("#tab4").attr('data-toggle',' ');
                            $("#tab1").attr('data-toggle','tab');
                            $("#tab1").click();
                            $("#Modal-Menu-Extrajudicial").modal('hide');
                            tar.guardarTareas();
                            alertify.success("Gestión Extrajudicial guardada satisfactoriamente");
                         }else{
                            alertify.error("Gestión Extrajudicial, No se pudo guardar");
                           
                         }
                      }
                  });
          } else {
              // user clicked "cancel"
          }
      });
    });

		/*$("#btnGuardarExtrajudicial").click(function(){
			var confirmado =  confirm("¿Esta seguro que desea guardar el registro?");
            if(confirmado == true){
                
                $.ajax({
                    url       : '<?php //echo base_url();?>cartera_fng/guardarExtrajudicial',
                    type      : 'POST',
                    data      : {
                                  subgestion : $('input:radio[name=cafeSeleccionado]:checked').val() ,
                                  cliente  : $("#SelDeudores").val(),
                                  contrato  : ontrato ,
                                  gestion : gestion,
                                  resultadocomunicacion  : resultadocomunicacion ,
                                  mediocomunicacion : comunicacion,
                                  txtObservaciones : $("#txtObservacionesExtrajudiciales").val()
                                },
                    success   : function(data){
                       if(data == 1){
                          $("#Modal-Menu-Extrajudicial").modal('hide');
                         // fng.extrajudicial(ontrato);
                          alertify.success("Gestión Extrajudicial guardada satisfactoriamente");
                       }else{
                          alertify.error("Gestión Extrajudicial, No se pudo guardar");
                         
                       }
                    }
                });
            }else{

            }
		});*/


		
    $("#btnguardarSaltandoUltimo").click(function(){
      alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
          if (e) {
              $.ajax({
                      url       : '<?php echo base_url();?>cartera_fng/guardarExtrajudicial2Tarea',
                      type      : 'POST',
                      data      : {
                                    cliente  : $("#SelDeudores").val(),
                                    contrato  : ontrato ,
                                    gestion : $('input:radio[name=localizadoSeleccionado]:checked').val(),
                                    resultadocomunicacion  : resultadocomunicacion ,
                                    mediocomunicacion : comunicacion,
                                    txtObservaciones : $("#txtObservacionesExtrajudiciales2").val()
                                  },
                      success   : function(data){
                         if(data == 1){
                            //$("#Modal-Menu-Extrajudicial").modal('hide');
                          // fng.extrajudicial(numeroContrato);
                            $("#SelDeudores").val(0);
                            $("#opcionesDeudor").hide();
                              $("#txtObservacionesExtrajudiciales").val('');
                            $("input:radio[name=cafeSeleccionado]").prop("checked", false);
                            $("#tab2").attr('data-toggle',' ');
                            $("#tab3").attr('data-toggle',' ');
                            $("#tab4").attr('data-toggle',' ');
                            $("#tab1").attr('data-toggle','tab');
                            $("#tab1").click();
                            $("#Modal-Menu-Extrajudicial").modal('hide');
                            tar.guardarTareas();
                            alertify.success("Gestión Extrajudicial guardada satisfactoriamente");
                         }else{
                            alertify.error("Gestión Extrajudicial, No se pudo guardar");
                           
                         }
                      }
                  });
          } else {
              // user clicked "cancel"
          }
      });
      
    });

		/*$("#btnguardarSaltandoUltimo").click(function(){
			var confirmado =  confirm("¿Esta seguro que desea guardar el registro?");
            if(confirmado == true){
                
                $.ajax({
                    url       : '<?php //echo base_url();?>cartera_fng/guardarExtrajudicial2',
                    type      : 'POST',
                    data      : {
                                  cliente  : $("#SelDeudores").val(),
                                  contrato  : ontrato ,
                                  gestion : $('input:radio[name=localizadoSeleccionado]:checked').val(),
                                  resultadocomunicacion  : resultadocomunicacion ,
                                  mediocomunicacion : comunicacion,
                                  txtObservaciones : $("#txtObservacionesExtrajudiciales2").val()
                                },
                    success   : function(data){
                       if(data == 1){
                          $("#Modal-Menu-Extrajudicial").modal('hide');
                          //fng.extrajudicial(numeroContrato);
                          alertify.success("Gestión Extrajudicial guardada satisfactoriamente");
                       }else{
                          alertify.error("Gestión Extrajudicial, No se pudo guardar");
                         
                       }
                    }
                });
            }else{

            }
		});*/

	});

	function getdatosTab1(queQuieresHacerSeleccionado){
		$("#tab2").attr('data-toggle','tab');
		$("#tab2").click();
		comunicacion = queQuieresHacerSeleccionado;
	}

	function getdatosTab2(localizadoSeleccionado){
		$("#tab1").attr('data-toggle','');
		$("#tab3").attr('data-toggle','tab');
		resultadocomunicacion = localizadoSeleccionado;

		if(localizadoSeleccionado == 1780){
			$("#localizado").show();
			$("#ilocalizado").hide();
		}else{
			$("#localizado").hide();
			$("#Ilocalizadosqui").show();
			$("#Ilocalizado2").show();
			
			$.ajax({
	            url      : "<?php echo base_url();?>cartera_fng/eventoBotonIlocalizado",
	            type     : "POST",
	       
	            data     : { localizadoSeleccionado : localizadoSeleccionado },
	            success  : function(data){
	                $("#IlocalizadosquiGestiones").html('Subgestiones :* '+ data);
	            }
	        });
		}

		$("#tab3").click();
	}


	function getdatosTab3(cafeSeleccionado){
		$("#tab2").attr('data-toggle','tab');
		$("#tab4").attr('data-toggle','tab');
		gestion = cafeSeleccionado;
		$.ajax({
            url      : "<?php echo base_url();?>cartera_fng/getSubgestiones",
            type     : "POST",
       
            data     : { cafeSeleccionado : cafeSeleccionado },
            success  : function(data){
                $("#subgestionesFinales").html('Subgestiones :* '+ data);
            }
        });

        $("#tab4").click();
		
	}

	function getMedidas(varId){
		medidaCautelar = varId;
		$("#getsionMedidas2").attr('data-toggle' ,'tab');
		$("#getsionMedidas2").click();
	}

	function soloHoraMayor(valorCampo) {
		var error = 0;
		var hora = new Date();
		h = valorCampo.split(":")[0];
		m = valorCampo.split(":")[1];
		//alert (h);
		//alert (m);
		h1 = hora.getHours();
		m1 = hora.getMinutes();
		//alert (h1);
		//alert (m1);
	
		if(h1 > h){
			error = 1;
		}else if (h1 == h){
			if (m1 > m){
				error = 1;
			}
		}

		return (error);
	}

	function getFechaHOy(datenow){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 

		var dia = datenow.split("-")[2];
		var mes = datenow.split("-")[1];
		var ano = datenow.split("-")[0];

		var res = 0;

		var f1 = new Date(yyyy, mm, dd); 
		var f2 = new Date(ano, mes, dia, 2);
		f1.setHours(0,0,0,0);
		f2.setHours(0,0,0,0);
		if (f1.getTime() == f2.getTime()){
		   res = 1;
		}

		return res;
	}

	function restaFechas(f1,f2){
		var aFecha1 = f1.split('-'); 
		var aFecha2 = f2.split('-'); 
		var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
		var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
		var dif = fFecha2 - fFecha1;
		var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
		return dias;
 	}

 	function sumaFecha(d, fecha){
 		fecha = fecha.split('-');

 		newfecha = fecha[1] + "/" + fecha[2] + "/" + fecha[0];

		var Fecha = new Date();
		var sFecha = newfecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
		var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
		var aFecha = sFecha.split(sep);
		var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
		fecha= new Date(newfecha);
		fecha.setDate(fecha.getDate()+parseInt(d));
		var anno=fecha.getFullYear();
		var mes= fecha.getMonth()+1;
		var dia= fecha.getDate();
		mes = (mes < 10) ? ("0" + mes) : mes;
		dia = (dia < 10) ? ("0" + dia) : dia;
		sep = '-';
		var fechaFinal = anno+sep+mes+sep+dia;

		return (fechaFinal);
 	}

</script>