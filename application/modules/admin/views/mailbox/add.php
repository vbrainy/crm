<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
/**Add Call
* 
*/ 

$(document).ready(function() {
	$("form[name='add_call']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/logged_calls/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#call_ajax").html(msg); 
			$("#call_submitbutton").html('<button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button>');
			
			 $("form[name='add_call']").find("input[type=text]").val(""); 
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
            <h2><strong>Create Logged Calls</strong></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   		<div id="call_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  		</div>
				         
				            <form id="add_call" name="add_call" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	                  	
               	 <div class="modal-body">
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Date</label>
                        <input type="text" class="date-picker form-control" name="date" id="date" placeholder="" value="<?php echo date('m/d/Y'); ?>">
                         
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-2" class="control-label">Call	Summary</label>
                        <input type="text" class="form-control" name="call_summary" id="call_summary" placeholder="">
                      </div>
                    </div>
                  </div>
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-4" class="control-label">Contact</label>
                         
                         <select name="company_id" id="company_id" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $companies as $company){ ?>
					                                <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
					                                <?php }?> 
					                                </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-5" class="control-label">Responsible</label>
                         <select name="resp_staff_id" id="resp_staff_id" class="form-control" data-search="true">
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>"><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					       </select>
                      </div>
                    </div>
                     
                  </div>
                </div>
                 
                  <div id="call_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button></div>
                 
                </form>             
                  				    
                  </div>
                  </div>
                </div>
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
