<?php 
	require_once('checkloggedin.php'); 
	require_once('lib/mysqli_connect.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SVSU IT Student Achievment Tracker</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container body-content">
		<div class="row">
			<?php if($_SESSION['permissions'] == 'student') { ?>
			<div class="col-md-8">
				<h2>Your Recently Earned Badges</h2>
				<table class="table">
					<tr><th>Image</th><th>Title</th><th>Description</th></tr>
					<?php
						$studentId = $_SESSION['userId'];
						$sql = "SELECT badge.badgeName, badge.imageFile, badge.badgeDescription
								FROM badge, student_badge
								WHERE student_badge.studentId = $studentId AND badge.badgeId = student_badge.badgeId AND student_badge.dateEarned
								ORDER BY student_badge.dateEarned
								LIMIT 10";
						$result = mysqli_query($dbc, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo '<tr><td><img src="images/badges/' . $row['imageFile'] . '" class="admin_badge"></td><td>' . $row['badgeName'] . '</td><td>' . $row['badgeDescription'] . '</td></tr>';
						}
					?>
				</table>
			</div>
			<?php 
			} 
			if($_SESSION['permissions'] == 'student') $width = '4';
			else $width = '8';
			echo '<div class="col-md-' . $width . '">';
			?>
				<h2>Badge Feed</h2>
				<table class="table">
					<?php
						$sql = "SELECT badge.badgeName, badge.imageFile, badge.badgeDescription, student.firstName, student.lastName
								FROM badge, student_badge, student
								WHERE student_badge.studentId = student.studentId AND badge.badgeId = student_badge.badgeId AND student_badge.dateEarned BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()
								ORDER BY student_badge.dateEarned
								LIMIT 10";
						$result = mysqli_query($dbc, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo '<tr><td><img src="images/badges/' . $row['imageFile'] . '" class="admin_badge"></td><td>' . $row['firstName'] . ' ' . $row['lastName'] . ' earned <span class="tooltipped" data-toggle="tooltip" data-placement="top" title="' . $row['badgeDescription'] . '"><b>' . $row['badgeName'] . '</b></span></tr>';
						}
					?>
				</table>
			</div>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script>
		$(function() {
			$('.tooltipped').tooltip();
		});
	</script>
</body>
</html>
