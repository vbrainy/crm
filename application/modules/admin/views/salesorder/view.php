<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
	$("form[name='send_quotation']").submit(function(e) {
		 
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?php echo base_url('admin/salesorder/send_quotation'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#quotation_ajax").html(msg); 
			$("#quotation_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			 
			//$("form[name='send_quotation']").find("input[type=text]").val("");
			
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});	
function create_pdf( quotation_id )
 { 
  
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/salesorder/ajax_create_pdf' ); ?>/" + quotation_id,
        success: function(msg)
        {
			if( msg != '' )
            {	  
                
                $("#pdf_url").attr("href", msg)
                
                var index = msg.lastIndexOf("/") + 1;
				var filename = msg.substr(index);				 
				$("#pdf_url").html(filename);
				
				$("#quotation_pdf").val(filename);
				
            }
             
        }

    });
   
    
 }	

</script>
<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="row">
            <h2 class="col-md-6"><strong>Sales Order <?php echo $quotation->quotations_number;?></strong></h2> 
            <div style="float:right; padding-top:10px;">
               <?php if (check_staff_permission('sales_orders_write')){?>
               <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-send_by_email" onclick="create_pdf(<?php echo $quotation->id;?>)">Send by Email</a>
               
               <a href="<?php echo base_url('admin/salesorder/print_quot/'.$quotation->id); ?>" class="btn btn-primary" target="">Print</a>
                
               <a href="<?php echo base_url('admin/salesorder/update/'.$quotation->id); ?>" class="btn btn-primary">Edit</a>
                
			   <a href="<?php echo base_url('admin/salesorder/create_invoice/'.$quotation->id); ?>" class="btn btn-primary" target="">Create Invoice</a> 
			   <?php }?>		
            </div>                
          </div>
           <div class="row">
           		 
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
					                              <label class="col-sm-4 control-label"><i class="fa fa-user"></i>Customer</label>
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
					                              <label class="col-sm-4 control-label"><i class="fa fa-calendar"></i>Date</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo date('m/d/Y H:i',$quotation->date); ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 	 	
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-user-plus"></i>Salesperson</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo $this->staff_model->get_user_fullname($quotation->sales_person); ?>
					                              </div>
					                              
					                            </div>
												</div>
												</div>  
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-users"></i>Sales Team</label>
					                              <div class="col-sm-8 append-icon">
					                                 <?php echo $this->salesteams_model->get_salesteam($quotation->sales_team_id)->salesteam; ?>
					                              </div>
					                              
					                            </div>
												</div>
												</div>  
					                          </div>
												<div class="col-sm-6">
					                            <div class="row" style="display: none;">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-columns"></i>Quotation Template</label>
					                              <div class="col-sm-8 append-icon">
					                                 
					                               <?php echo $this->qtemplates_model->get_qtemplate($quotation->qtemplate_id)->quotation_template; ?> 
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-list-ul"></i>Pricelist</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $this->pricelists_model->get_pricelist($quotation->pricelist_id)->pricelist_name; ?>   
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-expand"></i>Payment Term</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php if($quotation->payment_term==0){echo 'Immediate Payment';}else{echo $quotation->payment_term.' Days';} ?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
													 
												  
												  
					                          </div>
					                        </div>    
                        			     
                        			     <div class="row">
                        			     	
                        			     	<div class="panel-content">
                   									<label class="control-label"><i class="fa fa-cubes"></i>Order</label> 
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
					                              <label class="col-sm-4 control-label"><i class="fa fa-clipboard"></i>Terms and Conditions</label>
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
  <!-- END PAGE CONTENT -->
  
  
<!-- START MODAL PRODUCT CONTENT -->
 <div class="modal fade" id="modal-send_by_email" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Send </strong>by Email</h4>
                </div>
               	<div id="quotation_ajax" style="text-align:center;
"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				  
               	 <div class="modal-body">
                  <form id="send_quotation" name="send_quotation" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="quotation_id" id="quotation_id" value="<?php echo $quotation->id;?>" class="form-control">    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Subject</label> 
                        	<input type="text" name="email_subject" id="email_subject" value="Demo Company Order (Ref <?php echo $quotation->quotations_number;?>)" class="form-control"> 
                         
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
					               <option value="<?php echo $company->email;?>" <?php if($quotation->customer_id==$company->id){?>selected<?php }?>><?php echo $company->name." (".$company->email.")";?></option>
					             
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
                       	
                       	<p>Hello <?php echo customer_name($quotation->customer_id)->name; ?>,</p>

    <p>Here is your order confirmation from Demo Company: </p>

    <p style="border-left: 1px solid #8e0000; margin-left: 30px;">
       &nbsp;&nbsp;<strong>REFERENCES</strong><br>
       &nbsp;&nbsp;Order number: <strong><?php echo $quotation->quotations_number;?></strong><br>
       &nbsp;&nbsp;Order total: <strong><?php echo $quotation->grand_total; ?></strong><br>
       &nbsp;&nbsp;Order date: <?php echo date('m/d/Y H:i',$quotation->date); ?> <br>
       
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
                         <input type="hidden" name="quotation_pdf" id="quotation_pdf" value="" class="form-control">
                      </div>
                    </div>
					 
                     
                  </div> 
                  <div class="modal-footer text-center"> 
                   <div id="quotation_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                  </div>
                 </form> 
                  
                </div>
                 
                 
                  
                 
                
              </div>
            </div>
          </div>
