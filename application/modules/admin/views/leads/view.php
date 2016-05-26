<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
 
/**Add Call
* 
*/ 

$(document).ready(function() {
	$("form[name='add_call']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/leads/add_call'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#call_ajax").html(msg); 
            
            if(msg=='yes')
            {	
            	$("#modal-create_calls").removeClass("fade").modal("hide");			
				location.reload();	
			} 
            
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

function delete_calls( call_id )
 {
    var confir=confirm('Are you sure you want to delete this?');
    
   if(confir==true)
   {
   	$.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/leads/call_delete' ); ?>/" + call_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#call_id_' + call_id).fadeOut('normal');
            }
        }

    });
   }
    
    
       
 }

//Modal Open and Close
 function model_hide_show(name)
 {  
 	 if(name=="calls")
 	 {
 	 	 
  	     $("#modal-all_calls").removeClass("fade").modal("hide");
         $("#modal-create_calls").modal("show").addClass("fade");
  	    
	 }
	  
 
 }
 
 /**Add Opportunity
* 
*/ 

$(document).ready(function() {
	$("form[name='add_convert_to_opportunity']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/leads/convert_to_opportunity'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
            	
            var str=msg.split("_");
            var id=str[1];
            var status=str[0]; 
            
            if(status=="yes")
            {
            	
            	$('body,html').animate({ scrollTop: 0 }, 200);
            	$("#convert_to_oppo_ajax").html('<?php echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>'?>');
            	
            	setTimeout(function () {
				window.location.href="<?php echo base_url('admin/opportunities/view' ); ?>/"+id;
				}, 2000); //will call the function after 2 secs.
				
			}
			else
			{
            	
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#convert_to_oppo_ajax").html(msg); 
			$("#convert_to_oppo_submitbutton").html('<button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button>');
			
			 $("form[name='add_convert_to_opportunity']").find("input[type=text]").val(""); 
			}
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
        <div class="row">
            <h2 class="col-md-6"><strong><?php echo $lead->opportunity;?></strong></h2> 
            <div style="float:right; padding-top:10px;">
            <?php if (check_staff_permission('lead_write')){?>
            	<a href="<?php echo base_url('admin/leads/convert_to_customer/'.$lead->id); ?>" class="btn btn-primary">Convert to Customer</a>
            	
            	<!--<a href="#" data-toggle="modal" data-target="#modal-convert_to_opportunity" class="btn btn-primary">Convert to opportunity</a>-->	
            	
            	<a href="<?php echo base_url('admin/leads/update/'.$lead->id); ?>" class="btn btn-primary"> Edit Lead</a>
             <?php }?>	            	
             	
            </div>                
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   				 
                        			 			 
                        				<div class="row">
                          					&nbsp;	   
					                    </div>
					                     <div class="row">
                          					<div class="col-sm-6">
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-globe"></i>Company Name</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->company_name;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												 
												<div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-map-marker"></i>Address</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->address;?><br/>
					                                <?php echo city_name($lead->city_id)->name; ?><br/>    
					                                <?php echo state_name($lead->state_id)->name; ?><br/>    
					                                <?php echo country_name($lead->country_id)->name; ?>   
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-user-plus"></i>Salesperson</label>
					                              <div class="col-sm-8 append-icon">					                                 
					                                <?php echo $this->staff_model->get_user($lead->salesperson_id)->first_name.' '.$this->staff_model->get_user($lead->salesperson_id)->last_name; ?>   
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-users"></i>Segment</label>
					                              <div class="col-sm-8 append-icon">					                                 
					                                <?php echo $this->segments_model->get_segment($lead->segment_id)->segment; ?>   
					                              </div>
					                              
					                            </div>
												</div>
												</div>  
					                          </div>
					                          	<div class="col-sm-6">
					                          	<div class="widget-infobox">
                            	<a href="#" data-toggle="modal" data-target="#modal-all_calls">
                            	<div class="infobox">
                                    <div class="left">
                                        <i class="fa fa-phone bg-red"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-red pull-left"><?php echo count($calls);?></span>
                                                <br>
                                            </div>
                                            <div class="txt">CALLS</div>
                                        </div>
                                    </div>
                                </div>
                            	</a>
                            	   
                                
                            </div>
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-user"></i> Contact Name</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->contact_name;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-envelope"></i>Email</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->email;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-circle"></i>Function</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->function;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-phone"></i>Phone</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->phone;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-mobile"></i>Mobile</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->mobile;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>	
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-fax"></i>Fax</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->fax;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-tags"></i>Tags</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->tags;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
												<div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-thumbs-o-up"></i>Priority</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $lead->priority;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div>
					                          </div>
					                        </div>    
                        			   
				                        <div class="row">
				                        	    
				                        	 <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label"><i class="fa fa-clipboard"></i>Internal Notes</label>
				                              <div class="append-icon">
				                                 
				                               <?php echo $lead->internal_notes;?>
				                              </div>
				                            </div>
				                          </div>
											 <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label"><i class="fa fa-group"></i>Assigned Partner</label>
				                              <div class="append-icon">
				                                 
				                               <?php echo customer_name($lead->assigned_partner_id)->name; ?>
				                              </div>
				                            </div>
				                          </div>	    
				                        </div>
				                         
                        			 
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
  
  
   
 <!-- START MODAL CONTENT -->
 <div class="modal fade" id="modal-create_calls" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Leads</strong> Calls</h4>
                </div>
               	<div id="call_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				         
				 <form id="add_call" name="add_call" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	 <input type="hidden" name="call_type_id" value="<?php echo $lead->id;?>"/>
               	 <input type="hidden" name="call_type" value="leads"/>	                        	
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
                 
                  <div id="call_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Create</button></div>
                 
                </form>
              </div>
            </div>
          </div>




 <div class="modal fade" id="modal-all_calls" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              	<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Leads</strong> Calls</h4>
                  
                  <div class="m-t-20">
                    <div class="btn-group">
                      <a href="#" class="btn btn-sm btn-dark" onclick="model_hide_show('calls')"><i class="fa fa-plus"></i> Create New</a>
                    </div>
                  </div>
                  
                  <div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Call Summary</th>
                        <th>Contact</th>
                        <th>Responsible</th>                         
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($calls) ){?>
					    <?php foreach( $calls as $call){ ?>
	                      <tr id="call_id_<?php echo $call->id; ?>">
	                        <td><?php echo date('m/d/Y',$call->date); ?></td>
	                        <td><?php echo $call->call_summary; ?></td>
	                        <td><?php echo $this->customers_model->get_company($call->company_id)->name;?></td>
	                        <td><?php echo $this->staff_model->get_user_fullname($call->resp_staff_id); ?></td>      	                        
	                        <td style="width: 13%;">
	                        <a href="<?php echo base_url('admin/leads/edit_call/'.$call->id); ?>" class="edit btn btn-sm btn-default"><i class="icon-note"></i></a>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger" onclick="delete_calls(<?php echo $call->id; ?>)"><i class="icons-office-52"></i></a></td> 
	                      </tr> 
                    	 <?php } ?>
					 <?php } ?> 
                      
                      
                    </tbody>
                  </table>
                </div>
                  
                </div>
              </div>
            </div>
 </div>       


<div class="modal fade" id="modal-convert_to_opportunity" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Convert</strong> to opportunity</h4>
                </div>
               	<div id="convert_to_oppo_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				         
				 <form id="add_convert_to_opportunity" name="add_convert_to_opportunity" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	 <input type="hidden" name="convert_opport_lead_id" value="<?php echo $lead->id;?>"/>
               	       	
               	 <div class="modal-body">
                   <h3>Assign opportunities to</h3>
                  <div class="row">                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-5" class="control-label">Salesperson</label>
                         <select name="salesperson_id" id="salesperson_id" class="form-control" data-search="true">
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if($lead->salesperson_id==$staff->id){?> selected="selected"<?php }?>><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					       </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-4" class="control-label">Sales Team</label>
                         
                         <select name="segment_id" id="segment_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                                <?php foreach( $segments as $segment){ ?>
					                                <option value="<?php echo $segment->id;?>" <?php if($lead->segment_id==$segment->id){?> selected="selected"<?php }?>><?php echo $segment->segment;?></option>
					                                <?php }?> 
					                                </select>
                      </div>
                    </div> 
                  </div>
                </div>
                 
                  <div id="convert_to_oppo_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Create Opportunity</button></div>
                 
                </form>
              </div>
            </div>
          </div>