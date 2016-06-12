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
                 
             
               </div>
            </div>                
           
        <h2> Welcome <?php echo userdata('first_name');?> </h2>

<p>We are pleased to welcome you to our new prospect management tool – airtel Bullseye. This tool is extremely simple to use and all sales managers are expected to commit to entering and monitoring all their opportunities through this tool. Essentially, you should use this tool religiously as the benefits are tremendous. </p>

The tool allows you to handle the following primary tasks:
    <ul>
<li>Create and monitor opportunities/leads</li>
<li>Consolidate customer contact information</li>
<li>Monitor targets and achievements</li>
</ul>
<p>The tool is fairly intuitive to learn. However, you should definitely read the instructions/guide. Also, do not hesitate to reach out to airtelsupport@noemdek.co.uk if you need any assistance. </p>

<p>We are confident you will be a great asset to Airtel Business. Below is a summary of your current achievements.</p>
<br/>
<br/>
<br/>

<div>
 <div class="col-md-6">
<h3>Individual Statistics</h3>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
.tg .tg-f6j5{background-color:#fcfbe3;font-family:Verdana, Geneva, sans-serif !important;}
.tg .tg-j2zy{background-color:#FCFBE3;vertical-align:top}
.tg .tg-ujzj{background-color:#b02a0c}
.tg .tg-y4nq{background-color:#FCFBE3;font-family:Verdana, Geneva, sans-serif !important;;vertical-align:top}
.tg .tg-ejgj{font-family:Verdana, Geneva, sans-serif !important;;vertical-align:top}
.tg .tg-u1pl{font-family:Verdana, Geneva, sans-serif !important;;background-color:#b02a0c}
.tg .tg-z2zr{background-color:#FCFBE3}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg">
  <tr>
    <th class="tg-u1pl">Name</th>
    <th class="tg-ujzj">&nbsp;&nbsp;<?php echo userdata('first_name');?>&nbsp;<?php echo userdata('last_name');?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <td class="tg-f6j5">Job Title</td>
    <td class="tg-z2zr"><?php echo userdata('job_title'); ?></td>
  </tr>
  <tr>
    <td class="tg-ejgj">Segment</td>
    <td class="tg-yw4l"><?php echo isset($staff_segment->segment) ? $staff_segment->segment : '' ; ?></td>
  </tr>
  <tr>
    <td class="tg-y4nq">Region</td>
    <td class="tg-j2zy"><?php echo isset($staff_region->region) ? $staff_region->region : '' ; ?></td>
  </tr>
  <tr>
    <td class="tg-ejgj">Supervisor name</td>
    <td class="tg-yw4l">
      <?php echo isset($staff_supervisor->first_name) ? $staff_supervisor->first_name : '' ; ?>
      <?php echo isset($staff_supervisor->last_name) ? $staff_supervisor->last_name : '' ; ?>
    </td>
  </tr>
  <tr>
    <td class="tg-ejgj">Opportunity (achieved)</td>
    <td class="tg-yw4l"><?= $this->dashboard_model->total_opp_won() ?></td>
  </tr>
  <tr>
    <td class="tg-y4nq">Opportunity (target)</td>
    <td class="tg-j2zy"><?= isset($staff->opportunity_target) ? $staff->opportunity_target : '' ?></td>
  </tr>
  <tr>
    <td class="tg-ejgj">% of Target Achieved</td>
    <td class="tg-yw4l"><?= (int) ($this->dashboard_model->total_opp_won() * 100 / $staff->opportunity_target)  ?>%</td>
  </tr>
</table>
</div>
 <div class="col-md-6">
<h3>Group Statistics</h3>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:3px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:3px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
.tg .tg-j2zy{background-color:#FCFBE3;vertical-align:top}
.tg .tg-ujzj{background-color:#b02a0c}
.tg .tg-4il0{background-color:#FCFBE3;font-family:Verdana, Geneva, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-mkr7{background-color:#fcfbe3;font-family:Verdana, Geneva, sans-serif !important;;text-align:center}
.tg .tg-0iqv{font-family:Verdana, Geneva, sans-serif !important;;background-color:#b02a0c;text-align:center}
.tg .tg-z2zr{background-color:#FCFBE3}
.tg .tg-jzjz{font-family:Verdana, Geneva, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg">
  <tr>
    <th class="tg-0iqv">% of Target Achieved</th>
    <th class="tg-ujzj"></th>
  </tr>
  <tr>
    <td class="tg-mkr7">Customer<br>acquisitions</td>
    <td class="tg-z2zr"></td>
  </tr>
  <tr>
    <td class="tg-jzjz">GSM</td>
    <td class="tg-yw4l"><?= $this->dashboard_model->total_opp_won_by_product(1, 'gsm') ?></td>
  </tr>
  <tr>
    <td class="tg-4il0">Solutions</td>
    <td class="tg-j2zy"><?= $this->dashboard_model->total_opp_won_by_product(2, 'solutions') ?></td>
  </tr>
  <tr>
    <td class="tg-jzjz">Devices</td>
    <td class="tg-yw4l"><?= $this->dashboard_model->total_opp_won_by_product(3, 'devices') ?></td>
  </tr>
  <tr>
    <td class="tg-4il0">Value Added Services</td>
    <td class="tg-j2zy"><?= $this->dashboard_model->total_opp_won_by_product(4, 'services') ?></td>
  </tr>
  <tr>
    <td class="tg-jzjz">Total</td>
    <td class="tg-yw4l"></td>
  </tr>
</table>
                      <br/>
                      <br/>
                      <br/>
         </div></div>
			
<p>Best of luck this year! <br/>

<strong>Tawa Bolarin! </strong><br/>
Director, Airtel Business</p>

                  
                     
          </div>
          
     
				
                    
         
         
        <!-- END PAGE CONTENT -->
    