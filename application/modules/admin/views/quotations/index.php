<script>

 function delete_quotation( quotation_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/quotations/delete' ); ?>/" + quotation_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#quotation_id_' + quotation_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Quotations</strong></h2> 
            <div style="float:right; padding-top:10px;">
               <?php if (check_staff_permission('quotations_write')){?>
			 	 <a href="<?php echo base_url('admin/quotations/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 
			  <?php }?>	
            </div>           
          </div>
             
            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           			<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
						  <label class="control-label">Start Date</label>
						  <div class="append-icon">
						    <input type="text" id="min" name="min" class="date-picker form-control">
						    <i class="icon-calendar"></i>
						  </div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
						  <label class="control-label">End Date</label>
						  <div class="append-icon">
						    <input type="text" id="max" name="max" class="date-picker form-control">
						    <i class="icon-calendar"></i>
						  </div>
						</div>
					</div>
				</div>
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic filter-between_date">
                    <thead>
                      <tr>                        
                        <th>Quotations Number</th>  						<th>Date</th> 
                        <th>Customer</th> 
                        <th>Salesperson</th> 
                        <th>Total</th> 
                        <th>Status</th> 
                         
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($quotations) ){?>
					    <?php foreach( $quotations as $quotation){ ?>
	                      <tr id="quotation_id_<?php echo $quotation->id; ?>">
	                       
	                        <td><a href="<?php echo base_url('admin/quotations/view/'.$quotation->id); ?>"><?php echo $quotation->quotations_number; ?></a></td>	                         		<td><?php echo date('m/d/Y',$quotation->date); ?></td>
	                        <td><?php echo customer_name($quotation->customer_id)->name; ?></td>
	         				<td><?php echo $this->staff_model->get_user_fullname($quotation->sales_person); ?></td>
	                        
	                        <td><?php echo $quotation->grand_total; ?></td>
	                        
	                        <td><?php echo $quotation->status; ?></td>
	                        
	                        <td style="width: 12%;">
	                        <?php if (check_staff_permission('quotations_write')){?>
	                        <a href="<?php echo base_url('admin/quotations/update/'.$quotation->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('quotations_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $quotation->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $quotation->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_quotation(<?php echo $quotation->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      