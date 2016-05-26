<script>

 function delete_leads( lead_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/leads/delete' ); ?>/" + lead_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#lead_id_' + lead_id).fadeOut('normal');
            }
        }

    });
       
 }


 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Leads</strong></h2> 
            <div style="float:right; padding-top:10px;">
               <?php if (check_staff_permission('lead_write')){?> 
			  <a href="<?php echo base_url('admin/leads/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 	
			   <?php }?>
            </div>           
          </div>
            

            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           			 
           		<div class="panel-content pagination2 table-responsive">
           		 
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Creation Date</th>
                        <th>Opportunity</th>
                        <th>Contact Name</th> 
                        <th>Country</th>
                        <th>Email</th>
                        <th>Phone</th>                        
                        <th>Segment</th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                     
                    <tbody>
                      
                      <?php if( ! empty($leads) ){?>
					    <?php foreach( $leads as $lead){ ?>
	                      <tr id="lead_id_<?php echo $lead->id; ?>">
	                      <td><?php echo date('m/d/Y',$lead->register_time); ?></td>
	                        <!--<td><?php echo date('d F Y g:i a',$lead->register_time); ?></td>-->
	                        <td>
	                         
	                        <a href="<?php echo base_url('admin/leads/view/'.$lead->id); ?>"><?php echo $lead->opportunity; ?></a>
	                        
	                        </td>
	                        <td><?php echo $this->contact_persons_model->get_contact_persons($lead->contact_name)->first_name; ?> <?php echo $this->contact_persons_model->get_contact_persons($lead->contact_name)->last_name; ?> </td>
	                          
	                        <td><?php echo country_name($lead->country_id)->name; ?></td>
	                        <td><?php echo $lead->email; ?></td>
	                        <td><?php echo $lead->phone; ?></td>
	                        
	                        <td><?php echo $this->segments_model->get_segment($lead->segment_id)->segment; ?>   </td>	                        
	                        <td style="width: 12%;">
	                        	
	                        	<?php if (check_staff_permission('lead_write')){?> 
	                        	<a href="<?php echo base_url('admin/leads/update/'.$lead->id); ?>" class=" btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a>
	                            <?php }?>
	                            
	                            <?php if (check_staff_permission('lead_delete')){?>
	                         	<a href="javascript:void(0)" class="btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $lead->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                           <?php }?>
	                         </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $lead->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_leads(<?php echo $lead->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      