      <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="header">
            <h2><strong>Quotations</strong></h2> 
            <div class="breadcrumb-wrapper">
               
            </div>           
          </div>
             
            <div class="row">
	           <div class="panel">																				<div class="panel-content">
	           <div class="row">
					<div class="col-sm-3">
						<div class="form-group">
						  <label class="control-label">Start Date</label>
						  <div class="append-icon">
						    <input type="text" id="min" name="min" class="date-picker form-control">
						    <i class="icon-calendar"></i>
						  </div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
						  <label class="control-label">End Date</label>
						  <div class="append-icon">
						    <input type="text" id="max" name="max" class="date-picker form-control">
						    <i class="icon-calendar"></i>
						  </div>
						</div>
					</div>
				</div>
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic filter-between_date">
                    <thead>
                      <tr>                        
                        <th>Quotations Number</th>                                  <th>Date</th> 
                        <th>Customer</th> 
                        <th>Salesperson</th> 
                        <th>Total</th> 
                        <th>Status</th> 
                         
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($quotations) ){?>
					    <?php foreach( $quotations as $quotation){ ?>
	                      <tr id="quotation_id_<?php echo $quotation->id; ?>">
	                       
	                        <td><a href="<?php echo base_url('customer/quotations/view/'.$quotation->id); ?>"><?php echo $quotation->quotations_number; ?></a></td>	                         		<td><?php echo date('m/d/Y H:i',$quotation->date); ?></td>
	                        <td><?php echo customer_name($quotation->customer_id)->name; ?></td>
	         				<td><?php echo $this->staff_model->get_user_fullname($quotation->sales_person); ?></td>
	                        
	                        <td><?php echo $quotation->grand_total; ?></td>
	                        
	                        <td><?php echo $quotation->status; ?></td>
	                        
	                        <td style="width: 12%;"><a href="<?php echo base_url('customer/quotations/view/'.$quotation->id); ?>" class="edit btn btn-sm btn-default"><i class="fa fa-search-plus"></i></a>  </td> 
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
        <!-- END PAGE CONTENT -->
      