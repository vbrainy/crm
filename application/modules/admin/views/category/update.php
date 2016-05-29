<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_category']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/category/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#category_ajax").html(msg); 
			$("#category_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
            <h2><strong>Update Category</strong></h2>
             
                     
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="category_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="update_category" name="update_category" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        			<input type="hidden" name="category_id" value="<?php echo $category->id;?>"/>	                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Category Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="category_name" value="<?php echo $category->category_name;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">Product</label>
                                        <div class="append-icon">
                                          <?php 
                                          $selected='';

                                          ?>

                                          <select name="product_id" id="product_id" class="form-control" data-search="true">
                                          <option value="" selected="selected"></option>
                                          <?php foreach($products as $key=>$value) { ?>
                                          <?php $selected = ($value->id == $category->product_id) ? 'selected=selected' : ''; ?>
                                          <option value="<?php echo $value->id ?>" <?= $selected ?>><?php echo $value->product_name ?></option>
                                          <?php } ?>
                                          </select>
                                           
                                        </div>
                                      </div>
                                    </div>
                                    
                                  </div>
					                    
				                       
                        				<div class="text-left  m-t-20">
                         				 <div id="category_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>               
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
 
 