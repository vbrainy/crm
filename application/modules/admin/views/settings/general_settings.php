<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
$(document).ready(function() {


	$("form[name='general_settings']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/settings/general_settings'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#general_ajax").html(msg); 
			$("#general_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			 //$("#site_logo").val("");
			 $("#general_settings")[0].reset();
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});


 /*
 Upload Settings
 */
 function upload_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/settings/upload_settings'); ?>",
        data: $("#upload_settings").serialize(),
        beforeSend : function(msg){ $("#upload_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#upload_ajax").html(msg); 
			$("#upload_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="upload_settings()">Save</button>');
			
			$("upload_settings")[0].reset();
            
        }

    });

 }
  
/**
* 
* Sales Tax
* 
*/
function sales_tax_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/settings/sales_tax_settings'); ?>",
        data: $("#sales_tax_settings").serialize(),
        beforeSend : function(msg){ $("#sales_tax_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#sales_tax_ajax").html(msg); 
			$("#sales_tax_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="sales_tax_settings()">Save</button>');
			
			$("sales_tax_settings")[0].reset();
            
        }

    });

 }

/**
* 
* Invoice Prefix
* 
*/
function invoice_prefix_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/settings/invoice_prefix_settings'); ?>",
        data: $("#invoice_prefix_settings").serialize(),
        beforeSend : function(msg){ $("#invoice_prefix_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#invoice_prefix_ajax").html(msg); 
			$("#invoice_prefix_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="invoice_prefix_settings()">Save</button>');
			
			$("sales_tax_settings")[0].reset();
            
        }

    });

 }

/**
* 
* Pyment Terms
* 
*/
function payment_term_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/settings/payment_term_settings'); ?>",
        data: $("#payment_term_settings").serialize(),
        beforeSend : function(msg){ $("#payment_term_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#payment_term_ajax").html(msg); 
			$("#payment_term_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="payment_term_settings()">Save</button>');
			
			//$("sales_tax_settings")[0].reset();
            
        }

    });

 }

$(document).ready(function() {
	$("form[name='login_settings']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/settings/login_settings'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#login_ajax").html(msg); 
			$("#login_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			 //$("#site_logo").val("");
			 $("#login_settings")[0].reset();
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});

/**
* 
* Email Settings
* 
*/
function smtp_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/settings/smtp_settings'); ?>",
        data: $("#smtp_settings").serialize(),
        beforeSend : function(msg){ $("#smtp_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#smtp_ajax").html(msg); 
			$("#smtp_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="smtp_settings()">Save</button>');
			
			//$("sales_tax_settings")[0].reset();
            
        }

    });

 }
 
 
 /**
* 
* Email Settings
* 
*/
function reminder_settings()
 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/settings/reminder_settings'); ?>",
        data: $("#reminder_settings").serialize(),
        beforeSend : function(msg){ $("#reminder_submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#reminder_ajax").html(msg); 
			$("#reminder_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary" onclick="reminder_settings()">Save</button>');
			
			//$("sales_tax_settings")[0].reset();
            
        }

    });

 }
 </script>


  <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
        <div class="header">
            <h2><strong>Settings</strong></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">                    
                    <div class="panel-content">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1_1" data-toggle="tab">General Settings</a></li>
                        <li class=""><a href="#tab1_2" data-toggle="tab">Upload Settings</a></li>
                        <li class=""><a href="#tab1_3" data-toggle="tab">Sales Tax</a></li>
                        <li class=""><a href="#tab1_4" data-toggle="tab">Invoice</a></li>
                        <li class=""><a href="#tab1_5" data-toggle="tab">Payment Terms</a></li>
                        <li class=""><a href="#tab1_6" data-toggle="tab">Login</a></li>            
                        <li class=""><a href="#tab1_7" data-toggle="tab">Email</a></li>        
                        <li class=""><a href="#tab1_8" data-toggle="tab">Reminder</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab1_1">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="general_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form name="general_settings" id="general_settings" class="form-validation" novalidate="novalidate" enctype="multipart/form-data" method="post">
                        				<div class="row">
                          					<div class="col-sm-6">
                          					<div class="form-group">
					                              <label class="control-label"><img src="<?php echo base_url('uploads/site').'/'.config('site_logo'); ?>" alt="company image" class="img-l"></label>
					                        </div>
					                            <div class="form-group">
					                              <label class="control-label">Site Logo</label> 
					                              <div class="append-icon">
					                                <div class="file">
					                                <div class="option-group">
					                                  <span class="file-button btn-primary">Choose File</span>
					                                  <input type="file" class="custom-file" name="site_logo" id="site_logo" onchange="document.getElementById('uploader1').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader1" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Site Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="site_name" value="<?php echo config('site_name'); ?>" class="form-control">
					                                <i class="icon-edit"></i>
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				<div class="row">
				                          <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Site Email</label>
				                              <div class="append-icon">
				                                <input type="email" name="site_email" value="<?php echo config('site_email'); ?>" class="form-control">
				                                <i class="icon-envelope"></i>
				                              </div>
				                            </div>
				                          </div>				                        
				                        </div>
                          
                        				<div class="text-left  m-t-20">
                         				 <div id="general_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                           
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
                      <div id="upload_ajax">                      	                       
                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
                           
                      </div>
                      <form id="upload_settings" class="form-validation" novalidate="novalidate">
                      	
                      		<div class="row">
                          	 
                          	 <div class="col-sm-6">
	                            <div class="form-group">
	                              <label class="control-label"><?php echo lang('allowed_files'); ?></label>
	                              <div class="append-icon">
	                                <input type="text" name="allowed_extensions" value="<?php echo config('allowed_extensions'); ?>" class="form-control">
	                                
	                              </div>
	                            </div>
	                          </div>
	                                     
					        </div>
					        <div class="row">
					       	 <div class="col-sm-6">
		                        <div class="form-group">
		                          <label class="control-label"><?php echo $this->lang->line('max_upload_files'); ?></label>
		                          <div class="append-icon">
		                          																									<select class="form-control" data-style="white" name="max_upload_files">
                            <option value="1" <?php if( config('max_upload_files') == 1 ){ echo 'selected="selected"'; } ?>>1</option>
											<option value="2" <?php if( config('max_upload_files') == 2 ){ echo 'selected="selected"'; } ?>>2</option>
											<option value="3" <?php if( config('max_upload_files') == 3 ){ echo 'selected="selected"'; } ?>>3</option>
											<option value="4" <?php if( config('max_upload_files') == 4 ){ echo 'selected="selected"'; } ?>>4</option>
											<option value="5" <?php if( config('max_upload_files') == 5 ){ echo 'selected="selected"'; } ?>>5</option>
											<option value="6" <?php if( config('max_upload_files') == 6 ){ echo 'selected="selected"'; } ?>>6</option>
											<option value="7" <?php if( config('max_upload_files') == 7 ){ echo 'selected="selected"'; } ?>>7</option>
											<option value="8" <?php if( config('max_upload_files') == 8 ){ echo 'selected="selected"'; } ?>>8</option>
											<option value="9" <?php if( config('max_upload_files') == 9 ){ echo 'selected="selected"'; } ?>>9</option>
											<option value="10" <?php if( config('max_upload_files') == 10 ){ echo 'selected="selected"'; } ?>>10</option>
                          </select>

		                          </div>
		                        </div>
                     		 </div>
							</div>
                        	<div class="row">
					       	 <div class="col-sm-6">
		                        <div class="form-group">
		                          <label class="control-label"><?php echo $this->lang->line('max_upload_file_size'); ?></label>
		                          <div class="append-icon">
		                          																									<select class="form-control" data-style="white" name="max_upload_file_size">
                            				<option value="1000" <?php if( config('max_upload_file_size') == 1000 ){ echo 'selected="selected"'; } ?>>1 MB</option>
											<option value="2000" <?php if( config('max_upload_file_size') == 2000 ){ echo 'selected="selected"'; } ?>>2 MB</option>
											<option value="3000" <?php if( config('max_upload_file_size') == 3000 ){ echo 'selected="selected"'; } ?>>3 MB</option>
											<option value="4000" <?php if( config('max_upload_file_size') == 4000 ){ echo 'selected="selected"'; } ?>>4 MB</option>
											<option value="5000" <?php if( config('max_upload_file_size') == 5000 ){ echo 'selected="selected"'; } ?>>5 MB</option>
											<option value="6000" <?php if( config('max_upload_file_size') == 6000 ){ echo 'selected="selected"'; } ?>>6 MB</option>
											<option value="7000" <?php if( config('max_upload_file_size') == 7000 ){ echo 'selected="selected"'; } ?>>7 MB</option>
											<option value="8000" <?php if( config('max_upload_file_size') == 8000 ){ echo 'selected="selected"'; } ?>>8 MB</option>
											<option value="9000" <?php if( config('max_upload_file_size') == 9000 ){ echo 'selected="selected"'; } ?>>9 MB</option>
											<option value="10000" <?php if( config('max_upload_file_size') == 10000){ echo 'selected="selected"'; } ?>>10 MB</option>
                          			</select>

		                          </div>
		                        </div>
                     		 </div>
							</div>			 
                      	                                                 
                        <div class="text-left  m-t-20">
                          <div id="upload_submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="upload_settings()">Save</button></div>
                           
                        </div>
                      </form>
                    </div>
                   	
                   </div>
                </div>
                        </div>
                        <div class="tab-pane fade in" id="tab1_3">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="sales_tax_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form id="sales_tax_settings" class="form-validation" novalidate="novalidate">
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Sales Tax</label>
					                              <div class="append-icon">
					                                <input type="number" name="sales_tax" value="<?php echo config('sales_tax'); ?>" class="form-control">
					                                <i class="icon-">%</i>
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				 
                        				<div class="text-left  m-t-20">
                         				 <div id="sales_tax_submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="sales_tax_settings()">Save</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                   	
                   			 </div>
               			   </div>
                        </div>
						<div class="tab-pane fade in" id="tab1_4">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="invoice_prefix_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form id="invoice_prefix_settings" class="form-validation" novalidate="novalidate">
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Invoice Prefix</label>
					                              <div class="append-icon">
					                                <input type="text" name="invoice_prefix" value="<?php echo config('invoice_prefix'); ?>" class="form-control">
					                                
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				 
                        				<div class="text-left  m-t-20">
                         				 <div id="invoice_prefix_submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="invoice_prefix_settings()">Save</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                   	
                   			 </div>
               			   </div>
                        </div>
						<div class="tab-pane fade in" id="tab1_5">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="payment_term_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form id="payment_term_settings" class="form-validation" novalidate="novalidate">
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Payment Term 1</label>
					                              <div class="append-icon">
					                                <input type="number" name="payment_term1" value="<?php echo config('payment_term1'); ?>" class="form-control">
					                             <i class="icon-">Days</i>   
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Payment Term 2</label>
					                              <div class="append-icon">
					                                <input type="number" name="payment_term2" value="<?php echo config('payment_term2'); ?>" class="form-control">
					                             <i class="icon-">Days</i>   
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
										<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Payment Term 3</label>
					                              <div class="append-icon">
					                                <input type="number" name="payment_term3" value="<?php echo config('payment_term3'); ?>" class="form-control">
					                             <i class="icon-">Days</i>   
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div> 
                        				<div class="text-left  m-t-20">
                         				 <div id="payment_term_submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="payment_term_settings()">Save</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                   	
                   			 </div>
               			   </div>
                        </div>
						<div class="tab-pane fade in" id="tab1_6">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="login_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form name="login_settings" id="login_settings" class="form-validation" novalidate="novalidate" enctype="multipart/form-data" method="post">
                        				<div class="row">
                          					<div class="col-sm-6">
                          					<div class="form-group">
					                              <label class="control-label"><img src="<?php echo base_url('uploads/site').'/'.config('login_bg'); ?>" alt="company image" class="img-lg"></label>
					                        </div>
					                            <div class="form-group">
					                              <label class="control-label">Login Background</label> 
					                              <div class="append-icon">
					                                <div class="file">
					                                <div class="option-group">
					                                  <span class="file-button btn-primary">Choose File</span>
					                                  <input type="file" class="custom-file" name="login_bg" id="login_bg" onchange="document.getElementById('uploader').value = this.value;">
					                                  <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					                                </div>
				                                </div>
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				
                        				<div class="text-left  m-t-20">
                         				 <div id="login_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                   	
                   			 </div>
               			   </div>
                        </div>
						
						<div class="tab-pane fade in" id="tab1_7">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="smtp_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form id="smtp_settings" class="form-validation" novalidate="novalidate" method="post">
                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">SMTP Host</label>
					                              <div class="append-icon">
					                                <input type="text" name="smtp_host" value="<?php echo config('smtp_host'); ?>" class="form-control">
					                              
					                              </div>
					                            </div>
					                          </div>
					                        <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">SMTP Port</label>
					                              <div class="append-icon">
					                                <input type="text" name="smtp_port" value="<?php echo config('smtp_port'); ?>" class="form-control">
					                              
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Email</label>
					                              <div class="append-icon">
					                                <input type="text" name="smtp_user" value="<?php echo config('smtp_user'); ?>" class="form-control">
					                              
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Password</label>
					                              <div class="append-icon">
					                                <input type="password" name="smtp_pass" value="<?php echo config('smtp_pass'); ?>" class="form-control">
					                              
					                              </div>
					                            </div>
					                          </div>  
					                        </div>
                        			 
                        				<div class="text-left  m-t-20">
                         				 <div id="smtp_submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="smtp_settings()">Save</button></div>
                           
                        </div>
                      </form>
                   				 </div>
                   	
                   			 </div>
               			   </div>
                        </div>

						<div class="tab-pane fade in" id="tab1_8">
                           <div class="panel-body bg-white">
                 			 <div class="col-md-8" align="center">
                   	
                   				<div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="reminder_ajax">                      	                       
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>                     	
				                           
				                      </div>
                  				    <form id="reminder_settings" class="form-validation" novalidate="novalidate">
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Opportunities Reminder</label>
					                              <div class="append-icon">
					                                <input type="number" name="opportunities_reminder_days" value="<?php echo config('opportunities_reminder_days'); ?>" class="form-control">
					                             <i class="icon-">Days</i>   
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Contract Renewal Reminder</label>
					                              <div class="append-icon">
					                                <input type="number" name="contract_renewal_days" value="<?php echo config('contract_renewal_days'); ?>" class="form-control">
					                             <i class="icon-">Days</i>   
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
										<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Invoice Reminder</label>
					                              <div class="append-icon">
					                                <input type="number" name="invoice_reminder_days" value="<?php echo config('invoice_reminder_days'); ?>" class="form-control">
					                             <i class="icon-">Days</i>   
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div> 
                        				<div class="text-left  m-t-20">
                         				 <div id="reminder_submitbutton"><button type="submit" class="btn btn-embossed btn-primary" onclick="reminder_settings()">Save</button></div>
                           
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