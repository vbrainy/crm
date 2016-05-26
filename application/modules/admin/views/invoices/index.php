<script>

 function delete_invoice( invoice_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/invoices/delete' ); ?>/" + invoice_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#invoice_id_' + invoice_id).fadeOut('normal');
            }
        }

    });
       
 }



 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Invoices</strong></h2> 
            <div style="float:right; padding-top:10px;">
                <a href="<?php echo base_url('admin/invoices/receive_payments_number/'); ?>" class="btn btn-primary" style="float:right; color:white; background-color:#0C59B0;">RECEIVE PAYMENT</a>
               
            </div>
           
			<div class="row">
                            <div class="col-md-12">
                                <div class="widget-cash-in-hand">
                                    
                                    <div class="cash">
                                    	<a href="<?php echo base_url('admin/invoices/status/Open Invoice'); ?>">
                                        <div class="number c-green">$<?php echo $open_invoice_total;?></div>
                                        <div class="txt">open invoices</div>
                                       </a> 
                                    </div>
                                           
                                    <div class="cash">
                                    <a href="<?php echo base_url('admin/invoices/status/Overdue Invoice'); ?>">
                                        <div class="number c-red">$<?php echo $overdue_invoices_total;?></div>
                                        <div class="txt">overdue invoices</div>
                                    </a>
                                    </div>
                                    
                                                   
                                    <div class="cash">
                                       <a href="<?php echo base_url('admin/invoices/status/Paid Invoice'); ?>">
                                        <div class="number c-blue">$<?php echo $paid_invoices_total;?></div>
                                        <div class="txt">paid invoices</div>
                                      </a>
                                    </div>
                                     
                                                    
                                    <div class="cash">
                                    <a href="<?php echo base_url('admin/invoices/'); ?>">
                                        <div class="number c-red">$<?php echo $invoices_total_collection;?></div>
                                        <div class="txt">COLLECTION AMOUNT</div>
                                     </a>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6"> 
</div>
                            </div>
                        </div> 
			<div class="row">&nbsp;</div>        
          </div>
             
            <div class="row">
	           
	           <div class="panel">															
	           	<div class="panel-content">
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
            	
                  <table class="table table-hover table-dynamic filter-between_date" >
                    <thead>
                      <tr>                        
                        <th>Invoice Number</th>                                       							<th>Date</th> 
                        <th>Customer</th>
                        <th>Due Date</th>
                        <th>Balance</th> 
                        <th>Status</th> 
                        <th>Receive Payments</th> 
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($invoices) ){?>
					    <?php foreach( $invoices as $invoice){ ?>
	                      <tr id="invoice_id_<?php echo $invoice->id; ?>">
	                       
	                        <td><a href="<?php echo base_url('admin/invoices/view/'.$invoice->id); ?>"><?php echo $invoice->invoice_number; ?></a></td>	                     <td><?php echo date('m/d/Y',$invoice->invoice_date); ?></td>
	                        <td><?php echo customer_name($invoice->customer_id)->name; ?></td>
	         				<td><?php echo date('m/d/Y',$invoice->due_date); ?></td>
	       
	       					<td><?php echo $invoice->unpaid_amount; ?></td>
	       					  				 
	                        <td><?php echo $invoice->status; ?></td>
	                        <td><?php if($invoice->status=="Paid Invoice"){?><a href="javascript:void(0);" class="btn btn-sm btn-success"><i class="fa fa-check"></i>  RECEIVED PAYMENT</a><?php }else{?><a href="<?php echo base_url('admin/invoices/receive_payments/'.$invoice->id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-plus"></i>  RECEIVE PAYMENT</a><?php }?></td>
	                        
	                        <td style="width: 17%;">
	                        
	                        <?php 
	                        $next_week= strtotime(date('m/d/Y',strtotime('+'.config('invoice_reminder_days').' days'))); 
			               	 
			               	$expiration_date= $invoice->due_date;
			               	$today= strtotime(date('m/d/Y'));
			               	
			               	if ($expiration_date < $today) 
			         		{ 
			               ?>
			               
			               <a href="#" class="edit btn btn-sm btn-warning dlt_sm_table" data-rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Invoice has been expired"><i class="icon-info"></i></a>
			                
			         <?php } else if( $expiration_date <= $next_week) { 
			               ?>
			               <a href="#" class="edit btn btn-sm btn-dark dlt_sm_table" data-rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Invoice will expire within the few days"><i class="icon-info"></i></a>
			                
			               <?php }?>
	                        
	                       <?php if (check_staff_permission('invoices_write')){?> 
	                        <a href="<?php echo base_url('admin/invoices/update/'.$invoice->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        <?php }?>
	                        
	                        <?php if (check_staff_permission('invoices_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $invoice->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        <?php }?>
	                        
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $invoice->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_invoice(<?php echo $invoice->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      