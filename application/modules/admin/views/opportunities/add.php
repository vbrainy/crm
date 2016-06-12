<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script language="javascript" type="text/javascript"> 
$(document).ready(function() {
	$("form[name='add_opportunities']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/opportunities/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#opportunities_ajax").html(msg); 
			$("#opportunities_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("form[name='add_opportunities']").find("input[type=text]").val("");
			
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});


//let's create arrays
var gsm = [
    {display: "New activations Pre-Paid", value:"activations-pre-paid" }, 
    {display: "New activations Post-Paid", value: "activations-post-paid" }, 
    {display: "MNP Pre-Paid", value: "nmp-pre-paid" },
    {display: "MNP Post-Paid", value: "nmp-post-paid" }];  
    
var solutions = [
    {display: "Dedicated Internet", value: "dedicated-internet" }, 
    {display: "National Leased Lines", value: "national-leased-lines" }, 
    {display: "International Leased Lines", value: "inter-leased-lines" },
    {display: "PRI", value: "pri" },
    {display: "APN Over Internet", value: "over-internet" },
    {display: "APN Over Leased Lines", value: "leased-lines" }];
    
var devices= [
    {display: "Devices", value: "devices" }, 
    {display: "Iphone", value: "iphone" }, 
    {display: "Blackberry", value: "blackberry" },
    {display: "Infinix", value: "infinix" },
    {display: "Sony", value: "sony" },
    {display: "Hauwei", value: "hauwei" },
    {display: "Asus", value: "asus" }];
    
var valueaddedservices = [
    {display: "Conference Calls", value: "conf-call" }, 
    {display: "Toll Free", value: "toll-free" }, 
    {display: "Corporate CRBT", value: "corporate-cbrt" },
    {display: "Mobile Advertising", value: "mobile-advertising" },
    {display: "Mobile switchboard", value: "mobile-switchboard" },
    {display: "Smart Number", value: "smart-number" },
    {display: "Smart track", value: "smart-track" },
    {display: "Smart Surveillance", value: "smart-surveillance" },
    {display: "Others", value: "others" }];
 
$(document).ready(function(){
//If parent option is changed
$("#product_id").change(function() {
		$('.prod_options').hide();
		$('#category_id').html('');
        var parent = $(this).val(); //get option value from parent 
        getProductCategories(parent);

        /*switch(parent){ //using switch compare selected option and populate child
               case 'gsm':
                list(gsm);
                break;
              case 'solutions':
                list(solutions);
                break;              
              case 'device':
                list(device);
                break;  
              case 'services':
                list(services);
                break; 
            default: //default child option is blank
                $("#child_selection").html('');  
                break;
           }*/
});

function getProductCategories(product_id){
	var url = "<?php echo base_url() ?>"+'admin/category/get_prod_cat';

	$.ajax({
		url: url, 
		method: 'post',
		data: {'product_id': product_id},
		success: function(result){
			$('#category_id').html(result);
    }});
}



});

//Stages Select
$(function() { 
	$('.prod_options').hide();
	$("#category_id").change(function(){
		//console.log("change");
		$('.prod_options').hide();
		var tempStr = $("option:selected", this).text();
		var product = $("option:selected", $('#product_id')).text().toLowerCase();
		//console.log(product);
		product = product.replace(/\s+/g, '');
		//console.log(tempStr);
		$('#product').val(product);
		$('#category').val(tempStr);
		var productField;
		switch(product){ //using switch compare selected option and populate child
               case 'gsm':
                productField = list(gsm, tempStr);
                //console.log(productField);
                break;
              case 'solutions':
                productField = list(solutions, tempStr);
                //console.log(productField);
                break;              
              case 'devices':
                //productField = list(device, tempStr);
                //productField = product;
                $("#"+product).show();
                //console.log(productField);
                break;  
              case 'valueaddedservices':
              	//console.log("sss")
                //productField=list(services, tempStr);
                //productField = product;
                //console.log(productField);
                $("#value-added-services").show();
                break; 
            default: //default child option is blank
                $("#child_selection").html('');  
                break;
        }
		//console.log(productField);
		
	});
	

//function to populate child select box
function list(array_list, dis)
{
    /*$("#child_selection").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options 
        $("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
    });*/
	$(array_list).each(function (i, val) { 
		// console.log(val.display);
		// console.log(dis);
        if(val.display == dis)
        {
        	var returnValue = val.value;
        	//return returnValue;
        	$("#"+returnValue).show();
        }
    });
}

    $('#stages').change(function() {
         
         var stage=$(this).val();
          
         if(stage=='Suspect 0%' || stage=='LOST')
         {
		 	 $('#probability').val(0);		 	
		 }
		 if(stage=='Prospect 10%') 
		 {
		 	$('#probability').val(10);	
		 	
		 }
		 if(stage=='Analysis 30%') 
		 {
		 	$('#probability').val(30);	
		 	
		 }
		 if(stage=='Negotiation 50%') 
		 {
		 	$('#probability').val(50);	
		 	
		 }
		 if(stage=='Closing 80%') 
		 {
		 	$('#probability').val(80);
		 		
		 	
		 }
		 if(stage=='Order 100%') 
		 {
		 	$('#probability').val(100);
		 
		 }
		 if(stage=='create_new') 
		 {
		 	$('#modal-create_calls').modal('show');
		 	
		 }         
        
    }).change(); // Trigger the event
    
 });   
    


 </script>
 
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Create Opportunities</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="opportunities_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_opportunities" name="add_opportunities" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 							<input type="hidden" name="product" id="product"/>
 							<input type="hidden" name="category" id="category"/>
                			        				                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Opportunity</label>
					                              <div class="append-icon">
					                                <input type="text" name="opportunity" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
                                             
											  <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Next Action</label>
					                              <div class="append-icon">
					                                <input type="text" name="next_action_title" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
										</div>
                                 <div class="row">
					                    	 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Identified Date</label>
					                              <div class="append-icon">
					                                <input type="text" name="identified_date" value="" class="date-picker form-control">
                                                      <i class="icon-calendar"></i> 
					                              </div>
					                            </div>
					                          </div>
					                           <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Next Action Date</label>
					                              <div class="append-icon">
					                                <input type="text" name="next_action" value="" class="date-picker form-control">
					                                <i class="icon-calendar"></i>
					                              </div>
					                            </div>
					                          </div>
					                    </div>
                                 <div class="row">
					                    	
					                           <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Expected Closing</label>
					                              <div class="append-icon">
					                                <input type="text" name="expected_closing" value="" class="date-picker form-control">
					                             <i class="icon-calendar"></i>    
					                              </div>
					                            </div>
					                          </div>
                                     <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Salesperson</label>
					                              <div class="append-icon">
					                                <select name="salesperson_id" id="salesperson_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>"><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					                                </select>
					                                
					                              </div>
					                            </div>
					                          </div>
					                    </div>
										<div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Stages</label>
					                              <div class="append-icon">
					                                 
					                                <?php $options = array(
									                  'Suspect 0%'  => 'Suspect 0%',
									                  'Prospect 10%'    => 'Prospect 10%',
									                  'Analysis 20%'   => 'Analysis 20%',
									                  'Negotiation 50%' => 'Negotiation 50%',
									                  'Closing 80%' => 'Closing 80%',
									                  'Order 100%' => 'Order 100%',
									                  'LOST' => 'LOST',
									                ); 
													echo form_dropdown('stages', $options,'New','class="form-control" id="stages"');?>
					                              </div>
					                            </div>
					                          </div>  
                                            <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Internal Notes</label>
				                              <div class="append-icon">
				                                 
				                                <textarea name="internal_notes" rows="4" class="form-control"></textarea> 
				                              </div>
				                            </div>
				                          </div>   

					                    </div>
					                     
					                    <div class="row">
                          					 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Customer</label>
					                              <div class="append-icon">
					                                 
					                                <select name="customer" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $companies as $company){ ?>
					                                <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
                          					 
					                    </div>
					                    
                                 		<div class="header">
            								<h2><strong>SELECT PRODUCT</strong></h2>            
      									</div> 
					                   
                                 
					                    <div class="row">
                          				<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Product</label>
<div class="append-icon">
										<select name="product_id" id="product_id" class="form-control" data-search="true">
                                          <option value="" selected="selected"></option>
                                          <?php foreach($products as $key=>$value) { ?>

                                          <option value="<?php echo $value->id ?>"><?php echo $value->product_name ?></option>
                                          <?php } ?>
                                          </select>

                                       
                                            <!--select name="parent_selection" id="parent_selection" class="form-control" data-search="true">
                                                    <option value="">-- Please Select --</option>
                                                    <option value="gsm">GSM</option>
                                                    <option value="solutions">Solutions</option>
                                                    <option value="device">Device</option>
                                                    <option value="services">Value Added Services</option>
                                                </select-->
             </div>
                                                </div>	
                                            </div>	
					                   

<div class="col-sm-6">
<div class="form-group">
<label class="control-label">Product categories</label>
<div class="append-icon">

                                                 <select name="category_id" id="category_id" class="form-control" data-search="true">

                                                    </select>
					                          </div>
                                                </div>	
                                            </div>	
                                            </div>
                                 <div class="row">
					                    	 <div class="col-sm-12">                                            
<div id="activations-pre-paid" class="prod_options">
<h3>New Activations Pre Paid</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3"></div>
			<div class="col-md-3">Qauntity (Number of Lines)</div>
			<div class="col-md-3">One time fee (e.g. SIM cost)</div>
			<div class="col-md-3">Annual recurring fee</div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Voice</div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_voice_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_voice_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_voice_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_data_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_data_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_data_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_bundle_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_bundle_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_pre_paid_bundle_annual_rec_fee"/></div>
		</div>
	</div>
</div>

</div>

<div id="activations-post-paid" class="prod_options">
<h3>New Activations Post Paid</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3"></div>
			<div class="col-md-3">Qauntity (Number of Lines)</div>
			<div class="col-md-3">One time fee (e.g. SIM cost)</div>
			<div class="col-md-3">Annual recurring fee</div>
		</div>
				<div class="row margin-top-5">
			<div class="col-md-3">Voice</div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_voice_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_voice_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_voice_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_data_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_data_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_data_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_bundle_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_bundle_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="new_act_post_paid_bundle_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>

<div id="nmp-pre-paid" class="prod_options">
<h3>MNP Pre Paid</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3"></div>
			<div class="col-md-3">Qauntity (Number of Lines)</div>
			<div class="col-md-3">One time fee (e.g. SIM cost)</div>
			<div class="col-md-3">Annual recurring fee</div>
		</div>
				<div class="row margin-top-5">
			<div class="col-md-3">Voice</div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_voice_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_voice_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_voice_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_data_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_data_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_data_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_bundle_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_bundle_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_pre_paid_bundle_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>

<div id="nmp-post-paid" class="prod_options">
<h3>MNP Post Paid</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3"></div>
			<div class="col-md-3">Qauntity (Number of Lines)</div>
			<div class="col-md-3">One time fee (e.g. SIM cost)</div>
			<div class="col-md-3">Annual recurring fee</div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Voice</div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_voice_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_voice_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_voice_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_data_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_data_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_data_annual_rec_fee"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_bundle_qty"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_bundle_one_time_fee"/></div>
			<div class="col-md-3"><input type="text" class="form-control" name="mnp_post_paid_bundle_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>

<div id="dedicated-internet" class="prod_options">
<h3>Dedicated Internet</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity per location</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_capacity_per_location"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_number_of_location"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Value per location</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_value_per_location"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">End Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_end_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">End Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_end_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_total_installation_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dedi_int_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>

<div id="national-leased-lines" class="prod_options">
<h3>National Leased Lines/MPLS</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_number_of_locations"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_a_point_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_a_point_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_b_point_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_b_point_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity required</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_capacity_required"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_total_installation_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="national_leased_lines_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>


<div id="inter-leased-lines" class="prod_options">
<h3>International Leased Lines/MPLS </h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_number_of_locations"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_a_point_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_a_point_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_b_point_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_b_point_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity required</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_capacity_required"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_total_installation_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="inter_leased_lines_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>


<div id="pri" class="prod_options">
<h3>PRI</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Installation location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="pri_installation_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Installation location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="pri_installation_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of DOD units</div>
			<div class="col-md-3"><input type="text" class="form-control" name="pri_number_of_dod_units"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of DID units</div>
			<div class="col-md-3"><input type="text" class="form-control" name="pri_number_of_did_units"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="pri_total_installation_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="pri_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>


<div id="over-internet" class="prod_options">
<h3>APN over internet</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of units</div>
			<div class="col-md-3"><input type="text" class="form-control" name="over_internet_number_of_units"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="over_internet_total_installation_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="over_internet_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>


<div id="leased-lines" class="prod_options">
<h3>APN over leased lines </h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_number_of_locations"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_a_point_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_a_point_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (City)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_b_point_location_city"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (State)</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_b_point_location_state"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity required</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_capacity_required"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_total_installation_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="leased_lines_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>


<?php 
$devices = ['Samsung', 'iPhone', 'Techno'];
?>
<div id="devices" class="prod_options">
<h3>Devices</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Device Type</div>
			<div class="col-md-3">
				<select name="dev_device_type">
					<?php foreach ($devices as $key => $value) { ?>
						<option value="<?= $value ?>"><?= $value ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of units</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dev_number_of_units"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total value</div>
			<div class="col-md-3"><input type="text" class="form-control" name="dev_total_value"/></div>
		</div>
	</div>
</div>
</div>


<div id="value-added-services" class="prod_options">
<h3>Value Added Services</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Quantity</div>
			<div class="col-md-3"><input type="text" class="form-control" name="ser_services_qty"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">One-time cost</div>
			<div class="col-md-3"><input type="text" class="form-control" name="ser_services_one_time_cost"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"><input type="text" class="form-control" name="ser_annual_rec_fee"/></div>
		</div>
	</div>
</div>
</div>

</div>
</div>
					                      
					                            	  
					                       
				                        
				                        
                        				<div class="text-left  m-t-20">
                         				 <div id="opportunities_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 

            	
 		</div>   
  <!-- END PAGE CONTENT -->
 