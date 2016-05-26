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
        
<script>

 function login_user()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('customer/login_process'); ?>",
        data: $("#loginform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg); 

                $("#submitbutton").html('<button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="login_user()"><?php echo $this->lang->line('sign_in_title'); ?></button>');
            }
            else
            { 
                $("#ajax").html(msg); 
            }
        }

    });

 }
 
 function lostpw()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('customer/lostpassword_process'); ?>",
        data: $("#lostpassword").serialize(),
        beforeSend : function(msg){ $("#lostsubmitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            
			$("#lostajax").html(msg); 

            $("#lostsubmitbutton").html('<button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="lostpw()">Send Password Reset Link</button>');
            
        }

    });

 }

 </script>
        
    </head>
    <body class="account separate-inputs" data-page="login">
        <!-- BEGIN LOGIN BOX -->
       <div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall" style="background-color: rgba(255, 255, 255, 0);">
                        <a href="<?php echo base_url(); ?>"><i class="user-img icons-faces-users-03" style="opacity: 1;"></i></a>
                        <form class="form-signin" id="loginform" role="form">
                        <div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>
                            <div class="append-icon">
                                <input type="text" name="email" id="email" class="form-control form-white username" placeholder="Email" required="" style="border-bottom-right-radius: 2px; border-bottom-left-radius: 2px; margin-bottom: 8px;">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Password" required="" style="border-top-right-radius: 2px; border-top-left-radius: 2px;">
                                <i class="icon-lock"></i>
                            </div>
                            <div id="submitbutton"><button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="login_user()"><?php echo $this->lang->line('sign_in_title'); ?></button></div>
                            <div class="social-btn" style="display: none;">
                                <button type="button" class="btn-fb btn btn-lg btn-block btn-primary"><i class="icons-socialmedia-08 pull-left"></i>Connect with Facebook</button>
                                <button type="button" class="btn btn-lg btn-block btn-blue"><i class="icon-social-twitter pull-left"></i>Login with Twitter</button>
                            </div>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a id="password" href="#">Forgot password?</a></p>
                                <p class="pull-right m-t-20"><a href="<?php echo base_url('customer/create'); ?>"><?php echo $this->lang->line('sign_up_here'); ?></a></p>
                            </div>
                        </form>
                        <form class="form-password" id="lostpassword" role="form">
                            <div id="lostajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>
                            <div class="append-icon m-b-20">
                                <input type="email" name="email" class="form-control form-white password" placeholder="Email" required="" style="border-top-right-radius: 2px; border-top-left-radius: 2px;">
                                <i class="icon-envelope"></i>
                            </div>
                            <div id="lostsubmitbutton"><button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="lostpw()">Send Password Reset Link</button></div>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a href="<?php echo base_url('customer/login'); ?>"><?php echo $this->lang->line('sign_in_here'); ?></a></p>
                                <p class="pull-right m-t-20"><a href="<?php echo base_url('customer/create'); ?>"><?php echo $this->lang->line('sign_up_here'); ?></a></p>
                            </div>
                        </form>
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