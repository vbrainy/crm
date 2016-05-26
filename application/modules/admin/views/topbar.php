<script>

 function delete_notification( notification_id,section_name,section_view,id )
 {
 	 $.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/dashboard/delete_notification' ); ?>/" + notification_id,
        success: function(msg)
        {
			if( msg == 'deleted' )
            {
                $('#noti_id_' + notification_id).fadeOut('normal');
                
                setTimeout(function () {
				window.location.href="<?php echo base_url('admin/' ); ?>/"+section_name+'/'+section_view+'/'+id;
				}, 500); //will call the function after 1 secs.
            }
        }

    });
       
 }


 </script>
<div class="topbar">
          <div class="header-left">
            <div class="topnav">
              <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
              <ul class="nav nav-horizontal">

      
           
           <?php if (userdata('id')=='1'){?>
           <li><a href="<?php echo base_url('admin/settings'); ?>"><i class="icon-settings"></i><span>Settings</span></a></li>
           <?php }?>
           
         </ul>
               
            </div>
          </div>
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
               <!-- BEGIN NOTIFICATION DROPDOWN -->
               <?php  
               
               		$res_notification=get_notifications();
               		
               		$total_notification=count($res_notification);
               ?>
              <li class="dropdown" id="notifications-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i>
                <?php if($total_notification > 0){?>
                <span class="badge badge-danger badge-header"><?php echo $total_notification;?></span>
                <?php }?>
                </a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header clearfix">
                    <?php if($total_notification > 0){?>
                    <p class="pull-left"><?php echo $total_notification;?> Pending Notifications</p>
                    <?php }else{?>
                    <p class="pull-left">No Pending Notification</p>
                    <?php }?>
                  </li>
                  <li>
                    <ul class="dropdown-menu-list withScroll" data-height="220">
                       <?php 
                      
                      	 foreach( $res_notification as $notification){
        		 		
	        		 		switch ($notification->section_name) 
	        		 		{  
								    case "leads":
								        $icon="fa fa-rocket";
								        $view="view";
								        break;
								    case "opportunities":
								        $icon="icon-key";
								        $view="view";
								        break;								        
								    case "logged_calls":
								        $icon="fa fa-phone";
								        $view="update";
								        break;								     
								     case "meetings":
								        $icon="fa fa-user";
								        $view="edit_meeting";
								        break;
								     case "quotations":
								        $icon="icon-tag";
								        $view="update";
								        break;
								     case "contracts":
								        $icon="fa fa-search-plus";
								        $view="update";
								        break;           
								     default:  
								     	$icon="fa fa-rocket";  	
	        		 		}			
                      ?> 
                        
                      <li id="noti_id_<?php echo $notification->id; ?>" onclick="delete_notification(<?php echo $notification->id; ?>,'<?php echo $notification->section_name;?>','<?php echo $view;?>',<?php echo $notification->section_id;?>)">
                        <a href="javascript:void(0)">
                        <i class="<?php echo $icon;?> p-r-10 f-18 c-red"></i>
                        <?php echo $notification->title;?>
                        <span class="dropdown-time"><?php echo xTimeAgo($notification->date); ?>
</span>
                        </a>
                      </li>
                     <?php }?> 
                    
                    </ul>
                  </li>
                   
                </ul>
              </li>
              <!-- END NOTIFICATION DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php if(userdata('user_avatar')){?>
                 <img src="<?php echo base_url(); ?>uploads/<?php echo userdata('user_avatar');?>" alt="user image" style="height: 36px;width: 36px;">
                <?php }else{?>
                
                <img src="<?php echo base_url(); ?>public/assets/global/images/avatars/user1.png" alt="user image" style="height: 36px;width: 36px;">                
                <?php }?>	
                
                  
                
                <span class="username">Hi, <?php echo userdata('first_name');?></span>
                </a>
                <ul class="dropdown-menu">                   
                  <?php if(userdata('id') == 1){?>
	                  <li>
	                    <a href="<?php echo base_url('admin/settings'); ?>"><i class="icon-settings"></i><span>General Settings</span></a>
	                  </li>
                  <?php }?>
                  <li>
                    <a href="<?php echo base_url('admin/account_settings'); ?>"><i class="icon-settings"></i><span>Account Settings</span></a>
                  </li>
                  <li>
                    <a href="<?php echo base_url('admin/logout'); ?>"><i class="icon-logout"></i><span><?php echo $this->lang->line('logout'); ?></span></a>
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