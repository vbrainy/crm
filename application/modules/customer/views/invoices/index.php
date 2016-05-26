     <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="header">
            <h2><strong>Invoices</strong></h2> 
            <div class="breadcrumb-wrapper">
                
               
            </div>
             
			<div class="row">
                            <div class="col-md-12">
                                <div class="widget-cash-in-hand">
                                    <div class="cash">
                                        <div class="number c-green">$<?php echo $open_invoice_total;?></div>
                                        <div class="txt">open invoices</div>
                                    </div>
                                    <div class="cash">
                                        <div class="number c-red">$<?php echo $overdue_invoices_total;?></div>
                                        <div class="txt">overdue invoices</div>
                                    </div>
                                    <div class="cash">
                                        <div class="number c-blue">$<?php echo $paid_invoices_total;?></div>
                                        <div class="txt">paid invoices</div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6"> 
</div>
                            </div>
                        </div>         
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
                        <th>Invoice Number</th>                                    <th>Date</th> 
                        <th>Customer</th>
                        <th>Due Date</th>
                        <th>Balance</th> 
                        <th>Status</th> 
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($invoices) ){?>
					    <?php foreach( $invoices as $invoice){ ?>
	                      <tr id="invoice_id_<?php echo $invoice->id; ?>">
	                       
	                        <td><a href="<?php echo base_url('customer/invoices/view/'.$invoice->id); ?>"><?php echo $invoice->invoice_number; ?></a></td>	                     <td><?php echo date('m/d/Y',$invoice->invoice_date); ?></td>
	                        <td><?php echo customer_name($invoice->customer_id)->name; ?></td>
	         				<td><?php echo date('m/d/Y',$invoice->due_date); ?></td>
	       
	       					<td><?php echo $invoice->unpaid_amount; ?></td>
	       					  				 
	                        <td><?php echo $invoice->status; ?></td> 
	                        <td style="width: 12%;"><a href="<?php echo base_url('customer/invoices/view/'.$invoice->id); ?>" class="edit btn btn-sm btn-default"><i class="fa fa-search-plus"></i></a>  </td> 
	                      </tr>
	                     
	                      
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
      