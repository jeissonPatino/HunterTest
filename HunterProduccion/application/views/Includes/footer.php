            
        
              <!-- Add the sidebar's background. This div must be placed
              immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>


        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>

       
        <!-- datepicker -->
        <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
        

        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>

        <script src="<?php echo base_url();?>assets/plugins/bockui/blockUi.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		
		<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
		 <!-- bootstrap time picker -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
		<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/js/numeric.js"></script>
        <script type="text/javascript">
			var validNavigation = false;
 
			function endSession() {
				$.ajax({
					url     : '<?php echo base_url();?>login/salirT',
					type    : 'POST',
					success : function(data){
						
					}
				});
			}
			 
			function wireUpEvents() {
			  /*
			  * For a list of events that triggers onbeforeunload on IE
			  * check http://msdn.microsoft.com/en-us/library/ms536907(VS.85).aspx
			  */
			  window.onbeforeunload = function() {
				  if (!validNavigation) {
					 endSession();
				  }
			  }
			 
			  // Attach the event keypress to exclude the F5 refresh
			  $(document).bind('keypress', function(e) {
				if (e.keyCode == 116){
				  validNavigation = true;
				}
			  });
			 
			  // Attach the event click for all links in the page
			  $("a").bind("click", function() {
				validNavigation = true;
			  });
			 
			  // Attach the event submit for all forms in the page
			  $("form").bind("submit", function() {
				validNavigation = true;
			  });
			 
			  // Attach the event click for all inputs in the page
			  $("input[type=submit]").bind("click", function() {
				validNavigation = true;
			  });
			   
			}
            $(function(){
                $.fn.datepicker.dates['es'] = {
                    days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
                    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    today: "Today",
                    clear: "Clear",
                    format: "yyyy-mm-dd",
                    titleFormat: "yyyy-mm-dd", /* Leverages same syntax as 'format' */
                    weekStart: 0
                };

                 //Datemask dd/mm/yyyy
                $(".datemask").datepicker({
                    language: "es",
                    autoclose: true,
                    todayHighlight: true
                });

                $(".especial").datepicker({
                    language: "es",
                    autoclose: true,
                    todayHighlight: true,
                     startDate: "today"
                });

                $(".numerosSolos").numeric();
                $(document).ajaxStart(function () {
                    $.blockUI({ message: '<img src="<?php echo base_url();?>assets/img/cargando/loader.gif" />' });
                });

                $(document).ajaxStop($.unblockUI);
				
				<?php 
					if(isset($ul)){
						if($ul != "NO"){
							echo '$("#'. $ul .'").addClass("active");';
							echo '$("#'. $li .'").addClass("active");';
						}else{
							echo '$("#'. $li .'").addClass("active");';
						}
					}else{
						if(isset($li))
							echo '$("#'. $li .'").addClass("active");';
					}
					
				?>
                
            });	
			
			/*window.onunload = window.onbeforeunload = function(){
				$.ajax({
					url     : '<?php //echo base_url();?>login/salirT',
					type    : 'POST',
					success : function(data){
						
					}
				})
				
			};*/
        </script>
    </body>
</html>
