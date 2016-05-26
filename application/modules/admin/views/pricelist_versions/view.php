<!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="row">
            <h2 class="col-md-6"><strong><?php echo $pricelist_version->pricelist_version_name;?></strong></h2> 
            <div style="float:right; padding-top:10px;">
               <a href="<?php echo base_url('admin/pricelist_versions/update/'.$pricelist_version->id); ?>" class="btn btn-primary">Edit</a>
                
			    		
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
					                              <label class="col-sm-4 control-label"><i class="fa fa-list-ul"></i>Price List</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo $this->pricelists_model->get_pricelist($pricelist_version->pricelist_id)->pricelist_name; ?>   
					                              </div>
					                              
					                            </div>
												</div>
												</div>
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-plus-square"></i>Active</label>
					                              <div class="col-sm-8 append-icon">
					                                <input type="checkbox" name="active" <?php if($pricelist_version->active){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue" disabled=""/> 
					                                
					                              </div>
					                              
					                            </div>
												</div>
												</div> 
												 
												  
					                          </div>
												<div class="col-sm-6">
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-calendar"></i>Start Date</label>
					                              <div class="col-sm-8 append-icon">
					                               <?php echo date('m/d/Y', $pricelist_version->start_date);?>
					                              </div>
					                              
					                            </div>
												</div>
												</div>
					                            <div class="row">
					                            <div class="col-sm-12">
					                          	  <div class="form-group">
					                              <label class="col-sm-4 control-label"><i class="fa fa-calendar"></i>End Date</label>
					                              <div class="col-sm-8 append-icon">
					                                <?php echo date('m/d/Y', $pricelist_version->end_date);?>
					                                
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
									                        <th>Product</th>
									                        <th>Description</th> 
									                        <th>Unit Price</th> 
									                        <th>Special Price</th>
									                        <th></th>
									                      </tr>
									                    </thead>
									                    <tbody id="InputsWrapper">
									                     <?php if( ! empty($pricelist_version_product) ){?>
					    									<?php foreach( $pricelist_version_product as $pricelist_ver_product){ ?> 
									                     <tr id="product_id_<?php echo $pricelist_ver_product->id;?>">
									                     <td>
														 <?php echo $pricelist_ver_product->product_name;?>
														 	
														 </td>
														 <td>
														 <?php echo $pricelist_ver_product->discription;?>
														 	
														 </td>
														 <td>
														 <?php echo $pricelist_ver_product->price;?>
														 	
														 </td>
														 <td>
														 <?php echo $pricelist_ver_product->special_price;?>
														 	
														 </td>
									                      </tr> 
									                       
									                     <?php
									                      }
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
