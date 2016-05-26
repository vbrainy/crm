<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo config('site_name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>/public/assets/global/images/favicon.png">
        <link href="<?php echo base_url(); ?>/public/assets/global/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/public/assets/global/css/ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/public/assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
               
    </head>
    <body class="account separate-inputs" data-page="login">
        <!-- BEGIN LOGIN BOX -->
       <div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall" style="background-color: rgba(255, 255, 255, 0);">
                        <a href="<?php echo base_url(); ?>"><i class="user-img icons-faces-users-03" style="opacity: 1;"></i></a>
                        <!-- Start Report Box -->
						<div class="reportbox" align="center">
							<h2><?php echo $this->lang->line('lostpw_message1'); ?></h2>
							<p class="text"><?php echo $this->lang->line('lostpw_message2'); ?></p>
							 
						</div>
						<!-- End Report Box -->
                    </div>
                </div>
            </div>
            <p class="account-copyright" style="position: relative; margin-top: 40px;">
                <span>Copyright © <?php echo date('Y');?> </span><span><?php echo config('site_name'); ?></span>.<span>All rights reserved.</span>
            </p>
            
        </div>
        <script src="<?php echo base_url(); ?>/public/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/assets/global/plugins/gsap/main-gsap.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/assets/global/plugins/backstretch/backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/assets/global/plugins/bootstrap-loading/lada.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/assets/global/js/pages/login-v1.js"></script>
    </body>
</html>