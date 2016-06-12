<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_staff']").submit(function(e) {

        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/staff/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#staff_ajax").html(msg); 
			//$("#staff_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			 
            $("form[name='add_staff']").find("input[type=text], input[type=checkbox]").val("");
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });

	//POPULATE THE ACCESS AS PER THE SELECTED ROLE
	$('#roles').change(function(){
		var url = "<?php echo base_url() ?>"+'admin/staff/get_user_rights';
		var role_id = $(this).val();
		$.ajax({
			url: url, 
			method: 'post',
			dataType : 'json',
			data: {'role_id': role_id},
			success: function(result){
				$.each($("input[type='checkbox']"), function(k, v){
					$(this).parent('div').removeClass('checked');
				});

				$.each( result, function( key, value ) {
  					if($("input[name="+key+"").length && value == 1)
  					{
  						$("input[name="+key+"").parent('div').addClass('checked');
  						$("input[name="+key+"").attr('checked', 'checked');
  					}
				});
				
	    	}});
	
		});

});
 

 </script>

 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
        <div class="header">
            <h2>Add Staff</h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="staff_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
				                      
                  				    <form id="add_staff" name="add_staff" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				
                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">First Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="first_name" value="" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Last Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="last_name" value="" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
                        				<div class="row">				                         
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Phone Number</label>
				                              <div class="append-icon">
				                                <input type="text" name="phone_number" value="" class="form-control">
				                                <i class="icon-screen-smartphone"></i>
				                              </div>
				                            </div>
				                          </div>
				                           <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Email Address</label>
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
				                              <label class="control-label">Password</label>
				                              <div class="append-icon">
				                                <input type="password" name="pass1" id="password1" value="" class="form-control">
				                                <i class="icon-lock"></i>
				                              </div>
				                            </div>
				                          </div>
											<div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Repeat Password</label>
				                              <div class="append-icon">
				                                <input type="password" name="pass2" id="password2" value="" class="form-control">
				                                <i class="icon-lock"></i>
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
					                                  <input type="file" class="custom-file" name="user_avatar" id="user_avatar" onchange="document.getElementById('uploader').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
				                              </div>
				                            </div>
   </div>
				                    
 <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Roles</label>
				                             <div class="append-icon">
					                                <select name="roles" id="roles" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                              	<?php foreach ($roles as $key => $value) { ?>
														<option value="<?= $value['id'] ?>"><?= $value['role'] ?></option>					                              		
					                              	<?php } ?>
					                                </select>
					                                <!-- <option value="director">Director</option>
					                                <option value="general">General Manager</option>
					                                <option value="managerone">Senior Manager One</option>
					                                <option value="managertwo">Senior Manager Two</option>
					                                <option value="managerthree">Manager</option>
					                                <option value="amanager">Assistance Manager</option>
					                                <option value="support">Support Manager</option>
					                                <option value="stake">Stake Holder</option> -->
					                              </div>
				                              </div>
				                            </div>
				                          </div>

<div class="row">				                         
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Job Title</label>
				                              <div class="append-icon">
				                                <input type="text" name="job_title" value="" class="form-control">
				                              </div>
				                            </div>
				                          </div>
				                           <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Segment</label>
				                              <div class="append-icon">
				                                <select name="segment_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                              	<?php foreach ($segments as $key => $value) { ?>
					                              		<option value="<?php echo $value->id ?>"><?php echo $value->segment ?></option>
					                              	<?php } ?>	
				                                </select>
				                              </div>
				                            </div>
				                          </div>
				                        </div>
				                        <div class="row">				                         
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Region</label>
				                              <div class="append-icon">
				                                <select name="region_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                              	<?php foreach ($regions as $key => $value) { ?>
					                              		<option value="<?php echo $value->id ?>"><?php echo $value->region ?></option>
					                              	<?php } ?>	
				                                </select>
				                              </div>
				                            </div>
				                          </div>
				                           <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Supervisor</label>
				                              <div class="append-icon">
				                                <select name="supervisor_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                              	<?php foreach ($staffs as $key => $value) { ?>
					                              		<option value="<?php echo $value->id ?>"><?php echo $value->first_name .' '.$value->last_name; ?></option>
					                              	<?php } ?>	
				                                </select>
				                              </div>
				                            </div>
				                          </div>
				                        </div>
<!-- <div class="row">
     <div class="header">
            <h5>Targets Settings</h5>            
          </div>
     

                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Customer</label>
					                              <div class="append-icon">
					                                <input type="text" name="customer" value="" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">GSM</label>
					                              <div class="append-icon">
					                                <input type="text" name="gsm" value="" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>


<div class="row">
<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Devices</label>
					                              <div class="append-icon">
					                                <input type="text" name="devices" value="" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Solutions</label>
					                              <div class="append-icon">
					                                <input type="text" name="solutions" value="" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>

 -->										
										<div class="row">
					                    
					                    	 <div class="panel-content">
					                    	 	<h3><i class="icon-check"></i> <strong>Permissions</strong></h3> 
                   						   <div class="row">		
               				 				<div class="col-md-2">
               				 				<p><strong>Admin </strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="admin_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="admin_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="admin_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   						
                   							
               				 				<div class="col-md-2">
               				 				<p><strong>Customers</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="customers_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="customers_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="customers_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>
                    				          </div>		
                    				          <div class="col-md-2">
               				 					<p><strong>Staff</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="staff_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="staff_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="staff_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   							<div class="col-md-2">
               				 				<p><strong>Opportunities</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="opportunities_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="opportunities_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="opportunities_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>	
                   							</div>		 
                   							
                   						
                   							
                   							<div class="col-md-2">
               				 				<p><strong>Products</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="products_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="products_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="products_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>	
                   							</div>
											<div class="col-md-2">
               				 				<p><strong>Statistics</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="statistics" value="1" data-checkbox="icheckbox_square-blue">Statistics</label>
                               					 </div>
                    				          </div>	
                   							</div>

                   							</div>
                   							
                   							
	</div>

											</div>	
                   							


                   						<!-- <div class="row">
					                    
					                    	 <div class="panel-content">
                   									
                   								
                   						   <div class="row">		
               				 				<div class="col-md-2">
               				 				<p><strong>Sales Teams</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="sales_team_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="sales_team_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="sales_team_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   						
                   							
               				 				<div class="col-md-2">
               				 				<p><strong>Leads</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="lead_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="lead_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="lead_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   							
                   							

										<div class="col-md-2">
               				 					<p><strong>Pricelists</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="pricelists_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="pricelists_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="pricelists_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>		
                   							</div> 
                   								
	</div>

											</div>	
                   							</div> 
                   						</div> -->
                        				<div class="text-left  m-t-20">
                         				 <div id="staff_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                  </div>
                </div>
           	</div>
            
            
 		</div>   
  <!-- END PAGE CONTENT -->
 