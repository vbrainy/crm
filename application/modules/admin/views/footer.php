 <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> <?php echo date('Y');?> </span>
                <span><?php echo config('site_name'); ?></span>.
                <span>All rights reserved. Developed by Madison & Park </span>
              </p>
              <!--<p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>-->
            </div>
          </div>
</div>
      <!-- END MAIN CONTENT -->
       
    </section>
   
    <!-- BEGIN PRELOADER -->
    <div id="preloader"></div>
     
    <!--<div class="loader-overlay">
      <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>   -->  
 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    
    <?php 
			$get_dcontroller_nm=$this->uri->segment(2);
			
			if($get_dcontroller_nm=="dashboard"){
?>
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
    
    	<?php }?>
    
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/gsap/main-gsap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
     
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> <!-- Custom Scrollbar sidebar -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script> <!-- Show Dropdown on Mouseover -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/select2/select2.min.js"></script> <!-- Select Inputs -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> <!-- Animated Progress Bar -->
     
    <script src="<?php echo base_url(); ?>public/assets/global/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="<?php echo base_url(); ?>public/assets/global/js/application.js"></script> <!-- Main Application Script -->
    <script src="<?php echo base_url(); ?>public/assets/global/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="<?php echo base_url(); ?>public/assets/global/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="<?php echo base_url(); ?>public/assets/global/js/quickview.js"></script> <!-- Chat Script -->
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
    <!-- BEGIN PAGE SCRIPT -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootstrap-editable/js/bootstrap-editable.min.js"></script> <!-- Inline Edition X-editable -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootstrap-context-menu/bootstrap-contextmenu.min.js"></script> <!-- Context Menu -->
    
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script> <!-- Time Picker -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/multidatepicker/multidatespicker.min.js"></script> <!-- Multi dates Picker -->
    <script src="<?php echo base_url(); ?>public/assets/global/js/widgets/todo_list.js"></script>
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/metrojs/metrojs.min.js"></script> <!-- Flipping Panel -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/charts-chartjs/Chart.min.js"></script>  <!-- ChartJS Chart -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/charts-highstock/js/highstock.min.js"></script> <!-- financial Charts -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/charts-highstock/js/modules/exporting.min.js"></script> <!-- Financial Charts Export Tool -->
    
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/dashboard/ammap.min.js"></script>         
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="<?php echo base_url(); ?>public/assets/global/js/pages/table_dynamic.js"></script>
    
    
        <script src="<?php echo base_url(); ?>public/assets/global/plugins/summernote/summernote.min.js"></script> <!-- Simple HTML Editor --> 
        <script src="<?php echo base_url(); ?>public/assets/global/plugins/cke-editor/ckeditor.js"></script> <!-- Advanced HTML Editor -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/cke-editor/adapters/adapters.min.js"></script>
    <!-- END PAGE SCRIPTS -->
         
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/countup/countUp.min.js"></script> <!-- Animated Counter Number -->
    
    <!-- END PAGE SCRIPT -->
    <script src="<?php echo base_url(); ?>public/assets/global/plugins/bootstrap-loading/lada.min.js"></script> <!-- Buttons Loading State -->
    
    <script src="<?php echo base_url(); ?>public/assets/global/js/pages/search.js"></script> <!-- Search Script -->
    
     <script src="<?php echo base_url(); ?>public/assets/global/plugins/quicksearch/quicksearch.min.js"></script> <!-- Search Filter -->
        
    <script src="<?php echo base_url(); ?>public/assets/global/js/pages/mailbox.js"></script>
    
    <script src='<?php echo base_url(); ?>public/assets/global/plugins/moment/moment.min.js'></script>
    <script src='<?php echo base_url(); ?>public/assets/global/plugins/fullcalendar/fullcalendar.min.js'></script>
    <!--<script src="<?php echo base_url(); ?>public/assets/global/js/pages/fullcalendar.js"></script>-->
    
    <script src="<?php echo base_url(); ?>public/assets/global/js/pages/dashboard.js"></script>
    <!-- BEGIN PAGE SCRIPTS -->
    
    <script src="<?php echo base_url(); ?>public/assets/admin/layout1/js/layout.js"></script>
    
    <script>
	 var widgetMapHeight = $('.widget-map').height();
    var pstatHeadHeight = $('.panel-stat-chart').parent().find('.panel-header').height() + 12;
    var pstatBodyHeight = $('.panel-stat-chart').parent().find('.panel-body').height() + 15;
    var pstatheight = widgetMapHeight - pstatHeadHeight - pstatBodyHeight + 30;
    $('.panel-stat-chart').css('height', pstatheight);
    var clockHeight = $('.jquery-clock ').height();
    var widgetProgressHeight = $('.widget-progress-bar').height();
    if($('.widget-map').length){
        $('.widget-progress-bar').css('margin-top', widgetMapHeight - clockHeight - widgetProgressHeight - 3);
    }
    var visitorsData = {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [
            {
                label: "New",
                fillColor: "rgba(200,200,200,0.5)",
                strokeColor: "rgba(200,200,200,1)",
                pointColor: "rgba(200,200,200,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(200,200,200,1)",
                data: []
            }, 
            {
                label: "Total Sales",
                fillColor: "rgba(49, 157, 181,0.5)",
                strokeColor: "rgba(49, 157, 181,0.7)",
                pointColor: "rgba(49, 157, 181,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(49, 157, 181,1)",
                data: [<?php echo sales_by_month_chart('January');?>,<?php echo sales_by_month_chart('February');?>,<?php echo sales_by_month_chart('March');?>,<?php echo sales_by_month_chart('April');?>,<?php echo sales_by_month_chart('May');?>,<?php echo sales_by_month_chart('June');?>,<?php echo sales_by_month_chart('July');?>,<?php echo sales_by_month_chart('August');?>,<?php echo sales_by_month_chart('September');?>,<?php echo sales_by_month_chart('October');?>,<?php echo sales_by_month_chart('November');?>,<?php echo sales_by_month_chart('December');?>]
            }
            
        ]
    };
    var chartOptions = {
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        pointDot: true,
        pointHitDetectionRadius: 20,
        tooltipCornerRadius: 0,
        scaleShowLabels: false,
        tooltipTemplate: "dffdff",
        multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>",
        responsive: true,
        scaleShowLabels: false,
        showScale: false,
    };

    if($('#visitors-chart').length){
        var ctx = document.getElementById("visitors-chart").getContext("2d");
        var myNewChart = new Chart(ctx).Line(visitorsData, chartOptions);
     }
</script>
<?php 
			$check_controller_nm=$this->uri->segment(2);
			if($check_controller_nm=="dashboard"){
?>
 
<!--Sales Performance-->
<script>

<?php
	 
	foreach( $salesteams_performance_list as $team_performnce){ 
	
	$y=date('Y');
	
	$first_date = date('d-m-Y',strtotime('01-01-'.$y.''));
 
	$last_date = date('d-m-Y',strtotime('31-12-'.$y.''));
	
 ?>
	var data<?php echo $team_performnce->id;?> = [
	<?php $i=1;
while (strtotime($first_date) <= strtotime($last_date)) {?>
	
	[<?php echo strtotime($first_date)*1000;?>,<?php echo sales_performance_salescount(strtotime($first_date),$team_performnce->id);?>],
	
	<?php $first_date = date ("Y-m-d", strtotime("+1 day", strtotime($first_date)));
	$i++;
	}
	 
	?>
	];
	
	<?php }?>
 	var data12=[
 		[1426719600000,5],
	
		
	[1426806000000,0],
	
		
	[1426892400000,7],
	
		
	[1426978800000,0],
	
		
	[1427065200000,1],
	
		
	[1427151600000,3],
	
		
	[1427238000000,10],

 	];
  
function stockCharts2(tabName,id) {
        var items = Array('',<?php foreach( $salesteams_performance_list as $team_performnce){echo 'data'.$team_performnce->id.',';}?>data12);
        //var randomData = items[Math.floor(Math.random() * items.length)];
          
         if(id=='')
         {
		 	var randomData = items['1'];
		 }
		 else
		 {
		 	var randomData = items[id];
		 }
         
          
         var custom_colors = ['#C9625F', '#18A689', '#90ed7d', '#f7a35c', '#8085e9', '#f15c80', '#8085e8', '#91e8e1'];
        var custom_color = custom_colors[Math.floor(Math.random() * custom_colors.length)];
        // Create the chart
        $('#stock-' + tabName).highcharts('StockChart', {
            chart: { 
            	width:831,
                height: 277,
                plotBorderColor: '#C21414',
                plotBorderColor: '#C21414'
            },
            credits: {
                enabled: false
            },
            colors: [custom_color],
            exporting: {
                enabled: false
            },
            rangeSelector: {
                inputEnabled: false,
                selected: 2
            },
            scrollbar: {
                enabled: false
            },
            navigator: {
                enabled: false
            },
             tooltip: {
            enabled: true
       		 },
            xAxis: {
                gridLineColor: '#C21414',
                gridLineColor: '#C21414',
                lineColor: '#EFEFEF',
                tickColor: '#EFEFEF',
            },
            yAxis: {
                gridLineColor: '#EFEFEF',
                lineColor: '#B324B3'
            },
            series: [{
                //name: tabName,
                name: 'Sales',
                data: randomData,
                tooltip: {
                    valueDecimals: 0,
                    valuePrefix: '$'
                }
            }]
        });
    }
    <?php foreach( $salesteams_performance_list as $team_performnce){ ?>	
    stockCharts2('<?php echo str_replace(' ', '',$team_performnce->salesteam);?>','<?php //echo $team_performnce->id;?>');
    <?php }?>
     
    $('.stock2 .nav-tabs a').on('click', function() {
        $('.stock2 .tab-content .tab-pane.active').fadeOut(300, function() {
        	
            $('.stock2 .tab-content .tab-pane.active').fadeIn(300);
        });
        
        var current_stock_id = $(this).data('id');
        var current_stock = $(this).attr('id');
        var current_value = $(this).data('value');
        var current_color = $(this).data('color');
        var current_title = $(this).data('title');
        title = current_title.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        $('.title-stock h1').text(title);
        $('.title-stock span').removeClass().addClass('c-' + current_color).text(current_value);
        stockCharts2(current_stock,current_stock_id);
    });	
	
</script>

<?php }?>

 <!-- Search between two date -->   
<?php 
			$get_controller_nm=$this->uri->segment(2);
?>
<script type="text/javascript" class="init">
 
$.fn.dataTable.ext.search.push(
	function( settings, data, dataIndex ) {
		 
		var min = new Date($('#min').val()).getTime();
		var max = new Date($('#max').val()).getTime(); 
		<?php if($get_controller_nm=="contracts"){?>
		 var date = new Date(data[0]).getTime() || 0;
		<?php }else{?>
		 var date = new Date(data[1]).getTime() || 0;
		<?php }?> 
		// use data for the date column
		//alert(date);
		if ( ( isNaN( min ) && isNaN( max ) ) ||
			 ( isNaN( min ) && date <= max ) ||
			 ( min <= date   && isNaN( max ) ) ||
			 ( min <= date   && date <= max ) )
		{
			return true;
		}
		return false;
	}
);
 
 	<?php if($get_controller_nm=="invoices"){?>
 	/*  Initialse DataTables, with no sorting on the 'date' column  */
		var oTable = $('.table-dynamic').dataTable({
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [0]
		    }],
		    "aaSorting": [
		        [1, 'desc']
		    ]
		});
	<?php }?> 
	 
	</script>
	
	<script>
	// site preloader -- also uncomment the div in the header and the css style for #preloader	 
	jQuery(document).ready(function($) {  
 
$(window).load(function(){
	$('#preloader').fadeOut('slow',function(){$(this).remove();});
});

});		
	</script>
	
  </body>
</html>