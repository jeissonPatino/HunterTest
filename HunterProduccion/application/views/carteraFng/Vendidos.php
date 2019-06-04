<section class="content-header">
    <h1>
        CARTERA FNG - MIS PROCESOS VENDIDOS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
        <li class="active">Cartera Fng - Procesos Vendidos</li>
    </ol>
</section>


<section class="content">
	<a href="<?php echo base_url();?>cartera_fng" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>
	<div class="box">
		<div class="box-header">
			
			<div class="box-tools">
				
			</div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			
			<table class="table table-hover" id="tablaJudicial">
				<thead>
					<tr>
						
						
						<th style="text-align:center;" class="col-md-5">Nombre</th>
						<th style="text-align:center;">Tipo Identificación</th>
						<th style="text-align:center;">No. Identificación</th>
						<th style="text-align:center;">N° Proceso SAP</th>
						<th style="text-align:center;">No. Liquidación</th>
						<th style="text-align:center;">Fecha de venta</th>
					
					</tr>
				</thead>
				<tbody>
					<?php

						/*foreach ($clientes as $key) {
							echo '	<tr  style="cursor:pointer;">
										<td  identificacion ="'.$key->identificacion.'">'.utf8_encode($key->cliente).'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->identificacion.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->SAP.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->No_contrato.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->Fecha_de_Venta.'</td>
										<td>
											<a href="'.base_url().'cartera_fng/datosJudiciales/'.$key->identificacion.'/3"  title="información" class="btn btn-sm btn-info">
												<i class="fa fa-info-circle"></i>
											</a>
										</td>
									</tr>';
						}*/
					?>
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
					
					{ mData: "cliente" },
					{ mData: "tipo_identificacion" },
					{ mData: "identificacion" },
					{ mData: "SAP"},
					{ mData: "No_contrato" },
					{ mData: "Fecha_de_Venta" }
					
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
						window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+"/3";
				   });
				},
				"bJQueryUI": true,
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