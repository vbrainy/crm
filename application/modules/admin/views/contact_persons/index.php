<script>

 function delete_contact_person( contact_person_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/contact_persons/delete' ); ?>/" + contact_person_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#contact_person_id_' + contact_person_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Contact Persons</strong></h2> 
            <div style="float:right; padding-top:10px;">
               
			  <a href="<?php echo base_url('admin/contact_persons/add/'); ?>" class="btn btn-primary btn-embossed"> New Contact Person</a> 	
            </div>           
          </div>
                    

            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	<input type="hidden" id="paginationValue" value="50"/>
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang->line('name'); ?></th>
                        <th><?php echo $this->lang->line('email'); ?></th>
                        <th><?php echo $this->lang->line('register_time'); ?></th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($contact_persons) ){?>
					    <?php foreach( $contact_persons as $contact_person){ ?>
	                      <tr id="contact_person_id_<?php echo $contact_person->id; ?>">
	                        <td><a href="<?php echo base_url('admin/contact_persons/view/'.$contact_person->id); ?>"><?php echo $contact_person->first_name.' '.$contact_person->last_name; ?></a></td>
	                        <td><?php echo $contact_person->email; ?></td>
	                        <td><?php echo date('d F Y g:i a',$contact_person->register_time); ?></td>
	                        <td>
	                        
	                        <a href="<?php echo base_url('admin/contact_persons/update/'.$contact_person->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $contact_person->id; ?>"><i class="glyphicon glyphicon-trash"></i></a></td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $contact_person->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_contact_person(<?php echo $contact_person->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      