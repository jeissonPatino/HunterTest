<section class="content-header">
    <h1>
        CARTERA FNG - CLIENTES SIN GESTIÓN POR MÁS DE 15 DÍAS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
        <li class="active">Cartera Fng - Clientes sin gestión por más de 15 días</li>
    </ol>
</section>


<section class="content">
	<a href="<?php echo base_url();?>Extrajudicial" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>
	<div class="box">
		<div class="box-header">
			
			<div class="box-tools">
				
			</div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			
			
			<table class="table table-hover" id="tablaJudicial">
				<thead>
					<tr>
						<th style="text-align:center;" class="col-md-3">Nombre</th>
						<th style="text-align:center;">Identificación</th>
						<th style="text-align:center;" class="col-md-3">Intermediario Financiero</th>
						<th style="text-align:center;">No. Liquidación</th>
						<th style="text-align:center;">Valor Pagado</th>
						
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

 <!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#tablaJudicial").DataTable({
			"aaData": <?php echo $clientes; ?>,
			"aoColumns": [
				
				{ mData: "deudor" },
				{ mData: "identificacion" },
				{ mData: "financiera"},
				{ mData: "contrato" },
				{ mData: "valor_pagado"}
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
			"processing": true,
		   //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				var id = aData.identificacion;
				$(nRow).attr("dato",id);
				$(nRow).attr("class",'trobligacion');
				return nRow;
			   
			},
			"fnDrawCallback": function (oSettings, json) {
			   //Aqui va el comando para activar los otros botones
			   $(".trobligacion").dblclick(function(){
					var garantia = $(this).attr('dato').replace(' ', '');
					window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+garantia+"/5";
			   });
			},
			"	bJQueryUI": true,
				"bProcessing": true,
				"bSort": true,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
	            "iDisplayLength": 20,
	            "aaSorting":[[0,"asc"]],
	            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
	    });




	});


</script>