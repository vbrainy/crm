<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_pricelist']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/pricelists/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#pricelist_ajax").html(msg); 
			$("#pricelist_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});
 
 
 </script>
 <script>
 
								 $(document).ready(function() {
								
								var MaxInputs       = 50; //maximum input boxes allowed
								var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
								var AddButton       = $("#AddMoreFileBox"); //Add button ID
								
								var x = InputsWrapper.length; //initlal text box count
								var FieldCount=1; //to keep track of text box added
								
								 
								
								$(AddButton).click(function (e)  //on add input button click
								{
												if(x <= MaxInputs) //max input box allowed
												{
														FieldCount++; //text box added increment
														//add input box
														$('#start_date').addClass('date-picker');
														
														$(InputsWrapper).append('<tr><td><input type="text" name="pricelist_version_name[]" value="" class="form-control"></td><td><input type="checkbox" name="active[]" value="1" checked data-checkbox="icheckbox_square-blue"/></td><td><input type="text" name="start_date[]" value="" class="date-picker form-control"></td><td><input type="text" name="end_date[]" value="" class="date-picker form-control"></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger removeclass" data-toggle="modal" data-target="#modal-basic"><i class="icons-office-52"></i></a></td></tr>');
														
														x++; //text box increment
												}
									 
								return false;
								});
								
								
								
								$("body").on("click",".removeclass", function(e){ //user click on remove text
												if( x > 1 ) {
																$(this).parent().parent().remove(); //remove text box
																x--; //decrement textbox
												}
								return false;
								}) 
								
								});

	$(document).on('focus',".date-picker", function(){
		    $(this).datepicker();
		}); 



//Delete 

function delete_version( version_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/pricelists/delete_version' ); ?>/" + version_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#version_id_' + version_id).fadeOut('normal');
            }
        }

    });
       
 }			
 </script>
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Update Pricelist</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="pricelist_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="update_pricelist" name="update_pricelist" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
                        				 
                        				<input  type="hidden" name="pricelist_id" value="<?php echo $pricelist->id;?>"/>                         
                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Pricelist Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="pricelist_name" value="<?php echo $pricelist->pricelist_name;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
				                                 <div class="form-group">
				                              <label class="control-label">Active</label>
				                              <div class="append-icon">
				                                <input type="checkbox" name="pricelist_status" <?php if($pricelist->pricelist_status){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue"/> 
				                                 
				                              </div>
				                            </div>
				                              </div>
					                        </div>
					                    <div class="row">
					                    	<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Currency</label>
					                              <div class="append-icon">
					                                 
					                                <select name="pricelist_currency" class="form-control" data-search="true">
					                                <option value="USD" <?php if($pricelist->pricelist_currency=="USD"){?>selected<?php }?>>USD</option>
					                                <option value="EUR" <?php if($pricelist->pricelist_currency=="EUR"){?>selected<?php }?>>EUR</option>
					                                 
					                                </select>
					                              </div>
					                            </div>
					                          </div>
					                    </div>
					                    <div class="row">
					                    
					                    	 <div class="panel-content">
                   									<label class="control-label">Pricelist Versions</label> 
                									 <table class="table">
									                    <thead>
									                      <tr style="font-size: 12px;">                         
									                        <th>Name</th>
									                        <th>Active</th>
									                        <th>Start Date</th>
									                        <th>End Date</th>
									                        <th></th>
									                      </tr>
									                    </thead>
									                    <tbody id="InputsWrapper">
									                      <?php if( ! empty($versions) ){?>
					    									<?php foreach( $versions as $version){ ?> 
									                      <tr id="version_id_<?php echo $version->id;?>"><td>
									                      <input type="hidden" name="version_id[]" id="version_id" value="<?php echo $version->id;?>" />
									                      <input type="text" name="pricelist_version_name[]" value="<?php echo $version->pricelist_version_name;?>" class="form-control" readonly></td><td><input type="checkbox" name="active[]" value="1" <?php if($version->active==1){?>checked<?php } ?> data-checkbox="icheckbox_square-blue" disabled/></td><td><input type="text" name="start_date[]" value="<?php echo date('m/d/Y',$version->start_date);?>" class="form-control" readonly></td><td><input type="text" name="end_date[]" value="<?php echo date('m/d/Y',$version->end_date);?>" class="form-control" readonly></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger removeclass" onclick="delete_version(<?php echo $version->id; ?>)"><i class="icons-office-52"></i></a></td></tr>
									                       <?php }
									                       	}
									                       ?>
									                    </tbody>
									                  </table>
									                  <a href="<?php echo base_url('admin/pricelist_versions/add'); ?>" id=""><button type="button" class="btn btn-sm btn-primary">Add an Version</button></a>
                 									 </div>
					                    	
					                    </div>   
					                     
					                        
                        				<div class="text-left  m-t-20">
                         				 <div id="pricelist_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 
