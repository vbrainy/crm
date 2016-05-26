<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_sources']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/sources/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#sources_ajax").html(msg); 
			$("#sources_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("form[name='add_sources']").find("input[type=text]").val("");
			
            
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
            <h2><strong>Create source</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="sources_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_sources" name="add_sources" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">source Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="source_name" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          
					                        
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Source Contact</label>
					                              <div class="append-icon">
					                                <input type="text" name="source_contacts" value="" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          </div>
					                        <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Source Sales</label>
					                              <div class="append-icon">
					                                <input type="text" name="source_sales" value="" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">	
                                                 <label class="control-label">Notes</label>
 
 <div class="append-icon">
 <textarea name="notes" rows="4" class="form-control"></textarea>   
					                              </div>
                                                   </div>
					                          </div>
					                        </div> 
					                    
                        				  
					                     
					                    
                        				<div class="text-left  m-t-20">
                         				 <div id="sources_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 