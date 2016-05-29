<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script language="javascript" type="text/javascript"> 
$(document).ready(function(){

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
    {display: "APN Over Leased Lines", value: "leased-line" }];
    
var device = [
    {display: "Samsung", value: "samsung" }, 
    {display: "Iphone", value: "iphone" }, 
    {display: "Blackberry", value: "blackberry" },
    {display: "Infinix", value: "infinix" },
    {display: "Sony", value: "sony" },
    {display: "Hauwei", value: "hauwei" },
    {display: "Asus", value: "asus" }];
    
var services = [
    {display: "Conference Calls", value: "conf-call" }, 
    {display: "Toll Free", value: "toll-free" }, 
    {display: "Corporate CRBT", value: "corporate-cbrt" },
    {display: "Mobile Advertising", value: "mobile-advertising" },
    {display: "Mobile switchboard", value: "mobile-switchboard" },
    {display: "Smart Number", value: "smart-number" },
    {display: "Smart track", value: "smart-track" },
    {display: "Smart Surveillance", value: "smart-surveillance" },
    {display: "Others", value: "others" }];
 

//If parent option is changed
$("#product_id").change(function() {
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


//function to populate child select box
function list(array_list)
{
    $("#child_selection").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options 
        $("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
    });
}

});

//Stages Select
$(function() { 

	$("#child_selection").change(function(){
$('.prod_options').hide();
	$("#"+$(this).val()).show();
	});
	

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
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
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
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
	</div>
</div>
</div>

<div id="mnp-pre-paid" class="prod_options">
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
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
	</div>
</div>
</div>

<div id="mnp-post-paid" class="prod_options">
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
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Data</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Bundle (Voice + Data)</div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
			<div class="col-md-3"><input type="text" class="form-control"/></div>
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
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Value per location</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">End Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">End Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>
</div>

<div id="national_leased" class="prod_options">
<h3>National Leased Lines/MPLS</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity required</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>
</div>


<div id="international_leased" class="prod_options">
<h3>International Leased Lines/MPLS </h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity required</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
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
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Installation location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of DOD units</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of DID units</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>
</div>


<div id="apn-over-internet" class="prod_options">
<h3>APN over internet</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of units</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>
</div>


<div id="apn-over-leased-lines" class="prod_options">
<h3>APN over leased lines </h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Number of locations</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">A-point Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (City)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">B-point Location (State)</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Capacity required</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total installation cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>
</div>


<div id="devices" class="prod_options">
<h3>Devices</h3>
<div class="row">
	<div class="col-md-12">
		<div class="row margin-top-5">
			<div class="col-md-3">Device Type</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Number of units</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Total value</div>
			<div class="col-md-3"></div>
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
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">One-time cost</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row margin-top-5">
			<div class="col-md-3">Annual recurring fee</div>
			<div class="col-md-3"></div>
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
 