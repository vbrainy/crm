<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong><?php echo $contact_person->first_name.' '.$contact_person->last_name;?></strong></h2>
            <div style="float:right; padding-top:10px;">
             
			    	<a href="<?php echo base_url('admin/contact_persons/update/'.$contact_person->id); ?>" class="btn btn-primary">Edit Contact Person</a>	
            </div>              
           </div>
  
		  <div class="row">
                         
                            <div class="row">
                                <div class="col-md-8">
                                    <h3><strong>CONTACT PERSON DETAILS</strong></h3> 
                                    <div class="panel widget-member2">
                                        <div class="row">
                                            <div class="col-lg-2 col-xs-3">
                                            <?php if($contact_person->company_avatar){?>
                                                <img src="<?php echo base_url('uploads/company').'/'.$contact_person->company_avatar; ?>" alt="profil 4" class="pull-left img-responsive" style="height: 81px;width:81px;">
                                                <?php }else{?>
	             		<img src="<?php echo base_url(); ?>public/assets/global/images/avatars/user1.png" alt="user image" class="pull-left img-responsive" style="height: 81px;width:81px;">  
	             	<?php }?>
                                            </div>
                                            <div class="col-lg-10 col-xs-9">
                                                <div class="clearfix">
                                                    <h3 class="m-t-0 member-name"><strong><?php echo $contact_person->name;?></strong></h3>
                                                </div>
                                                <div class="row">
                                                <?php if($contact_person->address){?>
                                                    <div class="col-sm-12">
                                                        <p><i class="fa fa-map-marker c-gray-light p-r-10"></i> <?php echo $contact_person->address;?></p>
                                                    </div>
                                                 <?php }?>   
                                                </div>
                                                <div class="row">
                                                <?php if($contact_person->website){?>
                                                	<div class="col-xlg-4 col-lg-6 col-sm-4">
                                                        <p><i class="fa fa-globe c-gray-light p-r-10"></i> <?php echo $contact_person->website;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($contact_person->email){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4 align-right">
                                                        <p><i class="icon-envelope  c-gray-light p-r-10"></i> <?php echo $contact_person->email;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($contact_person->phone){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4">
                                                        <p><i class="fa fa-phone c-gray-light p-r-10"></i> <?php echo $contact_person->phone;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($contact_person->fax){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4 align-right">
                                                        <p><i class="fa fa-fax c-gray-light p-r-10"></i> <?php echo $contact_person->fax;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($contact_person->title){?>
                                                     <div class="col-xlg-4 col-lg-6 col-sm-4">
                                                        <p><i class="fa fa-comment c-gray-light p-r-10"></i> <?php echo $contact_person->title;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($contact_person->segment_id){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4 align-right">
                                                        <p><i class="icon-check c-gray-light p-r-10"></i> <?php echo $this->segments_model->get_segment($contact_person->segment_id)->segment?></p>
                                                    </div>
                                                   <?php }?>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="m-t-30"><strong>CONTACT PERSON Calendar</strong></h3> 
                                    <div class="widget widget_calendar bg-red">
                                        <div class="multidatepicker"></div>
                                    </div>
                                </div>
                            </div>
                         
                    </div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 