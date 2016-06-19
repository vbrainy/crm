 <script type="text/javascript">
$(document).ready(function(){
//If parent option is changed
$("#product_id").change(function() {
		$('#category_id').html('');
        var parent = $(this).val(); //get option value from parent 
        getProductCategories(parent);
	});
});
function getProductCategories(product_id){
	var url = "<?php echo base_url() ?>"+'admin/category/get_prod_cat';

	$.ajax({
		url: url, 
		method: 'post',
		data: {'product_id': product_id},
		success: function(result){
			$('#category_id').html(result);
    }});
}

 </script>
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Database Query</strong></h2> 
		    </div>
            <div class="row">
	           <div class="panel">		
	           	<div class="panel-content">
	           		<form method="post">
	           			<div class="row">
	           				<div class="col-md-2">Vertical</div>
	           				<div class="col-md-2">Sub-Vertical</div>
	           				<div class="col-md-2">Stage</div>
	           				<div class="col-md-2">Segments</div>
	           				<div class="col-md-2">Category</div>
	           				<div class="col-md-2">Product</div>
	           			</div>
           		<div class="row">
			    	<div class="col-md-2">
			    		<select name="vertical" style="width: 150px;">
			    			<option value="all">All</option>
			    			<?php foreach ($verticals as $key => $value) { ?>
			    				<?php $selected = ($value->id == $vertical) ? 'selected=selected' : '' ?>
			    				<option value="<?= $value->id ?>" <?= $selected ?>><?= $value->vertical_name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="sub_vertical" style="width: 150px;">
			    			<option value="all">All</option>
			    			<?php foreach ($sub_verticals as $key => $value) { ?>
			    				<?php $selected = ($value->id == $sub_vertical) ? 'selected=selected' : '' ?>
			    				<option value="<?= $value->id ?>" <?= $selected ?>><?= $value->subvertical_name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-2">

			    		<select name="stage" style="width: 150px;">
			    			<option value="all">All</option>

			    			<?php foreach ($stages as $key => $value) { ?>
			    				<?php $selected = ($key == $stage) ? 'selected=selected' : '' ?>
			    				<option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="segment" style="width: 150px;">
			    			<option value="all">All</option>
			    			<?php foreach ($segments as $key => $value) { ?>
			    				<?php $selected = ($value->id == $segment) ? 'selected=selected' : '' ?>
			    				<option value="<?= $value->id ?>" <?= $selected ?>><?= $value->segment ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="category" id="product_id1" style="width: 150px;">
			    			<option value="all">All</option>
			    			<?php foreach ($categories as $key => $value) { ?>
			    				<?php $selected = ($value->id == $category) ? 'selected=selected' : '' ?>
			    				<option value="<?= $value->id ?>" <?= $selected ?>><?= $value->product_name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="product" id="category_id1" style="width: 150px;">
			    			<option value="all">All</option>
			    			<?php foreach ($products as $key => $value) { ?>
			    				<?php $selected = ($value->id == $product) ? 'selected=selected' : '' ?>
			    				<option value="<?= $value->id ?>" <?= $selected ?>><?= $value->category_name ?></option>
			    			<?php } ?>
			    		</select>
			    	</div>
		    	</div>
    	
		    	<div style="margin: 10px; 0; 10px;"></div>	
		    	<div class="row">
		    	<div class="col-md-12">
			    		<input type="submit" class="btn btn-primary" value="Query"/>
			    	</div>
			    </div>

		    </form>
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>                        
                        <th>Opportunity</th> 
                        <th>Customer</th> 
                        <th>Product</th> 
                        <th>Stage</th> 
                        <th>One time fee</th> 
                        <th>Annual recurring fee</th> 
                        <th>Segment</th> 
						<th>Region</th> 
						<th>Next Action</th> 
						<th>Next Action Date</th> 
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php //print_r($result); ?>
                      <?php if(!empty($result)) {?>
					    <?php foreach($result as $value){ ?>
	                      <tr id="category_id_<?php echo $value->id; ?>">
	                       
	                        <td><?php echo $value['opportunity']; ?></td>
	                        <td><?php echo customer_name($value['customer'])->name; ?></td>
	                        <td><?php $product = $this->category_model->get_category($value['category_id']); echo $product->category_name; ?></td>
	                        <td><?php echo $value['stages']; ?></td>
	                        <td><?php echo $value['total_one_time_fee']; ?></td>
	                        <td><?php echo $value['total_rec_fee']; ?></td>
	                        <td><?php echo $this->staff_model->get_segment_by_user($value['salesperson_id'])->segment; ?></td>
	                        <td><?php echo $this->staff_model->get_region_by_user($value['salesperson_id'])->region; ?></td>
	                        <td><?php echo $value['next_action_title']; ?></td>
	                        <td><?php echo $value['next_action']; ?></td>
	                                              
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
      