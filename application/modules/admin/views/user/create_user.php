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

 function create_user()

 {

    $.ajax({

        type: "POST",
        url: "<?php echo base_url('admin/create_process'); ?>",
        data: $("#createform").serialize(),
        beforeSend : function(msg){ $("#submitbutton").html('<img src="<?php echo base_url('public/images/loading.gif'); ?>" />'); },
        success: function(msg)
        {
			$('body,html').animate({ scrollTop: 0 }, 200);
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg); 
                 

                $("#submitbutton").html('<button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="create_user()"><?php echo $this->lang->line('sign_up_title'); ?></button>');
                
                $("#createform")[0].reset();
            }
            else
            { 
                $("#ajax").html(msg); 
            }
        }

    });

 }

 </script>
        
    </head>
     <body class="account separate-inputs no-terms no-social" data-page="signup">
        <!-- BEGIN LOGIN BOX -->
       <div class="container" id="login-block">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3">
                    <div class="account-wall" style="background-color: rgba(255, 255, 255, 0);">
                        <i class="user-img icons-faces-users-03" style="opacity: 1;"></i>
                        <form class="form-signup" id="createform" role="form">
                            <div id="ajax"><?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="first_name" id="first_name" class="form-control form-white firstname" placeholder="First Name" autofocus="">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="append-icon">
                                        <input type="text" name="last_name" id="last_name" class="form-control form-white lastname" placeholder="Last Name">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="append-icon">
                                <input type="email" name="email" id="email" class="form-control form-white email" placeholder="Email">
                                <i class="icon-envelope"></i>
                            </div>
                            <div class="append-icon">
                                <input type="password" name="pass1" id="password" class="form-control form-white password" placeholder="Password">
                                <i class="icon-lock"></i>
                            </div>
                            <div class="append-icon m-b-20">
                                <input type="password" name="pass2" id="password2" class="form-control form-white password2" placeholder="Repeat Password">
                                <i class="icon-lock"></i>
                            </div>                          
                            <div id="submitbutton"><button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left" onClick="create_user()"><?php echo $this->lang->line('sign_up_title'); ?></button></div>
                            <div class="social-btn" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-lg btn-block btn-primary"><i class="fa fa-facebook pull-left"></i>Sign In with Facebook</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-lg btn-block btn-danger"><i class="fa fa-google pull-left"></i>Sign In with Google</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <p class="pull-right m-t-20"><a href="<?php echo base_url('admin/login'); ?>"><?php echo $this->lang->line('sign_in_here'); ?></a></p>
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