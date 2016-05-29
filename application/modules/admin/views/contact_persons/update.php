<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        $("form[name='update_contact_person']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo base_url('admin/contact_persons/update_process'); ?>",
                type: "POST",
                data: formData,
                async: false,
                success: function (msg) {
                    $('body,html').animate({scrollTop: 0}, 200);
                    $("#contact_person_ajax").html(msg);
                    $("#contact_person_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');

                    $('#password,#customer_avatar,#uploader').val('');


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
	<h2><strong>Update Contact Person</strong></h2>
    </div>
    <div class="row">

	<div class="panel">

	    <div class="panel-content">
		<div id="contact_person_ajax">
		    <?php
		    if($this->session->flashdata('message'))
		    { echo $this->session->flashdata('message'); }
		    ?>
		</div>

		<form id="update_contact_person" name="update_contact_person" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">

		    <input type="hidden" name="customer_id" value="<?php echo $contact_person->id; ?>" />
		    <div class="row">
			<div class="col-sm-1">
			    <div class="form-group">
				<label class="control-label">Title</label>
				<div class="append-icon">
				    <select name="title">
					<option value="Mr">Mr</option>
					<option value="Mrs">Mrs</option>
					<option value="Miss">Miss</option>
				    </select>
				</div>
			    </div>
			</div>
			<div class="col-sm-5">
			    <div class="form-group">
				<label class="control-label">First Name</label>
				<div class="append-icon">
				    <input type="text" name="first_name" value="<?php echo $contact_person->first_name; ?>" class="form-control">
				    <i class="icon-user"></i>
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Last Name</label>
				<div class="append-icon">
				    <input type="text" name="last_name" value="<?php echo $contact_person->last_name; ?>" class="form-control">
				    <i class="icon-user"></i>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Job Position</label>
				<div class="append-icon">
				    <input type="text" name="job_position" value="<?php echo $contact_person->job_position; ?>" class="form-control">
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Email</label>
				<div class="append-icon">
				    <input type="email" name="email" value="<?php echo $contact_person->email; ?>" class="form-control">
				    <i class="icon-envelope"></i>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Company</label>
				<div class="append-icon">
				    <select name="company" class="form-control" data-search="true">
					<option value="">Select Company</option>
					<?php
					foreach($companies as $company)
					{
					    ?>
    					<option value="<?php echo $company->id; ?>" <?php
					    if($company->id == $contact_person->company)
					    {
						?>selected<?php } ?>><?php echo $company->name; ?></option>
						<?php } ?>
				    </select>

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Upload your avatar</label>
				<div class="append-icon">
				    <div class="file">
					<div class="option-group">
					    <span class="file-button btn-primary">Choose File</span>
					    <input type="file" class="custom-file" name="customer_avatar" id="customer_avatar" onchange="document.getElementById('uploader').value = this.value;">
					    <input type="text" class="form-control" id="uploader" placeholder="no file selected" readonly="">
					</div>
				    </div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Main Contact Person</label>
				<div class="append-icon">
				    <input type="checkbox" name="main_contact_person" value="1" <?php
				    if($main_contact->main_contact_person == $contact_person->id)
				    {
					?>checked<?php } ?> data-checkbox="icheckbox_square-blue"/>

				</div>
			    </div>
			</div>
		    </div>

		    <div class="text-left  m-t-20">
			<div id="contact_person_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>

		    </div>
		</form>

	    </div>
	</div>

    </div>

</div>
<!-- END PAGE CONTENT -->













