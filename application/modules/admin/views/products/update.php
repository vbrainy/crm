<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_product']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/products/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#product_ajax").html(msg); 
			$("#product_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
	
	
//Delete 

function delete_variant( variant_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/products/delete_variant' ); ?>/" + variant_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#variant_id_' + variant_id).fadeOut('normal');
            }
        }

    });
       
 }	
 </script>
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Update Product</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="product_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="update_product" name="update_product" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				<input  type="hidden" name="product_id" value="<?php echo $product->id;?>"/>                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Product Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="product_name" value="<?php echo $product->product_name;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6"> 
					                          	<div class="col-sm-8">
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
				                                <div class="col-sm-4">
					                          		<?php if($product->product_image){?>	
	             	<img src="<?php echo base_url('uploads/products').'/'.$product->product_image; ?>" alt="company image" class="img-md img-thumbnail">  
	             	<?php }else{?>
	             		<img src="<?php echo base_url('uploads/products').'/default.gif'; ?>" alt="user image" class="img-md img-thumbnail">  
	             	<?php }?>
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
															echo form_dropdown('status', $options,$product->status,'class="form-control"');?>	
					                              </div>
					                            </div>
					                          </div>
					                      </div>    
										  <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Quantity On Hand </label>
					                              <div class="append-icon">
					                                <input type="text" name="quantity_on_hand" value="<?php echo $product->quantity_on_hand;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Quantity Available</label>
					                              <div class="append-icon">
					                                <input type="text" name="quantity_available" value="<?php echo $product->quantity_available;?>" class="form-control">
					                                 
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
															echo form_dropdown('product_type', $options,$product->product_type,'class="form-control"');?>	
							                              </div>
							                            </div>
					                          			</div>
	                          							 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Active</label>
							                              <div class="append-icon">
							                                <input type="checkbox" name="active" <?php if($product->active==1){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue"/> 
							                                 
							                              </div>
							                            </div>
							                          </div>
                          					 	
					                    			     </div>
	 													 <div class="row">
                          							     	 <div class="col-sm-6">
									                           <div class="form-group">
									                              <label class="control-label">Sale Price</label>
									                              <div class="append-icon">
									                                <input type="text" name="sale_price" value="<?php echo $product->sale_price;?>" class="form-control">
									                                 
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
					                                
					                                <textarea name="description" rows="5" class="form-control" placeholder="describe the product characteristics..."><?php echo $product->description;?></textarea>   
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
					                                
					                                <textarea name="description_for_quotations" rows="5" class="form-control"><?php echo $product->description_for_quotations;?></textarea>   
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
									                      
									                      <?php if( ! empty($variants) ){?>
					    									<?php foreach( $variants as $variant){ ?> 
									                      <tr id="variant_id_<?php echo $variant->id;?>"><td>
									                      <input type="hidden" name="variant_id[]" id="variant_id[]" value="<?php echo $variant->id;?>" />
									                      <input type="text" name="unit[]" value="<?php echo $variant->unit;?>" class="form-control"></td><td><input type="text" name="capacity[]" value="<?php echo $variant->capacity;?>" class="form-control"></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger" onclick="delete_variant(<?php echo $variant->id; ?>)"><i class="icons-office-52"></i></a></td></tr>
									                      <?php } ?>
					 									<?php } ?>
									                       
									                    </tbody>
									                  </table>
									                  <a href="#" id="AddMoreFileBox"><button type="button" class="btn btn-sm btn-primary">Add an item</button></a>
                 									 </div>
                </div>
												</div>  
					                        </div>
                        				   
                        				<div class="text-left  m-t-20">
                         				 <div id="product_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 