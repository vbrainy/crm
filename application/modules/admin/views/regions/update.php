<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_regions']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/regions/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#regions_ajax").html(msg); 
			$("#regions_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
            <h2><strong>Update Regions</strong></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="regions_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				           <form id="update_regions" name="update_regions" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        			<input type="hidden" name="region_id" value="<?php echo $region->id;?>"/>
                        				                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Region</label>
					                              <div class="append-icon">
					                                <input type="text" name="region" value="<?php echo $region->region;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Actual Sales</label>
					                              <div class="append-icon">
					                                <input type="text" name="actual_sales" value="<?php echo $region->actual_sales;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                 </div>
					                      </div>
					                    <div class="row">
                          					 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">sales target</label>
					                              <div class="append-icon">
					                                <input type="text" name="sales_target" value="<?php echo $region->sales_target;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                 </div>
					                 
                          					 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">`sales forecast</label>
					                              <div class="append-icon">
					                                <input type="text" name="sales_forecast" value="<?php echo $region->sales_forecast;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                 </div>
					                 
					                          
					                        </div> 
					                          
					                    <div class="row">
                          					 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Region Leader</label>
					                              <div class="append-icon">
					                                 
					                                <select name="region_leader" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if($region->region_leader==$staff->id){?>selected<?php }?>><?php echo $staff->first_name.' '. $staff->last_name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
                          					<div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Active</label>
				                              <div class="append-icon">
				                                <input type="checkbox" name="status" <?php if($region->status){?>checked<?php }?> value="1" checked data-checkbox="icheckbox_square-blue"/> 
				                                 
				                              </div>
				                            </div>
				                          </div>
                          					 	
					                    </div>
										
										 <ul class="nav nav-tabs">
				                        <li class="active"><a href="#tab1_1" data-toggle="tab">Region Members</a></li>
				                        <li class=""><a href="#tab1_2" data-toggle="tab">Notes</a></li>                      
				                      </ul>
					                     <div class="tab-content">
						                        <div class="tab-pane fade active in" id="tab1_1">
							                           <div class="panel-body bg-white">
							                 			 		 																						<div class="col-sm-6">
					                            <div class="form-group">
					                               
					                              <div class="append-icon">
					                                  
					                                <select name="region_members[]" class="form-control" multiple> 
					                                <?php 
					                                $region_members = explode(",", $region->region_members);
					                                foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if(in_array($staff->id,$region_members)){?>selected<?php }?>><?php echo $staff->first_name.' '. $staff->last_name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div> 
							               			   </div>
						                        </div>
											<div class="tab-pane fade" id="tab1_2">
												<div class="panel-body bg-white">	
													<div class="col-sm-8">
					                            <div class="form-group">
					                               
					                              <div class="append-icon">
					                                
					                                <textarea name="notes" rows="4" class="form-control"><?php echo $region->notes;?></textarea>   
					                              </div>
					                            </div>
					                          </div>
												</div>
					                         </div> 
					                          
					                        </div>
                        				<div class="text-left  m-t-20">
                         				 <div id="region_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>    
                  				    
                  </div>
                  </div>
                </div>
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 

 