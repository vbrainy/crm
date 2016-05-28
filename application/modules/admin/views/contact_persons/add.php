<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("form[name='add_contact_person']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo base_url('admin/contact_persons/add_process'); ?>",
                type: "POST",
                data: formData,
                async: false,
                success: function (msg) {
                    $('body,html').animate({scrollTop: 0}, 200);
                    $("#contact_person_ajax").html(msg);
                    $("#contact_person_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
                    //$("form[name='add_contact_person']").find("input[type=text], textarea").val("");
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
	<h2><strong>Add Contact Person</strong></h2>
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

		<form id="add_contact_person" name="add_contact_person" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">


		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">First Name</label>
				<div class="append-icon">
				    <input type="text" name="first_name" value="" class="form-control">
				    <i class="icon-user"></i>
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Last Name</label>
				<div class="append-icon">
				    <input type="text" name="last_name" value="" class="form-control">
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
				    <input type="text" name="job_position" value="" class="form-control">

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Phone</label>
				<div class="append-icon">
				    <input type="text" name="phone" value="" class="form-control">
				    <i class="icon-screen-smartphone"></i>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Mobile</label>
				<div class="append-icon">
				    <input type="text" name="mobile" value="" class="form-control">
				    <i class="icon-screen-smartphone"></i>
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Fax</label>
				<div class="append-icon">
				    <input type="text" name="fax" value="" class="form-control">
				    <i class="icon-screen-smartphone"></i>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Title</label>
				<div class="append-icon">
				    <input type="text" name="title" value="" class="form-control">

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Company</label>
				<div class="append-icon">

				    <select name="company" class="form-control" data-search="true">
					<option value=""></option>
					<?php
					foreach($companies as $company)
					{
					    ?>
    					<option value="<?php echo $company->id; ?>"><?php echo $company->name; ?></option>
					<?php } ?>
				    </select>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Email</label>
				<div class="append-icon">
				    <input type="email" name="email" value="" class="form-control">
				    <i class="icon-envelope"></i>
				</div>
			    </div>
			</div>

		    </div>
		    <div class="row">
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
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Main Contact Person</label>
				<div class="append-icon">
				    <input type="checkbox" name="main_contact_person" value="1" data-checkbox="icheckbox_square-blue"/>

				</div>
			    </div>
			</div>
		    </div>

		    <div class="text-left  m-t-20">
			<div id="contact_person_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>

		    </div>
		</form>

	    </div>
	</div>

    </div>

</div>
<!-- END PAGE CONTENT -->
