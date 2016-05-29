<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("form[name='add_report_error']").submit(function (e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "<?php echo base_url('admin/help/add_process'); ?>",
                type: "POST",
                data: formData,
                async: false,
                success: function (msg) {
                    $('body,html').animate({scrollTop: 0}, 200);
                    $("#report_error_ajax").html(msg);
                    $("#help_submitbutton").html('<button type="submit" class="btn btn-embossed btn-primary">Save</button>');
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
	<h2><strong>Add Report Error</strong></h2>
    </div>
    <div class="row">

	<div class="panel">

	    <div class="panel-content">
		<div id="report_error_ajax">
		    <?php
		    if($this->session->flashdata('message'))
		    { echo $this->session->flashdata('message'); }
		    ?>
		</div>

		<form id="add_report_error" name="add_report_error" class="form-validation" accept-charset="utf-8" method="post">
		    <div class="row">

			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Module Name</label>
				<div class="append-icon">
				    <input type="text" name="module_name" value="" class="form-control">
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-6">
			    <div class="form-group">
				<label class="control-label">Comment</label>
				<div class="append-icon">
				    <textarea rows="8" name="comment" class="form-control"></textarea>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="text-left  m-t-20">
			<div id="help_submitbutton"><button type="submit" class="btn btn-embossed btn-primary">Create</button></div>

		    </div>
		</form>

	    </div>
	</div>

    </div>

</div>
<!-- END PAGE CONTENT -->
