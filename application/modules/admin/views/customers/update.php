<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        $("form[name='update_customer']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo base_url('admin/customers/update_process'); ?>",
                type: "POST",
                data: formData,
                async: false,
                success: function (msg) {
                    $('body,html').animate({scrollTop: 0}, 200);
                    $("#customer_ajax").html(msg);
                    $("#customer_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');

                    $('#password,#company_avatar,#uploader').val('');


                },
                cache: false,
                contentType: false,
                processData: false
            });

            e.preventDefault();
        });
    });


//Contact Person
    $(document).ready(function () {
        $(':input#main_contact_person').live('change', function () {
            var sel_opt = $(this).val();
            //alert(sel_opt);
            if (sel_opt == 'creat_new')
            {
                model_hide_show();
                $("#main_contact_person").each(function () {
                    this.selectedIndex = 0
                });
            }

        });

    });

    //Modal Open and Close
    function model_hide_show()
    {
        //$("#modal-all_calls").removeClass("fade").modal("hide");
        $("#modal-create_contact_person").modal("show").addClass("fade");

    }
//Contact Person
    $(document).ready(function () {
        $("form[name='add_contact_person']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo base_url('admin/contact_persons/add_process_ajax'); ?>",
                type: "POST",
                data: formData,
                dataType: 'json',
                async: false,
                success: function (data) {
                    $('body,html').animate({scrollTop: 0}, 200);

                    /*  $('#main_contact_person').prepend($('<option>', {
                     value: data.co_person_id,
                     text: data.co_person_name,
                     selected: true
                     }));
                     */
                    $("#main_contact_person option:first").after($('<option>', {
                        value: data.co_person_id,
                        text: data.co_person_name,
                        selected: true
                    }));

                    if (data.co_person_id)
                    {
                        $("#contact_person_ajax").html("Contact person create succesful");
                    }

                    $("#contact_person_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');

                    $("form[name='add_contact_person']").find("input[type=text], textarea").val("");

                },
                cache: false,
                contentType: false,
                processData: false
            });

            e.preventDefault();
        });
    });


    function getsubverticals(id)
    {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('admin/customers/ajax_subvertical_list') . '/'; ?>' + id,
            //data: id = 'cat_id',
            success: function (data) {
                console.log(data);
                $("#subverticals").html(data);
                $('#loader').slideUp(200, function () {
                    $(this).remove();
                });
            },
        });
    }

</script>

<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
    <div class="row">
	<h2 class="col-md-6"><strong>Update Customer</strong></h2>

    </div>
    <div class="row">

	<div class="panel">

	    <div id="test_div_id" class="panel-content">
		<div id="customer_ajax">
		    <?php
		    if($this->session->flashdata('message'))
		    { echo $this->session->flashdata('message'); }
		    ?>
		</div>

		<form id="update_customer" name="update_customer" class="form-validation" accept-charset="utf-8" enctype="multipart/form-data" method="post">

		    <input type="hidden" name="company_id" value="<?php echo $customer->id; ?>" />
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Company Name</label>
				<div class="append-icon">
				    <input type="text" name="name" value="<?php echo $customer->name; ?>" class="form-control">

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Street # and Name</label>
				<div class="append-icon">
				    <input type="text" name="address" value="<?php echo $customer->address; ?>" class="form-control">
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Main Contact Person</label>
				<div class="append-icon">
				    <select name="main_contact_person" id="main_contact_person" class="form-control" data-search="true">
					<option value=""></option>
					<?php
					foreach($contact_persons as $contact_person)
					{
					    ?>
    					<option value="<?php echo $contact_person->id; ?>" <?php
					    if($contact_person->id == $customer->main_contact_person)
					    {
						?>selected<?php } ?>><?php echo $contact_person->first_name . ' ' . $contact_person->last_name; ?></option>
						<?php } ?>
				    </select>
				</div>
			    </div>
			</div>

			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Contact Person 2</label>
				<div class="append-icon">
				    <select name="contact_person" id="contact_person" class="form-control" data-search="true">
					<option value=""></option>
					<?php
					foreach($contact_persons as $contact_person)
					{
					    ?>
    					<option value="<?php echo $contact_person->id; ?>" <?php
					    if($contact_person->id == $customer->contact_person)
					    {
						?>selected<?php } ?>><?php echo $contact_person->first_name . ' ' . $contact_person->last_name; ?></option>
						<?php } ?>
				    </select>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">City</label>
				<div class="append-icon">
				    <input type="text" name="city" value="<?php echo $customer->city; ?>" class="form-control">
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">State</label>
				<select name="state_id" id="state_id" class="form-control" data-search="true">
				    <option value="" selected="selected">Select State</option>
				    <?php
				    foreach($states as $state)
				    {
					?>
    				    <option value="<?php echo $state->id; ?>" <?php
					if($customer->state_id == $state->id)
					{
					    ?> selected="selected"<?php } ?>><?php echo $state->name; ?></option>
					    <?php } ?>
				</select>
			    </div>
			</div>
		    </div>

		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Phone</label>
				<div class="append-icon">
				    <input type="text" name="phone" value="<?php echo $customer->phone; ?>" class="form-control">
				    <i class="icon-screen-smartphone"></i>
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Fax</label>
				<div class="append-icon">
				    <input type="text" name="fax" value="<?php echo $customer->fax; ?>" class="form-control">
				    <i class="icon-screen-smartphone"></i>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Email</label>
				<div class="append-icon">
				    <input type="email" name="email" value="<?php echo $customer->email; ?>" class="form-control">
				    <i class="icon-envelope"></i>
				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Website</label>
				<div class="append-icon">
				    <input type="text" name="website" value="<?php echo $customer->website; ?>" class="form-control">
				    <i class="icon-globe"></i>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Annual turnover</label>
				<div class="append-icon">
				    <input type="text" name="annual_turnover" value="<?php echo $customer->annual_turnover; ?>"  class="form-control">

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Region</label>
				<div class="append-icon">
				    <select name="regions" class="form-control" data-search="true">
					<option value=""></option>
					<?php
					foreach($regions as $region)
					{
					    ?>
    					<option value="<?php echo $region->id; ?>" <?php
					    if($region->id == $customer->regions)
					    {
						?>selected<?php } ?>><?php echo $region->region; ?></option>
						<?php } ?>
				    </select>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Number of employees</label>
				<div class="append-icon">
				    <input type="text" name="number_employees" value="<?php echo $customer->number_employees; ?>"  class="form-control">

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Number of domestic branches</label>
				<div class="append-icon">
				    <input type="text" name="domestic_branches" value="<?php echo $customer->domestic_branches; ?>"  class="form-control">

				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Number of int’l branches</label>
				<div class="append-icon">
				    <input type="text" name="int_branches" value="<?php echo $customer->int_branches; ?>"  class="form-control">
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
					    <input type="file" class="custom-file" name="company_avatar" id="company_avatar" onchange="document.getElementById('uploader').value = this.value;">
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
				<label class="control-label">Vertical</label>
				<div class="append-icon">

				    <select name="vertical" class="form-control" data-search="true" onChange="getsubverticals(this.value)">
					<option value="">Select Vertical</option>
					<?php
					foreach($verticals as $vertical)
					{
					    ?>
    					<option value="<?php echo $vertical->id; ?>"<?php
					    if($vertical->id == $customer->vertical)
					    {
						?>selected<?php } ?>><?php echo $vertical->vertical_name; ?></option>
						<?php } ?>
				    </select>

				</div>
			    </div>
			</div>
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">SubVertical</label>
				<div class="append-icon">

				    <select name="subverticals" id="subverticals" class="form-control" data-search="true">
					<option value="">Select Subvertical</option>
					<?php
					$subverticals = $this->customers_model->subvertical_list_by_vertical_id($customer->vertical_id);
					foreach($subverticals as $subvertical)
					{
					    ?>
    					<option value="<?php echo $subvertical->id; ?>"<?php
					    if($subvertical->id == $customer->subverticals)
					    {
						?>selected<?php } ?>><?php echo $subvertical->subvertical_name; ?></option>
						<?php } ?>
				    </select>

				</div>
			    </div>
			</div>
		    </div>
		    <div class="text-left  m-t-20">
			<div id="customer_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Update</button></div>

		    </div>
		</form>

	    </div>
	</div>

    </div>

</div>
<!-- END PAGE CONTENT -->