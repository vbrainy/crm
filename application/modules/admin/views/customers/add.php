<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_customer']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/customers/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#customer_ajax").html(msg); 
			$("#customer_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("form[name='add_customer']").find("input[type=text], textarea").val("");
			
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});
 
//Contact Person
$(document).ready(function() {
	$("form[name='add_contact_person']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/contact_persons/add_process_ajax'); ?>",
            type: "POST",
            data: formData,
            dataType:'json', 
            async: false,
            success: function (data) {
			$('body,html').animate({ scrollTop: 0 }, 200);           
            
            //Add to dropdown
			$("#main_contact_person option:first").after($('<option>', {
			    value: data.co_person_id,
			    text: data.co_person_name,
			    selected: true
			}));
			
			if(data.co_person_id)
			 {
			 	$("#contact_person_ajax").html("Contact person create succesful");
			 } 
            
			$("#contact_person_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("form[name='add_contact_person']").find("input[type=text], textarea").val("");
			
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});


function getstatedetails(id)
{
                //alert('this id value :'+id);
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('admin/customers/ajax_state_list').'/';?>'+id,
                    data: id='cat_id',
                    success: function(data){
                        //alert(data);
                        $("#state_id").html(data);
						$('#loader').slideUp(200, function() {
							$(this).remove();
						});
                },
});
}

function getcitydetails(id)
{
                //alert('this id value :'+id);
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url('admin/customers/ajax_city_list').'/';?>'+id,
                    data: id='cat_id',
                    success: function(data){
                        //alert(data);
                        $("#city_id").html(data);
						$('#loader').slideUp(200, function() {
							$(this).remove();
						});
                },
});
}
 </script>

 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="row">
            <h2 class="col-md-6"><strong>Add Customer</strong></h2>
                    
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="customer_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_customer" name="add_customer" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Comapany Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="name" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
</div>
<div class="row">
					                           <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Main Contact Person</label>
					                              <div class="append-icon">
					                                <select name="main_contact_person" id="main_contact_person" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $contact_persons as $contact_person){ ?>
					                                <option value="<?php echo $contact_person->id;?>"><?php echo $contact_person->first_name.' '.$contact_person->last_name;?></option>
					                                <?php }?> 
					                                
					                                </select>
					                                  <div style="float:right; padding-top:10px;">
               
               <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-create_contact_person" onclick="">New Contact Person</a>
              
             </div>   
					                              </div>
					                            </div>
					                          </div>

<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Contact Person 2</label>
					                              <div class="append-icon">
					                                <select name="contact_person" id="contact_person" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $contact_persons as $contact_person){ ?>
					                                <option value="<?php echo $contact_person->id;?>"><?php echo $contact_person->first_name.' '.$contact_person->last_name;?></option>
					                                <?php }?> 
					                                
					                                </select>
					                                  <div style="float:right; padding-top:10px;">
               
               <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-create_contact_person" onclick="">New Contact Person</a>
              
             </div>   
					                              </div>
					                            </div>
					                          </div>
					                        </div>
                        				<div class="row">				                         
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Address</label>
				                              <div class="append-icon">
				                                 
				                                <textarea name="address" rows="4" class="form-control"></textarea> 
				                              </div>
				                            </div>
				                          </div>
                                          <div class="col-sm-6">
				                            <div class="form-group">
				                            <label class="control-label"></label>
				                              <div class="append-icon">
				                                 <div class="col-sm-12">
				                                 <select name="country_id" id="country_id" class="form-control" data-search="true" onChange="getstatedetails(this.value)">
					                                <option value="" selected="selected">Select Country</option>
					                                <?php foreach( $countries as $country){ ?>
					                                <option value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
					                                <?php }?> 
					                                </select>
				                                  </div>
				                                  </div>
				                                  <br/><br/>
				                                 <div class="col-sm-6">
				                                 <select name="state_id" id="state_id" class="form-control" data-search="true" onChange="getcitydetails(this.value)">
					                                <option value="" selected="selected">Select State</option>
					                                
					                                </select>
				                                  </div>
				                             	 <div class="col-sm-6">
				                                 <select name="city_id" id="city_id" class="form-control" data-search="true">
					                                <option value="" selected="selected">Select City</option>
					                                
					                                </select>
				                                  </div>
				                            </div>
				                          </div>
				                           
				                        </div>
				                        <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Phone</label>
					                              <div class="append-icon">
					                                <input type="text" name="phone" value="" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Mobile</label>
					                              <div class="append-icon">
					                                <input type="text" name="mobile" value="" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
					                    <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Fax</label>
					                              <div class="append-icon">
					                                <input type="text" name="fax" value="" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Email</label>
				                              <div class="append-icon">
				                                <input type="email" name="email" value="" class="form-control">
				                                <i class="icon-envelope"></i>
				                              </div>
				                            </div>
				                          </div>
					                    </div>
					                        
				                        <div class="row">
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Website</label>
				                              <div class="append-icon">
				                                <input type="text" name="website" value="" class="form-control">
				                                <i class="icon-globe"></i>
				                              </div>
				                            </div>
				                          </div>
                          					
					                          
					                             <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Region</label>
					                              <div class="append-icon">
					                          
					                                
					                                <select name="regions" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $regions as $region){ ?>
					                                <option value="<?php echo $region->id;?>"><?php echo $region->region;?></option>
					                                <?php }?> 
					                                </select>
					                                  
					                              </div>
					                            </div>
					                          </div>
</div>
                                
                                
                                <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Annual turnover</label>
					                              <div class="append-icon">
					                                <input type="text" name="annual_turnover" value="" class="form-control">
					                               
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Number of employees</label>
					                              <div class="append-icon">
					                                <input type="text" name="number_employees" value="" class="form-control">
					                           
					                              </div>
					                            </div>
					                          </div>
					                        </div>
                                <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Number of domestic branches</label>
					                              <div class="append-icon">
					                                <input type="text" name="domestic_branches" value="" class="form-control">
					                             
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Number of int’l branches</label>
					                              <div class="append-icon">
					                                <input type="text" name="int_branches" value="" class="form-control">
					                              
					                              </div>
					                            </div>
					                          </div>
					                        </div>
                                            <div class="row">
<div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">Vertical</label>
                                        <div class="append-icon">
                                           
                                           <select name="vertical" class="form-control" data-search="true">
                                          <option value=""></option>
                                          <?php foreach( $verticals as $vertical){ ?>
                                          <option value="<?php echo $vertical->id;?>"><?php echo $vertical->vertical_name;?></option>
                                          <?php }?> 
                                          </select>
                                           
                                        </div>
                                      </div>
                                    </div>
<div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">SubVertical</label>
                                        <div class="append-icon">
                                           
                                           <select name="subverticals" class="form-control" data-search="true">
                                          <option value=""></option>
                                          <?php foreach( $subverticals as $subvertical){ ?>
                                          <option value="<?php echo $subvertical->id;?>"><?php echo $subvertical->subvertical_name;?></option>
                                          <?php }?> 
                                          </select>
                                           
                                        </div>
                                      </div>
                                    </div>
                                                </div>
				                        <div class="row">
				                        	<div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Upload Your Avatar</label>
				                              <div class="append-icon">
				                                <div class="file">
					                                <div class="option-group">
					                                  <span class="file-button btn-primary">Choose File</span>
					                                  <input type="file" class="custom-file" name="company_avatar" id="company_avatar" onchange="document.getElementById('uploader').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
				                              </div>
				                            </div>
				                          </div>
											
											<div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Upload Attachment</label>
				                              <div class="append-icon">
				                                <div class="file">
					                                <div class="option-group">
					                                  <span class="file-button btn-primary">Choose File</span>
					                                  <input type="file" class="custom-file" name="company_attachment" id="company_attachment" onchange="document.getElementById('uploader_attach').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader_attach" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
				                              </div>
				                            </div>
				                          </div>
				                        </div>
				                         
                        				<div class="text-left  m-t-20">
                         				 <div id="customer_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>  



 <!-- END PAGE CONTENT -->
 
<!-- START MODAL CONTENT -->
 <div class="modal fade" id="modal-create_contact_person" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Add</strong> Contact Person</h4>
                </div>
               <div id="contact_person_ajax" style="color:red;margin-left:15px;"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				 <form id="add_contact_person" name="add_contact_person" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	 <input type="hidden" name="company" value="<?php echo $customer->id; ?>"/>
               	      	
               	 <div class="modal-body">
                   
                  <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">First Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="first_name" value="" class="form-control" required>
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Last Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="last_name" value="" class="form-control" required>
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
                        		
				                        <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Job Position</label>
					                              <div class="append-icon">
					                                <input type="text" name="job_position" value="" class="form-control">
					                                
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Phone</label>
					                              <div class="append-icon">
					                                <input type="text" name="phone" value="" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
					                    <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Mobile</label>
					                              <div class="append-icon">
					                                <input type="text" name="mobile" value="" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Fax</label>
					                              <div class="append-icon">
					                                <input type="text" name="fax" value="" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
					                    </div>
					                    <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Title</label>
					                              <div class="append-icon">
					                                <input type="text" name="title" value="" class="form-control">
					                                
					                              </div>
					                            </div>
					                          </div>
					                         	<div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Email</label>
				                              <div class="append-icon">
				                                <input type="email" name="email" value="" class="form-control" required>
				                                <i class="icon-envelope"></i>
				                              </div>
				                            </div>
				                          </div>
					                        </div>    
				                      
				                        <div class="row">
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Upload your avatar</label>
				                              <div class="append-icon">
				                                <div class="file">
					                                <div class="option-group">
					                                  <span class="file-button btn-primary">Choose File</span>
					                                  <input type="file" class="custom-file" name="customer_avatar" id="customer_avatar" onchange="document.getElementById('uploader').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
				                              </div>
				                            </div>
				                          </div>
				                          	
                          				</div>
                </div>
                 
                  <div id="contact_person_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Create</button></div>
                 
                </form>
              </div>
            </div>
          </div>
