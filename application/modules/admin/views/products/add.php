<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_product']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/products/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#product_ajax").html(msg); 
			$("#product_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("form[name='add_product']").find("input[type=text]").val("");
			
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});
 
 
 </script>
 <script>
								 $(document).ready(function() {
								
								var MaxInputs       = 50; //maximum input boxes allowed
								var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
								var AddButton       = $("#AddMoreFileBox"); //Add button ID
								
								var x = InputsWrapper.length; //initlal text box count
								var FieldCount=1; //to keep track of text box added
								
								$(AddButton).click(function (e)  //on add input button click
								{
												if(x <= MaxInputs) //max input box allowed
												{
														FieldCount++; //text box added increment
														//add input box
														$(InputsWrapper).append('<tr><td><input type="text" name="attribute_name[]" value="" class="form-control"></td><td><input type="text" name="product_attribute_value[]" value="" class="form-control"></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger removeclass" data-toggle="modal" data-target="#modal-basic"><i class="icons-office-52"></i></a></td></tr>');
														x++; //text box increment
												}
								return false;
								});
								
								$("body").on("click",".removeclass", function(e){ //user click on remove text
												if( x > 1 ) {
																$(this).parent().parent().remove(); //remove text box
																x--; //decrement textbox
												}
								return false;
								}) 
								
								});
 							</script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Add Product</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="product_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_product" name="add_product" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
  
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Product Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="product_name" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
				                                <div class="form-group">
				                              <label class="control-label">Product Image</label>
				                              <div class="append-icon">
				                                <div class="file">
					                                <div class="option-group">
					                                  <span class="file-button btn-primary">Choose File</span>
					                                  <input type="file" class="custom-file" name="product_image" id="product_image" onchange="document.getElementById('uploader').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
				                              </div>
				                            </div>
				                              </div>
					                        </div>
					                     <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Status</label>
					                              <div class="append-icon">
					                                 
					                                 <?php $options = array(
											                  ''  => '',
											                  'In Development'  => 'In Development',
											                  'Normal'    => 'Normal',
											                  'End of Lifecycle'   => 'End of Lifecycle',
											                  'Obsolete'   => 'Obsolete',
											                ); 
															echo form_dropdown('status', $options,'','class="form-control"');?>	
					                              </div>
					                            </div>
					                          </div>
					                      </div>    
										  <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Quantity On Hand </label>
					                              <div class="append-icon">
					                                <input type="text" name="quantity_on_hand" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Quantity Available</label>
					                              <div class="append-icon">
					                                <input type="text" name="quantity_available" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                      </div>    	
					                     <ul class="nav nav-tabs">
				                        <li class="active"><a href="#tab1_1" data-toggle="tab">Information</a></li>
				                        <li class=""><a href="#tab1_2" data-toggle="tab">Sales</a></li>                      			
				                       <li class=""><a href="#tab1_3" data-toggle="tab">Variants</a></li>                      
				                      </ul>
					                     <div class="tab-content">
						                        
						                        <div class="tab-pane fade active in" id="tab1_1">
							                           <div class="panel-body bg-white">
						                 			  		   											 				  							  <div class="row">
                          							   <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Product Type</label>
							                              <div class="append-icon">
							                                 
							                                <?php $options = array( 
											                  'Device'  => 'Device',
											                  'Enterprise'    => 'Enterprise',
											                  'Mobile'   => 'Mobile',
                                                                'VAS'   => 'VAS',
											                ); 
															echo form_dropdown('product_type', $options,'Device','class="form-control"');?>	
							                              </div>
							                            </div>
					                          			</div>
	                          							 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Active</label>
							                              <div class="append-icon">
							                                <input type="checkbox" name="active" value="1" checked data-checkbox="icheckbox_square-blue"/> 
							                                 
							                              </div>
							                            </div>
							                          </div>
                          					 	
					                    			     </div>
	 													 <div class="row">
                          							     	 <div class="col-sm-6">
									                           <div class="form-group">
									                              <label class="control-label">Sale Price/Unit</label>
									                              <div class="append-icon">
									                                <input type="text" name="sale_price" value="" class="form-control">
									                                 
									                              </div>
									                            </div>
					                         				 </div>
                          								     <div class="col-sm-6">
				                            
				                         					 </div>
                          					 	
					                    			      </div>
														<div class="row">
														<div class="col-sm-12">
					                            		<div class="form-group">
					                               
					                              <div class="append-icon">
					                                
					                                <textarea name="description" rows="5" class="form-control" placeholder="describe the product characteristics..."></textarea>   
					                              </div>
					                            </div>
					                         			 </div>
														</div>
							               			   </div>
						                        </div>
											    
											    <div class="tab-pane fade" id="tab1_2">
												<div class="panel-body bg-white">	
													<div class="col-sm-12">
					                            <div class="form-group">
					                               <label class="control-label">Description for Quotations</label>
					                              <div class="append-icon">
					                                
					                                <textarea name="description_for_quotations" rows="5" class="form-control"></textarea>   
					                              </div>
					                            </div>
					                          </div>
												</div>
					                         </div> 
					                          
					                          	<div class="tab-pane fade" id="tab1_3">
												<div class="panel-body bg-white">	
												
													 <div class="panel-content">
                   										 
                									 <table class="table">
									                    <thead>
									                      <tr>                         
									                        <th>unit</th>
									                        <th>capacity</th>
									                        <th>Option</th>
									                      </tr>
									                    </thead>
									                    <tbody id="InputsWrapper">
									                      <!--<tr> 
									                        <td><input type="text" name="unit" value="" class="form-control"></td>
									                        <td><input type="text" name="capacity" value="" class="form-control"></td>
									                        <td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-basic"><i class="icons-office-52"></i></a></td>
									                      </tr>-->
									                       
									                    </tbody>
									                  </table>
									                  <a href="#" id="AddMoreFileBox"><button type="button" class="btn btn-sm btn-primary">Add an item</button></a>
                 									 </div>
                </div>
												</div>
					                            </div>
					                          
					                         
                        				   
                        				<div class="text-left  m-t-20">
                         				 <div id="product_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
              
           	</div>
            
            		</div>
 		 
  <!-- END PAGE CONTENT -->