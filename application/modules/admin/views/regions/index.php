<script>

 function delete_regions( region_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/regions/delete' ); ?>/" + region_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#region_id_' + region_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Region</strong></h2> 
            <div style="float:right; padding-top:10px;">
              <?php if (check_staff_permission('region_write')){?> 
			  <a href="<?php echo base_url('admin/regions/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 	
			 <?php }?> 
            </div>           
          </div>
            

            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>                        
                        <th>Region Name</th>                         
                        <th>Sales Target</th>
                        <th>Sales Forecast</th>
                        <th>Actual Sales</th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($regions) ){?>
					    <?php foreach( $regions as $region){ ?>
              <?php //print_r($region);exit; ?>
	                      <tr id="region_id_<?php echo $region->id; ?>">	                        
	                        <td><a href="<?php echo base_url('admin/regions/update/'.$region->id); ?>"><?php echo $region->region; ?></a></td>
	                        <td><?php echo $region->sales_target;?></td>
	                        <td><?php echo $region->sales_forecast;?></td>
	                        <td><?php echo $region->actual_sales;?></td>	                        
	                                                
	                        <td style="width: 12%;">
	                        <?php if (check_staff_permission('region_write')){?>
	                        <a href="<?php echo base_url('admin/regions/update/'.$region->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('region_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $region->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $region->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            				<div class="modal-dialog">
              					<div class="modal-content">
					                <div class="modal-header">
					                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
					                  <h4 class="modal-title"><strong>Confirm</strong></h4>
					                </div>
					                <div class="modal-body">
					                  Are you sure you want to delete this?<br>
					                </div>
					                <div class="modal-footer">
					                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel</button>
					                  <button type="button" onclick="delete_regions(<?php echo $region->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
					                </div>
             					 </div>
           					 </div>
        				  </div>
	                      
                    	 <?php } ?>
					 <?php } ?> 
                      
                      
                    </tbody>
                  </table>
                </div>
		   		</div>
			   </div>
		 	   	
       		 </div>
        </div>
        <!-- END PAGE CONTENT -->
      