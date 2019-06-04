<section class="content-header">
    <h1>
      	Reportes
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Reportes</li>
    </ol>
</section>

<section class="content">


	<!-- Salario Minimo -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Reportes</h3>
		</div>
		<div class="box-body">
			<div class="row-fuid">
				<div class="col-md-4">
					<form id="FrmAbogados" method="post">
						<div class="form-group">
							<Label>Seleccione el reporte que quiere ver:</Label>
							<select id="selCiudades" name ="selCiudades" class="form-control">
								<option value="0">Seleccione un reporte</option>
								<?php 
									foreach ($reportesCombo as $key) {
										echo "<option value='".$key->id."'>".utf8_encode($key->reporte)."</option>";
									}
								?>
							</select>
						</div>
					</form>
					
				</div>
			</div>
			<div class="row-fluid">
				<div class="col-md-12" id="reportesHtml">

					
				</div>
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">
	$(function(){
		$("#selCiudades").change(function(){
			$.ajax({
				url    :  '<?php echo base_url();?>reportes/mostrarReporte/'+$(this).val(),
				type   :  'POST',
				success:  function(data){
					$("#reportesHtml").html(data);
				}
			});
		});
		
	});
</script>


