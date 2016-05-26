<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_qtemplates']").submit(function(e) {
       
       update_total_price();
       
       var formData = new FormData($(this)[0]);
		 
        $.ajax({
            url: "<?php echo base_url('admin/qtemplates/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#qtemplates_ajax").html(msg); 
			$("#qtemplates_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
 
 function product_price_changes(quantity,product_price,sub_total_id)
 {
 	
 	var no_quantity=$("#"+quantity).val();
 	 
 	var sub_total= parseFloat(no_quantity * product_price).toFixed(2); 
 	
 	var tax_amount = 0;		
		tax_amount = (sub_total*<?php echo config('sales_tax'); ?>) / 100;
		$('#taxes').val(tax_amount.toFixed(2));
 	 
 	$('#'+sub_total_id).val(sub_total); 
 	 
 }
 
 function update_total_price()
 {
 	var sub_total = 0;
 	$('input[name^="sub_total"]').each(function() {
   	 sub_total += parseFloat($(this).val());     
     $('#total').val(sub_total.toFixed(2)); 
     
     	var tax_per=<?php echo config('sales_tax'); ?>;
		var tax_amount = 0;
		
		tax_amount = (sub_total*tax_per) / 100;
		$('#tax_amount').val(tax_amount.toFixed(2)); 
		var grand_total = 0;
		grand_total = sub_total + tax_amount;
		$('#grand_total').val(grand_total.toFixed(2)); 

	});
	 
 }
 
 function product_value()
 {
 	var all_Val=$("#product_list").val();
 	var res = all_Val.split("_");
 	
 	$('#product_id').val(res[0]);  
 	$('#product_name1').val(res[1]);
 	$('#unit_price').val(res[2]);
 	$('#pdescription').val(res[3]); 
 }
 
								 $(document).ready(function() {
						 	 	
								
								
								var MaxInputs       = 50; //maximum input boxes allowed
								var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
								var AddButton       = $("#AddMoreFileBox"); //Add button ID
								
								var x = InputsWrapper.length; //initlal text box count
								var FieldCount=1 + <?php echo count($qtemplate_products);?>; //to keep track of text box added
								
								 
								//$("#total").val("0");
								
								$(AddButton).click(function (e)  //on add input button click
								{
									var product_id=$("#product_id").val();
									var product_name=$("#product_name1").val();
									var product_quantity=$("#product_quantity").val();
									var product_price=$("#unit_price").val();
									var description=$("#pdescription").val();
									var tax_rat = <?php echo config('sales_tax');?>
									
									var sub_total= parseFloat(product_quantity * product_price).toFixed(2);
									var main_total=$("#total").val();
									
												if(x <= MaxInputs) //max input box allowed
												{
														FieldCount++; //text box added increment
														 
														$(InputsWrapper).append('<tr class="remove_tr"><td><input type="hidden" name="p_id[]" id="p_id" value="'+product_id+'" readOnly><input type="text" name="product_name[]" id="product_name" value="'+product_name+'" class="form-control" readOnly></td><td><textarea name=description[]" id="description" rows="2" class="form-control" readOnly>'+description+'</textarea></td><td><input type="text" name="quantity[]" id="quantity'+FieldCount+'" value="'+product_quantity+'" class="form-control" onchange="product_price_changes(\'quantity'+FieldCount+'\','+product_price+',\'sub_total'+FieldCount+'\');"></td><td><input type="text" name="product_price[]" id="product_price" value="'+product_price+'" class="form-control" readOnly></td><td><input type="text" name="taxes[]" id="taxes" value="'+parseFloat((product_quantity*product_price*tax_rat)/100).toFixed(2)+'" class="form-control" readOnly></td><td><input type="text" name="sub_total[]" id="sub_total'+FieldCount+'" value="'+sub_total+'" class="form-control" readOnly></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger removeclass" data-toggle="modal" data-target="#modal-basic"><i class="icons-office-52"></i></a></td></tr>');
														
														
														x++; //text box increment
												}
												
												//Total price count 
												var total1 = parseInt(sub_total) + parseInt(main_total) ;
												$('#total').val(total1.toFixed(2)); 
												var tax_per=<?php echo config('sales_tax'); ?>;
									 			var tax_amount = 0;
									 			
									 			tax_amount = (total1*tax_per) / 100;
									 			$('#tax_amount').val(tax_amount.toFixed(2)); 
									 			var grand_total = 0;
									 			grand_total = total1 + tax_amount;
									 			$('#grand_total').val(grand_total.toFixed(2)); 
									 
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

	/*$(document).on('focus',".date-picker", function(){
		    $(this).datepicker();
		}); */


//Delete products

function delete_product( product_id )
 { 
  
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/qtemplates/delete_product' ); ?>/" + product_id,
        success: function(msg)
        {
			if( msg != '' )
            {	
            	var str=msg.split("_");
	            var untax_amount=str[0];
	            var taxes=str[1];
	            var total=str[2];
             
                $('#qproduct_id_' + product_id).remove();
                
                $('#total').val(untax_amount);
                $('#tax_amount').val(taxes);
                $('#grand_total').val(total); 
                
            }
             
        }

    });
   
    
 }			
 </script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Update Quotation Template</strong></h2>            
          </div>
           <div class="row">
            
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="qtemplates_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_qtemplates" name="add_qtemplates" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                        			<input  type="hidden" name="qtemplates_id" value="<?php echo $qtemplate->id;?>"/>	 
                        				<div class="row">
                          					 
					                          <div class="col-sm-6">
				                                 <div class="form-group">
				                              <label class="control-label">Quotation Template</label>
				                              <div class="append-icon">
				                                <input type="text" name="quotation_template" value="<?php echo $qtemplate->quotation_template;?>" class="form-control"/> 
				                                 
				                              </div>
				                            </div>
				                              </div>
					                     	  <div class="col-sm-6">
				                                 <div class="form-group">
				                              <label class="control-label">Quotation Duration</label>
				                              <div class="append-icon">
				                                <input type="text" name="quotation_duration" value="<?php echo $qtemplate->quotation_duration;?>" class="form-control"/> 
				                                 
				                              </div>
				                            </div>
				                              </div>
					                     </div>
					                    <div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Immediate Payment</label>
					                              <div class="append-icon">
					                                 
					                                <input type="checkbox" name="immediate_payment" value="1" <?php if($qtemplate->immediate_payment==1){?> checked <?php } ?> data-checkbox="icheckbox_square-blue"/> 
					                              </div>
					                            </div>
					                          </div>
					                          
					                    </div>   
					                    <div class="row">
					                    
					                    	 <div class="panel-content">
                   									<label class="control-label">Products</label> 
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
									                      <?php if( ! empty($qtemplate_products) ){?>
					    									<?php foreach( $qtemplate_products as $qtemplate_product){ ?> 
									                      <tr id="qproduct_id_<?php echo $qtemplate_product->id;?>"><td>
									                      <input type="hidden" name="qtemplate_product_id[]" id="qtemplate_product_id" value="<?php echo $qtemplate_product->id;?>" />
									                      <input type="hidden" name="p_id[]" id="p_id" value="<?php echo $qtemplate_product->product_id;?>" readOnly><input type="text" name="product_name[]" id="product_name" value="<?php echo $qtemplate_product->product_name;?>" class="form-control" readOnly></td><td><textarea name=description[]" id="description" rows="2" class="form-control" readOnly><?php echo $qtemplate_product->discription;?></textarea></td><td><input type="text" name="quantity[]" id="quantity<?php echo $qtemplate_product->product_id;?>" value="<?php echo $qtemplate_product->quantity;?>" class="form-control" onchange="product_price_changes('quantity<?php echo $qtemplate_product->product_id;?>','<?php echo $qtemplate_product->price;?>','sub_total<?php echo $qtemplate_product->product_id;?>');"></td><td><input type="text" name="product_price[]" id="product_price" value="<?php echo $qtemplate_product->price;?>" class="form-control" readOnly></td><td><input type="text" name="taxes[]" id="taxes<?php echo $qtemplate_product->product_id;?>" value="<?php echo number_format($qtemplate_product->quantity*$qtemplate_product->price*config('sales_tax')/100,2,'.',' ');?>" class="form-control" readonly></td><td><input type="text" name="sub_total[]" id="sub_total<?php echo $qtemplate_product->product_id;?>" value="<?php echo $qtemplate_product->sub_total;?>" class="form-control" readOnly></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger" onclick="delete_product(<?php echo $qtemplate_product->id;?>)"><i class="icons-office-52"></i></a></td></tr>
									                      <?php } ?>
					 									<?php } ?> 
									                    </tbody>
									                  </table>
									                 <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create_product">Add an product</a>
									                 <!-- <a href="#" id="AddMoreFileBox"><button type="button" class="btn btn-sm btn-primary">Add an item</button></a>-->
                 									 </div>
					                    	
					                    </div>
					                    <div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label"></label>
					                              <div class="append-icon"> 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Untaxed Amount</label>
					                              <div class="append-icon">
					                                 
					                                <input type="text" name="total" id="total" value="<?php echo $qtemplate->total;?>" class="form-control" readonly/> 
					                              </div>
					                            </div>
					                          </div>
					                          
					                    </div>
					                   	<div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label"></label>
					                              <div class="append-icon"> 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Taxes</label>
					                              <div class="append-icon">
					                                 
					                                <input type="text" name="tax_amount" id="tax_amount" value="<?php echo $qtemplate->tax_amount;?>" class="form-control" readonly/> 
					                              </div>
					                            </div>
					                          </div>
					                          
					                    </div>   
					                    <div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Terms and Conditions</label>
					                              <div class="append-icon">
					                                 
					                                <textarea name="terms_and_conditions" rows="4" class="form-control"><?php echo $qtemplate->terms_and_conditions;?></textarea> 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Total (<a href="javascript:void(0);" id="update_total" onclick="update_total_price();"><b>Update</b></a>)</label>
					                              <div class="append-icon">
					                                 
					                                <input type="text" name="grand_total" id="grand_total" value="<?php echo $qtemplate->grand_total;?>" class="form-control" readonly/> 
					                              </div>
					                            </div>
					                          </div>
					                          
					                    </div>    
					                        
                        				<div class="text-left  m-t-20">
                         				 <div id="qtemplates_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
 
 <!-- START MODAL PRODUCT CONTENT -->
 <div class="modal fade" id="modal-create_product" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Product</strong> Order</h4>
                </div>
               	<div id="call_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				         
				
               	  
               	 <div class="modal-body">
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Product</label>
                         <input type="hidden" name="product_id" id="product_id" value="">
                         <input type="hidden" name="product_name1" id="product_name1" value="">
                        	<select name="product_list" id="product_list" class="form-control" data-search="true" onchange="product_value();">
                                <option value=""></option>
                                <?php foreach( $products as $product){ ?>
                                <option value="<?php echo $product->id.'_'.$product->product_name.'_'.$product->sale_price.'_'.$product->description_for_quotations;?>"><?php echo $product->product_name;?></option>
                                <?php }?> 
					       
					       </select>
                         
                      </div>
                    </div>
					<div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Quantity</label>
                         
                        <input type="text" name="product_quantity" id="product_quantity" value="1" class="form-control">	 
                         
                      </div>
                    </div>
                     
                  </div>
				  
				  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Unit Price</label>
                         
                        <input type="text" name="unit_price" id="unit_price" value="" class="form-control" readonly>	 
                          
                      </div>
                    </div>
					<div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Description</label>
                         
                       <textarea name="pdescription" id="pdescription" rows="2" class="form-control" readonly></textarea>	 
                         
                      </div>
                    </div>
                     
                  </div>	
                   
                   
                </div>
                 
                  <div class="modal-footer text-center"> 
                  <a href="#" id="AddMoreFileBox"><button type="button" class="btn btn-embossed btn-primary" data-dismiss="modal" onclick="">Add an item</button></a>
                  </div>
                 
                 
                
              </div>
            </div>
          </div>

