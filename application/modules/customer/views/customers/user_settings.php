<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
	$("form[name='change_profile']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('customers/change_profile'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#profile_ajax").html(msg); 
			$("#profile_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$('#user_avatar,#uploader').val('');
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});


 function update_password()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('customers/change_password'); ?>",
        data: $("#change_password").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#ajax").html(msg); 
			$("#submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="update_password()">Save</button>');
			
			$("#change_password")[0].reset();
            
        }

    });

 }
 
 /*function update_profile()

 {
	   $.ajax({
		
        type: "POST",
        url: "<?php echo base_url('member/change_profile'); ?>",
        data: $("#change_profile").serialize(),
        mimeType: "multipart/form-data",
        beforeSend : function(msg){ $("#profile_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#profile_ajax").html(msg); 
			$("#profile_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="update_profile	()">Save</button>');
			
			$("change_profile")[0].reset();
            
        }

    });

 }*/

 </script>


  <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
        <div class="header">
            <h2><strong>Account Settings</strong></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                    <div class="panel-header">
                      <h3><strong>Update</strong> Profile</h3>
                    </div>
                    <div class="panel-content">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1_1" data-toggle="tab">Profile</a></li>
                        <li class=""><a href="#tab1_2" data-toggle="tab">Change Password</a></li>                      
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab1_1">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="profile_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
				                      
                  				    <form id="change_profile" name="change_profile" class="form-validation" novalidate="novalidate" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">First Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="first_name" value="<?php echo $user->first_name; ?>" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Last Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="last_name" value="<?php echo $user->last_name; ?>" class="form-control">
					                                <i class="icon-user"></i>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
                        				<div class="row">
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Email Address</label>
				                              <div class="append-icon">
				                                <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control">
				                                <i class="icon-envelope"></i>
				                              </div>
				                            </div>
				                          </div>
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Phone Number</label>
				                              <div class="append-icon">
				                                <input type="text" name="phone_number" value="<?php echo $user->phone_number; ?>" class="form-control">
				                                <i class="icon-screen-smartphone"></i>
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
					                                  <input type="file" class="custom-file" name="avatar" id="avatar" onchange="document.getElementById('uploader').value = this.value;" required>
					                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
				                              </div>
				                            </div>
				                          </div>
				                          </div>
                          
                        				<div class="text-left  m-t-20">
                         				 <div id="profile_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                   	
                   			 </div>
               			   </div>
                        </div>
                        <div class="tab-pane fade" id="tab1_2">
                          <div class="panel-body bg-white">
                  <div class="col-md-8" align="center">
                   	
                   	<div class="col-md-12 col-sm-12 col-xs-12">
                      <div id="ajax">                      	                       
                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
                           
                      </div>
                      <form id="change_password" class="form-validation" novalidate="novalidate">
                      
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"><?php echo $this->lang->line('current_password'); ?>
</label>
                              <div class="append-icon">
                                <input type="password" name="currentpass" id="currentpass" class="form-control">
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          </div> 
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"><?php echo $this->lang->line('new_password'); ?>
</label>
                              <div class="append-icon">
                                <input type="password" name="pass1" id="pass1" class="form-control">
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                          </div>
                          <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label"><?php echo $this->lang->line('retype_new_password'); ?></label>
                              <div class="append-icon">
                                <input type="password" name="pass2" id="pass2" class="form-control">
                                <i class="icon-lock"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                         
                        <div class="text-left  m-t-20">
                          <div id="submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="update_password()">Save</button></div>
                           
                        </div>
                      </form>
                    </div>
                   	
                   </div>
                </div>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
           
            	
 			</div>           
         
        </div>
  <!-- END PAGE CONTENT -->