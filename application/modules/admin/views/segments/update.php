<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_segments']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/segments/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#segments_ajax").html(msg); 
			$("#segments_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
            <h2><strong>Update Segment</strong></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="segments_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				           <form id="update_segments" name="update_segments" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        			<input type="hidden" name="segment_id" value="<?php echo $segment->id;?>"/>
                        				                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Segment</label>
					                              <div class="append-icon">
					                                <input type="text" name="segment" value="<?php echo $segment->segment;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                        <div class="col-sm-6">
					                            <div class="form-group">
					                            <p><strong>&nbsp;</strong>
                             					 </p>
					                               <div class="input-group">
                           						     <div class="icheck-inline">
						                                  <label>
						                                  <input type="checkbox" name="quotations" <?php if($segment->quotations){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue"> Quotations</label>
						                                  <label>
						                                  <input type="checkbox" name="leads" <?php if($segment->leads){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue"> Leads</label>
						                                  <label>
						                                  <input type="checkbox" name="opportunities" <?php if($segment->opportunities){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue"> Opportunities</label>
                               						 </div>
                             						</div> 
					                            </div>
					                          </div>  
					                    </div>
					                    <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Sales Target</label>
					                              <div class="append-icon">
					                                <input type="text" name="sales_target" value="<?php echo $segment->sales_target;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Sales Forecast</label>
					                              <div class="append-icon">
					                                <input type="text" name="sales_forecast" value="<?php echo $segment->sales_forecast;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div> 
					                         <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Actual Sales</label>
					                              <div class="append-icon">
					                                <input type="text" name="actual_sales" value="<?php echo $segment->actual_sales;?>" class="form-control">
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Region</label>
					                              <div class="append-icon">
					                          
					                                
					                                <select name="regions" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $regions as $region){ ?>
					                                <option value="<?php echo $region->id;?>"<?php if($segment->regions==$region->id){?>selected<?php }?>><?php echo $region->region;?></option>
					                                <?php }?> 
					                                </select>
					                                  
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div>
					                    <div class="row">
                          					 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Segment Leader</label>
					                              <div class="append-icon">
					                                 
					                                <select name="segment_leader" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if($segment->segment_leader==$staff->id){?>selected<?php }?>><?php echo $staff->first_name.' '. $staff->last_name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
                          					<div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Active</label>
				                              <div class="append-icon">
				                                <input type="checkbox" name="status" <?php if($segment->status){?>checked<?php }?> value="1" checked data-checkbox="icheckbox_square-blue"/> 
				                                 
				                              </div>
				                            </div>
				                          </div>
                          					 	
					                    </div>
										
										 <ul class="nav nav-tabs">
				                        <li class="active"><a href="#tab1_1" data-toggle="tab">Segment Members</a></li>
				                        <li class=""><a href="#tab1_2" data-toggle="tab">Notes</a></li>                      
				                      </ul>
					                     <div class="tab-content">
						                        <div class="tab-pane fade active in" id="tab1_1">
							                           <div class="panel-body bg-white">
							                 			 		 																						<div class="col-sm-6">
					                            <div class="form-group">
					                               
					                              <div class="append-icon">
					                                  
					                                <select name="segment_members[]" class="form-control" multiple> 
					                                <?php 
					                                $segment_members = explode(",", $segment->segment_members);
					                                foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if(in_array($staff->id,$segment_members)){?>selected<?php }?>><?php echo $staff->first_name.' '. $staff->last_name;?></option>
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
					                                
					                                <textarea name="notes" rows="4" class="form-control"><?php echo $segment->notes;?></textarea>   
					                              </div>
					                            </div>
					                          </div>
												</div>
					                         </div> 
					                          
					                        </div>
                        				<div class="text-left  m-t-20">
                         				 <div id="segments_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>    
                  				    
                  </div>
                  </div>
                </div>
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 

 