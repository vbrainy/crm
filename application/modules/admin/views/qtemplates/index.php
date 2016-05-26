<script>

 function delete_qtemplate( qtemplate_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/qtemplates/delete' ); ?>/" + qtemplate_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#qtemplate_id_' + qtemplate_id).fadeOut('normal');
            }
        }

    });
       
 }

 </script>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Quotation Template</strong></h2> 
            <div style="float:right; padding-top:10px;">
               
			  <a href="<?php echo base_url('admin/qtemplates/add/'); ?>" class="btn btn-primary btn-embossed"> Create New</a> 	
            </div>           
          </div>
             
            <div class="row">
	           <div class="panel">																				<div class="panel-content">
           
           		<div class="panel-content pagination2 table-responsive">
            	
                  <table class="table table-hover table-dynamic ">
                    <thead>
                      <tr>                        
                        <th>Quotation Template</th>                                       
                        <th>Quotation Duration</th> 
                         
                        <th><?php echo $this->lang->line('options'); ?></th>     
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if( ! empty($qtemplates) ){?>
					    <?php foreach( $qtemplates as $qtemplate){ ?>
	                      <tr id="qtemplate_id_<?php echo $qtemplate->id; ?>">
	                       
	                        <td><?php echo $qtemplate->quotation_template; ?></td>	                         
	                        <td><?php echo $qtemplate->quotation_duration; ?> Days</td>
	                        
	                        <td style="width: 12%;">
	                        <a href="<?php echo base_url('admin/qtemplates/update/'.$qtemplate->id); ?>" class="edit btn btn-sm btn-default dlt_sm_table"><i class="icon-note"></i></a>
	                         <a href="javascript:void(0)" class="delete btn btn-sm btn-danger dlt_sm_table" data-toggle="modal" data-target="#modal-basic<?php echo $qtemplate->id; ?>"><i class="glyphicon glyphicon-trash"></i></a>
	                         </td> 
	                      </tr>
	                      <div class="modal fade" id="modal-basic<?php echo $qtemplate->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
					                  <button type="button" onclick="delete_qtemplate(<?php echo $qtemplate->id; ?>)" class="btn btn-primary btn-embossed" data-dismiss="modal">Delete</button>
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
      