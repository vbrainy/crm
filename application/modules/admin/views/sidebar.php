<div class="sidebar">
    <div class="logopanel">
	<a href="<?php echo base_url('admin/dashboard/'); ?>"><img src="<?php echo base_url('uploads/site') . '/' . config('site_logo'); ?>" alt="company logo" class="" style="height: 30px;"></a>

    </div>
    <div class="sidebar-inner">

	<div class="menu-title">
            Navigation
            <!--<div class="pull-right menu-settings">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-delay="300">
              <i class="icon-settings"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#" id="reorder-menu" class="reorder-menu">Reorder menu</a></li>
                <li><a href="#" id="remove-menu" class="remove-menu">Remove elements</a></li>
                <li><a href="#" id="hide-top-sidebar" class="hide-top-sidebar">Hide user &amp; search</a></li>
              </ul>
            </div>-->
	</div>


	<ul class="nav nav-sidebar">
            <li class=" nav-active <?php echo is_active_menu('dashboard'); ?>"><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>



	    <?php
	    if(check_staff_permission('opportunities_read'))
	    {
		?>
    	    <li class=" nav-active <?php echo is_active_menu('opportunities'); ?>"><a href="<?php echo base_url('admin/opportunities'); ?>"><i class="icon-key"></i><span>Opportunities</span></a></li>
	    <?php } ?>




            <li class=" nav-parent <?php echo is_active_menu('customers'); ?><?php echo is_active_menu('contact_persons'); ?>">
		<a href="#"><i class="icon-user"></i><span>Customers</span> <span class="fa arrow"></span></a>
		<ul class="children collapse">

		    <li class="<?php echo is_active_menu('customers'); ?>"><a href="<?php echo base_url('admin/customers'); ?>">Customers</a></li>

		    <li class="<?php echo is_active_menu('contact_persons'); ?>"><a href="<?php echo base_url('admin/contact_persons'); ?>">Contact Persons</a></li>
		</ul>
            </li>

	    <?php
	    if(check_staff_permission('products_read'))
	    {
		?>

    	    <li class="nav-parent <?php echo is_active_menu('category'); ?><?php echo is_active_menu('products'); ?>">
    		<a href="#"><i class="fa fa-cubes"></i><span>Products</span> <span class="fa arrow"></span></a>
    		<ul class="children collapse">
    		    <li class="<?php echo is_active_menu('products'); ?>"><a href="<?php echo base_url('admin/products'); ?>"> Products</a></li>
    		    <li class="<?php echo is_active_menu('category'); ?>"><a href="<?php echo base_url('admin/category'); ?>"> Category</a></li>
    		</ul>
    	    </li>
	    <?php } ?>

	    <?php
	    if(check_staff_permission('statistics'))
	    {
	    ?>
		<li class="nav-parent">
		<a href="#"><i class="fa fa-bar-chart"></i><span>Statistics</span> <span class="fa arrow"></span></a>
		<ul class="children collapse">
		    <li class="<?php echo is_active_menu('value'); ?>"><a href="<?php echo base_url('admin/stats/value'); ?>"> Value</a></li>
		    <!-- <li class="<?php echo is_active_menu('regions'); ?>"><a href="<?php echo base_url('admin/regions'); ?>"> Regions</a></li> -->
		</ul>
		</li>
	    <?php } ?>
	    <li class="<?php echo is_active_menu('help'); ?>"><a href="<?php echo base_url('admin/reports/add'); ?>"><i class="fa fa-life-ring"></i><span>Help</span></a></li>

	    <?php if(check_staff_permission('admin_read')) { ?>
        <li class="nav-parent">
		<a href="#"><i class="fa fa-cubes"></i><span>Admin</span> <span class="fa arrow"></span></a>
		<ul class="children collapse">
		    <li class="<?php echo is_active_menu('segments'); ?>"><a href="<?php echo base_url('admin/segments'); ?>"> Segments</a></li>
		    <li class="<?php echo is_active_menu('regions'); ?>"><a href="<?php echo base_url('admin/regions'); ?>"> Regions</a></li>
		    <li class="<?php echo is_active_menu('verticals'); ?>"><a href="<?php echo base_url('admin/vertical'); ?>"> Verticals</a></li>
		    <li class="<?php echo is_active_menu('subverticals'); ?>"><a href="<?php echo base_url('admin/subverticals'); ?>"> Sub Verticals</a></li>
		    <li class="<?php echo is_active_menu('users_management'); ?>"><a href="<?php echo base_url('admin/staff'); ?>"> User Management</a></li>
		    <li class="<?php echo is_active_menu('reports'); ?>"><a href="<?php echo base_url('admin/reports'); ?>"> Reports Management</a></li>
		    <!-- <li class="<?php echo is_active_menu('setting_targets'); ?>"><a href="<?php echo base_url('admin/settings/setting_targets'); ?>">Setting Targets</a></li> -->
		</ul>
        </li>
        <?php } ?>

	</ul>



    </div>
</div>