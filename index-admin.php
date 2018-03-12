<?php
session_start();
// set session
$_SESSION['login'] = false;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login-Inventaris Ofice</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>  
    </head>
    <body>
        <div class="top-content" id="contain">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Admin</strong> Login</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3><strong><b>Login</b></strong></h3>
                            		<p>Input username and password</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" id="login-form" method="POST" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
			                        </div>
			                        <button id="sign" type="submit" class="btn">Login</button>
                                </form>
                        <script type="text/javascript">
                        $.jGrowl.defaults.position = 'top-right';

                        
                        
                        $(document).ready(function(){
                        $("#login-form").submit(function(e){
                                e.preventDefault();
                                var formData = $("#login-form").serialize();
                                $.ajax({
                                    type: "POST",
                                    data: formData,
                                    url: "proses.php",
                                    
                                    success: function(html){
                                    if(html=='Super admin')
                                    {      
                                    $('#login-form').jGrowl("Login Berhasil");                             
                                    var delay = 500;
                                        setTimeout(function(){ window.location = 'sadmin/dashboard.php'}, delay);  
                                    }else if(html=='Admin')
                                    {  
                                    $('#login-form').jGrowl("Login Berhasil");                             
                                    var delay = 500;
                                        setTimeout(function(){ window.location = 'admin/dashboard.php'}, delay);  
                                    }else
                                    {
                                    $('#login-form').jGrowl("Login Gagal, Silahkan Cek Username atau Password Anda");
                                    var delay = 500;
                                    }
                                    }
                                });
                            });
                        });
                        </script>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>