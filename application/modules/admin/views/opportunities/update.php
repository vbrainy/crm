<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_opportunities']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/opportunities/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#opportunities_ajax").html(msg); 
			$("#opportunities_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});
 

//Stages Select
$(function() { 
    $('#stages').change(function() {
         
         var stage=$(this).val();
          
         if(stage=='New' || stage=='Lost' || stage=='Dead')
         {
		 	 $('#probability').val(0);		 	
		 }
		 if(stage=='Qualification') 
		 {
		 	$('#probability').val(20);	
		 	
		 }
		 if(stage=='Proposition') 
		 {
		 	$('#probability').val(40);	
		 	
		 }
		 if(stage=='Negotiation') 
		 {
		 	$('#probability').val(60);	
		 	
		 }
		 if(stage=='Won') 
		 {
		 	$('#probability').val(100);	
		 	
		 }         
        
    }).change(); // Trigger the event
});




/**Add Call
* 
*/ 

$(document).ready(function() {
	$("form[name='add_call']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/opportunities/add_call'); ?>",
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

function delete_calls( call_id )
 {
    var confir=confirm('Are you sure you want to delete this?');
   
   if(confir==true)
   {
   	$.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/opportunities/call_delete' ); ?>/" + call_id,
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
//Date class changes
/*$(function(){
     
    $('#all_day').on('ifChecked',function(event) {
    	  
        if($(this).is(':checked')) 
        { 
            $('#starting_date').addClass('date-picker');
            $('#starting_date').removeClass('datetimepicker');
             
        }
    });
});*/ 

/**Add Meting
* 
*/ 

$(document).ready(function() {
	$("form[name='add_meeting']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/opportunities/add_meeting'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#meeting_ajax").html(msg); 
			$("#meeting_submitbutton").html('<button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button>');
			
			 $("form[name='add_meeting']").find("input[type=text]").val(""); 
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
}); 

function delete_meeting( meeting_id )
 {
    var confir=confirm('Are you sure you want to delete this?');
   
   if(confir==true)
   {
   	$.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/opportunities/meeting_delete' ); ?>/" + meeting_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#meeting_id_' + meeting_id).fadeOut('normal');
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
	 if(name=="meetings")
	 {
	 	 
  	     $("#modal-all_meetings").removeClass("fade").modal("hide");
         $("#modal-create_meetings").modal("show").addClass("fade");
  	    
	 }
 	 
 
 }
 
 </script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="row">
            <h2 class="col-md-6"><strong>Update Opportunities</strong></h2>  
              
            <div style="float:right; padding-top:10px;">
                <?php if (check_staff_permission('opportunities_write')){?>
                <a href="<?php echo base_url('admin/opportunities/convert_to_quotation/'.$opportunity->id); ?>" class="btn btn-primary" target="">Convert to Quotation</a>
                <?php }?>
            </div>          
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="opportunities_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="update_opportunities" name="update_opportunities" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        		<input  type="hidden" name="opportunity_id" value="<?php echo $opportunity->id;?>"/>		                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Opportunity</label>
					                              <div class="append-icon">
					                                <input type="text" name="opportunity" value="<?php echo $opportunity->opportunity;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                             <div class="row m-t-10">
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
                            	<a href="#" data-toggle="modal" data-target="#modal-all_meetings">     
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-user bg-yellow"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-yellow pull-left"><?php echo count($meetings);?></span>
                                                <br>
                                            </div>
                                            <div class="txt">MEETINGS</div>
                                        </div>
                                    </div>
                                </div>
                            </a>   
                                
                            </div>
												</div>
					                          </div>   
					                    </div>
					                    <div class="row">
					                    <div class="col-sm-6">
					                            <div class="form-group">
					                            
					                              <label class="control-label">Stages</label>
					                              <div class="append-icon">
					                                 
					                                <?php $options = array(
									                  'New'  => 'New',
									                  'Qualification'    => 'Qualification',
									                  'Proposition'   => 'Proposition',
									                  'Negotiation' => 'Negotiation',
									                  'Won' => 'Won',
									                  'Lost' => 'Lost',
									                  'Dead' => 'Dead',
									                ); 
													echo form_dropdown('stages', $options,$opportunity->stages,'class="form-control" id="stages"');?>
					                              </div>
					                            </div>
					                          </div> 
					                    </div>
					                    <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Expected Revenue</label>
					                              <div class="append-icon">
					                                <input type="text" name="expected_revenue" value="<?php echo $opportunity->expected_revenue;?>" class="form-control">
					                                 <i class="fa fa-usd"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Probability</label>
					                              <div class="append-icon">
					                                <input type="text" name="probability" id="probability" value="<?php echo $opportunity->probability;?>" class="form-control">
					                                 <i class="">%</i>
					                              </div>
					                            </div>
					                          </div>
					                          
					                        </div> 
					                    <div class="row">
                          					 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Customer</label>
					                              <div class="append-icon">
					                                 
					                                <select name="customer" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $companies as $company){ ?>
					                                <option value="<?php echo $company->id;?>" <?php if($opportunity->customer==$company->id){?> selected="selected"<?php }?>><?php echo $company->name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Email</label>
					                              <div class="append-icon">
					                                <input type="text" name="email" value="<?php echo $opportunity->email;?>" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
                          					 	
					                    </div>
					                    <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Phone</label>
					                              <div class="append-icon">
					                                <input type="text" name="phone" value="<?php echo $opportunity->phone;?>" class="form-control">
					                                <i class="icon-screen-smartphone"></i>
					                              </div>
					                            </div>
					                          </div>
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Salesperson</label>
					                              <div class="append-icon">
					                                <select name="salesperson_id" id="salesperson_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>" <?php if($opportunity->salesperson_id==$staff->id){?> selected="selected"<?php }?>><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					                                </select>
					                                
					                              </div>
					                            </div>
					                          </div>
					                         
					                    </div>
					                    <div class="row">
					                     <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Sales Team</label>
					                              <div class="append-icon">
					                               <select name="sales_team_id" id="sales_team_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                                <?php foreach( $salesteams as $salesteam){ ?>
					                                <option value="<?php echo $salesteam->id;?>" <?php if($opportunity->sales_team_id==$salesteam->id){?> selected="selected"<?php }?>><?php echo $salesteam->salesteam;?></option>
					                                <?php }?> 
					                                </select>
					                                
					                              </div>
					                            </div>
					                          </div>
					                    <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Next Action Date</label>
					                              <div class="append-icon">
					                                <input type="text" name="next_action" value="<?php echo date('m/d/Y', strtotime($opportunity->next_action));?>" class="date-picker form-control">
					                                <i class="icon-calendar"></i>
					                              </div>
					                            </div>
					                          </div>
					                    </div>
					                    <div class="row">
					                    	 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Next Action</label>
					                              <div class="append-icon">
					                                <input type="text" name="next_action_title" value="<?php echo $opportunity->next_action_title;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                           <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Expected Closing</label>
					                              <div class="append-icon">
					                                <input type="text" name="expected_closing" value="<?php echo date('m/d/Y', strtotime($opportunity->expected_closing));?>" class="date-picker form-control">
					                             <i class="icon-calendar"></i>    
					                              </div>
					                            </div>
					                          </div>
					                    </div>
					                    <div class="row">
                          				<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Priority</label>
					                              <div class="append-icon">
					                                 
					                                <?php $options = array(
									                  'Low'  => 'Low',
									                  'High'    => 'High',
									                  'Very High'   => 'Very High',
									                ); 
													echo form_dropdown('priority', $options,$opportunity->priority,'Low','class="form-control"');?>	
					                              </div>
					                            </div>
					                          </div>	
					                      <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Tags</label>
					                              <div class="append-icon">
					                                 
					                                <?php $options = array(
									                  'Product'  => 'Product',
									                  'Software'    => 'Software',
									                  'Design'   => 'Design',
									                  'Training' => 'Training',
									                  'Other' => 'Other',
									                ); 
													echo form_dropdown('tags[]', $options,explode(',',$opportunity->tags),'class="form-control" multiple');?>
					                              </div>
					                            </div>
					                          </div>    	  
					                    </div>    
				                        <div class="row">
				                        	
				                        	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Lost Reason</label>
					                              <div class="append-icon">
					                                 
					                                <?php $options = array(
									                  ''  => '',
									                  'Too expensive'  => 'Too expensive',
									                  'We don\'t have people/skills'    => 'We don\'t have people/skills',
									                  'Not enough stock'   => 'Not enough stock',
									                   
									                ); 
													echo form_dropdown('lost_reason', $options,$opportunity->lost_reason,'class="form-control"');?>
					                              </div>
					                            </div>
					                          </div>    
					                        <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Internal Notes</label>
				                              <div class="append-icon">
				                                 
				                                <textarea name="internal_notes" rows="4" class="form-control"><?php echo $opportunity->internal_notes;?></textarea> 
				                              </div>
				                            </div>
				                          </div>    
				                        </div>
				                         <div class="row">                          					 
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Assigned Partner</label>
					                              <div class="append-icon">
					                                 
					                                <select name="assigned_partner_id" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $companies as $company){ ?>
					                                <option value="<?php echo $company->id;?>" <?php if($opportunity->assigned_partner_id==$company->id){?> selected="selected"<?php }?>><?php echo $company->name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
					                    </div> 
                        				<div class="text-left  m-t-20">
                         				 <div id="opportunities_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 

 
<!-- START MODAL CALLS CONTENT -->
 <div class="modal fade" id="modal-create_calls" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Opportunities</strong> Calls</h4>
                </div>
               	<div id="call_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				         
				 <form id="add_call" name="add_call" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	 <input type="hidden" name="call_type_id" value="<?php echo $opportunity->id;?>"/>
               	 <input type="hidden" name="call_type" value="opportunities"/>	                        	
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
                  <h4 class="modal-title"><strong>Opportunities</strong> Calls</h4>
                  
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
	                        
	                        <a href="<?php echo base_url('admin/opportunities/edit_call/'.$call->id); ?>" class="edit btn btn-sm btn-default"><i class="icon-note"></i></a>
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
 
 <!-- END MODAL CALLS CONTENT -->
 
 
 <!-- START MODAL MEETINGS CONTENT -->
 <div class="modal fade" id="modal-create_meetings" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Opportunities</strong> Meeting</h4>
                </div>
               	<div id="meeting_ajax"> 
				       <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				         
				 <form id="add_meeting" name="add_meeting" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	 <input type="hidden" name="meeting_type_id" value="<?php echo $opportunity->id;?>"/>
               	 <input type="hidden" name="meeting_type" value="opportunities"/>	                        			 
               	 <div class="modal-body">
                   
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-2" class="control-label">Meeting Subject</label>
                        <input type="text" class="form-control" name="meeting_subject" id="meeting_subject" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-4" class="control-label">Attendees</label>
                         
                         <select name="attendees[]" id="attendees" class="form-control" data-search="true" multiple>
					                                <option value=""></option>
					                                <?php foreach( $companies as $company){ ?>
					                                <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
					                                <?php }?> 
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
                        <label for="field-5" class="control-label">Responsible</label>
                         <select name="responsible" id="responsible" class="form-control" data-search="true">
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>"><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					       </select>
                      </div>
                    </div>  
                    
                  </div>

				<ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1_1" data-toggle="tab">Meeting Details</a></li>
                    <li class=""><a href="#tab1_2" data-toggle="tab">Options</a></li>                      			
                   
                 </ul>
				 <div class="tab-content">
						                        
						                        <div class="tab-pane fade active in" id="tab1_1">
							                           <div class="panel-body bg-white">
						                 			  		   											 				  							  <div class="row">
                          							   <div class="col-md-6">
									                      <div class="form-group">
									                        <label for="field-1" class="control-label">Starting at</label>
									                        <!--<input type="text" class="date-picker form-control" name="date" id="date" placeholder="" value="">-->
									                        <input type="text" name="starting_date" id="starting_date" class="datetimepicker form-control" placeholder="Choose a date..." id="">
									                         
									                      </div>
									                    </div> 
	                          							 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Location</label>
							                              <div class="append-icon">
							                                <input type="text" name="location" value=""  class="form-control"/> 
							                                 
							                              </div>
							                            </div>
							                          </div>
                          					 	
					                    			     </div>
	 													 <div class="row">
                          							     	 <div class="col-sm-6">
									                           <div class="form-group">
									                              <label class="control-label">Ending at</label>
									                              <div class="append-icon">
									                                <input type="text" name="ending_date" id="ending_date" class="datetimepicker form-control" placeholder="Choose a date..." id="">
									                                 
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
									                               <input type="checkbox" name="all_day" id="all_day" value="1" data-checkbox="icheckbox_square-blue"/> 
									                                 
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
					                                
					                                <textarea name="meeting_description" rows="5" class="form-control" placeholder="describe the product characteristics..."></textarea>   
					                              </div>
					                            </div>
					                         			 </div>
														</div>
							               			   </div>
						                        </div>
											    
											    <div class="tab-pane fade" id="tab1_2">
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
															echo form_dropdown('privacy', $options,'','class="form-control"');?>	
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
															echo form_dropdown('show_time_as', $options,'','class="form-control"');?>	
							                              </div>
							                            </div>
					                          			</div>	
													 </div>
												</div>
					                         </div> 
					                          
					                           
					                            </div>
                </div>
                 
                  <div id="meeting_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Create</button></div>
                 
                </form>
              </div>
            </div>
          </div>
          
          
          
 <div class="modal fade" id="modal-all_meetings" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              	<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Opportunities</strong> Meetings</h4>
                  
                    <div class="m-t-20">
                    <div class="btn-group">
                      <a href="#" class="btn btn-sm btn-dark" onclick="model_hide_show('meetings')"><i class="fa fa-plus"></i> Create New</a>
                    </div>
                  </div>
                  
                  <div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Date</th>
                        <th>Responsible</th>    
                        <th>Location</th>
                        <th>Show Time as</th>
                        <th>Privacy</th>
                        <th>Duration</th>
                                             
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($meetings) ){?>
					    <?php foreach( $meetings as $meeting){ ?>
	                      <tr id="meeting_id_<?php echo $meeting->id; ?>">
	                      	<td><?php echo $meeting->meeting_subject; ?></td>
	                        <td><?php if($meeting->all_day=='1'){echo date('m/d/Y',$meeting->starting_date);} ?></td>
	                        <td><?php  if($meeting->all_day=='0'){echo date('m/d/Y g:i a',$meeting->starting_date);} ?></td>
	                        <td><?php echo $meeting->responsible.$this->customers_model->get_company($meeting->responsible)->name;?></td>
	                         <td><?php echo $meeting->location; ?></td>
	                         <td><?php echo $meeting->privacy; ?></td>
	                         <td><?php echo $meeting->show_time_as; ?></td>
	                         <td><?php echo $meeting->duration; ?></td>               
	                        <td style="width: 13%;">
	                        <a href="<?php echo base_url('admin/opportunities/edit_meeting/'.$meeting->id); ?>" class="edit btn btn-sm btn-default" onclick="edit_meeting(<?php echo $meeting->id; ?>)" ><i class="icon-note"></i></a>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger" onclick="delete_meeting(<?php echo $meeting->id; ?>)"><i class="icons-office-52"></i></a></td> 
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



  
 <!-- END MODAL MEETINGS CONTENT -->
 