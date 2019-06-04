<?php 


?>

<!-- aqui se muestra el resultado en las barras -->


<div class="box box-info">
  
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-hover table-bordered" id="tablaGestiones">
            <thead>
              <tr>
					<th style="text-align:center;">Nombre Deudor</th>
					<th style="text-align:center;">Tipo Identificación</th>
					<th style="text-align:center;">No. Identificación</th>
					<th style="text-align:center;">Ciudad Despacho</th>
					<th style="text-align:center;">Intermediario financiero</th>
					<th style="text-align:center;">No. Liquidación</th>
					<th style="text-align:center;">No. Proceso SAP</th>
					<th style="text-align:center;">Valor Pagado</th>
					<th style="text-align:center;">Rol</th>
					<th style="text-align:center;">Fecha Gestión</th>
              </tr> 
            </thead>
            <tbody>
              
              
            </tbody>
          </table>    
        </div>
      </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">
	$(function(){

        $("#tablaGestiones").DataTable({
            "aaData": <?php echo $ResultadoGestiones; ?>,
            "aoColumns": [
   						{ mData: "nombre" },
						{ mData: "TipoIdentificacion" },
						{ mData: "NumeroId" },
						{ mData: "CiudadDespacho"},
						{ mData: "Intermediariofinancero" },
						{ mData: "NumeroLiquidacion" },
						{ mData: "ProcesoSAP" },
						{ mData: "valorPagado" },
						{ mData: "ROL" },
						{ mData: "fechaIngreso" }
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
             "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
					var id = aData.NumeroId;
					$(nRow).attr("dato",id);
					$(nRow).attr("class",'trobligacion');
					return nRow;
				   
				},
				"fnDrawCallback": function (oSettings, json) {
				   //Aqui va el comando para activar los otros botones
				   $(".trobligacion").dblclick(function(){
						var dato = $(this).attr('dato').replace(' ', '');
						window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+dato+"/17";
				   });
				},
            "buttons":[{
                            text: 'Exportar Excel',
                            extend: 'excel'
                          }],
            "processing": true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "bSortClasses": false,
            "bDeferRender": true,
            "sPaginationType": "simple",
             "iDisplayLength": 20,
             "aaSorting":[[1,"asc"]],
             "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
             
          });
	});
</script>