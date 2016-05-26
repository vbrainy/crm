<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->

<script type="text/javascript">
$(function(){
    $('.marquee').marquee({
    showSpeed:1000, //speed of drop down animation
    scrollSpeed: 10, //lower is faster
    yScroll: 'bottom',  // scroll direction on y-axis 'top' for down or 'bottom' for up
    direction: 'left', //scroll direction 'left' or 'right'
    pauseSpeed: 1000, // pause before scroll start in milliseconds
    duplicated: true  //continuous true or false
    });
});
</script>
<style>

		/* STYLE FOR BAR CHART TIME FILTERS */
		.chart-holder {
			position: relative;
			padding-top: 40px;
		}
		.chart-holder .tabs {
			position: absolute;
			top: 0;
			left: 0;
			border: 4px solid #eee;
			background: #eee;
		}
		.chart-holder .tabs span {
			padding: 5px 10px;
			color: #555;
			cursor: pointer;
			display: inline-block;
		}
		.chart-holder .tabs span.active {
			background: #fff;
			color: #333;
		}
		.chart-holder .tabs span:hover {
			background: rgba(255,255,255,0.5);
		}
	</style>


	        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
           <div class="row">
           	<div class=	"widget-infobox" style="padding-bottom:15px; padding-left:6px;">
                            <div class="row"></div>
                            <h2><b style="text-transform: uppercase;"><?php echo config('site_name'); ?></b> <b>DASHBOARD</b></h2> 
                            <a href="<?php echo base_url('admin/leads/'); ?>">
                      		<div class="infobox"> 
                                <div class="left"> 
                                    <i class="fa fa-user bg-orange"></i> 
                                </div>                                 
                                <div class="right"> 
                                    <div> 
                                        <span class="c-orange pull-left"><?php echo $leads;?></span> 
                                        <br> 
                                    </div>                                     
                                    <div class="txt">LEADS</div>                                     
                                </div>                                 
                            </div> 
							</a>
							
							<a href="<?php echo base_url('admin/opportunities/'); ?>">     
                     		<div class="infobox"> 
                                <div class="left"> 
                                    <i class="fa fa-key bg-yellow"></i> 
                                </div>                                 
                                <div class="right"> 
                                    <div> 
                                        <span class="c-yellow pull-left"><?php echo $opportunities;?></span> 
                                        <br> 
                                    </div>                                     
                                    <div class="txt">OPPORTUNITIES</div>                                     
                                </div>                                 
                            </div>
							</a>
							
							<a href="<?php echo base_url('admin/customers/'); ?>"> 
                            <div class="infobox"> 
                                <div class="left"> 
                                    <i class="fa fa-users bg-purple"></i> 
                                </div>                                 
                                <div class="right"> 
                                    <div> 
                                        <span class="c-purple pull-left"><?php echo $customers;?></span> 
                                        <br> 
                                    </div>                                     
                                    <div class="txt">CUSTOMERS</div>                                     
                                </div>                                 
                            </div>

							</a>
							
						
               </div>
            </div>                
           
         <div>
  <h2>Marketing strategy insights
</h2> 
         <div class="row">
                        <div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
<div class="title-stock"> 
                                               
                                                <span class="c-red" style="display: none;"></span>
                                            </div>
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Lead Volume by Region over time</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                    <canvas data-chart-id="lead_volume_by_region" class="chart" height="200" width="320"></canvas>                                      
                                    </div>                                     
                                </div>                                 
                            </div>
                             
<div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Lead Volume by Segment Over Time</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                    <canvas data-chart-id="lead_volume_by_segment" class="chart" height="200" width="320"></canvas>                                      
                                    </div>                                     
                                </div>                                 
                            </div>
                             <div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Lead Volume by Source Over Time</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                    <canvas data-chart-id="lead_volume_by_source" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             
                        
                      
                    </div>
                    <h2>Business Development Performance</h2> 
<div class="row">
                        <div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 

                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Total Value of Opportunities by Region</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                    <canvas data-chart-id="total_value_opportunities_by_region" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             
<div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Total Value of Opportunities by Segment</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                    <canvas data-chart-id="total_value_opportunities_by_segment" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             <div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong> Average Value of Opportunities by Stage</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                   <canvas data-chart-id="average_value_opportunities_by_stage" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             
                        
                      
                    </div>

<h2>Business Development Effectiveness</h2>

<div class="row">
                        <div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 

                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Average Value of Opportunities by Segment</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                    <canvas data-chart-id="average_value_opportunities_by_segment" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             
<div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong>Total Value of Opportunities by Stage</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                   <canvas data-chart-id="total_value_opportunities_by_stage" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             <div class="col-md-4 col-sm-6"> 
                            <div class="panel"> 
                                <div class="panel-header"> 
                                    <h3><i class="icon-list"></i> <strong> Total Number of Opportunities by Stage</strong> </h3> 
                                </div>                                 
                                <div class="panel-content"> 
                                  <canvas data-chart-id="total_opportunities_by_stage" class="chart" height="200" width="320"></canvas>                                     
                                    </div>                                     
                                </div>                                 
                            </div>
                             
                        
                      
                    </div>
         </div>
         

          
               
                                         
         
			
		 	
                  
                     
          </div>
          
     
				
                    
         
         
        <!-- END PAGE CONTENT -->
      