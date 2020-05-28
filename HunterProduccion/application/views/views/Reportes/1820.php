<?php 
  $colores = array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de');
   function hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo, $valorFinal){

        $ci = &get_instance();
        $ci->load->Model('Reportes_model');

        $consulta = '';
        $from = '';
        $join = '';
        $cosojoin = '';
        $where = '';
        $group = '';
        $label = '';


        switch ($tipo) {
            case "6":
                $consulta =  "DISTINCT Id as valor1, Nombre_b as valor2";
                $from  = "G".$aplicacion;
                $join  = "ParametroGeneral";
                $cosojoin = "G".$aplicacion."_C".$analisis." = Id";
                break;

            case "11":
                $resultObjectCampo =$ci->Reportes_Model->findCampoAsociado($agrupadoPor2);
                $resultObject = $ci->Reportes_Model->findTipoCampoGuionAsociado2($agrupadoPor2);
                $campoAsociado = ($resultObjectCampo != null) ? $resultObjectCampo : null;
                $guionAsociado = ($resultObject != null) ? $resultObject : null;
                $consulta =  "DISTINCT G".$aplicacion."_C".$agrupadoPor2." as valor1, G".$guionAsociado."_C".$campoAsociado." as valor2";
                $from = "G".$aplicacion;
                $join  = "G".$guionAsociado;
                $cosojoin = " G".$aplicacion."_C".$agrupadoPor2." = G".$guionAsociado."_ConsInte__b";
           
                break;
            case "otro":
                //PEndiente terminar armar consultas
                break;
        }
        //echo "SELECT $consulta FROM $from JOIN $join ON  $cosojoin  $where $group";
        $jose = $ci->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);

        foreach ($jose as $key) {
           if($valorFinal == $key->valor1){
              $label = $key->valor2;
           }
        }
        return utf8_encode($label);
    }

?>

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo utf8_encode($nombreGrafica);?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="chart">
          <?php 
              
          
              $PieData = '[';
             
              $i = 0;

              foreach ($consulta as $key) {
                  if($i == 0){
                      
                      $PieData .= '{
                                    value: '.$key->Resultado.',
                                    color: "#f56954",
                                    highlight: "#f56954",
                                    label: "'.hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo2,  $key->Mas).'"
                                  }';
                  }else{
                     
                      $PieData .= ',{
                                    value: '.$key->Resultado.',
                                    color: "#f56954",
                                    highlight: "#f56954",
                                    label: "'.hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo2,  $key->Mas).'"
                                  }';
                  }   

                  $i++;             
              }

              $PieData .= ']';
             

              
           ?>
          <canvas id="pieChart" style="height:330px"></canvas>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->

<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">

  $(function () {
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        /*var PieData = [
          {
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Chrome"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "IE"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "FireFox"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Safari"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Opera"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Navigator"
          }
        ];*/
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(<?php echo $PieData;?>, pieOptions);
        
  });
  
</script>