<script>

 function delete_payment_log( payment_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/invoices_payment_log/delete' ); ?>/" + payment_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#payment_id_' + payment_id).fadeOut('normal');
            }
        }

    });
       
 }



 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="header">
            <h2><strong>Payments Log</strong></h2> 
            <div class="breadcrumb-wrapper">
               
            </div>           
          </div>
             
            <div class="row">
	           
	           <div class="panel">															
	           	<div class="panel-content">
           		
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic" >
                    <thead>
                      <tr>                        
                        <th>Amount</th>
                        <th>Invoice Number</th>                          
                        <th>Company Name</th>
                        <th>Staff User</th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($invoice_payments) ){?>
					    <?php foreach( $invoice_payments as $payment){ ?>
	                      <tr id="payment_id_<?php echo $payment->id; ?>">
	                
	                		<td><?php echo $payment->payment_received; ?></td>       
	                        <td><a href="<?php echo base_url('admin/invoices/view/'.$payment->invoice_id); ?>"><?php echo $this->invoices_model->get_invoice($payment->invoice_id)->invoice_number; ?></a></td>	                     
	                        <td><?php echo customer_name($this->invoices_model->get_invoice($payment->invoice_id)->customer_id)->name; ?></td>
	                          				 
	                        <td><?php echo $this->staff_model->get_user_fullname($payment->staff_id);?></td>
	                        
	                        <td style="width: 12%;"> <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $invoice->id; ?>"><i class="glyphicon glyphicon-trash"></i></a></td> 
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
					                  <button type="button" onclick="delete_payment_log(<?php echo $payment->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      