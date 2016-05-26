<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$("form[name='edit_meeting']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/opportunities/edit_meeting_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#meeting_ajax").html(msg); 
			$("#meeting_submitbutton").html('<button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button>');
			
			  
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
}); 
</script
<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
      	  <div class="header">
            <h2><strong>Update Meeting</strong></h2>  
            
             
            <div class="breadcrumb-wrapper">
                
               <a href="<?php echo base_url('admin/opportunities/update/'.$meeting->meeting_type_id); ?>" class="btn btn-primary btn-embossed"> Back</a>
                 
            </div>          
          </div>
		
		 <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="meeting_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
						 <form id="edit_meeting" name="edit_meeting" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	  	               
               	  	               <input  type="hidden" name="meeting_id" value="<?php echo $meeting->id;?>"/>
               	  	                <input type="hidden" name="meeting_type_id" value="<?php echo $meeting->meeting_type_id;?>"/>
               	                    <input type="hidden" name="meeting_type" value="opportunities"/>	                        			
               	  	                        			 
               	 <div class="modal-body">
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-2" class="control-label">Meeting Subject</label>
                        <input type="text" class="form-control" name="meeting_subject" id="meeting_subject" value="<?php echo $meeting->meeting_subject;?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-4" class="control-label">Attendees</label>
                         
                         <select name="attendees[]" id="attendees" class="form-control" data-search="true" multiple>
					                                <option value=""></option>
					                                <?php 
					                                $attendees = explode(",", $meeting->attendees); 
					                                foreach( $companies as $company){ ?>
					                                
					                                <option value="<?php echo $company->id;?>" <?php if(in_array($company->id,$attendees)){?>selected<?php }?>><?php echo $company->name;?></option>
					                                <?php 
					                                }
					                                ?> 
					                                <?php foreach( $staffs as $staff){ ?>
					                                
					                                
					                                <option value="<?php echo $staff->id;?>" <?php if(in_array($staff->id,$attendees)){?>selected<?php }?>><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?>
					                                </select>
                      </div>
                    </div>
                    
                  </div>
                   
                  <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-5" class="control-label">Responsible</label>
                         <select name="responsible" id="responsible" class="form-control" data-search="true">
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if($meeting->responsible==$staff->id){?>selected<?php }?>><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					       </select>
                      </div>
                    </div>  
                    
                  </div>

				<ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1_1edit" data-toggle="tab">Meeting Details</a></li>
                    <li class=""><a href="#tab1_2edit" data-toggle="tab">Options</a></li>                      			
                   
                 </ul>
				 <div class="tab-content">
						                        
						                        <div class="tab-pane fade active in" id="tab1_1edit">
							                           <div class="panel-body bg-white">
						                 			  		   											 				  							  <div class="row">
                          							   <div class="col-md-6">
									                      <div class="form-group">
									                        <label for="field-1" class="control-label">Starting at</label>
									                        <!--<input type="text" class="date-picker form-control" name="date" id="date" placeholder="" value="">-->
									                        <input type="text" name="starting_date" id="starting_date" class="datetimepicker form-control" placeholder="Choose a date..."  value="<?php echo date('m/d/Y H:i', $meeting->starting_date);?>">
									                         
									                      </div>
									                    </div> 
	                          							 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Location</label>
							                              <div class="append-icon">
							                                <input type="text" name="location" value="<?php echo $meeting->location;?>"  class="form-control"/> 
							                                 
							                              </div>
							                            </div>
							                          </div>
                          					 	
					                    			     </div>
	 													 <div class="row">
                          							     	 <div class="col-sm-6">
									                           <div class="form-group">
									                              <label class="control-label">Ending at</label>
									                              <div class="append-icon">
									                                <input type="text" name="ending_date" id="ending_date" class="datetimepicker form-control" placeholder="Choose a date..." value="<?php echo date('m/d/Y H:i', $meeting->ending_date);?>">
									                                 
									                              </div>
									                            </div>
					                         				 </div>
                          								     <div class="col-sm-6">
				                            
				                         					 </div>
                          					 	
					                    			      </div>
														<div class="row">
                          							     	 <div class="col-sm-6">
									                           <div class="form-group">
									                              <label class="control-label">All Day</label>
									                              <div class="append-icon">
									                               <input type="checkbox" name="all_day" id="all_day" value="1" <?php if($meeting->all_day==1){?>checked<?php }?> data-checkbox="icheckbox_square-blue"/> 
									                                 
									                              </div>
									                            </div>
					                         				 </div>
                          								     <div class="col-sm-6">
				                            
				                         					 </div>
                          					 	
					                    			      </div>
														<div class="row">
														<div class="col-sm-12">
					                            		<div class="form-group">
					                               <label class="control-label">Description</label>
					                              <div class="append-icon">
					                                
					                                <textarea name="meeting_description" rows="5" class="form-control" placeholder="describe the product characteristics..."><?php echo $meeting->meeting_description;?></textarea>   
					                              </div>
					                            </div>
					                         			 </div>
														</div>
							               			   </div>
						                        </div>
											    
											    <div class="tab-pane fade" id="tab1_2edit">
												<div class="panel-body bg-white">	
													 <div class="row">
													 	 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Privacy</label>
							                              <div class="append-icon">
							                                 
							                                <?php $options = array( 
											                  ''  => '',
											                  'Everyone'  => 'Everyone',
											                  'Only me'    => 'Only me',
											                  'Only internal users'   => 'Only internal users',
											                ); 
															echo form_dropdown('privacy', $options,$meeting->privacy,'class="form-control"');?>	
							                              </div>
							                            </div>
					                          			</div>
														 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Show Time as</label>
							                              <div class="append-icon">
							                                 
							                                <?php $options = array( 
											                  ''  => '',
											                  'Free'  => 'Free',
											                  'Busy'    => 'Busy', 
											                ); 
															echo form_dropdown('show_time_as', $options,$meeting->show_time_as,'class="form-control"');?>	
							                              </div>
							                            </div>
					                          			</div>	
													 </div>
												</div>
					                         </div> 
					                          
					                           
					                            </div>
                </div>
                 
                  <div id="meeting_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button></div>
                 
                </form>
					</div>
				</div>
			</div>
		</div>			
               
</div>              