<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_user']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('member/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#profile_ajax").html(msg); 
			$("#profile_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("#update_user")[0].reset();
            
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
            <h2><?php echo $this->lang->line('update_user'); ?></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="profile_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
				                      
                  				    <form id="update_user" name="update_user" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				
                        				<input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
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
				                                <input type="checkbox" name="banned" <?php if( $user->status == 0 ){ echo 'checked="checked"';} ?> value="1" data-checkbox="icheckbox_square-blue"/> <?php echo $this->lang->line('yes'); ?>
				                                 
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
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
