<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='add_opportunities']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/opportunities/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#opportunities_ajax").html(msg); 
			$("#opportunities_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			$("form[name='add_opportunities']").find("input[type=text], textarea").val("");
			
            
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
          
         if(stage=='Suspect 0%' || stage=='LOST')
         {
		 	 $('#probability').val(0);		 	
		 }
		 if(stage=='Prospect 10%') 
		 {
		 	$('#probability').val(10);	
		 	
		 }
		 if(stage=='Analysis 30%') 
		 {
		 	$('#probability').val(30);	
		 	
		 }
		 if(stage=='Negotiation 50%') 
		 {
		 	$('#probability').val(50);	
		 	
		 }
		 if(stage=='Closing 80%') 
		 {
		 	$('#probability').val(80);
		 		
		 	
		 }
		 if(stage=='Order 100%') 
		 {
		 	$('#probability').val(100);
		 
		 }
		 if(stage=='create_new') 
		 {
		 	$('#modal-create_calls').modal('show');
		 	
		 }         
        
    }).change(); // Trigger the event
});
 </script>
 
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Create Opportunities</strong></h2>            
          </div>
           <div class="row">
           	<div class="col-md-12">
                  <div class="panel">
                     
                     <div class="col-md-12 col-sm-12 col-xs-12">
                   					<div id="opportunities_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="add_opportunities" name="add_opportunities" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Opportunity</label>
					                              <div class="append-icon">
					                                <input type="text" name="opportunity" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
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
									                  'create_new' => 'Create New',
									                ); 
													echo form_dropdown('stages', $options,'New','class="form-control" id="stages"');?>
					                              </div>
					                            </div>
					                          </div>   
					                    </div>
					                    <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Expected Revenue</label>
					                              <div class="append-icon">
					                                <input type="text" name="expected_revenue" value="" class="form-control">
					                                 <i class="fa fa-usd"></i>
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Probability</label>
					                              <div class="append-icon">
					                                <input type="text" name="probability" id="probability" value="" class="form-control">
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
					                                <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Email</label>
					                              <div class="append-icon">
					                                <input type="text" name="email" value="" class="form-control">
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
					                                <input type="text" name="phone" value="" class="form-control">
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
					                                <option value="<?php echo $staff->id;?>"><?php echo $staff->first_name.' '.$staff->last_name;?></option>
					                                <?php }?> 
					                                </select>
					                                
					                              </div>
					                            </div>
					                          </div>
					                         
					                    </div>
					                    <div class="row">
					                    <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Segment</label>
					                              <div class="append-icon">
					                               <select name="sales_team_id" id="sales_team_id" class="form-control" data-search="true">
					                                <option value="" selected="selected"></option>
					                                <?php foreach( $salesteams as $salesteam){ ?>
					                                <option value="<?php echo $salesteam->id;?>"><?php echo $salesteam->salesteam;?></option>
					                                <?php }?> 
					                                </select>
					                                
					                              </div>
					                            </div>
					                          </div>
					                    <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Next Action</label>
					                              <div class="append-icon">
					                                <input type="text" name="next_action" value="" class="date-picker form-control">
					                                <i class="icon-calendar"></i>
					                              </div>
					                            </div>
					                          </div>
					                    </div>
					                    <div class="row">
					                    	 <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Call for proposal</label>
					                              <div class="append-icon">
					                                <input type="text" name="next_action_title" value="" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                           <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Expected Closing</label>
					                              <div class="append-icon">
					                                <input type="text" name="expected_closing" value="" class="date-picker form-control">
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
													echo form_dropdown('priority', $options,'Low','class="form-control"');?>	
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
													echo form_dropdown('tags[]', $options,'','class="form-control" multiple');?>
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
													echo form_dropdown('lost_reason', $options,'','class="form-control"');?>
					                              </div>
					                            </div>
					                          </div>    
					                        <div class="col-sm-6">
				                            <div class="form-group">
				                              <label class="control-label">Internal Notes</label>
				                              <div class="append-icon">
				                                 
				                                <textarea name="internal_notes" rows="4" class="form-control"></textarea> 
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
					                                <option value="<?php echo $company->id;?>"><?php echo $company->name;?></option>
					                                <?php }?> 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
					                    </div>  
                        				<div class="text-left  m-t-20">
                         				 <div id="opportunities_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Save</button></div>
                           
                        </div>
                      </form>             
                  				    
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
                 
                  <div id="call_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button></div>
                 
                </form>
              </div>
            </div>
          </div>