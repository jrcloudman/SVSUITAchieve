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
	<?php	
	session_start();
	if (!(isset($_SESSION['userId']) && $_SESSION['userId'] != '')) { ?>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">SVSU IT Student Achievment Tracker</a>
				</div>
	            <div class="navbar-collapse collapse navbar-responsive-collapse">
	            </div>
			</div>
		</div>
	<?php
	}
	else {
		include 'navbar.php';
	}
	?>
	<div class="container body-content">
		<div class="page-header">
			<h1>404 - Not Found</h1>
		</div>
		<p>Oops! The page you were looking for was not found. If you believe you were brought here in error, please <a href="#">Contact Us</a>. <br><a href="index.php">Return to the homepage</a></p>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/login.js"></script>
</body>
</html>