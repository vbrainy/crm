<script>

 function delete_user( staff_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/staff/delete' ); ?>/" + staff_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#staff_id_' + staff_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>

<!-- BEGIN PAGE CONTENT -->
    <div class="page-content page-thin">
    	<div class="row">
            <h2 class="col-md-6"><strong>Staff</strong></h2>
            <div style="float:right; padding-top:10px;">       
            <?php if (check_staff_permission('staff_write')){?>
                <a href="<?php echo base_url('admin/staff/add'); ?>" class="btn btn-primary btn-embossed"><i class="fa fa-plus"></i> Add New</a>
            <?php }?>     
            </div>
          </div>
         <div class="row">
         	<div class="col-lg-12">
              <div class="panel">
                <!-- <div class="panel-header">
                  <h3><i class="fa fa-table"></i> <strong>Manage </strong> Staff</h3>
                </div> -->
               <div class="panel-content"> 
                   <div class="m-b-20">
                   
                    <div> 
                     <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				     </div>
                  </div>

                   <div class="panel-content pagination2 table-responsive">
                    <input type="hidden" id="paginationValue" value="25"/>
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang->line('name'); ?></th>
                        <th><?php echo $this->lang->line('email'); ?></th>
                        <th><?php echo $this->lang->line('user_role'); ?></th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($staffs) ){?>
					    <?php foreach( $staffs as $staff){ ?>
	                      <tr id="staff_id_<?php echo $staff->id; ?>">
	                        <td><?php echo $staff->first_name.' '.$staff->last_name; ?></td>
	                        <td><?php echo $staff->email; ?></td>
	                        <td><?php echo $staff->role; //echo date('d F Y g:i a',$staff->register_time); ?></td>
	                        <td>
	                        <?php if (check_staff_permission('staff_write')){?>
	                        <a href="<?php if(userdata('id')==$staff->id){echo base_url('admin/account_settings/');}else{ echo base_url('admin/staff/update/'.$staff->id);}?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('staff_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $staff->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $staff->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_user(<?php echo $staff->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
    </div>       
