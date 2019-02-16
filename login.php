<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - To Account</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="asset/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="asset/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="asset/css/style.css" rel="stylesheet" type="text/css">
<link href="asset/css/pages/signin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="asset/css/sweetalert2.min.css">
</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				Dealer Admin Web
			</a>
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container">
	
	<div class="content clearfix">
		
		<form id="edit-profile" enctype='application/json'>
		
			<h1>Member Login</h1>		
			
			<div class="login-fields">
				
				<p>Please provide your details</p>
				
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" id="username" required="" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field" id="pass" required="" />
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<button class="button btn btn-success btn-large" id="btn_submit">Sign In</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<script src="asset/js/jquery-1.7.2.min.js"></script>
<script src="asset/js/bootstrap.js"></script>

<script src="asset/js/signin.js"></script>
<script src="asset/js/sweetalert2.min.js"></script>
</body>

</html>
<script type="text/javascript">
	$(function () {
		$(document).ready(function () {
			// alert();
			// Swal.fire({
			//   title: 'Error!',
			//   text: 'Do you want to continue',
			//   type: 'error',
			//   confirmButtonText: 'Cool'
			// })
		});
		$('#edit-profile').submit(function (e){
			$('#btn_submit').text('Tunggu Sebentar...');
        	$('#btn_submit').attr('disabled',false);
        	e.preventDefault();
        	var me = $(this);

        	$.ajax({
        		type: "post",
        		url: "process/loginpro.php",
        		data: me.serialize(),
        		dataType: "json",
        		success: function (response) {
        			if(response.success == true){
        				document.location='index.php';
        			}
        			else{

        				if(response.message == 'E500-03'){
	        				Swal.fire({
	        					title: 'Error !',
	        					text: 'Username Password tidak cocok',
	        					type: 'error',
	        					confirmButtonText: 'Cool'
	        				});
        				}
        				else
        				{
	        				Swal.fire({
	        					title: 'Error !',
	        					text: 'Unidentified Error',
	        					type: 'error',
	        					confirmButtonText: 'Cool'
	        				});
        				}
        			}
        		}
        	});
		});
	});
</script>