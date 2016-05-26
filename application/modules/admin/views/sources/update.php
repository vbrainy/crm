<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_sources']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/sources/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#sources_ajax").html(msg); 
			$("#sources_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
            <h2><strong>Update source</strong></h2>
             
                     
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="sources_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="update_sources" name="update_sources" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        			<input type="hidden" name="source_id" value="<?php echo $source->id;?>"/>	                        				 
                        				
					                        
					                        <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">source Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="source_name" value="<?php echo $sources->source_name;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          
					                        
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Source Contact</label>
					                              <div class="append-icon">
					                                <input type="text" name="source_contacts" value="<?php echo $sources->source_contacts;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          </div>
					                        <div class="row">
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Source Sales</label>
					                              <div class="append-icon">
					                                <input type="text" name="source_sales" value="<?php echo $sources->source_sales;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">	
                                                 <label class="control-label">Notes</label>
 
 <div class="append-icon">
 <textarea name="notes" rows="4" class="form-control"><?php echo $sources->notes;?></textarea>   
					                              </div>
                                                   </div>
					                          </div>
					                        </div> 
					                    
                        				  
					                    
				                       
                        				<div class="text-left  m-t-20">
                         				 <div id="sources_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>               
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
 
 