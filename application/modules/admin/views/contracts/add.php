<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
/**Add Call
* 
*/ 

$(document).ready(function() {
	$("form[name='add_contracts']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/contracts/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#contracts_ajax").html(msg); 
			$("#contracts_submitbutton").html('<button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button>');
			
			 $("form[name='add_contracts']").find("input[type=text]").val(""); 
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
            <h2><strong>Create Contract</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   		<div id="contracts_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  		</div>
				         
				            <form id="add_contracts" name="add_contracts" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	                  	
               	 <div class="modal-body">
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Start Date</label>
                        <input type="text" class="date-picker form-control" name="start_date" id="start_date" placeholder="" value="">
                         
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">End Date</label>
                        <input type="text" class="date-picker form-control" name="end_date" id="end_date" placeholder="" value="">
                         
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
				  
				  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-2" class="control-label">Description</label> 
                        <textarea name="description" rows="4" class="form-control"></textarea> 
                      </div>
                    </div>

					<div class="col-md-6">
                      <div class="form-group">
                        <label for="field-2" class="control-label">Attach Signed Contract</label> 
                        <div class="append-icon">
                            <div class="file">
                            <div class="option-group">
                              <span class="file-button btn-primary">Choose File</span>
                              <input type="file" class="custom-file" name="real_signed_contract" id="real_signed_contract" onchange="document.getElementById('uploader1').value = this.value;">
                              <input type="text" class="form-control" id="uploader1" placeholder="no file selected" readonly="">
                            </div>
                        	</div>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  </div>
				  	
                </div>
                 
                  <div id="contracts_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Create</button></div>
                 
                </form>             
                  				    
                  </div>
                   
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
