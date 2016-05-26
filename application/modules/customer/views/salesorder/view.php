<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
       	  <?php if($quotation->quotations_number){?> 
       	   <div class="header">
            <h2><strong>Sales Order <?php echo $quotation->quotations_number;?></strong></h2> 
            <div class="breadcrumb-wrapper">
               <?php 
               	$expiration_date= $quotation->exp_date;
               	$today= strtotime(date('m/d/Y')); 
               if ($expiration_date < $today) { 
               ?>
               <button type="button" class="btn btn-danger">Expired</button>
               <?php }?>
                
               <a href="<?php echo base_url('customer/salesorder/print_quot/'.$quotation->id); ?>" class="btn btn-primary" target="">Print</a>
                 		
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
					                              <?php echo customer_name($quotation->customer_id)->name; ?><br/>
					                          <?php echo $this->customers_model->get_company($quotation->customer_id)->address; ?>     
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Date</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo date('m/d/Y H:i',$quotation->date); ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Expiration Date</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo date('m/d/Y',$quotation->exp_date); ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 	
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Salesperson</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo $this->staff_model->get_user_fullname($quotation->sales_person); ?>
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Sales Team</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo $this->salesteams_model->get_salesteam($quotation->sales_team_id)->salesteam; ?>
					                              </div>
					                              
					                            </div>
												</div>
												</div>	  
												  
					                          </div>
												<div class="col-sm-6">
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Quotation Template</label>
					                              <div class="col-sm-8 append-icon">
					                                 
					                               <?php echo $this->qtemplates_model->get_qtemplate($quotation->qtemplate_id)->quotation_template; ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Pricelist</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $this->pricelists_model->get_pricelist($quotation->pricelist_id)->pricelist_name; ?>   
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Payment Term</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $quotation->payment_term; ?> Days     
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Status</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $quotation->status; ?>   
					                                
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
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label">Terms and Conditions</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $quotation->terms_and_conditions; ?>      
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
									</div>
									<div class="col-sm-4">
									    <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-6 control-label">Untaxed Amount </label>
					                              <div class="col-sm-6 append-icon">
					                               <?php echo $quotation->total; ?> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
									    <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-6 control-label">Taxes </label>
					                              <div class="col-sm-6 append-icon">
					                               <?php echo $quotation->tax_amount; ?> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
										<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-6 control-label">Total </label>
					                              <div class="col-sm-6 append-icon">
					                               <?php echo $quotation->grand_total; ?> 
					                                
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
          <?php }else{?>
          	 <h2><strong>Not found sales order </strong></h2> 
          <?php }?>  	
 		</div>   
  <!-- END PAGE CONTENT -->
  
   