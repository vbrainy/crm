<div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
              <!--<ul class="nav nav-icons">
                <li><a href="#" class="toggle-sidebar-top"><span class="icon-user-following"></span></a></li>
                <li><a href="mailbox.html"><span class="octicon octicon-mail-read"></span></a></li>
                
              </ul>-->
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php if(userdata_customer('customer_avatar')){?>
                 <img src="<?php echo base_url(); ?>uploads/customer/<?php echo userdata_customer('customer_avatar');?>" alt="user image" style="height: 36px;width: 36px;">
                <?php }else{?>
                
                <img src="<?php echo base_url(); ?>public/assets/global/images/avatars/user1.png" alt="user image" style="height: 36px;width: 36px;">                
                <?php }?>	
                
                  
                
                <span class="username">Hi, <?php echo userdata_customer('first_name');?></span>
                </a>
                <ul class="dropdown-menu">                   
                    
                  <li>
                    <a href="<?php echo base_url('customer/settings'); ?>"><i class="icon-settings"></i><span>Account Settings</span></a>
                  </li>
                  <li>
                    <a href="<?php echo base_url('customer/logout'); ?>"><i class="icon-logout"></i><span><?php echo $this->lang->line('logout'); ?></span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
              <!--<li id="quickview-toggle"><a href="#"><i class="icon-bubbles"></i></a></li>-->
            </ul>
          </div>
          <!-- header-right -->
        </div>