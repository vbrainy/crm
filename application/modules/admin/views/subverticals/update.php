<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
	$("form[name='update_subvertical']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/subverticals/update_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
			$('body,html').animate({ scrollTop: 0 }, 200);
            $("#subvertical_ajax").html(msg); 
			$("#subvertical_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
			
			  
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
							$(InputsWrapper).append('<tr><td><input type="text" name="attribute_name[]" value="" class="form-control"></td><td><input type="text" name="subvertical_attribute_value[]" value="" class="form-control"></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger removeclass" data-toggle="modal" data-target="#modal-basic"><i class="icons-office-52"></i></a></td></tr>');
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
	
	
//Delete 

function delete_variant( variant_id )
 {
     
    $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/subverticals/delete_variant' ); ?>/" + variant_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#variant_id_' + variant_id).fadeOut('normal');
            }
        }

    });
       
 }	
 </script>
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Update subvertical</strong></h2>            
          </div>
           <div class="row">
           	 
                  <div class="panel">
                     
                     <div class="panel-content">
                   					<div id="subvertical_ajax"> 
				                          <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
				                      </div>
				         
				            <form id="update_subvertical" name="update_subvertical" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
 
                        				<input  type="hidden" name="subvertical_id" value="<?php echo $subvertical->id;?>"/>                        				 
                        				<div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">subvertical Name</label>
					                              <div class="append-icon">
					                                <input type="text" name="subvertical_name" value="<?php echo $subvertical->subvertical_name;?>" class="form-control">
					                                 
					                              </div>
					                            </div>
					                          </div>
					                         </div>
					                     <div class="row">
                          					<div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Vertical</label>
					                              <div class="append-icon">
					                                 
					                                 <select name="vertical_id" class="form-control" data-search="true">
					                                <option value=""></option>
					                                <?php foreach( $verticals as $vertical){ ?>
					                                <option value="<?php echo $vertical->id;?>"<?php if($subvertical->vertical_id==$vertical->id){?>selected<?php }?>><?php echo $vertical->vertical_name;?></option>
					                                <?php }?> 
					                                </select>
					                                 
					                              </div>
					                            </div>
					                          </div>
					                          <div class="col-sm-6">
					                            <div class="form-group">
					                              <label class="control-label">Status</label>
					                              <div class="append-icon">
					                                 
					                                 <?php $options = array(
											                  ''  => '',
											                  'In Development'  => 'In Development',
											                  'Normal'    => 'Normal',
											                  'End of Lifecycle'   => 'End of Lifecycle',
											                  'Obsolete'   => 'Obsolete',
											                ); 
															echo form_dropdown('status', $options,$subvertical->status,'class="form-control"');?>	
					                              </div>
					                            </div>
					                          </div>
					                      </div>    
										  
					                     <ul class="nav nav-tabs">
				                        <li class="active"><a href="#tab1_1" data-toggle="tab">Information</a></li>
				                                            
				                      </ul>
					                     <div class="tab-content">
						                        <div class="tab-pane fade active in" id="tab1_1">
							                           <div class="panel-body bg-white">
						                 			  		   											 				  							  <div class="row">
                          							   
	                          							 <div class="col-sm-6">
							                            <div class="form-group">
							                              <label class="control-label">Active</label>
							                              <div class="append-icon">
							                                <input type="checkbox" name="active" <?php if($subvertical->active==1){?>checked<?php }?> value="1" data-checkbox="icheckbox_square-blue"/> 
							                                 
							                              </div>
							                            </div>
							                          </div>
                          					 	
					                    			     </div>
														<div class="row">
														<div class="col-sm-12">
					                            		<div class="form-group">
					                               
					                              <div class="append-icon">
					                                
					                                <textarea name="description" rows="5" class="form-control" placeholder="describe the product characteristics..."><?php echo $subvertical->description;?></textarea>   
					                              </div>
					                            </div>
					                         			 </div>
														</div>
							               			   </div>
						                        </div>
					                        </div>
                        				   
                        				<div class="text-left  m-t-20">
                         				 <div id="subvertical_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>
                           
                        </div>
                      </form>             
                  				    
                  </div>
                  </div>
                 
           	</div>
            	
 		</div>   
  <!-- END PAGE CONTENT -->
 