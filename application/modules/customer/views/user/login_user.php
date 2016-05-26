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

                $("#submitbutton").html('<button type="submit" id="submit-form" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left" onClick="login_user()"><?php echo $this->lang->line('sign_in_title'); ?></button>');
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
    <body class="account2" data-page="login" style="background-image:url('<?php echo base_url('uploads/site').'/'.config('login_bg'); ?>');background-attachment: fixed;background-position: center;background-repeat: no-repeat;background-size: cover;">
        <!-- BEGIN LOGIN BOX -->
       <div class="container" id="login-block">
            <div class="container" id="login-block">
            <i class="user-img icons-faces-users-03"></i>
            <div class="account-info">
                <a href="<?php echo base_url(); ?>" class=""><img src="<?php echo base_url('uploads/site').'/'.config('site_logo'); ?>" alt="company logo" class="" style="height: 30px;"></a> 
                <h3>Modular &amp; Flexible Admin.</h3>
                 
            </div>
            <div class="account-form">
                <form class="form-signin" id="loginform" role="form">     
                    <h3><strong>Sign in</strong> to your account</h3>
                    <div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>
                    <div class="append-icon">
                        <input type="text" name="email" id="email" class="form-control form-white username" placeholder="Email" required>
                        <i class="icon-envelope"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" id="" class="form-control form-white password" placeholder="Password" required>
                        <i class="icon-lock"></i>
                    </div>
                    <div id="submitbutton"><button type="submit" id="submit-form" class="btn btn-lg btn-dark btn-rounded ladda-button" data-style="expand-left" onClick="login_user()"><?php echo $this->lang->line('sign_in_title'); ?></button></div>
                    <span class="forgot-password"><a id="password" href="#">Forgot password?</a></span>
                    <?php /*
                    <div class="form-footer"> 
                        <div class="clearfix">
                            <p class="new-here"><a href="<?php echo base_url('customer/create'); ?>"><?php echo $this->lang->line('sign_up_here'); ?></a></p>
                        </div>
                    </div>
					*/
					?>
                </form>
                <form class="form-password" id="lostpassword" role="form">
                    <h3><strong>Reset</strong> your password</h3>
                    <div id="lostajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>
                    <div class="append-icon m-b-20">
                        <input type="email" name="email" class="form-control form-white password" placeholder="Email" required>
                        <i class="icon-envelope"></i>
                    </div>
                    <div id="lostsubmitbutton"><button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="lostpw()">Send Password Reset Link</button></div>
                    <div class="clearfix m-t-60">
                        <p class="pull-left m-t-20 m-b-0"><a id="login" href="#">Have an account? Sign In</a></p>
                        <?php /*
                        <p class="pull-right m-t-20 m-b-0"><a href="<?php echo base_url('customer/create'); ?>"><?php echo $this->lang->line('sign_up_here'); ?></a></p>
                        */
                        ?>
                    </div>
                </form>
            </div>
            
        </div>
        <!-- END LOCKSCREEN BOX -->
        
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