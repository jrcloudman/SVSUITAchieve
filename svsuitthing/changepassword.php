<?php 
	require_once('checkloggedin.php');
	require_once('lib/mysqli_connect.php'); 
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
	<?php include 'navbar.php'; ?>
	<div class="container body-content">
		<div class="col-md-6 well" id="loneFormContainer">
			<form class="form-horizontal" id="changePassForm" method="post">
				<legend>Change Your Password</legend>
				<div class="alert alert-danger" role="alert" id="invalidAlert" hidden>Your old password is incorrect</div>
				<div class="alert alert-success" role="alert" id="validAlert" hidden>Your password has been changed successfully</div>
				<div class="form-group">
					<label for="username" class="col-md-4 control-label">Old Password</label>
					<div class="col-md-8">
						<input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-md-4 control-label">New Password</label>
					<div class="col-md-8">
						<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-md-4 control-label">Confirm New Password</label>
					<div class="col-md-8">
						<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-md-offset-4">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/jquery.validate.min.js"></script>
	<script src="scripts/changepassword.js"></script>
</body>
</html>