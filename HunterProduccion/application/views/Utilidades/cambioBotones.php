<section class="content-header">
    <h1>
        Cambiar botones
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Utilidades</li>
    </ol>
</section>

<section class="content">
	<div class="box">
        <div class="box-body">
			<a class="btn btn-app" id="edit">
				<i class="fa fa-edit"></i> Editar
			</a>
			<a class="btn btn-app" id="Save" disabled>
				<i class="fa fa-save"></i> Guardar
			</a>
			<a class="btn btn-app" id="cancel" disabled>
				<i class="fa fa-close"></i> Cancelar
			</a>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->
  	<form id="cambioImagenes"  action="<?php echo base_url(); ?>utilidades/cambiarImagenes" method="POST"  enctype="multipart/form-data">
  		<div class="box">
			<div class="box-header with-border">
				<h4>Hoja de datos del cliente</h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-70.png" style=" width: 150px; height: auto;" id="ImgGesExtraJudicial">	

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="GesExtraJudicial" name="GesExtraJudicial" class="form-control">
			          		<input type="hidden" name="HidGesExtraJudicial" id="HidGesExtraJudicial" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-71.png" style=" width: 150px; height: auto;" id="ImgGesJudicial">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="GesJudicial" name="GesJudicial" class="form-control">
			                <input type="hidden" name="HidGesJudicial" id="HidGesJudicial" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-72.png" style=" width: 150px; height: auto;" id="ImgSimulador">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="Simulador" name="Simulador" class="form-control">
			                <input type="hidden" name="HidSimulador" id="HidSimulador" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-69.png" style=" width: 150px; height: auto;" id="ImgGestionarTodas">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="GestionarTodas" name="GestionarTodas" class="form-control">
			                <input type="hidden" name="HidGestionarTodas" id="HidGestionarTodas" value = '0'>
			          	</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-68.png" style=" width: 150px; height: auto;" id="ImgLibretoCall">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="LibretoCall" name="LibretoCall" class="form-control">
			                <input type="hidden" name="HidLibretoCall" id="HidLibretoCall" value = '0'>
			          	</div>
					</div>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box">
			<div class="box-header with-border">
				<h4>Gestión Judicial</h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/judicial/botones-73.png" style=" width: 150px; height: auto;" id="ImgMisprocesosVigentes">	

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="MisprocesosVigentes" name="MisprocesosVigentes" class="form-control"><input type="hidden" name="HidMisprocesosVigentes" id="HidMisprocesosVigentes" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/judicial/botones-74.png" style=" width: 150px; height: auto;" id="ImgMisprocesosIrrecuperables">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="MisprocesosIrrecuperables" name="MisprocesosIrrecuperables" class="form-control">
			                <input type="hidden" name="HidMisprocesosIrrecuperables" id="HidMisprocesosIrrecuperables" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/judicial/botones-75.png" style=" width: 150px; height: auto;" id="ImgMisProcesosVendidos">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="MisProcesosVendidos" name="MisProcesosVendidos" class="form-control">
			                <input type="hidden" name="HidMisProcesosVendidos" id="HidMisProcesosVendidos" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/judicial/botones-77.png" style=" width: 150px; height: auto;" id="ImgBusquedaAvanzada">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="BusquedaAvanzada" name="BusquedaAvanzada" class="form-control">
			                <input type="hidden" name="HidBusquedaAvanzada" id="HidBusquedaAvanzada" value = '0'>
			          	</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/judicial/botones-78.png" style=" width: 150px; height: auto;" id="ImgMisProcesosPazYsalvo">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="MisProcesosPazYsalvo" name="MisProcesosPazYsalvo" class="form-control">
			                <input type="hidden" name="HidMisProcesosPazYsalvo" id="HidMisProcesosPazYsalvo" value = '0'>
			          	</div>
					</div>
				</div>
			</div><!-- /.box-body -->


		<div class="box">
			<div class="box-header with-border">
				<h4>Gestión Extrajudicial</h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-43.png" style=" width: 150px; height: auto;" id="ImgClientesNuevos">	

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="ClientesNuevos" name="ClientesNuevos" class="form-control">
			                <input type="hidden" name="HidClientesNuevos" id="HidClientesNuevos" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-44.png" style=" width: 150px; height: auto;" id="ImgClienteDatosNuevos">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="ClienteDatosNuevos" name="ClienteDatosNuevos" class="form-control">
			          		<input type="hidden" name="HidClienteDatosNuevos" id="HidClienteDatosNuevos" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-45.png" style=" width: 150px; height: auto;" id="ImgVlaorAdeudado">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="VlaorAdeudado" name="VlaorAdeudado" class="form-control">
			                <input type="hidden" name="HidVlaorAdeudado" id="HidVlaorAdeudado" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-46.png" style=" width: 150px; height: auto;" id="ImgAcuerdoDepago">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="AcuerdoDepago" name="AcuerdoDepago" class="form-control">
			                <input type="hidden" name="HidAcuerdoDepago" id="HidAcuerdoDepago" value = '0'>
			          	</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-48.png" style=" width: 150px; height: auto;" id="ImgClientesVigentesExtrajudicial">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="ClientesVigentesExtrajudicial" name="ClientesVigentesExtrajudicial" class="form-control">
			                <input type="hidden" name="HidClientesVigentesExtrajudicial" id="HidClientesVigentesExtrajudicial" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-49.png" style=" width: 150px; height: auto;" id="ImgBusquedavanzadaExtrajudicial">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="BusquedavanzadaExtrajudicial" name="BusquedavanzadaExtrajudicial" class="form-control">
			                <input type="hidden" name="HidBusquedavanzadaExtrajudicial" id="HidBusquedavanzadaExtrajudicial" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-66.png" style=" width: 150px; height: auto;" id="ImgObligacionesVendidas">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="ObligacionesVendidas" name="ObligacionesVendidas" class="form-control">
			                <input type="hidden" name="HidObligacionesVendidas" id="HidObligacionesVendidas" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/extrajudicial/botones-65.png" style=" width: 150px; height: auto;" id="ImgPazySalv">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="PazySalv" name="PazySalv" class="form-control">
			                <input type="hidden" name="HidPazySalv" id="HidPazySalv" value = '0'>
			          	</div>
					</div>

				</div>



				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/Extrajudicial/botones-50.png" style=" width: 150px; height: auto;" id="ImgBoton1">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="Boton1" name="Boton1" class="form-control">
			                <input type="hidden" name="HidBoton1" id="HidBoton1" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/Extrajudicial/botones-51.png" style=" width: 150px; height: auto;" id="ImgBoton2">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="Boton2" name="Boton2" class="form-control">
			                <input type="hidden" name="HidBoton2" id="HidBoton2" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/Extrajudicial/botones-52.png" style=" width: 150px; height: auto;" id="ImgBoton3">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="Boton3" name="Boton3" class="form-control">
			                <input type="hidden" name="HidBoton3" id="HidBoton3" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/Extrajudicial/botones-53.png" style=" width: 150px; height: auto;" id="ImgBoton4">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="Boton4" name="Boton4" class="form-control">
			                <input type="hidden" name="HidBoton4" id="HidBoton4" value = '0'>
			          	</div>
					</div>
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/botones/Extrajudicial/botones-54.png" style=" width: 150px; height: auto;" id="ImgBoton5">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="Boton5" name="Boton5" class="form-control">
			                <input type="hidden" name="HidBoton5" id="HidBoton5" value = '0'>
			          	</div>
					</div>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box">
			<div class="box-header with-border">
				<h4>Botones Medidas cautelares</h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoInmueble.png" style=" width: 150px; height: auto;" id="ImgembargoInmueble">	

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoInmueble" name="embargoInmueble" class="form-control">
			                <input type="hidden" name="HidembargoInmueble" id="HidembargoInmueble" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoVehiculo.png" style=" width: 150px; height: auto;"  id="ImgembargoVehiculo">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoVehiculo" name="embargoVehiculo" class="form-control">
			          		<input type="hidden" name="HidembargoVehiculo" id="HidembargoVehiculo" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoEstabComercio.png" style=" width: 150px; height: auto;" id="ImgembargoEstabComercio">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoEstabComercio" name="embargoEstabComercio" class="form-control">
			                <input type="hidden" name="HidembargoEstabComercio" id="HidembargoEstabComercio" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoRetenSalario.png" style=" width: 150px; height: auto;" id="ImgembargoRetenSalario">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoRetenSalario" name="embargoRetenSalario" class="form-control">
			                <input type="hidden" name="HidembargoRetenSalario" id="HidembargoRetenSalario" value = '0'>
			          	</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoRetenCuentasAhCorr.png" style=" width: 150px; height: auto;" id="ImgembargoRetenCuentasAhCorr">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoRetenCuentasAhCorr" name="embargoRetenCuentasAhCorr" class="form-control">
			                <input type="hidden" name="HidembargoRetenCuentasAhCorr" id="HidembargoRetenCuentasAhCorr" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoRemanentes.png" style=" width: 150px; height: auto;" id="ImgembargoRemanentes">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoRemanentes" name="embargoRemanentes" class="form-control">
			                <input type="hidden" name="HidembargoRemanentes" id="HidembargoRemanentes" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoSecuestroBienes.png" style=" width: 150px; height: auto;" id="ImgembargoSecuestroBienes">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoSecuestroBienes" name="embargoSecuestroBienes" class="form-control">
			                <input type="hidden" name="HidembargoSecuestroBienes" id="HidembargoSecuestroBienes" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoRazonSocial.png" style=" width: 150px; height: auto;" id="ImgembargoRazonSocial">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoRazonSocial" name="embargoRazonSocial" class="form-control">
			                <input type="hidden" name="HidembargoRazonSocial" id="HidembargoRazonSocial" value = '0'>
			          	</div>
					</div>

				</div>



				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoMaqEquipo.png" style=" width: 150px; height: auto;" id="ImgembargoMaqEquipo">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoMaqEquipo" name="embargoMaqEquipo" class="form-control">
			                <input type="hidden" name="HidembargoMaqEquipo" id="HidembargoMaqEquipo" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoAcciones.png" style=" width: 150px; height: auto;" id="ImgembargoAcciones">

						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoAcciones" name="embargoAcciones" class="form-control">
			                <input type="hidden" name="HidembargoAcciones" id="HidembargoAcciones" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoCuotasParticipacion.png" style=" width: 150px; height: auto;" id="ImgembargoCuotasParticipacion">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoCuotasParticipacion" name="embargoCuotasParticipacion" class="form-control">
			                <input type="hidden" name="HidembargoCuotasParticipacion" id="HidembargoCuotasParticipacion" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoPosesion.png" style=" width: 150px; height: auto;" id="ImgembargoPosesion">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoPosesion" name="embargoPosesion" class="form-control">
			                <input type="hidden" name="HidembargoPosesion" id="HidembargoPosesion" value = '0'>
			          	</div>
					</div>
					
				</div>


				<div class="row">
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoCreditos.png" style=" width: 150px; height: auto;" id="ImgembargoCreditos">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoCreditos" name="embargoCreditos" class="form-control">
			                <input type="hidden" name="HidembargoCreditos" id="HidembargoCreditos" value = '0'>
			          	</div>
					</div>
					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoUsufructo.png" style=" width: 150px; height: auto;" id="ImgembargoUsufructo">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoUsufructo" name="embargoUsufructo" class="form-control">
			                <input type="hidden" name="HidembargoUsufructo" id="HidembargoUsufructo" value = '0'>
			          	</div>
					</div>

					<div class="col-md-3">
						<img src="<?php echo base_url();?>assets/img/medidas/embargoGarantiaInmob.png" style=" width: 150px; height: auto;" id="ImgembargoGarantiaInmob">
						<div class="form-group">
			              	<label for="FilExcell" class="control-label">Nueva Imagen</label>
			                <input type="file" id="embargoGarantiaInmob" name="embargoGarantiaInmob" class="form-control">
			                <input type="hidden" name="HidembargoGarantiaInmob" id="HidembargoGarantiaInmob" value = '0'>
			          	</div>
					</div>
				</div>


			</div><!-- /.box-body -->
		</div><!-- /.box -->
  	</form>
  	
</section>

<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">
	var hiden = null;
	$(function(){
		$(".form-control").each(function(){
			$(this).attr('disabled', true);
		});

		$("#edit").click(function(){
			$(".form-control").each(function(){
				$(this).attr('disabled', false);
			});
			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
		});

		$("#cancel").click(function(){
			$(".form-control").each(function(){
				$(this).attr('disabled', true);
			});
			$("#edit").attr('disabled', false);
			$("#Save").attr('disabled', true);
			$(this).attr('disabled', true);
		});

		
		$("#Save").click(function(){
			alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
				if (e) {
		  			var formData = new FormData($("#cambioImagenes")[0]);
		          	$.ajax({
		            	url: '<?php echo base_url();?>utilidades/cambiarImagenes',  
		            	type: 'POST',
			            data: formData,
		            	cache: false,
		            	contentType: false,
		            	processData: false,
			            //una vez finalizado correctamente
			            success: function(data){
			            	if($.trim(data) == '1'){
			            		$("#cambioImagenes")[0].reset();
			            		alertify.success('Datos ingresados Imagene cambiadas correctamente');
			            		window.location.reload(true);
			            	}else{
			            		alertify.error('Un error a ocurrido');
			            	}
			               
			                
			            },
			            //si ha ocurrido un error
			            error: function(){
			                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
			            }
			        });
				  		
				} else {
				        // user clicked "cancel"
			    }	
			}); 
		});
		//cambioImagenes


		$(".form-control").change(function(e) {
            addImage2(e);
            hiden = $(this).attr('name'); 
            $("#Hid"+hiden).val(1);
           // alert("Hola Cambie" + e.target.files[0]);
        });

        function addImage2(e){
            var file = e.target.files[0],
            imageType = /image.*/;

            if (!file.type.match(imageType))
                return;

            var reader = new FileReader();
            reader.onload = fileOnload2;
            reader.readAsDataURL(file);
        }

        function fileOnload2(e) {
            var result= e.target.result;
            $('#Img'+hiden).attr("src",result);
        }
	});
</script>