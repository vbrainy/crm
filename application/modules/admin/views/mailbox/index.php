<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
/**Send Mil
* 
*/ 

$(document).ready(function() {
	$("form[name='send_email']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/mailbox/send_email'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#send_email_ajax").html(msg); 
			$("#send_email_submitbutton").html('<button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button>');
			
			 $("form[name='send_email']").find("input[type=text], textarea").val(""); 
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});

function close_email()
 { 
 	$( ".email-details h1" ).empty();
 	$( ".email-details .sender" ).empty();
 	$( ".email-details .date" ).empty();
 	$( ".email-details .email-content" ).empty();
 	
    $("#email_details_show").hide();
 }

function open_email()
 { 
     $("#email_details_show").show();
 }
  
 function delete_email( id )
 {
 	var id=document.getElementById('email_id').value;
 	
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/mailbox/delete' ); ?>/" + id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                close_email();
                $('#email_id_' + id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-app mailbox">
          <section class="app">
            <aside class="aside-md emails-list">
              <section>
                <div class="mailbox-page clearfix">
                  <h1 class="pull-left"><?php if($customer_id){echo customer_name($customer_id)->name;}?> Mail</h1>
                  <div class="append-icon">
                    <input type="text" class="form-control form-white pull-right" id="email-search" placeholder="Search..."> 
                    <i class="icon-magnifier"></i>
                  </div>
                </div>
                <ul class="nav nav-tabs text-right">
                  <li class="emails-action">
                      
                    	<div class="pos-rel dis-inline">
                    		<?php if($customer_id){?>
                    		<a href="<?php echo base_url('admin/mailbox/'); ?>" class="btn btn-sm btn-primary">All Mail</a> 
                    		<?php }?>
                    		
                    		<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create_email">Compose</a> 
                     	</div>
                  </li>  
                  <li class="f-right"><a href="#sent_emails" data-toggle="tab">Sent Mail</a></li>
                  <li class="active f-right"><a href="#inbox_emails" data-toggle="tab">Inbox</a></li>
                   
                </ul>
                <div class="tab-content">
                  
                  <div class="tab-pane fade in active" id="inbox_emails"> 
                    <div class="messages-list withScroll show-scroll" data-padding="180" data-height="window">
                    <?php if( ! empty($email_list) ){?>
					    <?php foreach( $email_list as $list){ ?>
					     
              	        <div class="message-item media" id="email_id_<?php echo $list->id;?>" onclick="open_email();">
              	        
              	        <div class="mail_id" style="display: none;"><?php echo $list->id;?></div>
              	        
                        <div class="media" style="margin-top: 0px;">
                        
                          <?php if($this->staff_model->get_staff_user_image($list->from)){?>
			                 <img src="<?php echo base_url(); ?>uploads/<?php echo $this->staff_model->get_staff_user_image($list->from);?>" alt="user image" width="40" class="sender-img">
			                <?php }else{?>
			                <img src="<?php echo base_url(); ?>public/assets/global/images/avatars/user1.png" alt="user image" width="40" class="sender-img">                
			                <?php }?>   
                          <div class="media-body">
                            <div class="sender"><?php echo $this->staff_model->get_user_fullname($list->from);?></div>
                            <div class="subject"><span class="subject-text"><?php echo $list->subject;?></span></div>
                            <div class="date"><?php echo date('m/d',$list->date_time); ?> <strong><?php echo date('g:i a',$list->date_time); ?></strong></div>
                            <div class="email-content">
                               <?php echo $list->message;?>
                               
                            </div>
                          </div>
                        </div>
                      </div>

	                    <?php } ?>
					  <?php } ?> 
                      
                       
                    </div>
                  </div>

				  <div class="tab-pane fade in" id="sent_emails">  
                    <div class="messages-list withScroll show-scroll" data-padding="180" data-height="window">
                    <?php if( ! empty($sent_email_list) ){?>
					    <?php foreach( $sent_email_list as $sent_list){ ?>
              	        <div class="message-item media" id="email_id_<?php echo $sent_list->id;?>" onclick="open_email();">
              	        <div class="mail_id" style="display: none;"><?php echo $sent_list->id;?></div>
              	        
                        <div class="media" style="margin-top: 0px;">
                        
                          <?php if($this->staff_model->get_staff_user_image($sent_list->to)){?>
			                 <img src="<?php echo base_url(); ?>uploads/<?php echo $this->staff_model->get_staff_user_image($sent_list->to);?>" alt="user image" width="40" class="sender-img">
			                <?php }else{?>
			                
			                <img src="<?php echo base_url(); ?>public/assets/global/images/avatars/user1.png" alt="user image" width="40" class="sender-img">                
			                <?php }?>
                           
                          <div class="media-body">
                            <div class="sender"><?php echo $this->staff_model->get_user_fullname($sent_list->to);?></div>
                            <div class="subject"><span class="subject-text"><?php echo $sent_list->subject;?></span></div>
                            <div class="date"><?php echo date('m/d',$sent_list->date_time); ?> <strong><?php echo date('g:i a',$sent_list->date_time); ?></strong></div>
                            <div class="email-content">
                               <?php echo $sent_list->message;?>
                               
                            </div>
                          </div>
                        </div>
                      </div>

	                    <?php } ?>
					  <?php } ?> 
                      
                       
                    </div>
                   
				  </div>	
                </div>
              </section>
            </aside>
             
            <div class="email-details">
              <section id="email_details_show" style="display: none;"> 
              <input type="hidden" name="email_id" id="email_id" value=""/>
                <div class="email-subject" >
                  <h1></h1>
                  <div class="clearfix">
                    <div class="go-back-list"><i data-rel="tooltip" data-placement="bottom" data-original-title="Back to email list" class="icon-arrow-left"></i></div>
                    <p>from <strong><span class="sender"></span></strong> &bull; <span class="date"></span></p>
                    <div class="pos-rel pull-left">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300"> 
                      <i class=" icon-rounded-arrow-down-thin"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#" class="reorder-menu" onclick="close_email()">Close</a></li>
                        <li><a href="#" class="reorder-menu" onclick="delete_email()">Delete email</a></li>
                        
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="email-details-inner withScroll" data-height="window" data-padding="155">
                  <div class="email-content">
                    
                    
                  </div>
                 
                  <div class="write-answer">
                    <div class="" style="height: 320px;"></div>
                    
                  </div>
                </div>
                
              </section>
            </div>
 
          </section>
          
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START MODAL CONTENT -->
 <div class="modal fade" id="modal-create_email" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Write</strong> an email</h4>
                </div>
               	<div id="send_email_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				  </div>
				         
				 <form id="send_email" name="send_email" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
               	  	                        	
               	 <div class="modal-body">
                   <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                         <label for="field-1" class="control-label">Assign Customer</label>
                         <select name="assign_customer_id" id="assign_customer_id" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $customers as $customer){ ?>
					                                <option value="<?php echo $customer->id;?>"><?php echo customer_name($customer->id)->name;?></option>
					                                <?php }?> 
					       </select>
                      </div>
                    </div>
                     
                  </div>
                   <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                         <label for="field-1" class="control-label">Recipients</label>
                         <select name="to_email_id[]" id="to_email_id" class="form-control" data-search="true" multiple>
					                                <?php foreach( $staffs as $staff){ ?>
					                                <option value="<?php echo $staff->id;?>"><?php echo $staff->first_name.' '.$staff->last_name.' ('.$staff->email.')';?></option>
					                                <?php }?> 
					       </select>
                      </div>
                    </div>
                     
                  </div> 
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group"> 
                         <label for="field-1" class="control-label">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    
                    <div class="col-md-12">
                    
                      <div class="form-group">
                          
                        <textarea name="message" id="message" cols="80" rows="10" class="cke-editor"></textarea>
                        
                      </div>
                    </div>
                  </div> 
                 
                </div>
                 
                  <div id="send_email_submitbutton" class="modal-footer text-center"><button type="submit" class="btn btn-primary btn-embossed bnt-square">Save</button></div>
                 
                </form>
              </div>
            </div>
          </div>
