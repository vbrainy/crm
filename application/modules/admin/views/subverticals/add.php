<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
  $("form[name='add_subvertical']").submit(function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?php echo base_url('admin/subverticals/add_process'); ?>",
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
      $('body,html').animate({ scrollTop: 0 }, 200);
            $("#subvertical_ajax").html(msg); 
      $("#subvertical_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
      
      $("form[name='add_subvertical']").find("input[type=text]").val("");
      
            
        },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    });
});
 
 
 </script>
 
 
 <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        <div class="header">
            <h2><strong>Add Sub vertical</strong></h2>            
          </div>
           <div class="row">
             
                  <div class="panel">
                     
                     <div class="panel-content">
                            <div id="subvertical_ajax"> 
                                  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>         
                              </div>
                 
                    <form id="add_subvertical" name="add_subvertical" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">
  
                                <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="control-label">Sub Vertical Name</label>
                                        <div class="append-icon">
                                          <input type="text" name="subvertical_name" value="" class="form-control">
                                           
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
                                          <option value="<?php echo $vertical->id;?>"><?php echo $vertical->vertical_name;?></option>
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
                              echo form_dropdown('status', $options,'','class="form-control"');?> 
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
                                              <input type="checkbox" name="active" value="1" checked data-checkbox="icheckbox_square-blue"/> 
                                               
                                            </div>
                                          </div>
                                        </div>
                                      
                                         </div>
                             
                            <div class="row">
                            <div class="col-sm-12">
                                          <div class="form-group">
                                         
                                        <div class="append-icon">
                                          
                                          <textarea name="description" rows="5" class="form-control" placeholder="describe the subvertical characteristics..."></textarea>   
                                        </div>
                                      </div>
                                         </div>
                            </div>
                                     </div>
                                    </div>
                          
                          
                                    
                                   
                                   
                                <div class="text-left  m-t-20">
                                 <div id="subvertical_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>
                           
                        </div>
                      </form>             
                              
                  </div>
                  </div>             
              
            </div>
              
     
  <!-- END PAGE CONTENT -->
 