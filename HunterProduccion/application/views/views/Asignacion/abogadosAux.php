<section class="content-header">
    <h1>
        ASIGNACIÓN - ABOGADOS AUX
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Asignacion - Abogados Aux.</li>
    </ol>
</section>

<section class="content">
	<div class="box">
        <div class="box-body">
                  
			<a class="btn btn-app" id="agregar">
				<i class="fa fa-plus"></i> Agregar
			</a>
			<a class="btn btn-app" disabled>
				<i class="fa fa-edit"></i> Editar
			</a>
			<a class="btn btn-app" disabled>
				<i class="fa fa-trash"></i> Eliminar
			</a>
			<a class="btn btn-app" id="Save" disabled>
				<i class="fa fa-save"></i> Guardar
			</a>
			<a class="btn btn-app" id="cancel" disabled>
				<i class="fa fa-close"></i> Cancelar
			</a>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->

	<!-- Salario Minimo -->
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Abogados</h3>
		</div>
		<div class="box-body">
			<div class="row-fluid">
				<div class="col-md-5">
					<form class="form-horizontal">
		                <div class="form-group">
		                  	<label for="cmbAbogados" class="col-sm-2 control-label">Abogado</label>
		                  	<div class="col-sm-10">
		                	 	<select id="cmbAbogados" class="form-control" disabled>
			                        <option>option 1</option>
			                        <option>option 2</option>
			                        <option>option 3</option>
			                        <option>option 4</option>
			                        <option>option 5</option>
		                      	</select>
		                  	</div>
		                </div>
		            </form>
				</div>
				<div class="col-md-7">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Registros</h3>
							<div class="box-tools">
								<div class="input-group" style="width: 150px;">
									<input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Buscar">
									<div class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover">
								<tr>
									<th>ID</th>
									<th>User</th>
									<th>Date</th>
									<th>Status</th>
									<th>Reason</th>
								</tr>
								<tr>
									<td>183</td>
									<td>John Doe</td>
									<td>11-7-2014</td>
									<td><span class="label label-success">Approved</span></td>
									<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
								</tr>
								<tr>
									<td>219</td>
									<td>Alexander Pierce</td>
									<td>11-7-2014</td>
									<td><span class="label label-warning">Pending</span></td>
									<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
								</tr>
								<tr>
									<td>657</td>
									<td>Bob Doe</td>
									<td>11-7-2014</td>
									<td><span class="label label-primary">Approved</span></td>
									<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
								</tr>
								<tr>
									<td>175</td>
									<td>Mike Doe</td>
									<td>11-7-2014</td>
									<td><span class="label label-danger">Denied</span></td>
									<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
								</tr>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			
		</div><!-- /.box-body -->
	</div><!-- /.box -->

	

</section><!-- /.content -->

<script type="text/javascript">
	$(function(){
		$("#agregar").click(function(){
			$("#cmbAbogados").prop('disabled', false);
			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
		});

		$("#cancel").click(function(){
			$("#cmbAbogados").prop('disabled', true);
			$("#cmbAbogados").val("0");
			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#Save").attr('disabled', true);
		});
	});
</script>
