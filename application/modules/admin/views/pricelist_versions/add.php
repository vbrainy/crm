<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_pricelist_versions']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/pricelist_versions/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#pricelist_ajax").html(msg); 
			$("#pricelist_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$('.remove_tr').remove(); //remove tr
			
			$("form[name='add_pricelist_versions']").find("input[type=text]").val("");
			
            
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
    
 
 function product_value()
 {
 	var all_Val=$("#product_list").val();
 	var res = all_Val.split("_");
 	
 	$('#product_id').val(res[0]);  
 	$('#product_name1').val(res[1]);
 	$('#unit_price').val(res[2]);
 	$('#special_price').val(res[2]);
 	$('#pdescription').val(res[3]); 
 }
 
								 $(document).ready(function() {
						 	 	
								
								
								var MaxInputs       = 50; //maximum input boxes allowed
								var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
								var AddButton       = $("#AddMoreFileBox"); //Add button ID
								
								var x = InputsWrapper.length; //initlal text box count
								var FieldCount=1; //to keep track of text box added
								
								  
								
								$(AddButton).click(function (e)  //on add input button click
								{
									var product_id=$("#product_id").val();
									var product_name=$("#product_name1").val(); 
									var product_price=$("#unit_price").val(); 
									var special_price=parseFloat($("#special_price").val()).toFixed(2);
									 
									
									var description=$("#pdescription").val();
									 
									
												if(x <= MaxInputs) //max input box allowed
												{
														FieldCount++; //text box added increment
														 
														$(InputsWrapper).append('<tr class="remove_tr"><td><input type="hidden" name="p_id[]" id="p_id" value="'+product_id+'" readOnly><input type="text" name="product_name[]" id="product_name" value="'+product_name+'" class="form-control" readOnly></td><td><textarea name=description[]" id="description" rows="2" class="form-control" readOnly>'+description+'</textarea></td><td><input type="text" name="product_price[]" id="product_price" value="'+product_price+'" class="form-control" readOnly></td><td><input type="text" name="special_price[]" id="special_price'+FieldCount+'" value="'+special_price+'" class="form-control"></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger removeclass" data-toggle="modal" data-target="#modal-basic"><i class="icons-office-52"></i></a></td></tr>');
														
														
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

	/*$(document).on('focus',".date-picker", function(){
		    $(this).datepicker();
		}); */

 
 	
 </script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Add Pricelist Version</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="pricelist_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_pricelist_versions" name="add_pricelist_versions" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="pricelist_version_name" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Start Date</label>
					                              <div class="append-icon">
					                                 
					                               <input type="text" name="start_date" id="start_date" value="" class="date-picker form-control">
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
					                    <div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Pricelists</label>
					                              <div class="append-icon">
					                                 
					                               <select name="pricelist_id" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $pricelists as $pricelist){ ?>
					                                <option value="<?php echo $pricelist->id;?>"><?php echo $pricelist->pricelist_name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
											<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">End Date</label>
					                              <div class="append-icon">
					                                 
					                               <input type="text" name="end_date" id="end_date" value="" class="date-picker form-control">
					                              </div>
					                            </div>
					                          </div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-sm-6">
					                    	</div>
					                    	<div class="col-sm-6">
					                    	<div class="col-sm-6">
				                                 <div class="form-group">
				                              <label class="control-label">Active</label>
				                              <div class="append-icon">
				                                <input type="checkbox" name="active" value="1" checked data-checkbox="icheckbox_square-blue"/> 
				                                 
				                              </div>
				                            </div>
				                              </div>
					                    	</div>
					                    </div>
					                    <div class="row">
					                    
					                    	 <div class="panel-content">
                   									<label class="control-label">Item List</label> 
                									 <table class="table">
									                    <thead>
									                      <tr style="font-size: 12px;">                         
									                        <th>Product</th>
									                        <th>Description</th> 
									                        <th>Unit Price</th> 
									                        <th>Special Price</th>
									                        <th></th>
									                      </tr>
									                    </thead>
									                    <tbody id="InputsWrapper">
									                      
									                       
									                    </tbody>
									                  </table>
									                  <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create_product">Add an item</a>
                 									 </div>
					                    	
					                    </div>   
					                     
					                        
                        				<div class="text-left  m-t-20">
                         				 <div id="pricelist_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
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
                        <label for="field-1" class="control-label">Special Price</label>
                         
                        <input type="text" name="special_price" id="special_price" value="" class="form-control">	 
                         
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

