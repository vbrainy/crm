<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$("form[name='receive_payments']").submit(function(e) {
		 
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('admin/invoices/receive_payments_number_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#receive_payments_ajax").html(msg); 
			$("#receive_payments_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			 
			$("form[name='receive_payments']").find("input[type=number]").val("");
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});	
 
 </script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Invoice Payment Receive </strong></h2>
                        
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   		 <div class="row">
                          					&nbsp;	   
					         </div>
                   					<div id="receive_payments_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="receive_payments" name="receive_payments" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post"> 
                        				  
                        				<div class="row">
                          					<div class="col-sm-6">
				                                 <div class="form-group">
				                              <label class="control-label">Invoice Number</label>
				                              <div class="append-icon">
				                                
				                               <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="">  
				                                 
				                              </div>
				                            </div>
				                              </div>  
											<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Payment Date</label>
					                              <div class="append-icon">
					                                 
					                                <input type="text" name="payment_date" id="payment_date" class="date-picker form-control" value="<?php echo date('m/d/Y');?>">
					                              </div>
					                            </div>
					                          </div>			
					                        
					                     </div>
					                       
					                    <div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Payment Method</label>
					                              <div class="append-icon">	 
					                                <select name="payment_method" class="form-control"> 
					                                <option value="Cash">Cash</option>
					                                <option value="Check">Check</option>
					                                <option value="Bank Account">Bank Account</option>
					                                <option value="Credit Card">Credit Card</option> 
					                                
					                                 </select>
					                              </div>
					                            </div>
					                          </div>
					                    	<div class="col-sm-6">
				                                 <div class="form-group">
				                              <label class="control-label">Amount Received</label>
				                              <div class="append-icon">
				                                
				                               <input type="number" name="payment_received" id="payment_received" class="form-control" value="">  
				                                 
				                              </div>
				                            </div>
				                              </div>
					                        
					                    </div>
					                     
                        		    
					                        
                        				<div class="text-left  m-t-20">
                         				 <div id="receive_payments_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                           
                        </div>
                      </form>             
                  			 <div class="row">
                          					&nbsp;	   
					         </div>	    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->

           