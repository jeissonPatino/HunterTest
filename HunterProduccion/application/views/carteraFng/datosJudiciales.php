<section class="content-header">
    <h1>
        <?php  
        $tipo_Proceso = 0;
		if(isset($vista)){
			switch ($vista) {
				case '1':
				//viene de Clientes nuevos
					echo 'CARTERA FNG - MIS PROCESOS VIGENTES';	
					break;

				case '2':
				//viene de Clientes nuevos
					echo 'CARTERA FNG - MIS PROCESOS IRRECUPERABLES ';	
					break;
				case '3':
				//viene de clientes con datos nuevos
					echo 'CARTERA FNG - MIS PROCESOS VENDIDOS';
					break;

				case '4':
				//viene de clientes con acuerdo de pago
					echo 'CARTERA FNG - BÚSQUEDA AVANZADA';
					break;

				case '5':
				//viene de clientes con acuerdo de pago
					echo 'CARTERA FNG - OBLIGACIONES CON PAZ Y SALVO';
					break;
			}
		}else{
			//viene de Clientes nuevos
			echo 'CARTERA FNG - MIS PROCESOS VIGENTES';
		}
		
	?>
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
    </ol>
</section>

<style type="text/css">
  a {
    cursor: pointer;
  }
  img {
  	width: 100px;
	height: 75px;
  }
  .datepicker{
    z-index:10000 !important;
   }
</style>

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-datos-extrajudicial">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda">Gestiones extrajudiciales</h4>
            </div>
            <div class="modal-body" id="datosGestionExtraJudicial">
                
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-iniciales">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >Datos iniciales del titular</h4>
            </div>
            <div class="modal-body" >
                <form id="FrmIniciales" method="post">
					<input type="hidden" id="const_int_" name="id" value="0">
					<input type="hidden" id="const_int_user" name="ID_PERSONAS" value="<?php echo $idUsuario;?>">
					<input type="hidden" id="IdentificacionUsers" name="IdentificacionUsers" value="<?php echo $identificacion;?>">
					<h3>Datos iniciales del titular</h3>
					<div class="row">
						<div class="col-md-8">
						<?php foreach ($cliente as $key) { ?>
							<div class="form-group">
								<Label>Dirección domicilio</Label>
								<input type="text" class="form-control" placeholder="Dirección domicilio" value="<?php echo $key->DireccionD;?>" id="direccion_domicilio" name="direccion_domicilio" >
							</div>
							<div class="form-group">
								<Label>Ciudad domicilio</Label>
								<select class="form-control" id="ciudad_domicilio" name="ciudad_domicilio" >
									<option value="0">Seleccione</option>
									<?php foreach ($ciudades as $keya ) {?>
										<option value='<?php echo $keya->id ;?>'><?php echo utf8_encode($keya->ciudad) ;?></option>
									<?php } ?>
								</select>

								<script type="text/javascript">
									$(function(){
										$("#ciudad_domicilio option").filter(function() {
										    //may want to use $.trim in here
										    return $(this).val() == <?php echo $key->G717_C17012 ;?>; ; 
										}).prop('selected', true);
									});
								</script>
							</div>
							<div class="form-group">
								<Label>Dirección oficina</Label>
								<input type="text" class="form-control" placeholder="Dirección oficina" value="<?php echo $key->DireccionO;?>" id="direccion_oficina" name="direccion_oficina" >
							</div>
							<div class="form-group">
								<Label>Ciudad oficina</Label>
								<select class="form-control" id="ciudad_oficina" name="ciudad_oficina" >
									<option value="0">Seleccione</option>
									<?php foreach ($ciudades as $keya ) {?>
										<option value='<?php echo $keya->id ;?>'><?php echo utf8_encode($keya->ciudad) ;?></option>
									<?php } ?>
								</select>

								<script type="text/javascript">
									$(function(){
										$("#ciudad_oficina option").filter(function() {
										    //may want to use $.trim in here
										    return $(this).val() == <?php echo $key->G717_C17013 ;?>; 
										}).prop('selected', true);
									});
								</script>
							</div>
							<div class="form-group">
								<Label>Teléfono domicilio</Label>
								<input type="text" class="form-control" maxlength="10" placeholder="Teléfono domicilio" value="<?php echo $key->TelefonoD;?>" id="telefono_domicilio" name="telefono_domicilio" >
							</div>
							<div class="form-group">
								<Label>Teléfono oficina</Label>
								<input type="text" class="form-control" maxlength="10" placeholder="Teléfono oficina" value="<?php echo $key->TelefonoO;?>" id="telefono_oficina" name="telefono_oficina" >
							</div>
							<div class="form-group">
								<Label>Celular</Label>
								<input type="text" class="form-control" maxlength="10" placeholder="Celular" value="<?php echo $key->Celular;?>" id="Celular" name="celular" >
							</div>
							<div class="form-group">
								<Label>Celular adicional</Label>
								<input type="text" class="form-control" maxlength="10" placeholder="Celular adicional" value="<?php echo $key->CelularA;?>" id="celular_adicional" name="celular_adicional" >
							</div>
							<div class="form-group">
								<Label>Correo electrónico</Label>
								<input type="text" class="form-control" placeholder="Correo electrónico" value="<?php echo $key->Mail;?>" id="correo_electronico" name="correo_electronico" >
							</div>
							<!-- Estos son los datos adcionales del excell -->
							<div class="form-group">
								<Label>Ciudad adicional</Label>
								<select class="form-control" id="ciudad_adicional" name="ciudad_adicional" >
									<option value="0">Seleccione</option>
									<?php foreach ($ciudades as $keya ) {?>
										<option value='<?php echo $keya->id ;?>'><?php echo utf8_encode($keya->ciudad) ;?></option>
									<?php } ?>
								</select>

								<script type="text/javascript">
									$(function(){
										$("#ciudad_adicional option").filter(function() {
										    //may want to use $.trim in here
										    return $(this).val() == <?php echo $key->G717_C17013 ;?>; 
										}).prop('selected', true);
									});
								</script>
							</div>

							<div class="form-group">
								<Label>Dirección adicional</Label>
								<input type="text" class="form-control" placeholder="Dirección adicional" value="<?php echo $key->dir_Adicional;?>" id="dir_Adicional" name="dir_Adicional" >
							</div>

							<div class="form-group">
								<Label>Telefono adicional</Label>
								<input type="text" class="form-control" placeholder="Telefono adicional" value="<?php echo $key->tele_adicional;?>" id="tele_adicional" name="tele_adicional" >
							</div>
							<?php } ?>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="seldireccion_domicilio"  name="seldireccion_domicilio">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="Selciudad_domicilio" name="Selciudad_domicilio">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="Seldireccion_oficina" name="Seldireccion_oficina">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCiudad_oficina" name="selCiudad_oficina">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selTelefono_domicilio" name="selTelefono_domicilio">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selTelefono_oficina" name="selTelefono_oficina">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCelular" name="selCelular">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCelularAdicional" name="selCelularAdicional">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCorreoOficial" name="selCorreoOficial">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							
							<!-- esto es la jugada de los datos adicionales -->
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selciudad_adicional" name="selciudad_adicional">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="seldiradicional" name="seldiradicional">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selTelAdicional" name="selTelAdicional">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
						</div>
					</div>
				</form>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="GuardarBtnDatosIniciales" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<div class="modal fade" tabindex="-1" role="dialog" id="Modal-adicionales">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close cerrarAdicionales" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >Agregar datos adicionales codeudores</h4>
            </div>
            <div class="modal-body" >
                <form id="FrmAbogados" method="post">
					<input type="hidden" id="const_int_" name="id" value="0">
					<input type="hidden" id="const_int_user" name="ID_PERSONAS" value="<?php echo $idUsuario;?>">
					<input type="hidden" id="IdentificacionUsers" name="IdentificacionUsers" value="<?php echo $identificacion;?>">
					<h3>Datos nuevos codeudores</h3>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<Label>Liquidación</Label>
								<select class="form-control" id="obligaciones"  name="obligaciones" >
									<option value="0">Seleccione</option>
									<?php 
										/**/
										for($i=0;$i < count($obligaciones); $i++){
											if(!is_null($obligaciones[$i])){
												if($obligaciones[$i]['contrato']!= '' && !is_null($obligaciones[$i]['contrato'])){
												 	$this->db->select('TOP 1 G719_ConsInte__b, G730_C17126');
												    $this->db->from('G719');
												    $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
												    $this->db->where('G719_C17423', $obligaciones[$i]['contrato']);
												    $query = $this->db->get();

												    echo "<option value='".$query->row()->G719_ConsInte__b."'>".$obligaciones[$i]['contrato']." </option>";
												}
											}
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Deudores</Label>
								<select class="form-control" id="DeudoresAqui"  name="DeudoresAqui" >
									<option value="0">Seleccione</option>
									
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group" style="visibility: hidden;">
								<Label>Rol del Usuario</Label>
								<input type="text" class="form-control" >
								
							</div>
							<div class="form-group">
								<Label>Rol del Usuario</Label>
								<input type="hidden"  id="rolUsers1" name="rolUsers_" >
								<input type="text" class="form-control" readonly="" placeholder="Rol del Usuario"  id="rolUsers"  >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<Label>Correo</Label>
								<input type="text" class="form-control" placeholder="Correo"  id="correo" name="CORREO_ELECTRONICO" >
							</div>
							<div class="form-group">
								<Label>Teléfono</Label>
								<input type="text" class="form-control" maxlength="10" placeholder="Teléfono"  id="telefono" name="TELEFONO" >
							</div>

							<div class="form-group">
								<Label>Dirección</Label>
								<input type="text" class="form-control" placeholder="Dirección"  id="direccion" name="DIRECCION" >
							</div>

							<div class="form-group">
								<Label>Ciudad</Label>
								<select class="form-control" id="ciudad"  name="CIUDAD" >
									<option value="0">Seleccione</option>
									<?php 
										foreach ($ciudades as $key) {
											echo '<option value="'.$key->id.'">'.utf8_encode($key->ciudad).'</option>';
										}
									?>
								</select>
							</div>

							
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCalificacionCorreo" name="selCalificacionCorreo">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCalificacionTelefono" name="selCalificacionTelefono">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCalificacionDireccion"  name="selCalificacionDireccion">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<Label>Calificación</Label>
								<select class="form-control" id="selCalificacionCiudad" name="selCalificacionCiudad">
									<option value="0">Calificación</option>
									<?php 
										foreach ($calificacion as $key) {
											echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
										}
									?>
								</select>
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<Label>Descripción</Label>
								<input type="text" class="form-control" placeholder="Descripción"  id="descripcion" name="DESCRIPCION" >
							</div>
						</div>
					</div>
				</form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left cerrarAdicionales" type="button">Cerrar</button>
                <button class="btn btn-primary" id="GuardarBtnDatosAdicionales" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<section class="content">
	<?php 

		if(isset($vista)){
			switch ($vista) {
				case '2':
			//viene de irrecupeables
					echo '<a href="'.base_url().'cartera_fng/procesosIrrecuperables" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';	
					break;
				case '3':
			//viene de vendidos
					echo '<a href="'.base_url().'cartera_fng/procesosVendidos" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '4':
			//viene de Busqueda Avanzada
					echo '<a href="'.base_url().'cartera_fng/busquedaAvanzada" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;
				case '5':
				//viene de clientes con acuerdo de pago
					echo '<a href="'.base_url().'cartera_fng/pazysalvo" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;
				
			}
		}else{
			//viene de Vigentes
			echo '<a href="'.base_url().'cartera_fng/gestionJudicial" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
		}
		
	?>
	
	<div class="box box-solid">
	    <div class="box-body">
			<div class="panel box box-primary">

				<div class="box-header with-border">
					<h4 class="box-title">
						<a >
							DATOS BÁSICOS TITULAR
						</a>
					</h4>
				</div>
				<div id="collapseDatos" class="panel-collapse">
					<div class="box-body">
	<?php
		$cliente_int_b = 0;
		foreach ($cliente as $key) { ?>
						<div class="row-primary ">
									
							<div class="col-md-12"> 
								<div class="row ">

									<div class="col-md-3">
										<div class="form-group">
					                      	<label for="TxtNombreDeudor">Nombre deudor</label>
					                    </div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->Deudor);?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtIdentificacion">No. Identificación</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->identificacion;?>
									</div>
								</div>
								<div class="row ">
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtIdentificacion">Tipo Identificación</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->tipo_identificacion;?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtDireccion">Dirección domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->DireccionD);?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCiudad">Ciudad domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->ciudadD);?>
									</div>
								</div>
								
								
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtDireccion">Dirección oficina</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->DireccionO);?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCiudad">Ciudad oficina</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->CiudadO);?>
									</div>
								</div>



								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtTelfonoD">Teléfono domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->TelefonoD;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtelefonoO">Teléfono oficina</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->TelefonoO;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCelular">Celular</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->Celular;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCelulara">Celular adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->CelularA;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtMail">Correo electrónico</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->Mail;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtNumero">No. de liquidaciones del deudor</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $numeroLiquidaciones;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCelular">Dirección adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->dir_Adicional;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCelulara">Ciudad adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->ciudad_ad;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCelular">Teléfono adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->tele_adicional;?>
									</div>
									
								</div>

							</div>
							
						</div>
	<?php }	?>		
					</div>
				</div>


			</div>


			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen2">
							DATOS ADICIONALES DEL TITULAR
						</a>
					</h4>
				</div>
				<div id="collapseThirteen2" class="panel-collapse collapse">
					<div class="box-body table-responsive">
						<button class="btn btn-primary" data-toggle="modal" data-target="#Modal-iniciales" ><i class="fa fa-plus"></i>&nbsp;Agregar</button>
						<br>
						<br>
						<table class="table table-hover" id="tabladatos_Iniciales">
							<thead>
								<tr>
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
				</div>
			</div>


			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen">
							DATOS ADICIONALES DEL CODEUDOR
						</a>
					</h4>
				</div>
				<div id="collapseThirteen" class="panel-collapse collapse">
					<div class="box-body table-responsive">
						<button class="btn btn-primary" data-toggle="modal" data-target="#Modal-adicionales" ><i class="fa fa-plus"></i>&nbsp;Agregar</button>
						<br>
						<br>
						<table class="table table-hover" id="tabladatos_Extras">
							<thead>
								<tr>
									<th>LIQUIDACIÓN</th>
									<th>CODEUDOR</th>
									<th>ROL</th>
									
									<th>TELÉFONO</th>
									<th>CALIFICACIÓN TELEFONO</th>
									<th>DIRECCIÓN</th>
									<th>CALIFICACIÓN DIRECCIÓN</th>
									<th>CIUDAD</th>
									<th>CALIFICACIÓN CIUDAD</th>
									<th>CORREO ELECTRÓNICO</th>
									<th>CALIFICACIÓN CORREO</th>
									<th>DESCRIPCIÓN</th>
									<th>FECHA</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
				  		
					</div>
				</div>
			</div>

			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							OBLIGACIONES
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
					<table >
						<tbody style="background-color: #ef7f1a">
							<ul>
								<td style=""><i class="fa fa-circle" style="color: #f00"></i>&nbsp; Saldo</td>

								<td><i class="fa fa-circle" style="color: #feff0d"></i>&nbsp; Acuerdos de pago</td>

								<td><i class="fa fa-circle" style="color: #769462"></i>&nbsp; Saldo Cero</td>

								<td><i class="fa fa-circle" style="color: #5ace10"></i>&nbsp; Paz y Salvo</td>

								<td><i class="fa fa-circle" style="color: #adabab"></i>&nbsp; Vendida</td>
							</ul>	
						</tbody>
					</table>
					<div class="box-body">
						<div row="row-fluid">
							<div class="col-md-2">
								<table class="table table-hover table-bordered" id="RowContrato">
									<thead>
										<th>Nº Liquidación</th>
									</thead>
									<tbody>
										<?php
										
											if($masliquidaciones > 0){
												for($i=0;$i < count($contratos); $i++){
													if(!is_null($contratos[$i])){
														if($contratos[$i]['contrato']!= ''){
															$this->db->select('TOP 1 G719_ConsInte__b, G730_C17126');
														    $this->db->from('G719');
														    $this->db->join('G730', 'G730_ConsInte__b = G719_C17030','LEFT');
														    $this->db->where('G719_C17423', $contratos[$i]['contrato']);
														    $query = $this->db->get();

													$color = $this->Obligaciones_Model->getColoresLiquidacicones($contratos[$i]['contrato']);
																json_encode($color);

													
														 	echo "<tr><td style='cursor:pointer;background-color:".$color[0]->Color."; color:".$color[0]->ColorFunte."' contrato ='".$query->row()->G719_ConsInte__b."'>".$contratos[$i]['contrato']." ".$query->row()->G730_C17126 ."</td></tr>";

														}
													}
												}
											}else{
												for($i=0;$i < count($contratos); $i++){
														if(!is_null($contratos[$i])){
														 	echo "<tr><td style='cursor:pointer;background-color:".$color[$i]->Color."; color:".$color[$i]->ColorFunte."' contrato ='".$contratos[$i]['No_CONTRATO']."'>".$contratos[$i]['contrato']." ".$contratos[$i]['if'] ."</td></tr>";


														}
													}
											}
										?>
									</tbody>
								</table>
							</div>
							<div class="col-md-10">
								<div class="panel box box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOneOne">
												DATOS OBLIGACIÓN
											</a>
										</h4>
									</div>
									<div id="collapseOneOne" class="panel-collapse ">
										<div class="box-body">
											<div class="row-fluid">
												<div class="col-md-12">
													
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">No. Liquidación</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtNumeroContrato" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Valor pagado</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtValorPagado">
															
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Fecha de pago de la garantía</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtFechagarantia" >
															
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Intermediario financiero</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtIntermediarioF" >
															
														</div>
														
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">Cobertura</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtCobertura">
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Judicializable</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtJudicial">
															
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">FRG</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtFrg" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">No. de proceso judicial SAP</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtSap">
															
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Despacho judicial</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtDespacho" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">Ciudad despacho</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtciudadDespacho">
															
														</div>
													</div>


													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">Clase de proceso</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtClase">
															
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Estado del proceso</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtEstado" >
															
														</div>
														
													</div>
													<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label for="TxtCelulara">Estado de Asignación</label>
											                 	</div>
															</div>
															<div class="col-md-3" id="AsigancionAbogado" >
																
															</div>
														</div>


												</div>
											</div>
										  	

											<div class="row-fluid" id="campos" style="display:none;" style="text-align:center;" >
				
												<div class="col-md-4">
													<a href="#" id="gestionJudicial" data-toggle="modal" data-target="#Modal-Menu" data-backdrop="static" 
   data-keyboard="false" >
								        				<img src="<?php echo base_url();?>assets/img/botones/botones/extrajudicial/botones-71.png" style=" width: 100%; height: auto;" id="logoHunter">
								        			</a>
												</div>
												<div class="col-md-4">
													<a href="#"  data-toggle="modal" data-target="#Modal-Menu-Extrajudicial" data-backdrop="static" 
   data-keyboard="false" >
								        				<img src="<?php echo base_url();?>assets/img/botones/botones/extrajudicial/botones-70.png" style=" width: 100%; height: auto;" id="logoHunter">
								        			</a>
												</div>
												<div class="col-md-4">
													<a href="#" data-toggle="modal" data-target="#Modal-Simulador" data-backdrop="static" 
   data-keyboard="false" >
								        				<img src="<?php echo base_url();?>assets/img/botones/botones/extrajudicial/botones-72.png" style=" width: 100%; height: auto;" id="logoHunter">
								        			</a>
												</div>

											</div>
											
										</div>
									</div>

									<div class="box-header with-border box-primary">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsetwo">
												HISTÓRICO GESTIÓN EXTRAJUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapsetwo" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											<br><br>
											<table class="table table-hover table-bordered" id="tblHistoricoExtrajudicial">
												<thead>
													<tr>
														<th>Cliente Gestionado</th>
														<th>Medio Comunicación</th>
														<th>Resultado Comunicación</th>
														<th>Gestión</th>
														<th>Subgestión</th>
														<th>Observaciones</th>
														<th>Ejecutor</th>
														<th>Fecha Ejecución</th>
														<th>Hora Ejecución</th>
													
													</tr>
												</thead>
												<tbody id="tablaExtraJudicial">

												</tbody>
												
											</table>
										</div><!-- /.box-body -->
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsethree">
												HISTÓRICO GESTIÓN JUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapsethree" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											
											<br><br>
											<table class="table table-hover table-bordered" id="tblHistoricoJudicial">
												<thead>
													<tr>
														<th>Tipo de proceso	</th>
														<th>Fecha de informe</th>
														<th>Etapa</th>
														<th>Actuación</th>
														<th>Fecha de trámite</th>
														<th>Observaciones</th>
														<th>Ejecutor</th>
														<th></th>
														
													</tr>
												</thead>
												<tbody id="tablaJudicial">

												</tbody>
												
											</table>
										</div><!-- /.box-body -->
									</div>


									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsefour">
												HISTÓRICO GESTIÓN MEDIDAS
											</a>
										</h4>
									</div>
									<div id="collapsefour" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											
											
											<br><br>
										  	<table class="table table-hover table-bordered" id="tblHistoricoMedidas">
												<thead>
													<tr>
														<th>Fecha Informe</th>
														<th>Medida Cautelar</th>
														<th>Fecha Solicitud</th>
														<th>Fecha Decreto</th>
														<th>Fecha Práctica</th>
														<th>Secuestre</th>
														<th>Medida efectiva</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsefive">
												CODEUDORES
											</a>
										</h4>
									</div>
									<div id="collapsefive" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											<br><br>
										  	<table class="table table-hover table-bordered">
												<thead>
													<tr>
														<th>N° Obligaciones</th>
														<th>Detalle Obligaciones Asociadas</th>
														<th>Nombre</th>
														<th>Identificación</th>
													</tr>
												</thead>
												<tbody id="tablaCodeudores">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
												ACUERDO DE PAGO
											</a>
										</h4>
									</div>
									<div id="collapseSix" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											<br><br>
										  	<table class="table table-hover table-bordered" id="tblAcuerdoPago">
												<thead>
													<tr>
														<th width='auto'>Fecha consignación anticipo</th>
														<th width='auto'>Fecha de legalización</th>
														<th width='auto'>Valor del acuerdo</th>
														<th width='auto'>Plazo acuerdo de Pago</th>
													</tr>
												</thead>
												<tbody id="tablaAcuerdosPago">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseSven">
												GARANTÍAS - PAGARÉS
											</a>
										</h4>
									</div>
									<div id="collapseSven" class="panel-collapse collapse ">
										<div class="box-body">
											<br><br>
										  	<table class="table table-hover table-bordered" id="tblGarantiaPagare">
												<thead>
													<tr>
														<th>N° Contrato</th>
														<th>N° Garantía</th>
														<th>N° Pagaré</th>
														<th>Valor Garantía</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
												
											</table>
										</div>
									</div>


									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseEigth">
												FACTURAS
											</a>
										</h4>
									</div>
									<div id="collapseEigth" class="panel-collapse collapse ">
										<div class="box-body table-responsive">
											<br><br>
										  	<table class="table table-hover table-bordered" id="tblFacturas">
												<thead>
													<tr>
														<th style="width:450px !important">N° de factura auto de subrogación</th>
														<th style="width:450px !important">Fecha de factura auto de subrogación</th>
														<th style="width:450px !important">Fecha auto de subrogación</th>
														<th style="width:450px !important">Valor facturado auto de subrogación</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>

											<table class="table table-hover table-bordered" id="tblFacturasIrrecuperables">
												<thead>
													<tr>
														<th style="width:450px !important">No. Factura sentencia irrecuperable</th>
														<th style="width:450px !important">Fecha sentencia irrecuperable</th>
														<th style="width:450px !important">Fecha de factura sentencia irrecuperable</th>
														<th style="width:450px !important">Valor facturado sentencia irrecuperable</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>



											<table class="table table-hover table-bordered" id="tblFacturasSoporte">
												<thead>
													<tr>
														<th style="width:450px !important">No. Factura soportes CISA</th>
														<th style="width:450px !important">Fecha recepción soporte</th>
														<th style="width:450px !important">Fecha aprobación soporte</th>
														<th style="width:450px !important">Valor facturado soportes CISA</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>

											<table class="table table-hover table-bordered" id="tblFacturasHonorarios">
												<thead>
													<tr>
														<th style="width:450px !important">No. Factura honorarios venta CISA</th>
														<th style="width:450px !important">Fecha de factura honorarios venta CISA</th>
														<th style="width:450px !important">Honorarios venta CISA</th>
														
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
												INFORMACIÓN JUDICIAL
											</a>
										</h4>
									</div>
									
									<div id="collapseNine" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"><label>Radicado o expediente</label> </div>
										  		<div class="col-md-3" id="RedicadoExpediente"> </div>
										  		<div class="col-md-3"><label>Fecha demanda</label> </div>
										  		<div class="col-md-3"  id="Fecchademanda"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha mandamiento de pago</label> </div>
										  		<div class="col-md-3" id="fechaadmiciondenabda"> </div>
										  		<div class="col-md-3"><label>Nombre abogado IF</label> </div>
										  		<div class="col-md-3" id="txtNombreabogadoIf"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Total gastos judiciales</label> </div>
										  		<div class="col-md-3"  id="totalGastosJudicales"> </div>
										  		<div class="col-md-3"><label>Fecha envío memorial de terminación</label> </div>
										  		<div class="col-md-3"  id="FechaEnvioMemorialTerminacion"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha de terminación proceso</label> </div>
										  		<div class="col-md-3" id="judicialFechaTerminacion"> </div>
										  		
										  	</div>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
												INFORMACIÓN ABOGADO
											</a>
										</h4>
									</div>
									
									<div id="collapseTen" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"><label>Abogado</label> </div>
										  		<div class="col-md-3" id="abogadoCarajo"> </div>
										  		<div class="col-md-3"><label>Fecha asignación abogado</label> </div>
										  		<div class="col-md-3"  id="fechaAsignacionabogado"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"   ><label>No. Póliza</label> </div>
										  		<div class="col-md-3" id="NumeroPoliza"> </div>
										  		<div class="col-md-3"  ><label>Fecha de aprobación de póliza</label> </div>
										  		<div class="col-md-3" id="fechaaprovaciondelapoliza"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha de vencimiento</label> </div>
										  		<div class="col-md-3"  id="fechadevencimientocarajo"> </div>
										  		<div class="col-md-3"><label>Promotor / Liquidador </label> </div>
										  		<div class="col-md-3" id="AbogadoPromotor"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha fijación del aviso</label> </div>
										  		<div class="col-md-3"  id="AbogadoFechaFijacion"> </div>
										  		<div class="col-md-3"><label>Celular</label> </div>
										  		<div class="col-md-3" id="AbogadoCelular"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Correo electrónico</label> </div>
										  		<div class="col-md-9"  id="AbogadoCorreo"> </div>
										  		
										  	</div>
										  	<div class="row">
									  			<div class="col-md-3"><label>Teléfono</label> </div>
										  		<div class="col-md-3" id="AbogadoTelefono"> </div>

										  		<div class="col-md-3"><label>Dirección</label> </div>
										  		<div class="col-md-3"  id="AbogadoDireccion"> </div>
										  		
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Firma de abogados</label> </div>
										  		<div class="col-md-3" id="AbogadoFirma"> </div>
										  		<div class="col-md-3"><label>Frg</label> </div>
										  		<div class="col-md-3"  id="AbogadoFrg"> </div>
										  	</div>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
												PAZ Y SALVO FNG / FECHA DE VENTA
											</a>
										</h4>
									</div>
									
									<div id="collapseEleven" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha de expedición del paz y salvo</label> </div>
										  		<div class="col-md-3" id="fechapazysalvo"> </div>
										  		
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha de venta</label> </div>
										  		<div class="col-md-3"  id="fechadeventacarajos"> </div>
										  		<div class="col-md-3"> </div>
										  		<div class="col-md-3"> </div>
										  	</div>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve">
												SUBROGACIÓN
											</a>
										</h4>
									</div>
									
									<div id="collapseTwelve" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha envío memorial de subrogación al FRG</label> </div>
										  		<div class="col-md-3" id="fechaenviomemorial"> </div>
										  		<div class="col-md-3"  ><label>Fecha devolución FRG memorial de subrogación por errores</label> </div>
										  		<div class="col-md-3" id="fechadevolocionmemorial"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha envío memorial de subrogación corregido</label> </div>
										  		<div class="col-md-3"  id="fechaenviomemeorialcorregido"> </div>
										  		<div class="col-md-3"><label>Fecha radicación memorial</label>   </div>
										  		<div class="col-md-3" id="fecharedicacionMemorial"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha pronunciamiento</label> </div>
										  		<div class="col-md-3" id="fechapronunciamiento"> </div>
										  		<div class="col-md-3"  ><label>Decisión</label> </div>
										  		<div class="col-md-3" id="decision"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha impugnación</label> </div>
										  		<div class="col-md-3"  id="fechaimpugnacion"> </div>
										  		<div class="col-md-3"><label>Nombre clase de impugnación</label></div>
										  		<div class="col-md-3" id="nombreclaseimpugnacion"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"  ><label>Fecha decisión final</label>  </div>
										  		<div class="col-md-3" id="Fechadecicionfinal"> </div>

										  		<div class="col-md-3"   ><label>Decisión final</label> </div>
										  		<div class="col-md-3" id="decicionfinal"> </div>
										  		
										  	</div>
										  	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen3">
							PROCESOS ASOCIADOS
						</a>
					</h4>
				</div>
				<div id="collapseThirteen3" class="panel-collapse collapse">
					<div class="box-body table-responsive">
						<table class="table table-hover" id="tablaProcesosAsociados">
							<thead>
								<tr>
									<th>LIQUIDACIÓN</th>
									<th>PROCESO</th>
									<th>ESTADO PROCESO</th>	
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
				  		
					</div>
				</div>
			</div> 
			
		</div><!-- /.box-body -->
		
	</div><!-- /.box -->

	
</section><!-- /.content -->

<div class="modal fade" tabindex="-1" style="z-index: 9999;" role="dialog" id="Modal-tareas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >Agregar Tareas</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Qué quieres hacer?</label>
                            <select class="form-control" id="gestionCombo">
                            	<option value="1792">Llamar</option>
                            	<option value="1793">Reunión</option>
                            	<option value="1794">Correo</option>
                            	<option value="1795">Visita</option>
                            	<option value="1842">Buscar datos de contacto</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Resumen de Datos Asociados</label>
                            <input type="text" readonly class="form-control" id="tareasEstaVaina">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea class="form-control" rows="3" id="txtDescripcion" placeholder="Descripción"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Fecha Programada</label>
                            <input type="text" class="form-control especial" id="txtFechaPrgramdad" placeholder="Fecha Tramite">
                        </div>
                    </div>
                </div>

                 <div class="bootstrap-timepicker">
                	<div class="form-group">
                  		<label>Time picker:</label>
	                  	<div class="input-group">
		                    <input type="text" class="form-control timepicker" id="timepikerettx">
		                    <div class="input-group-addon">
		                      	<i class="fa fa-clock-o"></i>
		                    </div>
	                  	</div><!-- /.input group -->
	                </div><!-- /.form group -->
              	</div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="GuardarBtnTarea" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-Menu-Extrajudicial">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close"  id="cerrarExtrajudicial" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >Gestión ExtraJudicial</h4>
            </div>
            <div class="modal-body" >
            	<div class="nav-tabs-custom">
	                <!-- Tabs within a box -->
	                <ul class="nav nav-tabs pull-left">
	              		<li class="active"><a id="tab1" href="#revenue-chart" data-toggle="tab">Qué quieres hacer</a></li>
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
	                  				<button class="btn" data-toggle="modal" data-target="#Modal-tareas">Agregar Nueva Tarea</button>
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
	                  				<button class="btn" data-toggle="modal" data-target="#Modal-tareas">Agregar Nueva Tarea</button>
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
            <div class="modal-footer">
                <button  id="cerrarModalExtrajudicial" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<!-- /.modla para el simulador -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="Modal-Simulador">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close"  id="butoncierreSimulador" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Simulador</h4>
            </div>
            <div class="modal-body" >
                <div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseObligacciob">
							DATOS DE LA OBLIGACIÓN
						</a>
					</h4>
				</div>
				<div id="collapseObligacciob" class="panel-collapse ">
					<div class="box-body">
						<?php foreach ($otrosDatos as $key) {
							echo '<div class="row">
						  		<div class="col-md-3"><label>Nombre del Deudor</label></div>
						  		<div class="col-md-3">'.utf8_encode($key->Deudor).'</div>
						  		<div class="col-md-3"><label>Número de Identificación</label></div>
						  		<div class="col-md-3">'.$key->identificacion.'</div>
						  	</div>
						  	<div class="row">
						  		<div class="col-md-3"><label>Tipo Identificación</label></div>
						  		<div class="col-md-3">'.$key->tipo_identificacion.'</div>
						  	</div>';
						  	
						}?>
					  	<div class="row">
					  		<div class="col-md-3"><label>Número de Contrato</label></div>
					  		<div class="col-md-3" id='simularContrato'></div>
					  		<div class="col-md-3"><label>Intermediario Financiero</label></div>
					  		<div class="col-md-3" id="simuladorIntemediario"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fondo Administrador de Cartera</label></div>
					  		<div class="col-md-3" id="simuladorfondoCartera"></div>
					  		<div class="col-md-3"><label>Valor Pagado Por el FNG</label></div>
					  		<div class="col-md-3" id="simuladorValorPagadoFng"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fecha de Pago</label></div>
					  		<div class="col-md-3" id="simuladorFechaPago"></div>
					  		<div class="col-md-3"><label>Saldo Capital a la Fecha</label></div>
					  		<div class="col-md-3" id="simuladorSaldo"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fecha ultimo abono registrado</label></div>
					  		<div class="col-md-3" id="simuladorUltimoabono"></div>
					  		<div class="col-md-3"></div>
					  		<div class="col-md-3"></div>
					  	</div>
					</div>
				</div>

				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseEstado">
							ESTADO DE CUENTA PARA PAGO TOTAL
						</a>
					</h4>
				</div>
				<div id="collapseEstado" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><button class="btn btn-primary" id="calculoEstadoSimulador"> Calcular </button></div>
					  	</div>
					  	<div class="row">
					  		&nbsp;
					  	</div>
					  	<div class="row">
					  		<div class="col-md-6">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Fecha Liquidación</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php date_default_timezone_set('America/Bogota'); echo date("d/m/Y"); ?>" id="txtSimuladorFEchaLiquidacion">
										</div>
									</div>
								</form>
					  		</div>
					  		<div class="col-md-3"><label>Tasa de Mora</label></div>
					  		<div class="col-md-3" id="simuladorTasamora"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Intereses Moratorios</label></div>
					  		<div class="col-md-3" id="simuladorMoratorios"></div>
					  		<div class="col-md-3"><label>Saldo Capital</label></div>
					  		<div class="col-md-3" id="simuladSaldoCapital"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Gastos Judiciales</label></div>
					  		<div class="col-md-3" id="simuladorgastosJudiciales"></div>
					  		<div class="col-md-3"><label>Total a Pagar</label></div>
					  		<div class="col-md-3" id="TotalApagarSimulador"></div>
					  	</div>
					</div>
				</div>


				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseAcuerdoPago">
							CONDICIONES PARA REALIZAR ACUERDO DE PAGO
						</a>
					</h4>
				</div>
				<div id="collapseAcuerdoPago" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><button class="btn btn-primary" id="btnCalcular2Simulador"> Calcular </button></div>
					  	</div>
					  	<div class="row">
					  		&nbsp;
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Valor Anticipo</label></div>
					  		<div class="col-md-3" id="anticipoSimulador"></div>
					  		<div class="col-md-6">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Porcentaje Anticipo</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="10" id="txtPorcentajeSmulador">
										</div>
									</div>
								</form>
							</div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fecha Limite de Pago</label></div>
					  		<div class="col-md-3" id="fechaLimitePagoLiquidacion"></div>
					  		<div class="col-md-3"><label>Monto de Capital a Diferir</label></div>
					  		<div class="col-md-3" id="MontocapitalDiferirSimulador"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Monto de Intereses</label></div>
					  		<div class="col-md-3" id="interecescalcluloSimulador"></div>
					  		<div class="col-md-3"><label>Saldo para amortizar</label></div>
					  		<div class="col-md-3" id="saldoadiferirSimulador"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Valor Cuotas</label></div>
					  		<div class="col-md-3" id="valordelascuotasSimulador"></div>
					  		<div class="col-md-6">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Número de Cuotas</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="10" id="txtNumeroCuotas">
										</div>
									</div>
								</form>
							</div>
					  	</div>
					</div>
				</div>

				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseAbogado">
							HONORARIOS ABOGADO
						</a>
					</h4>
				</div>
				<div id="collapseAbogado" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><button class="btn btn-primary" id="btnCalcularAbogado"> Calcular </button></div>
					  	</div>
					  	<div class="row">
					  		&nbsp;
					  	</div>
					  	<div class="row">
					  		<div class="col-md-7">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Porcentaje Honorarios</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value='10' id="txtHonorariosSimulador">
										</div>
									</div>
								</form>
					  		</div>
					  		<div class="col-md-3"><label>Valor Honorarios</label></div>
					  		<div class="col-md-2" id="valorHonorarios"></div>
					  	</div>
					</div>
				</div>

				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapsePAGO">
							DATOS PARA REALIZAR EL PAGO
						</a>
					</h4>
				</div>
				<div id="collapsePAGO" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><label>BANCO</label></div>
					  		<div class="col-md-3"><label>Bancolombia</label></div>
					  		<div class="col-md-3"><label>CONVENIO N°</label></div>
					  		<div class="col-md-3"><label>53821</label></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>TITULAR DE LA CUENTA</label></div>
					  		<div class="col-md-3"><label>Fondo Nacional de Garantías S.A.</label></div>
					  		<div class="col-md-3"><label>NÚMERO DE REFERENCIA</label></div>
					  		<div class="col-md-3" id="referenciaCOntratop"></div>
					  	</div>
					</div>
				</div>

			</div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<div class="modal fade" tabindex="-1" role="dialog" id="Modal-Menu">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" id="cerrarJudiciales" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="">Gestión Judicial</h4>
            </div>
            <div class="modal-body" >
            	<div>
	        		<button class="btn btn-primary" data-toggle="modal" data-target="#Modal-Medidas" >Registrar Medida</button>
	        		<br><br>
	        	</div>
        		
                <div class="row">
                	<div class="col-md-1" >

                	</div>
                    <div class="col-md-10" >
                    	<div class="nav-tabs-custom">
			                <!-- Tabs within a box -->
			                <ul class="nav nav-tabs pull-left">
			              		<li class="active"><a id="getsionJudicialTab1" href="#gestionJudicial1" data-toggle="tab">Etapas</a></li>
			                 	<li><a id="getsionJudicialTab2" href="#gestionJudicial2" data-toggle="">Actuaciones</a></li>
			                </ul>
			                <div class="tab-content no-padding">
			                  	<!-- Morris chart - Sales -->
			                  	<div class="chart tab-pane active" id="gestionJudicial1" style="position: relative; height: auto;">
			                  		<p class="text-white alert-info" id="TxtTituloProceso"></p>
			                  		
			                  		<div class="row-fluid" id="EjecutovosEtapas">
			                  			<div class="col-md-2">&nbsp;</div>
			                  			<div class="col-md-8">
											
			                  				<div class="row">
					                  			<div class="col-md-12">&nbsp;</div>
					                  		</div>
					                  		<div class="row">
					                      		<div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(1, 'Demanda');"><img src="<?php echo base_url();?>assets/img/botones/Demanda.png"></a>
					                            </div>
					                      			<div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard('10', 'Embargo');"><img src="<?php echo base_url();?>assets/img/botones/Embargo.png"></a>
					                            </div>
					                      			<div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(11,'Secuestro');"><img src="<?php echo base_url();?>assets/img/botones/Secuestro.png"></a>
					                            </div>
					                      	
					                            
					                    	</div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(2, 'Notificación');"><img src="<?php echo base_url();?>assets/img/botones/Notificacion.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript: getDatosWizard(9, 'Liquidación de créditos y costas' );"><img src="<?php echo base_url();?>assets/img/botones/Liquidacion.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript: getDatosWizard(12, 'Avalúo');"><img src="<?php echo base_url();?>assets/img/botones/Avaluo.png"></a>
					                            </div>
					                           
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            

					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(3, 'Contestacion Demanda y/o excepciones');"><img src="<?php echo base_url();?>assets/img/botones/Contestacion_demanda.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(8, 'Segunda Instancia');"><img src="<?php echo base_url();?>assets/img/botones/Segunda_Instancia.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(13, 'Remate');"><img src="<?php echo base_url();?>assets/img/botones/Remate.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(4, 'Subrogacion');"><img src="<?php echo base_url();?>assets/img/botones/Subrogacion.png"></a>
					                            </div>
					                            
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(7, 'Sentencia');"><img src="<?php echo base_url();?>assets/img/botones/Sentencia.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(14, 'Impulso Procesal');"><img src="<?php echo base_url();?>assets/img/botones/Impulso_Procesal.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(17, 'Terminación');"><img src="<?php echo base_url();?>assets/img/botones/Terminacion.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                        	
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(5, 'Audiencia');"><img src="<?php echo base_url();?>assets/img/botones/Audiencia.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(6, 'Acuerdo Pago FNG');"><img src="<?php echo base_url();?>assets/img/botones/Acuerdo_Pago.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(15, 'Desistimiento Táctico');" ><img src="<?php echo base_url();?>assets/img/botones/Desistimiento_Tactico.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(16, 'Venta de Cartera');"><img src="<?php echo base_url();?>assets/img/botones/Venta_Cartera.png"></a>
					                            </div>
					                        </div>
			                  			</div>
			                  		</div>

			                  		<div class="row-fluid" id="otrasEtapas" style="display:none">
			                  			<div class="col-md-2">&nbsp;</div>
			                  			<div class="col-md-8">
											
			                  				<div class="row">
					                  			<div class="col-md-12">&nbsp;</div>
					                  		</div>
					                  		<div class="row">
					                      		<div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(18, 'Acuerdo de adjudicación');"><img src="<?php echo base_url();?>assets/botones/1116/botones-01.png"></a>
					                            </div>
					                      			<div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard('25', 'Traslado de objeciones');"><img src="<?php echo base_url();?>assets/botones/1116/botones-02.png"></a>
					                            </div>
					                      			<div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(26,'Venta de cartera ley 1116');"><img src="<?php echo base_url();?>assets/botones/1116/botones-03.png"></a>
					                            </div>
					                      	
					                            
					                    	</div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(19, 'Auto inicio');"><img src="<?php echo base_url();?>assets/botones/1116/botones-06.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript: getDatosWizard(24, 'Reconoce créditos y aprueba inventario' );"><img src="<?php echo base_url();?>assets/botones/1116/botones-04.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript: getDatosWizard(27, 'Terminación ley 1116');"><img src="<?php echo base_url();?>assets/botones/1116/botones-05.png"></a>
					                            </div>
					                           
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            

					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(20, 'Acuerdo de Reorganización');"><img src="<?php echo base_url();?>assets/botones/1116/botones-07.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(23, 'Inventario de bienes');"><img src="<?php echo base_url();?>assets/botones/1116/botones-08.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                               
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(21, 'Impulso procesal Ley 1116');"><img src="<?php echo base_url();?>assets/img/botones/Etapa_Tramite.png"></a>
					                            </div>
					                            
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(22, 'Subrogación');"><img src="<?php echo base_url();?>assets/botones/1116/botones-09.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                              
					                            </div>
					                            <div class="col-md-3">
					                               
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>

			                  			</div>
			                  		</div>
			                  		
			                  		
			                    </div>
			                 
			                  	<div class="chart tab-pane" id="gestionJudicial2" style="position: relative; height: auto;">
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
		                  		 	<h4 class="modal-title" id="tituloModal"></h4>
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
			                  		<div class="row-fluid">
			                  			<div class="col-md-12">
			                  				<div class="row">
			                  					
							                    <div class="col-md-8" >
							                        <div class="form-group" id="modalBody">
							                            
							                        </div>
							                    </div>
							                    <div class="col-md-4">
							                        <!-- text input -->
							                        <div class="form-group">
							                            <label>Fecha Trámite*</label>
							                            <input type="text" class="form-control datemask1" id="txtFecha" placeholder="Fecha Tramite">
							                        </div>

							                        <div class="form-group">
							                            <label>Observaciones</label>
							                            <textarea class="form-control" rows="3" id="txtObservaciones" placeholder="Observaciones"></textarea>
							                        </div>
							                    </div>
							                </div>
							                <div class="row">

							                    <div class="col-md-9" >
							                        <div class="form-group" id="modalBody">
							                            
							                        </div>
							                    </div>
							                    <div class="col-md-3">
							                       <button class="btn btn-primary" id="GuardarBtn" type="button">Guardar</button>
							                    </div>
							                </div>
			                  			</div>
			                  		</div>
			                  	</div>
		                 	</div>
		                </div>
		            </div>
		        </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>









<div class="modal fade" tabindex="3" role="dialog" id="Modal-Medidas">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" id="cerrarMedidas" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="">Medidas Cautelares</h4>
            </div>
            <div class="modal-body" >
            	
                <div class="row">
                	<div class="col-md-1" >

                	</div>
                    <div class="col-md-10" >
                    	<div class="nav-tabs-custom">
			                <!-- Tabs within a box -->
			                <ul class="nav nav-tabs pull-left">
			              		<li class="active"><a id="getsionMedidas1" href="#medidas1" data-toggle="tab">Medidas</a></li>
			                 	<li><a id="getsionMedidas2" href="#medidas2" data-toggle="">Datos Medida</a></li>
			                </ul>
			                <div class="tab-content no-padding">
			                  	<!-- Morris chart - Sales -->
			                  	<div class="chart tab-pane active" id="medidas1" style="position: relative; height: auto;">
			                  		<p class="text-white alert-info" ><h2>Medida</h2></p>
			                  		<div class="row-fluid">
			                  			<div class="col-md-2">&nbsp;</div>
			                  			<div class="col-md-8">
											
			                  				<div class="row">
					                  			<div class="col-md-12">&nbsp;</div>
					                  		</div>
					                  		<div class="row">
					                      		<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoInmueble.png"></a>
					                            </div>
					                      			<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(2);"><img src="<?php echo base_url();?>assets/img/medidas/embargoVehiculo.png"></a>
					                            </div>
				                      			<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(3);"><img src="<?php echo base_url();?>assets/img/medidas/embargoEstabComercio.png"></a>
					                            </div>
					                      		<div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(4);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRetenSalario.png"></a>
					                            </div>
					            
					                    	</div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(5);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRetenCuentasAhCorr.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript: getMedidas(6);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRemanentes.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(7);"><img src="<?php echo base_url();?>assets/img/medidas/embargoSecuestroBienes.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(8);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRazonSocial.png"></a>
					                            </div>
					                           
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            

					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(9);"><img src="<?php echo base_url();?>assets/img/medidas/embargoMaqEquipo.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(10);"><img src="<?php echo base_url();?>assets/img/medidas/embargoAcciones.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(11);"><img src="<?php echo base_url();?>assets/img/medidas/embargoCuotasParticipacion.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(12);"><img src="<?php echo base_url();?>assets/img/medidas/embargoPosesion.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(13);"><img src="<?php echo base_url();?>assets/img/medidas/embargoCreditos.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(14);"><img src="<?php echo base_url();?>assets/img/medidas/embargoUsufructo.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(15);"><img src="<?php echo base_url();?>assets/img/medidas/embargoGarantiaInmob.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                               
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
			                  			</div>
			                  		</div>
			                  		
			                    </div>
			                 
			                  	<div class="chart tab-pane" id="medidas2" style="position: relative; height: auto;">
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
		                  		 	<h4 class="modal-title" id="tituloModal"></h4>
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
									<form class="form-horizontal">
										<div class="form-group">
											<label for="txtSolicitudF" class="col-sm-3 control-label">Fecha Solicitud *</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="txtSolicitudF" placeholder="Fecha Solicitud">
											</div>
										</div>
										<div class="form-group">
											<label for="txtDecretoF" class="col-sm-3 control-label">Fecha Decreto </label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="txtDecretoF" placeholder="Fecha Decreto">
											</div>
										</div>
										
										<div class="form-group">
											<label for="txtPracticaF" class="col-sm-3 control-label">Fecha Práctica </label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="txtPracticaF" placeholder="Fecha Práctica">
											</div>
										</div>
										<div class="form-group">
											<label for="txtSecuestro" class="col-sm-3 control-label">Secuestre </label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="txtSecuestro" placeholder="Secuestre">
											</div>
										</div>
										<div class="form-group">
											<label for="txtOtroBien" class="col-sm-3 control-label">Otro Bien </label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="txtOtroBien" placeholder="Otro Bien">
											</div>
										</div>
										<div class="form-group">
											<label for="txtObservacionesFechas" class="col-sm-3 control-label">Observaciones</label>
											<div class="col-sm-9">
												<textarea class="form-control" id="txtObservacionesFechas" placeholder="Observaciones"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="txtOtroBien" class="col-sm-3 control-label">La medida fue efectiva </label>
											<div class="col-sm-9">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="Calificacionesobligaciones"  value="SI">
														Si
													</label>
												</div>

												<div class="checkbox">
													<label>
														<input type="checkbox" name="Calificacionesobligaciones" value="NO">
														No
													</label>
												</div>
											</div>
										</div>

									</form>
			                  		<div class="row-fluid">
			                  				
						                <div class="row">

						                    <div class="col-md-9" >
						                        <div class="form-group" id="modalBody">
						                            
						                        </div>
						                    </div>
						                    <div class="col-md-3">
						                       <button class="btn btn-primary" id="GuardarBtnMedidas" type="button">Guardar</button>
						                    </div>
						                </div>
			                  			
			                  		</div>
			                  	</div>
		                 	</div>
		                </div>
		            </div>
		        </div>
		    </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/bajadas/Jzip.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>


<style type="text/css">
	td.details-control {
	    background: url('<?php echo base_url();?>assets/img/botones/details_open.png') no-repeat center center;
	    cursor: pointer;
	}
	tr.shown td.details-control {
	    background: url('<?php echo base_url();?>assets/img/botones/details_close.png') no-repeat center center;
	}

	th {text-align:center;}
</style>
<script type="text/javascript">
var numeroContrato = 0;
var nombreContrato= '';
var comunicacion = 0;
var resultadocomunicacion = 0;
var gestion = 0;
var subgestion  = 0;
var etapa = 0;
var medidaCautelar = 0;


var interesxmora = 0;
var saldosimulador = 0;
var fachasimulador = '';
var simuladorFinalos = 0;
var valoragadoFNG = 0;

var tipoProceso = 0;
	
	fng = {
		codeudores : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getCodeudores/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaCodeudores").html(tablaExtraJudicial);
	    			$(".obligacionesHref").click(function(e){
	    				e.preventDefault();
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/detallesObligaciones/'+ $(this).attr('usuario'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("CODEUDORES");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});
	    		}

	    	});
		},

		judicial : function (varcontrato){
			$.ajax({
	    		url    	 : '<?php echo base_url();?>cartera_fng/getgestioJudicial/'+ varcontrato,
	    		dataType : 'json',
	    		type     : 'POST',
	    		success  : function(tablaExtraJudicial){
	    			
					//$("#tblHistoricoJudicial").html(tablaExtraJudicial);
					
	    			

	    			if($.fn.dataTable.isDataTable( '#tblHistoricoJudicial' )){
	    				//console.log('es data table');
	    				$("#tblHistoricoJudicial").dataTable().fnDestroy();
						
	    			}
						
	    			var dataTableJudicial = $("#tblHistoricoJudicial").dataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "TipoProceso" },
								{ mData: "txtFechaIngreso" },
								{ mData: "Etapa" },
								{ mData: "actuacion" },
								{ mData: "fecha" },
								{ mData: "txtObservaciones" },
								{ mData: "users" }
								
							],"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"aaSorting":[[1,"desc"]],
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
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
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;

								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionJudicial');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionJudicial").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosgestionJudicial/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("HISTORICO GESTION JUDICIAL");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							"dom": 'Blfrtip',
		        			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
							
				            
				    });
					
					
				
	    			



	    		}
	    	});
		},

		extrajudicial : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getgestionExtrajudicial/'+ varcontrato,
	    		dataType : 'json',
	    		type     : 'POST',
	    		success  : function(tablaExtraJudicial){
	    			

	    			if($.fn.dataTable.isDataTable( '#tblHistoricoExtrajudicial' )){
	    				$("#tblHistoricoExtrajudicial").dataTable().fnDestroy();
	    			}


	    			var tblHistoricoExtrajudicial = $("#tblHistoricoExtrajudicial").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "nombres" },
								{ mData: "mediocomunicacion" },
								{ mData: "resultadocomunicacion" },
								{ mData: "gestion" },
								{ mData: "subgestion" },
								{ mData: "observaciones" },
								{ mData: "users" },
								{ mData: "fecha"},
								{ mData: "Niidea"}
							],
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"aaSorting":[[7,"desc"]],
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				           	"iDisplayLength": 20,
				           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
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
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionExtraJudicial');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionExtraJudicial").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosgestionExtrajudicial/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("HISTORICO GESTION  EXTRAJUDICIAL");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
				    });
				
	    		}
	    	});
		},

		medidas : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getTablaMedida/'+ varcontrato,
	    		type   : 'POST',
	    		dataType: 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			if($.fn.dataTable.isDataTable( '#tblHistoricoMedidas' )){
	    				$("#tblHistoricoMedidas").dataTable().fnDestroy();
	    			}


	    			var tblHistoricoMedidas = $("#tblHistoricoMedidas").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "fecha" },
								{ mData: "Medida" },
								{ mData: "var1" },
								{ mData: "var2" },
								{ mData: "var3" },
								{ mData: "Secuestre" },
								{mData : "calificar"}
							
								
							],
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"aaSorting":[[0,"asc"]],
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
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
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.G736_ConsInte__b;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionMedidas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionMedidas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosMedidas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("HISTORICO MEDIDAS CAUTELARES");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
				    });
	    		}
	    	});
		},


		garantias : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getGarantias/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    		
	    			if($.fn.dataTable.isDataTable( '#tblGarantiaPagare' )){
	    				$("#tblGarantiaPagare").dataTable().fnDestroy();
	    			}


	    			var tblGarantiaPagare = $("#tblGarantiaPagare").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "contrato"},
								{ mData: "garantia" },
								{ mData: "pagare" },
								{ mData: "vPagado"}
							],
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				           "iDisplayLength": 20,
				           "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
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
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligaciongarania');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligaciongarania").dblclick(function(){
									var garantia = $(this).attr('id').replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosGarantias/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("GARANTIAS Y PAGARÉS");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });

					
							},
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
							
				    });
	    		}
	    	});
		},

		
		acuerdopago : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/gerAcuerdoPago/'+ varcontrato,
	    		type   : 'POST',
	    		dataType: 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			if($.fn.dataTable.isDataTable( '#tblAcuerdoPago' )){
	    				$("#tblAcuerdoPago").dataTable().fnDestroy();
	    			}


	    			var tblAcuerdoPago = $("#tblAcuerdoPago").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
								{ mData: "FECHA_CONSIGNACION_ANTICIPO"},
								{ mData: "FECHA_DE_LEGALIZACION" },
								{ mData: "VALOR_DEL_ACUERDO" },
								{ mData: "PLAZO_ACUERDO_DE_PAGO"}
							],
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
							"bAutoWidth": false , 
							"responsive" : true,
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
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.id;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionMedidasPoh');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionMedidasPoh").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosAcuerdoDepago/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("ACUERDO DE PAGO");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
				    });
  		
				}
	    	});
		},

		

		facturas : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturas/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    				    			

	    			if($.fn.dataTable.isDataTable( '#tblFacturas' )){
	    				$("#tblFacturas").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturas").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "N_DE_FACTURA_AUTO_DE_SUBROGACION" },
								{ mData: "FECHA"},
								
								{ mData: "FECHA_AUTO_DE_SUBROGACION" },
								{ mData: "VALOR_FACTURADO_AUTO_DE_SUBROGACION"}
							],
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
							"bAutoWidth": false , 
							"responsive" : true,
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
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
							
				    });
	    		}
	    	});

	    	//Irrecuperables
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasIrrecuperables/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			
	    			if($.fn.dataTable.isDataTable( '#tblFacturasIrrecuperables' )){
	    				$("#tblFacturasIrrecuperables").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturasIrrecuperables").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "N_DE_FACTURA_IRRECUPERABLE" },
								{ mData: "FECHA_SENTENCIA_IRRECUPERABLE"},
								
								{ mData: "FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE" },
								{ mData: "VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE"}
							],
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
							"bAutoWidth": false , 
							"responsive" : true,
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
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
							
				    });
	    		}
	    	});


	    	//Soporte
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasSOPORTE/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			
	    			if($.fn.dataTable.isDataTable( '#tblFacturasSoporte' )){
	    				$("#tblFacturasSoporte").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturasSoporte").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "NumeroFactura" },
					            { mData: "fecharecepcion" },
								{ mData: "fechaaprovacion"},
								{ mData: "valor"}
							],
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
							"bAutoWidth": false , 
							"responsive" : true,
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
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
				    });
	    		}
	    	});


			//Honorarios
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasHonorarios/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			
	    			if($.fn.dataTable.isDataTable( '#tblFacturasHonorarios' )){
	    				$("#tblFacturasHonorarios").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturasHonorarios").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "NumeroFactura" },
					            { mData: "fecha" },
								{ mData: "valor"}
							],
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
							"bAutoWidth": false , 
							"responsive" : true,
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
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			$("#Modal-datos-extrajudicial").modal();
							    		}
							    	});
							   });
							},
							"dom": 'Blfrtip',
			    			"buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
							
				    });
	    		}
	    	});
			
		},

		infoJudicial : function(varcontrato){

			$("#RedicadoExpediente").html('');
			$("#Fecchademanda").html('');
			$("#fechaadmiciondenabda").html('');
			$("#fechamandamientoPago").html('');
			$("#totalGastosJudicales").html('');
			$("#txtNombreabogadoIf").html('');
			$("#FechaEnvioMemorialTerminacion").html('');

			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getinformacionJudicial/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {
	    				$("#RedicadoExpediente").html(item.Radicado_o_expediente);
	    				var x = item.Fech_demanda;
	    				if(x){
	    					$("#Fecchademanda").html(x.split(' ')[0]);
	    				}
		    			
		    			var f = item.Fecha_admision_demanda;
		    			if(f){
		    				$("#fechaadmiciondenabda").html(f.split(' ')[0]);
		    			}
		    			
		    			var  m = item.Fecha_mandamiento_de_pago;
		    			if(m){
		    				$("#fechamandamientoPago").html(m.split(' ')[0]);
		    			}
		    			
		    			$("#totalGastosJudicales").html("$ "+ Number(item.Total_gastos_judiciales).toFixed(0));
		    			$("#judicialFechaTerminacion").html(item.fechaTErminacion);
		    			$("#txtNombreabogadoIf").html(item.abogadoIf);
		    			$("#FechaEnvioMemorialTerminacion").html(item.fechaEnvioTErminacion);
	    			});
	    			
	    		}
	    	});
			
		},


		abogado : function(varcontrato){

			$("#AbogadoDireccion").html('');
			$("#AbogadoTelefono").html('');
			$("#AbogadoCorreo").html('');
			$("#AbogadoCelular").html('');
			$("#AbogadoFirma").html('');
			$("#AbogadoFrg").html('');
			$("#AbogadoPromotor").html('');
			$("#abogadoCarajo").html('');
			$("#fechaAsignacionabogado").html('');
			$("#NumeroPoliza").html('');
			$("#fechaaprovaciondelapoliza").html('');
			$("#fechadevencimientocarajo").html('');


			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getInformacionAbogado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {
	    				$("#abogadoCarajo").html(item.Abogado);
	    				var x = item.Fecha_asignacion_abogado;
	    				
	    				if(x){

	    					x = x.split(' ')[0];
	    					x = x.split('-');
	    					$("#fechaAsignacionabogado").html(x[2] +'/' + x[1] + '/' + x[0]);
	    				}
		    			
		    		
		    			$("#NumeroPoliza").html( item.No_Poliza );
		    		
		    			
		    			var  m = item.Fecha_de_aprobacion_de_Poliza;
		    			if(m){
		    				m = m.split(' ')[0];
	    					m = m.split('-');
		    				$("#fechaaprovaciondelapoliza").html(m[2] +'/' + m[1] + '/' + m[0]);	
		    			}
		    			
		    			var f = item.Fecha_de_vencimiento;
		    			if(f){
		    				f = f.split(' ')[0];
	    					f = f.split('-');
		    				$("#fechadevencimientocarajo").html(f[2] +'/' + f[1] + '/' + f[0]);
		    			}

		    			$("#AbogadoDireccion").html(item.direccion);
                		$("#AbogadoTelefono").html(item.telefono);
                		$("#AbogadoCorreo").html(item.correo);
                		$("#AbogadoCelular").html(item.celular);
                		$("#AbogadoFirma").html(item.firma);
                		$("#AbogadoFrg").html(item.frg);
                		$("#AbogadoPromotor").html(item.promotor);
	    			});
	    		}
	    	});
		},

		pazysalvo : function(varcontrato){
			
			$("#fechapazysalvo").html('');
			$("#pazysalvo").html('');
			$("#fechadeventacarajos").html('');

			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getPazYsalvo/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {

	    				var x = item.Fecha_de_expedicion_del_paz_y_salvo;
	    				if(x){
	    					$("#fechapazysalvo").html(x.split(' ')[0]);
	    				}
		    			var paz = 'NO';
		    			if(item.Paz_y_salvo == '1405'){
		    				paz = 'SI';
		    			}
		    			$("#pazysalvo").html(paz);
		    			var m = item.Fecha_venta;
		    			if(m){
		    				$("#fechadeventacarajos").html(m.split(' ')[0]);	
		    			}
	    			});

	    		}
	    	});
		},

		subrogacion : function(varcontrato){

			$("#fechaenviomemorial").html('');
			$("#fechadevolocionmemorial").html('');	
			$("#fechaenviomemeorialcorregido").html('');
			$("#fecharedicacionMemorial").html('');
			$("#fechapronunciamiento").html('');
			$("#decision").html('');
			$("#fechaimpugnacion").html('');
			$("#nombreclaseimpugnacion").html('');
			$("#Fechadecicionfinal").html('');
			$("#decicionfinal").html('');

			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getSubrogacion/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){

	    			$.each(tablaExtraJudicial, function(i, item) {

	    			
						$("#fechaenviomemorial").html(item.Fecha_envio_memorial_de_subrogacion_al_FRG);
						$("#fechadevolocionmemorial").html(item.Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores);	
						$("#fechaenviomemeorialcorregido").html(item.Fecha_envio_memorial_de_subrogacion_corregido);
						$("#fecharedicacionMemorial").html( item.Fecha_radicacion_memorial);
						$("#fechapronunciamiento").html(item.Fecha_pronunciamiento);	
						$("#decision").html(item.Decision);
						$("#fechaimpugnacion").html(item.Fecha_impugnacion_decision_final);
						$("#nombreclaseimpugnacion").html(item.Nombre_clase_de_impugnacion);
						$("#Fechadecicionfinal").html(item.Fecha_decision_final);
						$("#decicionfinal").html(item.decicion_Final);
	    			});
	    		}
	    	});
		},

		dartosadicionales : function (){
		
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosAdicionales/<?php echo $idUsuario;?>',
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			if($.fn.dataTable.isDataTable( '#tabladatos_Extras' )){
	    				$("#tabladatos_Extras").dataTable().fnDestroy();
	    			}

	    			$("#tabladatos_Extras").DataTable({
						"aaData": tablaExtraJudicial,
						"aoColumns": [
							{ mData: "obligaciones" },
							{ mData: "deudor"},
							{ mData: "rol" },

							{ mData: "TELEFONO" },
							{ mData: "Calificacion_telefono"},
							{ mData: "DIRECCION" },
							{ mData: "Calificacion_direccion"},
							{ mData: "CIUDAD" },
							{ mData: "Calificacion_ciudad"},
							{ mData: "CORREO_ELECTRONICO" },
							{ mData: "Calificacion_correo"},
							{ mData: "DESCRIPCION" },
							{ mData: "fecha"}
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
			           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
			            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
							var id = aData.id;
							$(nRow).attr("id",id);
							$(nRow).attr("class",'trobligacionDatosAdicionales');
							return nRow;
						   
						},
						"fnDrawCallback": function (oSettings, json) {
						   //Aqui va el comando para activar los otros botones
						   $(".trobligacionDatosAdicionales").dblclick(function(){
								var garantia = $(this).attr('id').replace(' ', '');
								$.ajax({
						    		url    : '<?php echo base_url();?>auxiliar/getdatosadicionalesbyid/'+ garantia,
						    		success  : function(data){
										$("#titulodeestaJoda").html("DATOS ADICIONALES");
						    			$("#datosGestionExtraJudicial").html(data);
						    			$("#Modal-datos-extrajudicial").modal();
						    		}
						    	});
						   });
						},
						"bJQueryUI": true,
						"bProcessing": true,
						"bSort": true,
						"bSortClasses": false,
						"bDeferRender": true,
						"sPaginationType": "simple",
			           	"iDisplayLength": 20,
			           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
			            "dom": 'Blfrtip',
				        "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}
				        ]
			    	});
	    		}
	    	});
			
		},

		datosIniciales : function(){
echo(<?php echo $idUsuario;?>);
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosIniciales/<?php echo $idUsuario;?>',
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			if($.fn.dataTable.isDataTable( '#tabladatos_Iniciales' )){
	    				$("#tabladatos_Iniciales").dataTable().fnDestroy();
	    			}

	    			$("#tabladatos_Iniciales").DataTable({
						"aaData": tablaExtraJudicial,
						"aoColumns": [
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
			           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
			            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			            	//alert( aData.id_log_datos);
							var id = aData.id_log_datos;
							$(nRow).attr("id",id);
							$(nRow).attr("class",'trobligacionDatosIniciales');
							return nRow;
						   
						},
						"fnDrawCallback": function (oSettings, json) {
						   //Aqui va el comando para activar los otros botones
						   $(".trobligacionDatosIniciales").dblclick(function(){
								var garantia = $(this).attr('id').replace(' ', '');
								$.ajax({
						    		url    : '<?php echo base_url();?>auxiliar/getdatosInicialesbyid/'+ garantia,
						    		success  : function(data){
										$("#titulodeestaJoda").html("DATOS ADICIONALES");
						    			$("#datosGestionExtraJudicial").html(data);
						    			$("#Modal-datos-extrajudicial").modal();
						    		}
						    	});
						   });
						},
						"bJQueryUI": true,
						"bProcessing": true,
						"bSort": true,
						"bSortClasses": false,
						"bDeferRender": true,
						"sPaginationType": "simple",
			            "iDisplayLength": 20,
			            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
			            "dom": 'Blfrtip',
				        "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
			       	});

			       	fng.asignarDatos(tablaExtraJudicial);
	    		}
	    	});
		},

		
		asignarDatos :function(tablaExtraJudicial){
			$.each(tablaExtraJudicial, function(i,item){
	       		if(tablaExtraJudicial[i].cal_direccionDomicilio != ''){
	       			$("#direccion_domicilio").val(tablaExtraJudicial[i].direccionDomicilio);
	       		}	

	       		if(tablaExtraJudicial[i].cal_ciudadDomicilio != ''){
	       		
	       			$("#ciudad_domicilio option").filter(function() {
				    //may want to use $.trim in here
				    	return $(this).text() == tablaExtraJudicial[i].ciudad_domicilio; 
					}).prop('selected', true);

	       		}

	       		if(tablaExtraJudicial[i].cal_direccionOficina != ''){
	       			$("#direccion_oficina").val(tablaExtraJudicial[i].direccionOficina);
	       		}

	       		if(tablaExtraJudicial[i].cal_ciudadOficina != ''){
	       			
	       			$("#ciudad_oficina option").filter(function() {
				    //may want to use $.trim in here
				    	return $(this).text() == tablaExtraJudicial[i].ciudadOficina; 
					}).prop('selected', true);

	       		}

	       		if(tablaExtraJudicial[i].cal_telefonoDomicilio != ''){
	       			$("#telefono_domicilio").val(tablaExtraJudicial[i].telefonoDomicilio);
	       		}

	       		if(tablaExtraJudicial[i].cal_tefonoOficina != ''){
	       			$("#telefono_oficina").val(tablaExtraJudicial[i].tefonoOficina);
	       		}

	       		if(tablaExtraJudicial[i].cal_celular != '' ){
	       			$("#celular").val(tablaExtraJudicial[i].celular);
	       		}

	       		if(tablaExtraJudicial[i].cal_celularAdicional != ''){
	       			$("#celular_adicional").val(tablaExtraJudicial[i].celularAdicional);
	       		}

	       		if(tablaExtraJudicial[i].cal_mail != ''){
	       			$("#correo_electronico").val(tablaExtraJudicial[i].mail);
	       		}

	       		if(tablaExtraJudicial[i].cal_dir_Adicional != ''){
	       			$("#dir_Adicional").val(tablaExtraJudicial[i].dir_Adicional);
	       		}

	       		if(tablaExtraJudicial[i].cal_ciudad_adicional != ''){
	       			
	       			$("#ciudad_adicional option").filter(function() {
				    //may want to use $.trim in here
				    	return $(this).text() == tablaExtraJudicial[i].ciudad_adicional; 
					}).prop('selected', true);
	       		}

	       		if(tablaExtraJudicial[i].cal_tele_adicional != ''){
	       			$("#tele_adicional").val(tablaExtraJudicial[i].tele_adicional);
	       		}

	       		$("#selCiudad_oficina option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_ciudadOficina; 
				}).prop('selected', true);

	       		$("#selTelefono_domicilio option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_telefonoDomicilio; 
				}).prop('selected', true);

	       		$("#selTelefono_oficina option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_tefonoOficina; 
				}).prop('selected', true);

	       		$("#selCelular option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_celular; 
				}).prop('selected', true);

	       		$("#selCelularAdicional option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_celularAdicional; 
				}).prop('selected', true);

	       		$("#selCorreoOficial option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_mail; 
				}).prop('selected', true);

	       		$("#selciudad_adicional option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_ciudad_adicional; 
				}).prop('selected', true);

	       		$("#seldiradicional option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_dir_Adicional; 
				}).prop('selected', true);

	       		$("#selTelAdicional option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_tele_adicional; 
				}).prop('selected', true);

				$("#Seldireccion_oficina option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_direccionOficina; 
				}).prop('selected', true);

				$("#Selciudad_domicilio option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_ciudadDomicilio; 
				}).prop('selected', true);

				$("#seldireccion_domicilio option").filter(function() {
			    //may want to use $.trim in here
			    	return $(this).text() == tablaExtraJudicial[i].cal_direccionDomicilio; 
				}).prop('selected', true);
			});
		}
	}
	$(function(){

		$(".timepicker").timepicker({
            showInputs: false,
            timeFormat: 'HH:mm:ss',
	        minTime: 'now', // 11:45:00 AM,
	        showMeridian: false,
	        showSeconds : true
        });

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

         //datemask1 dd/mm/yyyy
        $(".datemask1").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });

        $(".datemask3").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });


        $.fn.datepicker.dates['as'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "dd/mm/yyyy",
            titleFormat: "dd/mm/yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

        $("#txtSimuladorFEchaLiquidacion").datepicker({
            language: "as",
            autoclose: true,
            todayHighlight: true
        });

        $("#txtSolicitudF").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate',function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('#txtDecretoF').datepicker('setStartDate', startDate);
	    }); 


        $("#txtDecretoF").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true,
        	onSelect: function(){
				$('#txtPracticaF').datepicker('option', 'minDate', true);
			}
        }).on('changeDate',function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('#txtPracticaF').datepicker('setStartDate', startDate);
	    }); 

        $("#txtPracticaF").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true
        });

        $("#butoncierreSimulador").click(function(){
        	//aqui se cosultan los intereses moratorios y el total a pagar
        	$("#txtSimuladorFEchaLiquidacion").val('<?php echo date("d/m/Y");?>');
			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
			//console.log(txtFechaLiquida);
			var hijueputaFecha = fachasimulador.split("/");
			var resta  = restaFechas(hijueputaFecha[2] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[0], fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			//console.log(resta);
			
			//console.log(resta);

			var finalis = ((mora * resta) / 365);
			$("#simuladorMoratorios").html("$ " + formatNumber.new(finalis.toFixed(0)));
			var suma = Number(finalis) + Number(saldosimulador);
			$("#TotalApagarSimulador").html("$ "+ formatNumber.new(suma.toFixed(0)));
			var anticipo = (suma * 0.1);



			//esto es el anticipo y las ondiciones para realizar el pago
			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));
			var saldodigerrir = Number(estoaqui) + Number(finalis);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			$("#fechaLimitePagoLiquidacion").html('');
			var estasuma =sumaFecha(15,  fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			estasuma = estasuma.split('-');
			$("#fechaLimitePagoLiquidacion").html(estasuma[2]+"/"+estasuma[1]+"/"+estasuma[0]);


			var resltao = getValorCuota( saldosimulador, 13, $("#txtNumeroCuotas").val(), finalis);
			console.log(resltao);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

			$("#Modal-Simulador").modal('hide');
        });
	
		<?php if($datosadicionales != ''){ ?>
			$("#tabladatos_Extras").DataTable({
				"aaData": <?php echo $datosadicionales;?>,
				"aoColumns": [
                	{ mData: "obligaciones" },
					{ mData: "deudor"},
					{ mData: "rol" },

					{ mData: "TELEFONO" },
					{ mData: "Calificacion_telefono"},
					{ mData: "DIRECCION" },
					{ mData: "Calificacion_direccion"},
					{ mData: "CIUDAD" },
					{ mData: "Calificacion_ciudad"},
					{ mData: "CORREO_ELECTRONICO" },
					{ mData: "Calificacion_correo"},
					{ mData: "DESCRIPCION" },
					{ mData: "fecha"}
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
	           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
	            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
					var id = aData.id;
					$(nRow).attr("id",id);
					$(nRow).attr("class",'trobligacionDatosAdicionales');
					return nRow;
				   
				},
				"fnDrawCallback": function (oSettings, json) {
				   //Aqui va el comando para activar los otros botones
				   $(".trobligacionDatosAdicionales").dblclick(function(){
						var garantia = $(this).attr('id').replace(' ', '');
						$.ajax({
				    		url    : '<?php echo base_url();?>auxiliar/getdatosadicionalesbyid/'+ garantia,
				    		success  : function(data){
								$("#titulodeestaJoda").html("DATOS ADICIONALES");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
				   });
				},
				"bJQueryUI": true,
				"bProcessing": true,
				"bSort": true,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
	           	"iDisplayLength": 20,
	           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
	            "dom": 'Blfrtip',
		        "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
	    });


		<?php } ?>

		<?php if($procesoAsociado != ''){ ?>
			$("#tablaProcesosAsociados").DataTable({
				"aaData": <?php echo $procesoAsociado;?>,
				"aoColumns": [
                	{ mData: "liquidacion" },
					{ mData: "Proceso" },
					{ mData: "EstadoProceso" },
					
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
	           	"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.identificacion;
								$(nRow).attr("dato",id);
								$(nRow).attr("class",'trobligacion');
								return nRow;
							   print(id);
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacion").dblclick(function(){
									var garantia = $(this).attr('dato').replace(' ', '');
									window.location.href = "<?php echo base_url();?>/cartera_fng/datosProcesoAsociado/"+garantia;
							   });
							},
				"bJQueryUI": true,
				"bProcessing": true,
				"bSort": true,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
	           	"iDisplayLength": 20,
	           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
	            "dom": 'Blfrtip',
		        "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
	    });
			<?php } ?>
		
		fng.asignarDatos(<?php echo $iniciales;?>);

		$("#tabladatos_Iniciales").DataTable({
			"aaData": <?php echo $iniciales;?>,
			"aoColumns": [

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
           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				var id = aData.id_log_datos;
				$(nRow).attr("id",id);
				$(nRow).attr("class",'trobligacionDatosIniciales');
				return nRow;
			   
			},
			"fnDrawCallback": function (oSettings, json) {
			   //Aqui va el comando para activar los otros botones
			   $(".trobligacionDatosIniciales").dblclick(function(){
					var garantia = $(this).attr('id').replace(' ', '');
					$.ajax({
			    		url    : '<?php echo base_url();?>auxiliar/getdatosInicialesbyid/'+ garantia,
			    		success  : function(data){
							$("#titulodeestaJoda").html("DATOS ADICIONALES");
			    			$("#datosGestionExtraJudicial").html(data);
			    			$("#Modal-datos-extrajudicial").modal();
			    		}
			    	});
			   });
			},
			"bJQueryUI": true,
			"bProcessing": true,
			"bSort": true,
			"bSortClasses": false,
			"bDeferRender": true,
			"sPaginationType": "simple",
           	"iDisplayLength": 20,
           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
            "dom": 'Blfrtip',
		        "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv'}]
	        
       	});

	    $("#RowContrato td").click(function(){
	    	
	    	$("#txtNumeroContrato").html('');
	    	$("#AsigancionAbogado").html('');
	    	$("#txtValorPagado").html('');
	    	$("#txtIntermediarioF").html('');
	    	$("#txtCobertura").html('');
	    	$("#txtFechagarantia").html('');
	    	$("#txtJudicial").html('');
	    	$("#txtFrg").html('');
	    	$("#txtSap").html('');
	    	$("#txtDespacho").html('');
	    	$("#txtciudadDespacho").html('');
	    	$("#txtClase").html('');
	    	$("#txtEstado").html('');
	    	$("#tareasEstaVaina").html('');
	    	$("#simularContrato").html('');
	    	$("#simuladorUltimoabono").html('');
	    	$("#simuladorSaldo").html('');
	    	$("#simuladorfondoCartera").html('');
			$("#simuladorIntemediario").html('');
			$("#simuladorFechaPago").html('');
			$("#simuladorValorPagadoFng").html('');
			$("#simuladorTasamora").html('');
			$("#simuladorgastosJudiciales").html('');
			$("#simuladSaldoCapital").html('');
			$("#simuladorMoratorios").html('');
			$("#TotalApagarSimulador").html('');
			$("#fechaLimitePagoLiquidacion").html('');
			$("#interecescalcluloSimulador").html('');
			$("#anticipoSimulador").html('');
			$("#MontocapitalDiferirSimulador").html('');
			$("#saldoadiferirSimulador").html('');
			$("#valorHonorarios").html('');
			$("#referenciaCOntratop").html('');
			$("#valordelascuotasSimulador").html('');
			
	    	var dato = $(this).attr('contrato').replace(' ', '');
	    	$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosObligaciones/'+ dato,
	    		dataType : 'json',
	    		success  : function(data){
	    			$.each(data, function(i, item) {
	    				$("#AsigancionAbogado").html(item.EstadoAbogado);
					    $("#txtNumeroContrato").html(item.Contrato);

					    var sal = item.Vlorpagado;
		    			$("#txtValorPagado").html("$ "+ formatNumber.new(Number(sal).toFixed(0)));
		    			$("#txtIntermediarioF").html(item.financiero);

		    			$("#txtCobertura").html(item.Cobertura + ' %');
		    			var fecha = item.fgarantia;
		    			if(fecha){
		    				fecha = fecha.split(' ')[0];
		    				fecha = fecha.split('-');
		    				fecha = fecha[2] + "/" + fecha[1] + "/" + fecha[0];
		    			}else{
		    				fecha = '';
		    			}

		    			$("#txtFechagarantia").html(fecha);
		    			var textto = 'NO';
		    			if($.isNumeric(item.Judiciable)){
		    				textto = 'SI';
		    			}
		    			$("#txtJudicial").html(textto);


		    			$("#txtFrg").html(item.FRG);
		    			$("#txtSap").html(item.SAP);
		    			$("#txtDespacho").html(item.Despacho);
		    			$("#txtciudadDespacho").html(item.ciudaddespacho);


		    			$("#txtClase").html(item.claseProceso);
		    			tipoProceso = item.procesoGu;

		    			

		    			$("#TxtTituloProceso").html('<h4>'+ item.claseProceso +'</h4>');
		    			if(item.claseProceso != 'EJECUTIVO'){
		    				$("#EjecutovosEtapas").hide();
		    				$("#otrasEtapas").show();
		    			}else{
							$.ajax({
								//EjecutovosEtapas
								url    : '<?php echo base_url();?>cartera_fng/getEtapasProceso/'+ tipoProceso,
								success  : function(data){
									$("#EjecutovosEtapas").html(data);
								}
							});
		    				$("#EjecutovosEtapas").show();
		    				$("#otrasEtapas").hide();
		    			}

		    			$("#txtEstado").html(item.estadoP);
		    			

		    			$("#tareasEstaVaina").val(item.Contrato);

		    			//esta es la carga del simulador
		    			var otherfecha = item.ultimoavnoFecha;
		    			if(otherfecha){
		    				otherfecha = otherfecha.split(' ')[0];
		    				otherfecha = otherfecha.split('-');
		    			}
		    			$("#simularContrato").html(item.Contrato);
		    			$("#simuladorUltimoabono").html(otherfecha[2]+"/"+otherfecha[1]+"/"+otherfecha[0]);

		    			var Jodete = item.saldo;
		    			$("#simuladorSaldo").html("$ "+formatNumber.new(Number(Jodete).toFixed(0)));

		    			$("#simuladorfondoCartera").html(item.FRG);
		    			$("#simuladorIntemediario").html(item.financiero);
		    			$("#simuladorFechaPago").html(fecha);
		    			
		    			$("#simuladorValorPagadoFng").html("$ "+ formatNumber.new(Number(sal).toFixed(0)));

		    			$("#simuladorTasamora").html(formatNumber.new(item.interespormora) +" %");
		    			$("#simuladorgastosJudiciales").html("$ " + formatNumber.new(item.GastoJudiciales));
		    			$("#simuladSaldoCapital").html("$ "+formatNumber.new(Number(Jodete).toFixed(0)));

		    			var mora = ((item.interespormora / 100) * item.saldo);
		    			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
		    			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
		    			//console.log(txtFechaLiquida);
		    			var hijueputaFecha = fecha.split("/");
		    			var resta  = restaFechas(hijueputaFecha[2] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[0], fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
		    			//console.log(resta);
		    			var finalis = ((mora * resta) / 365);
		    			$("#simuladorMoratorios").html("$ " + formatNumber.new(Number(finalis).toFixed(0)));
		    			

		    			var suma = Number(finalis) + Number(item.saldo ) + Number(item.GastoJudiciales);
		    			$("#TotalApagarSimulador").html("$ "+ formatNumber.new(Number(suma).toFixed(0)));
		    			numeroContrato  = dato;
		    			nombreContrato = item.Contrato;
		    			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
		    			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
		    			var sumaLimite = sumaFecha(15, fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
		    			sumaLimite = sumaLimite.split('-');
		    			$("#fechaLimitePagoLiquidacion").html(sumaLimite[2] + "/"+ sumaLimite[1] + "/"+ sumaLimite[0]);

		    			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));


		    			var anticipo = (suma * 0.1);
		    			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

		    			var estoaqui = ( item.saldo - anticipo)
		    			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));

		    			var saldodigerrir = Number(estoaqui) + Number(finalis);
		    			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

		    			var valor = (item.Vlorpagado * 0.1);
		    			$("#valorHonorarios").html("$ "+ formatNumber.new(valor.toFixed(0)));

		    			$("#referenciaCOntratop").html("<label>"+nombreContrato+"</label>");

		    			var resltao = getValorCuota( Jodete, 0.13, 10, finalis);
						//console.log(resltao);
						$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));


		    			interesxmora = item.interespormora;
						saldosimulador = Number(Jodete).toFixed(0);
						fachasimulador = fecha;
						simuladorFinalos = finalis;
						valoragadoFNG = item.Vlorpagado;
					});
	    			//$("#gestionJudicial").attr('href', '<?php echo base_url();?>cartera_fng/gestionJudicialmenu/<?php echo $identificacion;?>/'+dato);
	    		
	    		}
	    	});

	    	$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosDeudores/'+ dato,
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

	    	$("#exportarExtrajudicial").attr("href", '<?php echo base_url();?>cartera_fng/exportarExtrajudicial/'+ dato);
	    	$("#exportarJudicial").attr("href", '<?php echo base_url();?>cartera_fng/exportarJudicial/'+ dato);
	    	$("#exportarMedidas").attr("href", '<?php echo base_url();?>cartera_fng/exportarMedidas/'+ dato);

	    	/*$.ajax({
	    		url    : '<?php //echo base_url();?>cartera_fng/getRolusuario',
	    		type   : 'POST',
	    		data   : {contrato: dato , usuario:<?php //echo $idUsuario;?>},
	    		success  : function(data){
	    			$("#txtRol").html(data);
	    		}
	    	});*/


	    	fng.extrajudicial(dato);
	    	fng.judicial(dato);
	    	fng.medidas(dato);
	    	fng.acuerdopago(dato);
	    	fng.garantias(dato);
	    	fng.codeudores(dato);
	    	fng.facturas(dato);
	    	fng.infoJudicial(dato);
	    	fng.abogado(dato);
	    	fng.pazysalvo(dato);
	    	fng.subrogacion(dato);

	    	$("#campos").show();
	    	
	    });
	

		$("#obligaciones").change(function(){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatoscoDeudores/'+ $(this).val(),
	    		dataType : 'json',
	    		success  : function(data){
	    			var select = '<option value="0">Seleccione un deudor</option>';
	    			$.each(data, function(i, item) {
					    select += '<option value="'+ item.id +'">'+ item.deudor+'</option>';
					});
	    			$("#rolUsers").val('');
	    			$("#DeudoresAqui").html(select);

	    			$("#DeudoresAqui").change(function(){
						$.ajax({
							url    : '<?php echo base_url();?>cartera_fng/getRolusuario',
							type   : 'POST',
							data   : {contrato: $("#obligaciones").val(), usuario: $(this).val()},
							success  : function(data){
								$("#rolUsers").val(data);
								$("#rolUsers1").val(data);
							}
						});
	    			});
	    		}
	    	});
		});

		$("#calculoEstadoSimulador").click(function(){

			//aqui se cosultan los intereses moratorios y el total a pagar
			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
			//console.log(txtFechaLiquida);
			var hijueputaFecha = fachasimulador.split("/");
			var resta  = restaFechas(hijueputaFecha[2] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[0], fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			//console.log(resta);
			
			//console.log(resta);

			var finalis = ((mora * resta) / 365);
			$("#simuladorMoratorios").html("$ " + formatNumber.new(finalis.toFixed(0)));
			var suma = Number(finalis) + Number(saldosimulador);
			$("#TotalApagarSimulador").html("$ "+ formatNumber.new(suma.toFixed(0)));
			var anticipo = (suma * 0.1);



			//esto es el anticipo y las ondiciones para realizar el pago
			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));
			var saldodigerrir = Number(estoaqui) + Number(finalis);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			$("#fechaLimitePagoLiquidacion").html('');
			var estasuma =sumaFecha(15,  fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			estasuma = estasuma.split('-');
			$("#fechaLimitePagoLiquidacion").html(estasuma[2]+"/"+estasuma[1]+"/"+estasuma[0]);


			var resltao = getValorCuota( saldosimulador, 0.13, $("#txtNumeroCuotas").val(), finalis);
			console.log(resltao);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

		});

		$("#btnCalcular2Simulador").click(function(){

			/*var interes = $("#txtPorcentajeSmulador").val();
			var suma = Number(simuladorFinalos) + Number(saldosimulador);
			var anticipo = (suma * ( interes / 100 ));
			//var anticipo = $("#anticipoSimulador").html();
			//anticipo = anticipo.replace('$','', anticipo);
			//anticipo = anticipo.replace('.','', anticipo);
			console.log(anticipo);
			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
			
			//console.log(fachasimulador);
			var hijueputaFecha = fachasimulador.split("/");
			console.log(hijueputaFecha[0] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[2]);
			console.log(fechaLiquidacionEsta[0] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[2]);
			var resta  = restaFechas(  hijueputaFecha[0] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[2], fechaLiquidacionEsta[0] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[2]);
	
			console.log(resta);
			var finalis = ((mora * resta) / 365);

			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));

			var saldodigerrir = Number(estoaqui) + Number(simuladorFinalos);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			var resltao = getValorCuota( saldosimulador, 13, $("#txtNumeroCuotas").val(), finalis);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

			*/

			//aqui se cosultan los intereses moratorios y el total a pagar
			var interes = $("#txtPorcentajeSmulador").val()
			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
			//console.log(txtFechaLiquida);
			var hijueputaFecha = fachasimulador.split("/");
			var resta  = restaFechas(hijueputaFecha[2] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[0], fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			//console.log(resta);
			
			//console.log(resta);

			var finalis = ((mora * resta) / 365);
			//$("#simuladorMoratorios").html("$ " + formatNumber.new(finalis.toFixed(0)));
			var suma = Number(finalis) + Number(saldosimulador);
			//$("#TotalApagarSimulador").html("$ "+ formatNumber.new(suma.toFixed(0)));
			var anticipo = (suma * ( interes / 100 ));



			//esto es el anticipo y las ondiciones para realizar el pago
			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));
			var saldodigerrir = Number(estoaqui) + Number(finalis);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			/*$("#fechaLimitePagoLiquidacion").html('');
			var estasuma =sumaFecha(15,  fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			estasuma = estasuma.split('-');
			$("#fechaLimitePagoLiquidacion").html(estasuma[2]+"/"+estasuma[1]+"/"+estasuma[0]);*/


			var resltao = getValorCuota( saldosimulador, 0.13, $("#txtNumeroCuotas").val(), finalis);
			console.log(resltao);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

		});

		$("#btnCalcularAbogado").click(function(){
			var interes = $("#txtHonorariosSimulador").val();
			var valor = (valoragadoFNG * (interes / 100));
			$("#valorHonorarios").html("$ "+ formatNumber.new(valor.toFixed(0)));
		});


		$("#GuardarBtnMedidas").click(function(){
			if( $("#txtSolicitudF").val().length < 1){
				alertify.error('Es necesario elegir una fecha de Solicitud!');
				$("#txtSolicitudF").focus();
			}else{
				alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
		                    url       : '<?php echo base_url();?>cartera_fng/guardarMedidas',
		                    type      : 'POST',
		                    data      : {
										
											FechaSolicitud  : $("#txtSolicitudF").val(),
											FechaDecreto    : $("#txtDecretoF").val(),
											FechaPractica   : $("#txtPracticaF").val(),
											Secuestre       : $("#txtSecuestro").val() ,
											OtroBien        : $("#txtOtroBien").val(),
											Observaciones   : $("#txtObservacionesFechas").val(),
											medidaCautelar  : medidaCautelar,
		                                  	contrato 		: numeroContrato,
		                                  	Calificacionesobligaciones : $('input:radio[name=Calificacionesobligaciones]:checked').val()
		                                },
		                    success   : function(data){
		                       if(data == 1){
		                       		$("#txtSolicitudF").val('');
									$("#txtDecretoF").val('');
									$("#txtPracticaF").val('');
									$("#txtSecuestro").val('');
									$("#txtOtroBien").val('');
									$("#txtObservacionesFechas").val('');
									$("input:radio[name=Calificacionesobligaciones]").prop("checked", false);

		                          	$("#getsionMedidas2").attr('data-toggle','');
                          		 	$("#getsionMedidas1").click();

		                          	$("#Modal-Medidas").modal('hide');
		                          //$("#Modal-Menu").modal('hide');
		                          fng.medidas(numeroContrato);
		                          alertify.success("Medida Cautelar guardada satisfactoriamente");
		                       }else{
		                          alertify.error("Medida Cautelar, No se pudo guardar");
		                         
		                       }
		                    }
		                });
				    } else {
				        // user clicked "cancel"
				    }
				});



			}
		});

		$("#GuardarBtn").click(function(){
			var validador = 0;
			if( $("#txtFecha").val().length < 1){
				alertify.error("Es necesario elegir una fecha!");
				validador = 1;
				$("#txtFecha").focus();
			}
			
			if(!$("input[name=optionsRadios]:checked").val()) {
				alertify.error('No hay actuación seleccionada');
				validador = 1;
			}
			
			if(validador == 0) {
				alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
		                    url       : '<?php echo base_url();?>cartera_fng/guardardatosWizard',
		                    type      : 'POST',
		                    data      : {
		                                  actuacion : $('input:radio[name=optionsRadios]:checked').val() ,
		                                  contrato  : numeroContrato ,
		                                  etapa   : etapa,
		                                  txtFechaTramite : $("#txtFecha").val(),
		                                  TipoProceso  : tipoProceso ,
		                                  txtObservaciones : $("#txtObservaciones").val()
		                                },
		                    success   : function(data){
		                       if(data == 1){
		                          
		                          $("#Modal-Demanda").modal('hide');
		                          $("#Modal-Menu").modal('hide');
		                          fng.judicial(numeroContrato);
		                          fng.subrogacion(numeroContrato);
								  $("input:radio[name=optionsRadios]").prop("checked", false);
								  $("#txtFecha").val('');
								  $("#txtObservaciones").val('');
							   		$("#getsionJudicialTab2").attr('data-toggle','');
            						$("#getsionJudicialTab1").click();
		                          alertify.success("Gestión Judicial guardada satisfactoriamente");
		                       }else{
		                          alertify.error("Gestión Judicial, No se pudo guardar");
		                         
		                       }
		                    }
		                });
				    } else {
				        // user clicked "cancel"
				    }
				});

			}
            
        });

		$("#cerrarJudiciales").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("input:radio[name=optionsRadios]").prop("checked", false);
					$("#txtFecha").val('');
					$("#txtObservaciones").val('');
					$("#getsionJudicialTab2").attr('data-toggle','');
					$("#getsionJudicialTab1").click();
					$("#Modal-Demanda").modal('hide');
                  	$("#Modal-Menu").modal('hide');
			    } else {
			        // user clicked "cancel"
			    }

			});
		});

		$("#cerrarExtrajudicial").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
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
			    } else {
			        // user clicked "cancel"
			    }

			});

		});

		$("#cerrarMedidas").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#txtSolicitudF").val('');
					$("#txtDecretoF").val('');
					$("#txtPracticaF").val('');
					$("#txtSecuestro").val('');
					$("#txtOtroBien").val('');
					$("#txtObservacionesFechas").val('');

                  	$("#getsionMedidas2").attr('data-toggle','');
          		 	$("#getsionMedidas1").click();

                  	$("#Modal-Medidas").modal('hide');
			    } else {
			        // user clicked "cancel"
			    }
			});

		});
		

		$("#btnGuardarExtrajudicial").click(function(){
			alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    if (e) {
		         	$.ajax({
	                    url       : '<?php echo base_url();?>cartera_fng/guardarExtrajudicial',
	                    type      : 'POST',
	                    data      : {
	                                  subgestion : $('input:radio[name=cafeSeleccionado]:checked').val() ,
	                                  cliente  : $("#SelDeudores").val(),
	                                  contrato  : numeroContrato ,
	                                  gestion : gestion,
	                                  resultadocomunicacion  : resultadocomunicacion ,
	                                  mediocomunicacion : comunicacion,
	                                  txtObservaciones : $("#txtObservacionesExtrajudiciales").val()
	                                },
	                    success   : function(data){
	                       if(data == 1){
	                          //$("#Modal-Menu-Extrajudicial").modal('hide');
	                          	fng.extrajudicial(numeroContrato);
							  	$("#SelDeudores").val(0);
								$("#opcionesDeudor").hide();
							  	$("#txtObservacionesExtrajudiciales").val('');
							 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
							 	$("#tab2").attr('data-toggle',' ');
							 	$("#tab3").attr('data-toggle',' ');
							 	$("#tab4").attr('data-toggle',' ');
							 	$("#tab1").attr('data-toggle','tab');
							 	$("#tab1").click();
							 	$("#ilocalizado").hide();
								$("#localizado").hide();
								$("#Ilocalizadosqui").hide();
								$("#Ilocalizado2").hide();
							 	$("#Modal-Menu-Extrajudicial").modal('hide');
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

		$("#cerrarModalExtrajudicial").click(function(){ 
		//	alertify.error("hola");

			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#SelDeudores").val(0);
					$("#opcionesDeudor").hide();
				  	$("#txtObservacionesExtrajudiciales").val('');
				 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
				 	$("#tab2").attr('data-toggle',' ');
				 	$("#tab3").attr('data-toggle',' ');
				 	$("#tab4").attr('data-toggle',' ');
				 	$("#tab1").attr('data-toggle','tab');
				 	$("#tab1").click();

				 	$("#ilocalizado").hide();
					$("#localizado").hide();
					$("#Ilocalizadosqui").hide();
					$("#Ilocalizado2").hide();
				 	$("#Modal-Menu-Extrajudicial").modal('hide');

			    } else {
			        // user clicked "cancel"
			    }
			});

			
		});



		
		$("#btnguardarSaltandoUltimo").click(function(){
			alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    if (e) {
			        $.ajax({
	                    url       : '<?php echo base_url();?>cartera_fng/guardarExtrajudicial2',
	                    type      : 'POST',
	                    data      : {
	                                  cliente  : $("#SelDeudores").val(),
	                                  contrato  : numeroContrato ,
	                                  gestion : 1816,
	                                  subgestion : $('input:radio[name=localizadoSeleccionado]:checked').val(),
	                                  resultadocomunicacion  : resultadocomunicacion ,
	                                  mediocomunicacion : comunicacion,
	                                  txtObservaciones : $("#txtObservacionesExtrajudiciales2").val()
	                                },
	                    success   : function(data){
	                       if(data == 1){
	                          //$("#Modal-Menu-Extrajudicial").modal('hide');
	                          	fng.extrajudicial(numeroContrato);
							  	$("#SelDeudores").val(0);
								$("#opcionesDeudor").hide();
							  	$("#txtObservacionesExtrajudiciales").val('');
							 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
							 	$("#tab2").attr('data-toggle',' ');
							 	$("#tab3").attr('data-toggle',' ');
							 	$("#tab4").attr('data-toggle',' ');
							 	$("#tab1").attr('data-toggle','tab');
							 	$("#tab1").click();
							 	$("#ilocalizado").hide();
								$("#localizado").hide();
								$("#Ilocalizadosqui").hide();
								$("#Ilocalizado2").hide();
							 	$("#Modal-Menu-Extrajudicial").modal('hide');
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


		$("#GuardarBtnTarea").click(function(){
			alertify.confirm("¿Esta seguro que desea guardar esta Tarea?", function (e) {
			    if (e) {
			        var fechas = getFechaHOy($("#txtFechaPrgramdad").val());
	            	if(fechas == 1){
	            		var horas = soloHoraMayor($("#timepikerettx").val());
	            		if(horas != 0){
	            			alertify.error('La hora esta vencida, por favor elija Otra');
	            			$("#timepikerettx").focus();
	            		}else{
	            			guardarTarea();
	            		}
	            	}else{
	            		guardarTarea();
            		}
			    } else {
			        // user clicked "cancel"
			    }
			});
		});


		$("#GuardarBtnDatosIniciales").click(function(){
			var valido = 0;
			

			if($("#direccion_domicilio").val().length > 0 ){
				if($("#seldireccion_domicilio").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la   domicilio");
					$("#seldireccion_domicilio").focus();
				}
			}

			if($("#ciudad_domicilio").val() != 0 ){
				if($("#Selciudad_domicilio").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la ciudad de domicilio");
					$("#Selciudad_domicilio").focus();
				}
			}

			if($("#direccion_oficina").val().length > 0 ){
				if($("#Seldireccion_oficina").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la dirección de la oficina");
					$("#Seldireccion_oficina").focus();
				}
			}

			if($("#ciudad_oficina").val() != 0 ){
				if($("#selCiudad_oficina").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar lal ciudad de oficina");
					$("#selCiudad_oficina").focus();
				}
			}

			if($("#telefono_domicilio").val().length > 0 ){
				if($("#selTelefono_domicilio").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el telefono del domicilio");
					$("#selTelefono_domicilio").focus();
				}
			}

			if($("#telefono_oficina").val().length > 0 ){
				if($("#selTelefono_oficina").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el telefono de la oficina");
					$("#selTelefono_oficina").focus();
				}
			}

			if($("#Celular").val().length > 0 ){
				if($("#selCelular").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el celular");
					$("#selCelular").focus();
				}
			}

			if($("#celular_adicional").val().length > 0 ){
				if($("#selCelularAdicional").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el celular adicional");
					$("#selCelularadicional").focus();
				}
			}

			if($("#correo_electronico").val().length > 0 ){
				if($("#selCorreoOficial").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el Correo");
					$("#selCorreoOficial").focus();
				}
			}

			if(valido == 0){
				var form = $("#FrmAbogados");
				if(form.valid()){
		  			var formData = new FormData($("#FrmIniciales")[0]);
		          	$.ajax({
		            	url: '<?php echo base_url();?>auxiliar/guardarDatosIniciales',  
		            	type: 'POST',
			            data: formData,
		            	cache: false,
		            	contentType: false,
		            	processData: false,
			            //una vez finalizado correctamente
			            success: function(data){
			            	if(data == '1'){
			            		form[0].reset();
			            		alertify.success('Datos ingresados correctamente');
			            		fng.datosIniciales();
			            		$("#Modal-iniciales").modal('hide');
			            	}else{
			            		alertify.error('Un error a ocurrido');
			            	}
			               
			                
			            },
			            //si ha ocurrido un error
			            error: function(){
			                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
			            }
			        });
			  	}else{
			  		alertify.error('No deben haber campos vacios, por favor rellena el formulario!!');
			  	}
			}


		});

		$(".cerrarAdicionales").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#correo").val('');
					$("#telefono").val('');
				  	$("#direccion").val('');
				 	$("#ciudad").val(0)
				 	$("#obligaciones").val(0)
				 	$("#DeudoresAqui").val(0)
				 	$("#Modal-adicionales").modal('hide');

			    } else {
			        // user clicked "cancel"
			    }
			});
		});

		$("#GuardarBtnDatosAdicionales").click(function(){
			var valido = 0;
			
			//aqui valido los datos adicionales
			if($("#correo").val().length > 0 ){
				if($("#selCalificacionCorreo").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el correo");
					$("#selCalificacionCorreo").focus();
				}
			}

			if($("#telefono").val().length > 0 ){
				if($("#selCalificacionTelefono").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el telefono");
					$("#selCalificacionTelefono").focus();
				}
			}

			if($("#direccion").val().length > 0 ){
				if($("#selCalificacionDireccion").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la dirección");
					$("#selCalificacionDireccion").focus();
				}
			}

			if($("#ciudad").val() != 0 ){
				if($("#selCalificacionCiudad").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la ciudad");
					$("#selCalificacionCiudad").focus();
				}
			}

			if($("#obligaciones").val() == 0 ){
				alertify.error("Seleccionar una obligación");
				valido = 1;
				$("#obligaciones").focus();
			}

			if($("#DeudoresAqui").val() == 0 ){
				alertify.error("Seleccionar una Deudor");
				valido = 1;
				$("#DeudoresAqui").focus();
			}


			if(valido == 0){
				var form = $("#FrmAbogados");
				if(form.valid()){
		  			var formData = new FormData($("#FrmAbogados")[0]);
		          	$.ajax({
		            	url: '<?php echo base_url();?>auxiliar/guardarDatosadicionales',  
		            	type: 'POST',
			            data: formData,
		            	cache: false,
		            	contentType: false,
		            	processData: false,
			            //una vez finalizado correctamente
			            success: function(data){
			            	if(data == '1'){
			            		form[0].reset();
			            		alertify.success('Datos ingresados correctamente');
			            		fng.dartosadicionales();
			            		$("#Modal-adicionales").modal('hide');
			            	}else{
			            		alertify.error('Un error a ocurrido');
			            	}
			               
			                
			            },
			            //si ha ocurrido un error
			            error: function(){
			                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
			            }
			        });
			  	}else{
			  		alertify.error('No deben haber campos vacios, por favor rellena el formulario!!');
			  	}
			}	
		});
	});

	var formatNumber = {
				separador: ".", // separador para los miles
				sepDecimal: ',', // separador para los decimales
				formatear:function (num){
					num +='';
					var splitStr = num.split('.');
					var splitLeft = splitStr[0];
					var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
					var regx = /(\d+)(\d{3})/;
					while (regx.test(splitLeft)) {
						splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
					}
					return this.simbol + splitLeft +splitRight;
				},
				new:function(num, simbol){
					this.simbol = simbol ||'';
					return this.formatear(num);
				}
			}

	function guardarTarea(){
		$.ajax({
            url       : '<?php echo base_url();?>tareas/guardarTareas',
            type      : 'POST',
            data      : {
                          contrato  : nombreContrato ,
                          fechaProgramada : $("#txtFechaPrgramdad").val(),
                          id_cliente  : <?=$idUsuario;?> ,
                          mediocomunicacion : $("#gestionCombo").val(),
                          resultadocomunicacion : resultadocomunicacion,
                          HoraProgramada : $("#timepikerettx").val(),
                          txtdescripcion : $("#txtDescripcion").val(),
                          nombrecliente   : $("#SelDeudores option:selected").text(),
                          tipificacion : 1,
                          dedonde : <?=$vista;?> 
                          //
                        },
            success   : function(data){
               if(data == 1){
                  	$.ajax({
			            url    : '<?php echo base_url();?>tareas/getTareas',
			            type   : 'POST',
			            success: function(data){
			                $("#menuTask").html(data);
			            }
			        });
		        	$("#txtFechaPrgramdad").val(''),
                  	$("#timepikerettx").val(''),
                  	$("#txtDescripcion").val(''),
                  	$("#Modal-tareas").modal('hide');
                  	alertify.success("Tarea Guardada satisfactoriamente");
               }else{
                  alertify.error("Tarea, No se pudo guardar");
                 
               }
            }
        });
	}

	function getDatosWizard(consInteEtapaSeleccionada, nombreEtapa){
		etapa = consInteEtapaSeleccionada;
        $.ajax({
            url      : "<?php echo base_url();?>cartera_fng/eventoBotonEtapa",
            type     : "POST",
       
            data     : { consInteEtapaSeleccionada : consInteEtapaSeleccionada },
            success  : function(data){
                $("#tituloModal").html("Etapa Seleccionada : "+nombreEtapa+" , Elija una actuación*");
                $("#modalBody").html(data);
                $("#getsionJudicialTab2").attr('data-toggle','tab');
                $("#getsionJudicialTab2").click();
            }
        });
	}


	function getdatosTab1(queQuieresHacerSeleccionado){
		$("#tab2").attr('data-toggle','tab');
		$("#tab2").click();
		comunicacion = queQuieresHacerSeleccionado;
	}

	function getdatosTab2(localizadoSeleccionado){
		$("#tab1").attr('data-toggle','');
		$("#tab3").attr('data-toggle','tab');
		resultadocomunicacion = localizadoSeleccionado;
		$("#localizado").hide();
		$("#ilocalizado").hide();
		$("#Ilocalizadosqui").hide();
		$("#Ilocalizado2").hide();
		if(localizadoSeleccionado == '1780'){
			$("#localizado").show();
		
		}else{
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
		$("#tab2").attr('data-toggle','');
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

	function calificarMedidas(idMedida, valor){

		alertify.confirm("¿Esta seguro que esta operación?", function (e) {
		    if (e) {
		    	if(valor === 1){
		    		valor = "SI";
		    	}else{
		    		valor = "NO";
		    	}

		        $.ajax({
		            url      : "<?php echo base_url();?>cartera_fng/calificarMedidas",
		            type     : "POST",
		            data     : { calificacion : valor, idMedidas : idMedida},
		            success  : function(data){
		                if(data == '1'){
		                    //$("#Modal-Menu").modal('hide');
		                    fng.medidas(numeroContrato);
		                    alertify.success("Medida Cautelar calificada satisfactoriamente");
		                }
		            }
		        });
		    } else {
		        // user clicked "cancel"
		    }
		});
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
		//console.log(f1);
		//console.log(f2);
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


 	function getValorCuota( varMontoCapital, varInteres, varNumCuotas, varMontoIntereses){
 		var salminimo = <?php echo $Sminimo;?>;
 		var result = '';
 		if (varNumCuotas > 0) {
            var i = (varInteres / 12);
            var valorCuota = (varMontoCapital * ((i * Math.pow(1 + i, varNumCuotas)) / ((Math.pow(1 + i, varNumCuotas)) - 1))) + (varMontoIntereses / varNumCuotas);
            var cuotaRound = Math.round(valorCuota);
            var smdlv = ( salminimo / 30) * 5;

            return cuotaRound;
        }
 	}

 	function eliminarGestion(varId){
 		alertify.confirm("¿Esta seguro que esta operación?", function (e) {
		    if (e) {
		    	$.ajax({
		 			url    : '<?php echo base_url();?>cartera_fng/eliminarGestion',
		 			type   : 'POST',
		 			data   : { IdEliminar : varId },
		 			success : function(data){
		 				fng.judicial(numeroContrato);
		 			}
		 		});
		    } else {
		        // user clicked "cancel"
		    }
		});
 	}
</script>
