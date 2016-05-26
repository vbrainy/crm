<div class="sidebar">
        <div class="logopanel">
          <a href="<?php echo base_url('customer/dashboard/'); ?>"><img src="<?php echo base_url('uploads/site').'/'.config('site_logo'); ?>" alt="company logo" class="" style="height: 30px;"></a> 
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
            <li class=" nav-active <?php echo is_active_menu('dashboard'); ?>"><a href="<?php echo base_url('customer/dashboard'); ?>"><i class="icon-home"></i><span>Dashboard</span></a></li>
             <li class="<?php echo is_active_menu('quotations'); ?>"><a href="<?php echo base_url('customer/quotations'); ?>"> <i class="icon-tag"></i><span>Quotations</span></a></li>
      		<li class="<?php echo is_active_menu('salesorder'); ?>"><a href="<?php echo base_url('customer/salesorder'); ?>"> <i class="fa fa-shopping-cart"></i><span>Sales Order</span></a></li>     
     		<li class="<?php echo is_active_menu('invoices'); ?>"><a href="<?php echo base_url('customer/invoices'); ?>"> <i class="icon-note"></i><span>Invoices</span></a></li>
     		
     		<li class="<?php echo is_active_menu('contracts'); ?>"><a href="<?php echo base_url('customer/contracts'); ?>"> <i class="fa fa-search-plus"></i><span>Contracts</span></a></li>
     		
     		 
     		
          </ul>
          
          
        </div>
      </div>