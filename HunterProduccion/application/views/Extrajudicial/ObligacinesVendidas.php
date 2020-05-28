<section class="content-header">
    <h1>
        CARTERA FNG - OBLIGACIONES VENDIDAS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>Extrajudicial">Cartera Fng</a></li>
        <li class="active">Cartera Fng - Obligaciones Vendidas</li>
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
						<th style="text-align:center;" class="col-md-4">Nombre</th>
						<th style="text-align:center;">Tipo Identificación</th>
						<th style="text-align:center;">No. Identificación</th>
						
						<th style="text-align:center;">No. Liquidación</th>
						<th style="text-align:center;">Valor pagado</th>
						<th style="text-align:center;">Fecha Venta</th>
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
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/bajadas/Jzip.js"></script>
<!--<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
<script type="text/javascript">
	$(function(){



		$("#tablaJudicial").DataTable({

				"aaData": <?php echo $clientes; ?>,
				"aoColumns": [
					
					{ mData: "nombre" },
					{ mData: "tipo_identificacion" },
					{ mData: "identificacion" },
					
					{ mData: "contrato"},
					{ mData: "valor_pagado"  },
					{ mData: "fecha_venta" }
					
				],

				"dom": 'Blfrtip',
				"bJQueryUI": true,
				"bProcessing": true,
				"bSort": true,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
		        "iDisplayLength": 20,
		        "aaSorting":[[0,"asc"]],
			    "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  fieldSeparator : ';',
			                  charset: 'utf-8',
			                  extension: '.csv',
							filename: 'Obligaciones Vendidas',
							bom: false
							}],
		        "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
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
						window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+garantia+"/8";
				   });
				},
				
	    });

		console.log(<?php echo $clientes; ?>);
	     $("#tablaJudicial td").dblclick(function(){
	    	var dato = $(this).attr('identificacion').replace(' ', '');
	    	window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+dato+"/8";
	    });

	});


</script>