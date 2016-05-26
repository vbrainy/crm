<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <?php if($invoice->invoice_number){?> 
        <div class="header">
            <h2><strong>Invoice <?php echo $invoice->invoice_number;?></strong></h2> 
            <div class="breadcrumb-wrapper">
                 
               <a href="<?php echo base_url('customer/invoices/print_quot/'.$invoice->id); ?>" class="btn btn-primary" target="">Print</a>
                 		
            </div>                
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   				 
                        			 			 
                        				<div class="row">
                          					&nbsp;	   
					                    </div>
					                     <div class="row">
                          					 
					                          	<div class="col-sm-6">
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Customer</label>
					                              <div class="col-sm-8 append-icon">  
					                              <?php echo customer_name($salesorder->customer_id)->name; ?><br/>
					                          <?php echo $this->customers_model->get_company($salesorder->customer_id)->address; ?>     
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Invoice Date</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo date('m/d/Y',$invoice->invoice_date); ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Due Date</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo date('m/d/Y',$invoice->due_date); ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 	
												   
					                          </div>
												<div class="col-sm-6">
					                            
												
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Payment Term</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php if($invoice->payment_term==0){echo 'Immediate Payment';}else{echo $invoice->payment_term.' Days';} ?>   
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>	 
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Status</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $invoice->status; ?>   
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>  	 
												  
												  
					                          </div>
					                        </div>    
                        			     
                        			     <div class="row">
                        			     	
                        			     	<div class="panel-content">
                   									<label class="control-label">Order</label> 
                									 <table class="table">
									                    <thead>
									                      <tr style="font-size: 12px;">                         
									                        <th>Product</th>
									                        <th>Description</th>
									                        <th>Quantity</th>
									                        <th>Unit Price</th>
									                        <th>Taxes</th>
									                        <th>Subtotal</th>
									                        <th></th>
									                      </tr>
									                    </thead>
									                    <tbody id="InputsWrapper">
									                      <?php if( ! empty($qo_products) ){?>
					    									<?php foreach( $qo_products as $qo_product){ ?> 
					    								  <tr>
					    								  	<td><?php echo $qo_product->product_name;?></td>
					    								  	<td><?php echo $qo_product->discription;?></td>
					    								  	<td><?php echo $qo_product->quantity;?></td>
					    								  	<td><?php echo $qo_product->price;?></td>
					    								  	<td><?php echo number_format($qo_product->quantity*$qo_product->price*config('sales_tax')/100,2,'.',' ');?></td>
					    								  	
					    								  	<td><?php echo $qo_product->sub_total;?></td>
					    								  	
					    								  </tr>	
									                       
									                      <?php } ?>
					 									<?php } ?> 
									                       
									                    </tbody>
									                  </table>
									                  
                 									 </div>
                        			     	
                        			     </div>
                        			 
				                  <div class="row">
				                  	<div class="col-sm-8">
				                  		<div class="row">
					           		                 <div class="col-sm-12">
					                          	  	</div>
												</div>
									</div>
									<div class="col-sm-4">
									    <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-6 control-label">Untaxed Amount </label>
					                              <div class="col-sm-6 append-icon">
					                               <?php echo $invoice->total; ?> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
									    <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-6 control-label">Taxes </label>
					                              <div class="col-sm-6 append-icon">
					                               <?php echo $invoice->tax_amount; ?> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
										<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-6 control-label">Total </label>
					                              <div class="col-sm-6 append-icon">
					                               <?php echo $invoice->grand_total; ?> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>	
									</div>
				                  </div>       
				            <div class="row">
                          					&nbsp;	   
					         </div>            
                        			 
                  </div>
                  </div>
                </div>
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
  
  
<!-- START MODAL PRODUCT CONTENT -->
 <div class="modal fade" id="modal-send_by_email" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Send </strong>by Email</h4>
                </div>
               	<div id="sendby_ajax" style="text-align:center;
"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				  
               	 <div class="modal-body">
                  <form id="send_invoice" name="send_invoice" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="quotation_id" id="quotation_id" value="<?php echo $salesorder->id;?>" class="form-control">    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Subject</label> 
                        	<input type="text" name="email_subject" id="email_subject" value="Demo Company Invoice (Ref <?php echo $invoice->invoice_number;?>)" class="form-control"> 
                         
                      </div>
                    </div>
					 
                     
                  </div>
                   
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Recipients</label> 
                        	<select name="recipients[]" id="recipients" class="form-control" data-search="true" multiple>
                                <option value=""></option>
                                <?php foreach( $companies as $company){ ?>
					               <option value="<?php echo $company->email;?>" <?php if($salesorder->customer_id==$company->id){?>selected<?php }?>><?php echo $company->name." (".$company->email.")";?></option>
					             
					             <?php }?> 
					       
					       </select>
                         
                      </div>
                    </div>
					 
                     
                  </div>
				  
				  <div class="row">
                    
					<div class="col-md-12">
                      <div class="form-group">
                        <label for="field-1" class="control-label"></label>
                         
                       <textarea name="message_body" id="message_body" cols="80" rows="10" class="cke-editor">
                       	
                       	<p>Hello <?php echo customer_name($salesorder->customer_id)->name; ?>,</p>

    <p>Here is your order confirmation from Demo Company: </p>

    <p style="border-left: 1px solid #8e0000; margin-left: 30px;">
       &nbsp;&nbsp;<strong>REFERENCES</strong><br>
       &nbsp;&nbsp;Invoice number: <strong><?php echo $invoice->invoice_number;?></strong><br>
       &nbsp;&nbsp;Invoice total: <strong><?php echo $invoice->grand_total; ?></strong><br>
       &nbsp;&nbsp;Invoice date: <?php echo date('m/d/Y',$invoice->invoice_date); ?> <br>
       
    </p>
                       	
                       </textarea>	 
                         
                      </div>
                    </div>
                     
                  </div>	
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="field-1" class="control-label">File</label> 
                        	<a href="" id="pdf_url" target="_blank"></a>
                         <input type="hidden" name="invoice_pdf" id="invoice_pdf" value="" class="form-control">
                      </div>
                    </div>
					 
                     
                  </div> 
                  <div class="modal-footer text-center"> 
                   <div id="sendby_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Send</button></div>
                  </div>
                 </form> 
                  
                </div>
                   
              </div>
            </div>
            <?php }else{?>
          	 <h2><strong>Not found invoices </strong></h2> 
          <?php }?>
          </div>
