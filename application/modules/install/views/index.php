<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Spruce Sales & CRM | Web Installer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="<?php echo base_url();?>public/install/install.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="<?php echo base_url();?>public/install/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>public/install/sliding.form.js"></script>
    </head>
    <style>
        span.reference{
            position:fixed;
            left:5px;
            top:5px;
            font-size:10px;
            text-shadow:1px 1px 1px #fff;
        }
        span.reference a{
            color:#555;
            text-decoration:none;
			text-transform:uppercase;
        }
        span.reference a:hover{
            color:#000;
            
        }
        h1 a{
            color:#ccc;
            font-size:26px;
            text-shadow:1px 1px 1px #fff;
            padding:20px;
			text-decoration:none;
        }
    </style>
    <body>
    	<center><br>
        	<h1>
            	<a href="http://madnpark.co.uk" target="_blank">
                	Airtel Business CRM
                </a>
            </h1>
            
            
        </center>
        <div id="content">
        	<?php if($this->session->flashdata('installation_result') == 'failed'):?>
            	<div class="result_error">Installation failed due to invalid settings</div>
            <?php endif;?>
            <div id="wrapper">
                <div id="steps">
                     
					
					<form action="<?php echo base_url('install/do_install'); ?>" id="formElem" name="formElem" method="post" accept-charset="utf-8">

                        <fieldset class="step">
                            <legend>Welcome to web installer</legend>
                            <br><br><br><br><br><br>
                            <p>
                            	
                                Install the script in few clicks.
                                <br>
                                Provide database and admin settings,
                                <br>
                                and run the installer.It's easy !
                                
                                
                            </p>
                                <ol style="clear:both;margin-top:100px;margin-left:50px; text-align:left;">
                                	<li><span style="color:#900;font-weight:bold;">Required</span> - 
                                    	application/config/database.php to be <span style="color:#063;font-weight:bold;">writtable</span></li>
                                	<li><span style="color:#900;font-weight:bold;">Required</span> - 
                                    	application/config/routes.php to be <span style="color:#063;font-weight:bold;">writtable</span></li>
									<li><span style="color:#900;font-weight:bold;">Required</span> - 
                                    	php CURL function <span style="color:#063;font-weight:bold;">enabled</span></li>	
                                	 
                                </ol>
                        </fieldset>                        
                        <fieldset class="step">
                            <legend>Database settings</legend>
                            <p>
                                <label for="name">Database Name</label>
                                <input id="db_name" name="db_name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="country">User name</label>
                                <input id="db_uname" name="db_uname" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="phone">Password</label>
                                <input id="db_password" name="db_password" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="website">Host Name</label>
                                <input id="db_hname" name="db_hname" type="text" AUTOCOMPLETE=OFF value="localhost" />
                            </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Settings</legend>
                            <p>
                                <label for="namecard">System name</label>
                                <textarea  name="system_name" AUTOCOMPLETE=OFF>Spruce Sales & CRM</textarea>
                            </p> 
                            <p>
                                <label for="country">First name</label>
                                <input id="first_name" name="first_name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="country">Last name</label>
                                <input id="last_name" name="last_name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="cardnumber">Admin email</label>
                                <input id="email" name="email" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="secure">Login password</label>
                                <input id="password" name="password" type="password" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
						<fieldset class="step">
                            <legend>Confirm</legend>
							<p>
								Everything in the form was correctly filled 
								if all the steps have a green checkmark icon.
								A red checkmark icon indicates that some field 
								is missing or filled out with invalid data.
							</p>
                            <p class="submit">
                                <button id="registerButton" type="submit">Run installer</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
                <div id="navigation" style="display:none;">
                    <ul>
                        <li class="selected">
                            <a href="#">Welcome</a>
                        </li>
                         
                        <li>
                            <a href="#">Database</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
						<li>
                            <a href="#">Install</a>
                        </li>
                    </ul>
                </div>
                <!--steps finishes here-->
            </div>
            
             
            
        </div>
    </body>
</html>