<script>

 function delete_user( user_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('member/delete' ); ?>/" + user_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#user_id_' + user_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>

<!-- BEGIN PAGE CONTENT -->
    <div class="page-content page-thin">
    	<div class="header">
            <h2><strong>Customers</strong></h2>            
          </div>
         <div class="row">
         	<div class="col-lg-12">
              <div class="panel">
                <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Manage </strong> Customers</h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang->line('name'); ?></th>
                        <th><?php echo $this->lang->line('email'); ?></th>
                        <th><?php echo $this->lang->line('register_time'); ?></th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($users) ){?>
					    <?php foreach( $users as $user){ ?>
	                      <tr id="user_id_<?php echo $user->id; ?>">
	                        <td><?php echo $user->first_name.' '.$user->last_name; ?></td>
	                        <td><?php echo $user->email; ?></td>
	                        <td><?php echo date('d F Y g:i a',$user->register_time); ?></td>
	                        <td>
	                        <a href="<?php echo base_url('member/update/'.$user->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $user->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_user(<?php echo $user->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
