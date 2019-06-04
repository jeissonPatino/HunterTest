<section class="content-header">
    <h1>
        ASIGNACIÓN - FRG
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Asignación - Frg.</li>
    </ol>
</section>


<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">FRG - ASIGNACIÓN AL FRG</h3>
		</div>
        <div class="box-body">
    	 <form class="form-horizontal">
                <div class="form-group">
                  	<label for="inputEmail3" class="col-sm-2 control-label">Seleccionar Filtro</label>
                  	<div class="col-sm-10">
                    	<select id="cmbFiltros" class="form-control">
	                        <option>option 1</option>
	                        <option>option 2</option>
                      	</select>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="inputPassword3" class="col-sm-2 control-label">Digite Filtro</label>
                  	<div class="col-sm-10">
                    	<input type="text" id="exampleInputFile" class="form-control">
                  	</div>
            	</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Fecha de asignación</label>
                  	<div class="col-sm-10">
                		<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control datemask" placeholder= "dd/mm/yyyy">
						</div><!-- /.input group -->
                  	</div>
				</div><!-- /.form group -->
				<div class="form-group">
                  	<label for="inputEmail3" class="col-sm-2 control-label">FRG</label>
                  	<div class="col-sm-10">
                    	<select id="cmbFiltros" class="form-control">
	                        <option>option 1</option>
	                        <option>option 2</option>
                      	</select>
                  	</div>
                </div>
				<button type="button" class="btn btn-primary">Agregar FRG</button>
            </form>
            <div class="box">
				<div class="box-header">
					<h3 class="box-title">Abogados Agregados</h3>
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
							<th>Nombre del Abogado</th>
							<th>Reason</th>
						</tr>
						
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
    	</div><!-- /.box-body -->
    	<div class="box-footer">
            <button type="button" class="btn btn-default">Cancelar</button>
            <button type="button" class="btn btn-primary">Asignar FRG(S)</button>
      	</div><!-- /.box-footer -->
  	</div><!-- /.box -->

</section>

