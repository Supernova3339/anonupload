<?php
// (A) LOGIN CHECKS
require 'check.php';
?>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" method="post" target="_self">
					<span class="login100-form-title p-b-33">
						Admin Login
					</span>
<!-- inv credentials -->					
					<?php if (isset($failed)) { ?>
					<div class="alert alert-danger shadow" data-dismiss="alert" role="alert" style="border-left:#721C24 5px solid; border-radius: 0px">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		   
		</button>
		<div class="row">
			<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="m-1 bi bi-exclamation-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
			</svg>
		  	<p style="font-size:18px" class="mb-0 font-weight-light"><b class="mr-1">Invalid Credentials</b>
		</div>
	</div>
<?php } ?>
<!-- invalid captcha -->
					<?php if (isset($_GET['capfail'])) { ?>
					<div class="alert alert-danger shadow" data-dismiss="alert" role="alert" style="border-left:#721C24 5px solid; border-radius: 0px">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		   
		</button>
		<div class="row">
			<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="m-1 bi bi-exclamation-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
			</svg>
		  	<p style="font-size:18px" class="mb-0 font-weight-light"><b class="mr-1">Invalid Captcha</b>
		</div>
	</div>
<?php } ?>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required">
						<input class="input100" type="email" id="user" name="user" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" id="password" name="password" placeholder="Password">
						
						<div class="captcha wrap-input100">
	<img src="captcha.php" width="150" height="50">
	<input type="text" id="captcha" name="captcha" placeholder="Enter captcha code" title="Please enter the captcha code!" required>
</div>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
						<span class="focus-input100-3"></span>
					</div>
					

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>                                                        
                               </form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>