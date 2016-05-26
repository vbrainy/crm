<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong><?php echo $customer->name;?></strong></h2>
            <div style="float:right; padding-top:10px;">
            			 
            			
            			<a href="<?php echo base_url('admin/customers/download/'.$customer->company_attachment);?>" class="edit btn btn-primary btn-embossed" title="Download">Download Attachment</a>
            			               
			    		<a href="<?php echo base_url('admin/customers/update/'.$customer->id); ?>" class="btn btn-primary btn-embossed"> Edit Customer</a>
			    		 
            </div>              
           </div>

           <div class="row">
                        <div class="col-md-12">
                            <h3><strong>Cash</strong> information</h3>
                            <div class="widget-cash-in-hand">
                                <div class="cash">
                                    <div class="number c-primary">$<?php echo $total_sales;?></div>
                                    <div class="txt">TOAL SALES</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-green">$<?php echo $open_invoices;?></div>
                                    <div class="txt">open invoices</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-red">$<?php echo $overdue_invoices;?></div>
                                    <div class="txt">overdue invoices</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-blue">$<?php echo $paid_invoices;?></div>
                                    <div class="txt">paid invoices</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-blue">$<?php echo $quotations_total;?></div>
                                    <div class="txt">quotations total</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="m-t-30 m-b-20"><strong>customer activities</strong></h3>
                            <div class="widget-infobox">
                               
                               <a href="<?php echo base_url('admin/logged_calls/index/'.$customer->id); ?>"> 
                                <div class="infobox">
                                    <div class="left">
                                        <i class="fa fa-phone bg-red"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-red pull-left"><?php echo $calls;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">CALLS</div>
                                        </div>
                                    </div>
                                </div>
                               </a>
                                
                                <a href="javascript:void(0)">
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-user bg-yellow"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-yellow pull-left"><?php echo $meetings;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">MEETINGS</div>
                                        </div>
                                    </div>
                                </div>
								
								</a>

                                <a href="<?php echo base_url('admin/salesorder/index/'.$customer->id); ?>">
                                <div class="infobox">
                                    <div class="left">
                                        <i class="fa fa-shopping-cart bg-blue"></i>
                                    </div>
                                    <div class="right">
                                        <div>
                                            <span class="c-primary pull-left"><?php echo $salesorder;?></span>
                                            <br>
                                        </div>
                                        <div class="txt">SALES ORDERS</div>
                                    </div>
                                </div>
								</a>
								
								<a href="<?php echo base_url('admin/invoices/index/'.$customer->id); ?>">
                                
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-note bg-purple"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-purple pull-left"><?php echo $invoices;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">INVOICES</div>
                                        </div>
                                    </div>
                                </div>
								
								</a>
                               
                               <a href="<?php echo base_url('admin/quotations/index/'.$customer->id); ?>">
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-tag bg-orange"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-orange pull-left"><?php echo $quotations;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">QUOTATIONS</div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                                
                                <a href="<?php echo base_url('admin/mailbox/index/'.$customer->id); ?>">
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-envelope bg-pink"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-purple pull-left"><?php echo $emails;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">EMAILS</div>
                                        </div>
                                    </div>
                                </div>
								</a>
								
								 
                                <a href="<?php echo base_url('admin/contracts/index/'.$customer->id); ?>">
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-hourglass bg-dark"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-dark pull-left"><?php echo $contracts;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">CONTRACTS</div>
                                        </div>
                                    </div>
                                </div>
							    </a>	
                            </div>
                        </div>
                    </div>
                    <div class="row">
</div>
                    <div class="row">
                         
                            <div class="row">
                                <div class="col-md-8">
                                    <h3><strong>CUSTOMER DETAILS</strong></h3> 
                                    <div class="panel widget-member2">
                                        <div class="row">
                                            <div class="col-lg-2 col-xs-3">
                                            <?php if($customer->company_avatar){?>
                                                <img src="<?php echo base_url('uploads/company').'/'.$customer->company_avatar; ?>" alt="profil 4" class="pull-left img-responsive" style="height: 81px;width:81px;">
                                                <?php }else{?>
	             		<img src="<?php echo base_url(); ?>public/assets/global/images/avatars/user1.png" alt="user image" class="pull-left img-responsive" style="height: 81px;width:81px;">  
	             	<?php }?>
                                            </div>
                                            <div class="col-lg-10 col-xs-9">
                                                <div class="clearfix">
                                                    <h3 class="m-t-0 member-name"><strong><?php echo $customer->name;?></strong></h3>
                                                </div>
                                                <div class="row">
                                                <?php if($customer->address){?>
                                                    <div class="col-sm-12">
                                                        <p><i class="fa fa-map-marker c-gray-light p-r-10"></i> <?php echo $customer->address;?></p>
                                                    </div>
                                                 <?php }?>
                                                </div>
                                                <div class="row">
                                                	<?php if($customer->website){?>
                                                	<div class="col-xlg-4 col-lg-6 col-sm-4">
                                                        <p><i class="fa fa-globe c-gray-light p-r-10"></i> <?php echo $customer->website;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($customer->email){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4 align-right">
                                                        <p><i class="icon-envelope  c-gray-light p-r-10"></i> <?php echo $customer->email;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($customer->phone){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4">
                                                        <p><i class="fa fa-phone c-gray-light p-r-10"></i> <?php echo $customer->phone;?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($customer->fax){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4 align-right">
                                                        <p><i class="fa fa-fax c-gray-light p-r-10"></i> <?php echo $customer->fax;?></p>
                                                    </div>
                                                    <?php }?>
                                                    
                                                    <?php if($customer->main_contact_person){?>
                                                    <div class="col-xlg-4 col-lg-6 col-sm-4 align-right">
                                                        <p><i class="icon-user c-gray-light p-r-10"></i> <?php echo $this->customers_model->get_contact_person($customer->main_contact_person,'first_name'); ?> <?php echo $this->customers_model->get_contact_person($customer->main_contact_person,'last_name'); ?></p>
                                                    </div>
                                                    <?php }?>
                                                    <?php if($customer->sales_team_id){?>
                                                   <div class="col-xlg-4 col-lg-6 col-sm-4">
                                                        <p><i class="fa fa-check c-gray-light p-r-10"></i> <?php echo $this->salesteams_model->get_salesteam($customer->sales_team_id)->salesteam?></p>
                                                    </div>
                                                    <?php }?>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="m-t-30"><strong>CUSTOMER Calendar</strong></h3> 
                                    <div class="widget widget_calendar bg-red">
                                        <div class="multidatepicker"></div>
                                    </div>
                                </div>
                            </div>
                         
                    </div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
