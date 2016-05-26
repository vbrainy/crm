<script>

 function delete_logged_call( logged_call_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/logged_calls/delete' ); ?>/" + logged_call_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#logged_call_id_' + logged_call_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Logged Calls</strong></h2> 
            <div style="float:right; padding-top:10px;">
              <?php if (check_staff_permission('logged_calls_write')){?> 
			  <a href="<?php echo base_url('admin/logged_calls/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 
			  <?php }?>
			  	
            </div>           
          </div>
             
            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>                        
                        <th>Date</th>
                        <th>Call Summary</th>
                        <th>Contact</th>
                        <th>Responsible</th> 
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($logged_calls) ){?>
					    <?php foreach( $logged_calls as $logged_call){ ?>
	                      <tr id="logged_call_id_<?php echo $logged_call->id; ?>">
	              
	              			<td><?php echo date('m/d/Y',$logged_call->date); ?></td>         
	                        <td><?php echo $logged_call->call_summary; ?></td>
	              
	              			<td><?php echo customer_name($logged_call->company_id)->name;?></td>
	              			
	              			<td><?php echo $this->staff_model->get_user($logged_call->resp_staff_id)->first_name.' '.$this->staff_model->get_user($logged_call->resp_staff_id)->last_name; ?></td>                                
	                        <td style="width: 12%;">
	                        <?php if (check_staff_permission('logged_calls_write')){?> 
	                        <a href="<?php echo base_url('admin/logged_calls/update/'.$logged_call->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('logged_calls_delete')){?> 
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $logged_call->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $logged_call->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_logged_call(<?php echo $logged_call->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      