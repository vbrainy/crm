<script>

 function delete_subvertical( subvertical_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/subverticals/delete' ); ?>/" + subvertical_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#subvertical_id_' + subvertical_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Subverticals</strong></h2> 
            <div style="float:right; padding-top:10px;">
               <?php if (check_staff_permission('subverticals_write')){?>
			  <a href="<?php echo base_url('admin/subverticals/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 
			  <?php }?>	
            </div>           
          </div>
             
            <div class="row">
	           <div class="panel">																				
	           <div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>                        
                        <th>Name</th>
                        <th>vertical</th>                      
                        <th>Status</th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                    
                      
                      <?php if( ! empty($subverticals) ){?>
					    <?php foreach( $subverticals as $subvertical){ ?>
	                      <tr id="subvertical_id_<?php echo $subvertical->id; ?>">
	                       
	                        <td><?php echo $subvertical->subvertical_name; ?></td>
	                        <td><?php if($subvertical->vertical_id){echo $this->vertical_model->get_vertical($subvertical->vertical_id)->vertical_name;} ?></td>
	                        <td><?php echo $subvertical->status; ?></td>
	                        <td style="width: 12%;">
	                        <?php if (check_staff_permission('subverticals_write')){?>
	                        <a href="<?php echo base_url('admin/subverticals/update/'.$subvertical->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('subverticals_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $subvertical->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $subvertical->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_subvertical(<?php echo $subvertical->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      