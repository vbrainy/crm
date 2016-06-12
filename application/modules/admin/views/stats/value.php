 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Value</strong></h2> 
		    </div>

		    
             
            <div class="row">
	           <div class="panel">		
	           	<div class="panel-content">
	           		<form method="post">
           		<div class="row">
			    	<div class="col-md-3">
			    		<select name="vertical">
			    			<option value="">Select Vertical</option>
			    			<?php foreach ($verticals as $key => $value) { ?>
			    				<option value="<?= $value->id ?>"><?= $value->vertical_name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-3">
			    		<select name="sub_vertical">
			    			<option value="">Select Sub-Vertical</option>
			    			<?php foreach ($sub_verticals as $key => $value) { ?>
			    				<option value="<?= $value->id ?>"><?= $value->subvertical_name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	
			    	<div class="col-md-3">
			    		<select name="customer">
			    			<option value="">Select Customers</option>
			    			<?php foreach ($customers as $key => $value) { ?>
			    				<?php $selected = ($value->id == $customer) ? 'selected=selected' : '' ?>
			    				<option value="<?= $value->id ?>" <?= $selected ?>><?= $value->name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-3">
			    		<input type="submit" class="btn btn-primary" value="Query"/>
			    	</div>
		    	</div>	
		    </form>
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>                        
                        <th>Opportunity</th> 
                        <!-- <th><?php echo $this->lang->line('options'); ?></th>      -->
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php //print_r($result); ?>
                      <?php if(!empty($result)) {?>
					    <?php foreach($result as $value){ ?>
	                      <tr id="category_id_<?php echo $value->id; ?>">
	                       
	                        <td><?php echo $value['opportunity']; ?></td>
	                                              
	                        <!-- <td style="width: 12%;">
	                        
	                        <a href="<?php echo base_url('admin/category/update/'.$category->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a> 
	                        
	                        <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $category->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                        </td>  -->
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $category->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_category(<?php echo $category->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      