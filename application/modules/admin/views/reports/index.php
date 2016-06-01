<script type="text/javascript">
    function update_report_status(status, id)
    {
        var data = {};
        data.status = status;
        data.report_id = id;
        $.ajax({
            type: "GET",
            data: data,
            url: "<?php echo base_url('admin/reports/update_status'); ?>",
            success: function (result)
            {
                $('body,html').animate({scrollTop: 0}, 200);
                $("#reports_ajax").html(result);
            }

        });
    }
</script>
<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
    <div class="row">
	<div class="panel">																				<div class="panel-content">
		<div id="reports_ajax">
		    <?php
		    if($this->session->flashdata('message'))
		    { echo $this->session->flashdata('message'); }
		    ?>
		</div>
		<div class="panel-content pagination2 table-responsive">

		    <table class="table table-hover table-dynamic ">
			<thead>
			    <tr>
				<th>Module Name</th>
				<th>Comment</th>
				<th><?php echo $this->lang->line('options'); ?></th>
			    </tr>
			</thead>
			<tbody>

			    <?php
			    if(!empty($reports))
			    {
				?>
				<?php
				foreach($reports as $report)
				{
				    ?>
				    <tr id="report_id_<?php echo $report->id; ?>">
					<td width="10%"><?php echo $report->module_title; ?></a></td>
					<td width="60%"><?php echo $report->comment; ?></td>
					<td style="width: 12%;">
					    <?php
					    //if(check_staff_permission('update_status'))
					    // {
					    ?>
					    <select name="status" onChange="update_report_status(this.value,<?php echo $report->id ?>)">
						<option value="0" <?php
						if($report->status == 0)
						{
						    ?>selected<?php } ?> >Pending</option>
						<option value="1" <?php
						if($report->status == 1)
						{
						    ?>selected<?php } ?>>Resolved</option>
					    </select>
					    <?php //}  ?>
					</td>
				    </tr>
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
