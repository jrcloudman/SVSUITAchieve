<?php session_start(); 
	if (isset($_SESSION['userId']) && $_SESSION['userId'] != '') {
		header ("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Support Center - REC/HHS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">SVSU IT Student Achievment Tracker</a>
			</div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">

            </div>
		</div>
	</div>
	<div class="container body-content">
		<div class="col-md-6 well" id="loneFormContainer">
			<form class="form-horizontal" id="loginForm" action="lib/validatelogin.php" method="post">
				<legend>Login</legend>
				<div class="alert alert-danger" role="alert" id="loginAlert" hidden>Your username or password is incorrect</div>
				<div class="form-group">
					<label for="username" class="col-md-4 control-label">Username</label>
					<div class="col-md-8">
						<input type="text" class="form-control" id="username" name="username" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-md-4 control-label">Password</label>
					<div class="col-md-8">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-md-offset-4">
						<button type="submit" class="btn btn-primary">Log In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/login.js"></script>
</body>
</html>