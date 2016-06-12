<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='setting_targets']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/settings/setting_targets_add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#category_ajax").html(msg); 
			$("#category_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			//$("form[name='setting_targets']").find("input[type=text]").val("");
			
            
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
        <div class="page-content">
        <div class="header">
            <h2><strong>Setting Targets</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="category_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="setting_targets" name="setting_targets" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                              <input type="hidden" name="last_updated_user_id" value="<?= userdata('id') ?>" />
                        				                         				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Customer Acquisition</label>
					                              <div class="append-icon">
					                                <input type="text" name="customer_acquisition" value="<?= isset($settings->customer_acquisition) ? $settings->customer_acquisition : '' ?>" class="form-control" >
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
					                    <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">GSM</label>
                                        <div class="append-icon">
                                          <input type="text" name="gsm" value="<?= isset($settings->gsm) ? $settings->gsm : '' ?>" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>
                        				  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">Solutions</label>
                                        <div class="append-icon">
                                          <input type="text" name="solutions" value="<?= isset($settings->solutions) ? $settings->solutions : '' ?>" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">Devices</label>
                                        <div class="append-icon">
                                          <input type="text" name="devices" value="<?= isset($settings->devices) ? $settings->devices : '' ?>" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">Services</label>
                                        <div class="append-icon">
                                          <input type="text" name="services" value="<?= isset($settings->services) ? $settings->services : '' ?>" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>
					                     
					                    
                        				<div class="text-left  m-t-20">
                         				 <div id="category_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
