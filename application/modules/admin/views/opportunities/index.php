<script>

 function delete_opportunities( opportunity_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/opportunities/delete' ); ?>/" + opportunity_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#opportunity_id_' + opportunity_id).fadeOut('normal');
            }
        }

    });
       
 }

 function confirm_opportunities( opportunity_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/opportunities/confirm_opp' ); ?>/" + opportunity_id,
        success: function(msg)
        {
			if( msg == 'confirmed' )
            {
                //$('#opportunity_id_' + opportunity_id).fadeOut('normal');
                $('#td_confirmed_' + opportunity_id).html('Confirmed');
            }
        }

    });
       
 }


 </script>
 <?php $level = $this->session->userdata['level']; ?>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Opportunities</strong></h2> 
            <div style="float:right; padding-top:10px;">
              <?php if (check_staff_permission('opportunities_write')){?>
			  <a href="<?php echo base_url('admin/opportunities/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 	
			 <?php }?>
            </div>           
          </div>
            

            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	<input type="hidden" id="paginationValue" value="50"/>
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Opportunity</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Stages</th>
                        <th>Segment</th> 
                        <th>Region</th> 
                        <th>Next Action Date</th>
                        <th>Next Action</th>
                        <?php if($level >= 2 && $opportunity->stages == "WON") { ?><th>Confirm</th><?php } ?>
                        <th><?php echo $this->lang->line('options'); ?></th>
                      </tr>
                    </thead>
                     
                    <tbody>
                      
                      <?php if( ! empty($opportunities) ){?>
					    <?php foreach( $opportunities as $opportunity){ ?>
	                      <tr id="opportunity_id_<?php echo $opportunity->id; ?>">
	                        <?php
	                        /*<td><?php echo date('d F Y g:i a',$opportunity->register_time); ?></td>*/
	                        ?>
	                        <td>
	                        	<!-- <a href="<?php echo base_url('admin/opportunities/view/'.$opportunity->id); ?>"></a> -->
	                        	<?php echo $opportunity->opportunity; ?>
	                        </td>	                        
	                        <td><?php echo customer_name($opportunity->customer)->name; ?>   </td>
	                        <td><?php $product = $this->category_model->get_category($opportunity->category_id); echo $product->category_name; ?></td>
	                        <td><?php echo $opportunity->stages; ?> </td>
	                        <td><?php echo $this->staff_model->get_segment_by_user($opportunity->salesperson_id)->segment; ?>   </td>
	                        <td><?php echo $this->staff_model->get_region_by_user($opportunity->salesperson_id)->region; ?>   </td>
	                        <td><?php echo date('m/d/Y', strtotime($opportunity->next_action));?>  </td>
	                        <td><?php echo $opportunity->next_action_title; ?> </td>
	                        <?php  if($level >= 2 && $opportunity->stages == "WON") { ?> 
							<td id="td_confirmed_<?= $opportunity->id ?>">
								<?php if($opportunity->is_confirmed == 1) { echo "Confirmed"; } else { ?>
								<a href="javascript:void(0)" class="btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#stage-confirm<?php echo $opportunity->id; ?>">Confirm</a>
								<?php } ?>
							</td>	                        
							<?php }?>

	                        <td style="width: 17%;">
	                        
	                        <?php 
	                        $next_week= strtotime(date('m/d/Y',strtotime('+'.config('opportunities_reminder_days').' days'))); 
			               	 
			               	$expiration_date= strtotime($opportunity->next_action);
			               	$today= strtotime(date('m/d/Y'));
			               	
			               	if ($expiration_date < $today) 
			         		{ 
			               ?>
			               
			               <a href="#" class="edit btn btn-sm btn-warning dlt_sm_table" data-rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Opportunities has been expired"><i class="icon-info"></i></a>
			                
			         <?php } else if( $expiration_date <= $next_week) { 
			               ?>
			               <a href="#" class="edit btn btn-sm btn-dark dlt_sm_table" data-rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Opportunities will expire within the few days"><i class="icon-info"></i></a>
			                
			               <?php }?>
	                        
	                        
	                         <?php if (check_staff_permission('opportunities_write')){?>
	                        <a href="<?php echo base_url('admin/opportunities/update/'.$opportunity->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	           				<?php }?>
	           				              
	                         <?php if (check_staff_permission('opportunities_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $opportunity->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>

	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $opportunity->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_opportunities(<?php echo $opportunity->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
					                </div>
             					 </div>
           					 </div>
        				  </div>
	                      <div class="modal fade" id="stage-confirm<?php echo $opportunity->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            				<div class="modal-dialog">
              					<div class="modal-content">
					                <div class="modal-header">
					                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
					                  <h4 class="modal-title"><strong>Confirm</strong></h4>
					                </div>
					                <div class="modal-body">
					                  Are you sure you want Approve this opportunity as closed?<br>
					                </div>
					                <div class="modal-footer">
					                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel</button>
					                  <button type="button" onclick="confirm_opportunities(<?php echo $opportunity->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Confirm</button>
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
      