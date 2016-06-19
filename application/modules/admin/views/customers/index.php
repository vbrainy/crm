<script>

 function delete_customer( customer_id )
 {
    //return confirm('Are you sure?');
    
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/customers/delete' ); ?>/" + customer_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#customer_id_' + customer_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
           	<div class="col-md-6"><h2><strong>Customers</strong></h2> </div>
             <div style="float:right; padding-top:10px;">
                
			 <a href="<?php echo base_url('admin/customers/add/'); ?>" class="btn btn-primary btn-embossed"> New Customer</a>
			 		
			  <a href="<?php echo base_url('admin/contact_persons/add/'); ?>" class="btn btn-primary btn-embossed"> New Contact Person</a> 	
            </div>           
          </div>
            

            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	<input type="hidden" id="paginationValue" value="50"/>
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>
                      	<th>Company</th>
                        <th>City</th>
                        <!-- <th>State</th> -->
                        <th>Region</th>
                        <th>Contact Person</th>
                        <!-- <th>Email</th>
                        <th>Phone</th> -->
                        <th>Vertical</th>
                        <th>Subvertical</th>
                        <th>Website</th>
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      <?php //print_r($customers); exit;?>
                      <?php if( ! empty($customers) ){?>
					    <?php foreach( $customers as $customer){ ?>
	                      <tr id="customer_id_<?php echo $customer->id; ?>">
	                        <td><a href="<?php echo base_url('admin/customers/view/'.$customer->id); ?>"><?php echo $customer->name; ?></a></td>
                          <td><?php echo $customer->city ?></td>
                          <!-- <td><?php echo $customer->state_id ?></td> -->
                          <td><?php $region = $this->regions_model->get_region($customer->regions); echo $region->region; ?></td>
                          
	                        <td><a href="<?php echo base_url('admin/contact_persons/view/'.$this->customers_model->get_contact_person($customer->main_contact_person,'id')); ?>"><?php echo $this->customers_model->get_contact_person($customer->main_contact_person,'first_name'); ?> <?php echo $this->customers_model->get_contact_person($customer->main_contact_person,'last_name'); ?></a></td> 
                          <!-- <td><?php echo $customer->email; ?></td>
	                        <td><?php echo $customer->phone; ?></td> -->
                          <td><?php $vertical = $this->vertical_model->get_vertical($customer->vertical); echo $vertical->vertical_name; ?></td>
                          <td><?php $subvertical = $this->subverticals_model->get_subverticals($customer->subverticals);  echo $subvertical->subvertical_name; ?></td>
                          <td><?php echo $customer->website; ?></td>
	                        <td>
	                         
	                        
	                        <?php if($customer->company_attachment){?>
	                        <a href="<?php echo base_url('admin/customers/download/'.$customer->company_attachment);?>" class="edit btn btn-sm btn-success dlt_sm_table" title="Download"><i class="glyphicon glyphicon-download"></i></a>
	                        <?php }?>
	                        
                          <?php if (check_staff_permission('customers_write')){?>
	                        <a href="<?php echo base_url('admin/customers/update/'.$customer->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
                          <?php } ?>
	                        <?php if (check_staff_permission('customers_delete')){?>
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $customer->id; ?>"><i class="glyphicon glyphicon-trash"></i></a></td> 
                          <?php } ?>
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $customer->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            				<div class="modal-dialog">
              					<div class="modal-content">
					                <div class="modal-header">
					                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
					                  <h4 class="modal-title"><strong>Confirm</strong></h4>
					                </div>
					                <div class="modal-body">
					                  Are you sure you want to delete this?<br>
					                </div>
					                <div class="modal-footer">
					                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel</button>
					                  <button type="button" onclick="delete_customer(<?php echo $customer->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
					                </div>
             					 </div>
           					 </div>
        				  </div>
	                      
                    	 <?php } ?>
					 <?php } ?> 
                      
                      
                    </tbody>
                  </table>
                </div>
		   		</div>
			   </div>
		 	   	
       		 </div>
        </div>
        <!-- END PAGE CONTENT -->
      