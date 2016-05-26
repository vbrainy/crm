<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_user']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/staff/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#profile_ajax").html(msg); 
			$("#profile_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$('#password1,#password2,#user_avatar,#uploader').val('');
			
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});
 

 </script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
        <div class="header">
            <h2>Update Staff</h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="profile_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
				                      
                  				    <form id="update_user" name="update_user" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				
                        				<input type="hidden" name="user_id" value="<?php echo $staff->id; ?>" />
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">First Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="first_name" value="<?php echo $staff->first_name; ?>" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Last Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="last_name" value="<?php echo $staff->last_name; ?>" class="form-control">
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
				                                <input type="text" name="phone_number" value="<?php echo $staff->phone_number; ?>" class="form-control">
				                                <i class="icon-screen-smartphone"></i>
				                              </div>
				                            </div>
				                          </div>
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Email Address</label>
				                              <div class="append-icon">
				                                <input type="email" name="email" value="<?php echo $staff->email; ?>" class="form-control">
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
				                              <label class="control-label"><?php echo $this->lang->line('banned'); ?></label>
				                              <div class="append-icon">
				                                <input type="checkbox" name="banned" <?php if( $staff->status == 0 ){ echo 'checked="checked"';} ?> value="1" data-checkbox="icheckbox_square-blue"/> <?php echo $this->lang->line('yes'); ?>
				                                 
				                              </div>
				                            </div>
				                          </div>
                          				</div>

										<div class="row">
					                    
					                    	 <div class="panel-content">
                   									
                   								<h3><i class="icon-check"></i> <strong>Permissions</strong></h3> 
                   							<div class="row">	
                   							<div class="col-md-2">
               				 				<p><strong>Sales Teams</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="sales_team_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_team_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="sales_team_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_team_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="sales_team_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_team_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   							<div class="col-md-2">
               				 				<p><strong>Region</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="region_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_team_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="region_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_team_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="region_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_team_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   								
               				 				<div class="col-md-2">
               				 				<p><strong>Leads</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="lead_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'lead_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="lead_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'lead_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="lead_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'lead_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   							
                   							<div class="col-md-2">
               				 				<p><strong>Opportunities</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="opportunities_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'opportunities_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="opportunities_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'opportunities_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="opportunities_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'opportunities_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>	
                   							</div>
                   							
                   							<div class="col-md-2">
               				 				<p><strong>Logged Calls</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="logged_calls_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'logged_calls_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="logged_calls_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'logged_calls_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="logged_calls_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'logged_calls_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>	
                   							</div>
                   							
                   							<div class="col-md-2">
               				 				<p><strong>Meetings</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="meetings_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'meetings_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="meetings_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'meetings_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="meetings_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'meetings_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>	
                   							</div>
                   							
                   							<div class="col-md-2">
               				 				<p><strong>Products</strong></p>	
               				               	 	<div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="products_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'products_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="products_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'products_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="products_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'products_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>	
                   							</div>
                   							
                   							</div>
                   							<div class="row">&nbsp;</div>
                   							
                   							<div class="row">		
               				 					
               				 					<div class="col-md-2">
               				 					<p><strong>Quotations</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="quotations_read" value="1" data-checkbox="icheckbox_square-blue">Read</label>
					                                  <label>
					                                  <input type="checkbox" name="quotations_write" value="1" data-checkbox="icheckbox_square-blue">Write</label>
					                                  <label>
					                                  <input type="checkbox" name="quotations_delete" value="1" data-checkbox="icheckbox_square-blue">Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>

												<div class="col-md-2">
               				 					<p><strong>Sales Orders</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="sales_orders_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_orders_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="sales_orders_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_orders_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="sales_orders_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'sales_orders_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
						
												<div class="col-md-2">
               				 					<p><strong>Invoices</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="invoices_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'invoices_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="invoices_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'invoices_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="invoices_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'invoices_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   							
                   							<div class="col-md-2">
               				 					<p><strong>Pricelists</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="pricelists_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'pricelists_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="pricelists_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'pricelists_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="pricelists_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'pricelists_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
                   							
                   							<div class="col-md-2">
               				 					<p><strong>Contracts</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="contracts_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'contracts_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="contracts_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'contracts_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="contracts_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'contracts_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>

											
											
											<div class="col-md-2">
               				 					<p><strong>Staff</strong></p>	
               				               	 <div class="input-group">
                               					 <div class="icheck-list">
					                                  <label>
					                                  <input type="checkbox" name="staff_read" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'staff_read')) echo 'checked';?>>Read</label>
					                                  <label>
					                                  <input type="checkbox" name="staff_write" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'staff_write')) echo 'checked';?>>Write</label>
					                                  <label>
					                                  <input type="checkbox" name="staff_delete" value="1" data-checkbox="icheckbox_square-blue" <?php if(get_permission_value($staff->id,'staff_delete')) echo 'checked';?>>Delete</label>
                               					 </div>
                    				          </div>		
                   							</div>
											
											</div>
                   									 
                   							</div>
                   						</div>			
                        				<div class="text-left  m-t-20">
                         				 <div id="profile_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                  </div>
                </div>
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 