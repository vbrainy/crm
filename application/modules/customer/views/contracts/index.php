
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="header">
            <h2><strong>Contracts</strong></h2> 
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
                        <th>Start Date</th>
                        <!--<th>End Date</th>-->
                        <th>Description</th>
                        
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($contracts) ){?>
					    <?php foreach( $contracts as $contract){ ?>
	                      <tr id="contract_id_<?php echo $contract->id; ?>">
	              
	              			<td><?php echo date('m/d/Y',$contract->start_date); ?></td> 
	              			<!--<td><?php echo date('m/d/Y',$contract->end_date); ?></td>-->           
	                        <td><?php echo $contract->description; ?></td>
	              
	              			  
	                        <td style="width: 22%;">
	                        
	                        
	                        
	                        <?php 
	                        $next_week= strtotime(date('m/d/Y',strtotime('+'.config('contract_renewal_days').' days'))); 
			               	 
			               	$expiration_date= $contract->end_date;
			               	$today= strtotime(date('m/d/Y'));?>
			         <?php if ($expiration_date < $today) 
			         		{ 
			               ?>
			               
			               <a href="#" class="edit btn btn-sm btn-warning dlt_sm_table" data-rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Contract has been expired"><i class="icon-info"></i></a>
			                
			         <?php } else if( $expiration_date <= $next_week) { 
			               ?>
			               <a href="#" class="edit btn btn-sm btn-dark dlt_sm_table" data-rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Contract will expire within the few days"><i class="icon-info"></i></a>
			                
			               <?php }?>
			                
			                <?php if($contract->real_signed_contract){?>
	                        <a href="<?php echo base_url('admin/contracts/download/'.$contract->real_signed_contract);?>" class="edit btn btn-sm btn-success dlt_sm_table" title="Download"><i class="glyphicon glyphicon-download"></i></a>
	                        <?php }?>
	                        
	                        
	                        </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $contract->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_contracts(<?php echo $contract->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      