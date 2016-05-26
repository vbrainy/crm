<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

function delete_meeting( meeting_id )
 {
    
   	$.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/meetings/meeting_delete' ); ?>/" + meeting_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#meeting_id_' + meeting_id).fadeOut('normal');
            }
        }

    });
    
      
 } 

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Meetings</strong></h2> 
            <div style="float:right; padding-top:10px;">
              <?php if (check_staff_permission('meetings_write')){?> 
			  <a href="<?php echo base_url('admin/meetings/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 
			  <?php }?>	
            </div>           
          </div>
             
            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>                        
                        <th>Subject</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Responsible</th> 
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($meetings) ){?>
					    <?php foreach( $meetings as $meeting){ ?>
	                      <tr id="meeting_id_<?php echo $meeting->id; ?>">
	              			<td><?php echo $meeting->meeting_subject; ?></td>
	              			<td><?php echo date('m/d/Y H:i',$meeting->starting_date); ?></td>         
	                         <td><?php echo date('m/d/Y H:i',$meeting->ending_date); ?></td>         
	              			 
	              			<td><?php echo $this->staff_model->get_user($meeting->responsible)->first_name.' '.$this->staff_model->get_user($meeting->responsible)->last_name; ?></td>                                
	                        <td style="width: 12%;">
	                        <?php if (check_staff_permission('meetings_write')){?> 
	                        <a href="<?php echo base_url('admin/meetings/edit_meeting/'.$meeting->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('meetings_delete')){?> 
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $meeting->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $meeting->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_meeting(<?php echo $meeting->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      