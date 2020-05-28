<?php 


?>

<div class="box box-info">
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <table class="table table-hover table-bordered" id ="tablaCantidadgestionada">
            <thead>
              <tr>
                  <th class= 'col-md-6' style="text-align:center ;">Gestor</th>
                  <th style="text-align:center;"> Cantidad gestionada </th>     
              </tr> 
            </thead>
            <tbody>
            </tbody>
          </table>    
        </div>
      </div>
    </div> 
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-hover table-bordered" id="tablafrggestores">
            <thead>
              <tr>
                  <th style="text-align:center;">No. Liquidación</th>     
                  <th style="text-align:center;">Nombre Deudor</th>
                  <th style="text-align:center;">Tipo Identificación</th>
                  <th style="text-align:center;">No. Identificación</th>
                  <th style="text-align:center;">Intermediario financiero</th>
                  <th style="text-align:center;">Fecha pago de garantía</th>
                  <th style="text-align:center;">Fecha de asignación</th>
                  <th class= 'col-md-2' style="text-align:center ;">Gestor</th>
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
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">
  $(function(){

        $("#tablafrggestores").DataTable({
            "aaData": <?php echo $ResultadoFrgGestiones?>, 
            "aoColumns": [
            { mData: "NumeroLiquidacion" },
            { mData: "NombreDeudor" },
            { mData: "TipoIdentificacion" },
            { mData: "NumeroId"},
            { mData: "Intermediariofinancero" },
            { mData: "FechaPagoGarantia" },
            { mData: "FechaGestion" },
            { mData: "Gestor" }
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
                    filename: 'Gestión Gestores de Recuperación'}],
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
          });

        $("#tablaCantidadgestionada").DataTable({
            "aaData": <?php echo $ResultadoCantidadGestionada?>,
            "aoColumns": [
            { mData: "Gestor" },
            { mData: "cantidad" }
            ],
              "bJQueryUI": true,
              "bProcessing": true,
              "bSort": true,
              "bSortClasses": false,
              "bDeferRender": true,
              "sPaginationType": "simple",
                    "iDisplayLength": 20,
                    "aaSorting":[[0,"asc"]],
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

          });
  });

</script>

