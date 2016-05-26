<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="row">
            <h2 class="col-md-6"><strong><?php echo $pricelist->pricelist_name;?></strong></h2> 
            <div style="float:right; padding-top:10px;">
               <?php if (check_staff_permission('pricelists_write')){?>
               <a href="<?php echo base_url('admin/pricelists/update/'.$pricelist->id); ?>" class="btn btn-primary">Edit</a>
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
					                              <label class="col-sm-4 control-label"><i class="fa fa-plus-square"></i>Active</label>
					                              <div class="col-sm-8 append-icon">
					                                <input type="checkbox" name="pricelist_status" <?php if($pricelist->pricelist_status){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue" disabled=""/> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 <div class="row">
					           		                 <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-money"></i>Currency</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo $pricelist->pricelist_currency;?>
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												  
												  
					                          </div>
					                        </div>    
                        			     
                        			     <div class="row">
                        			     	
                        			     	<div class="panel-content">
                   									<label class="control-label"><i class="fa fa-list-alt"></i>Pricelist Versions</label> 
                									 <table class="table">
									                    <thead>
									                      <tr style="font-size: 12px;">                         
									                        <th>Name</th>
									                        <th>Active</th>
									                        <th>Start Date</th>
									                        <th>End Date</th>
									                        
									                      </tr>
									                    </thead>
									                    <tbody id="InputsWrapper">
									                      <?php if( ! empty($versions) ){?>
					    									<?php foreach( $versions as $version){ ?> 
									                      <tr id="version_id_<?php echo $version->id;?>">
									                      <td><?php echo $version->pricelist_version_name;?></td>
									                      <td><input type="checkbox" name="active[]" value="1" <?php if($version->active==1){?>checked<?php } ?> data-checkbox="icheckbox_square-blue" disabled=""/></td>
									                      <td><?php echo date('m/d/Y',$version->start_date);?></td>
									                      <td><?php echo date('m/d/Y',$version->end_date);?></td
									                      </tr>
									                       <?php }
									                       	}
									                       ?>
									                    </tbody>
									                  </table>
									                  
                 									 </div>
                        			     	
                        			     </div>
                        			 
				                         
				                         
                        			 
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
