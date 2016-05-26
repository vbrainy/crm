

 <script>

 function lostpw()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('member/lostpassword_process'); ?>",
        data: $("#lostpassword").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            
			$("#ajax").html(msg); 

            $("#submitbutton").html('<button type="submit" class="btn btn-primary pull-right" onClick="lostpw()"><?php echo $this->lang->line('send'); ?></button>');
            
        }

    });

 }

 </script>

   
   <div class="wrapper">
		<div class="container">
			<div class="row">
 
					 <!-- Register Form -->

					 <div class="module module-login span4 offset4">
					 
					<form id="lostpassword" class="form-vertical">
						<div class="module-head">
							<h3><?php echo $this->lang->line('forgot_password_title'); ?></h3>
						</div>
						<div class="module-body">
						<div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>

							<div class="control-group">
								<div class="controls row-fluid">
									  
									<input type="text" name="email" value="" maxlength="50"  class="span12 typeahead" placeholder="Email"/>
								</div>
							</div>
							 
						</div>
						
						<div class="module-foot">
							<div class="control-group">
								 
								<div class="controls clearfix">
 									 <div id="submitbutton"><button type="submit" class="btn btn-primary pull-right" onClick="lostpw()"><?php echo $this->lang->line('send'); ?></button></div>
								</div>
								 
							</div>
						</div>
					</form>
				</div>
						 
			</div>
		</div>
	</div><!--/.wrapper-->
