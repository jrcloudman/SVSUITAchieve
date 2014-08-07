<?php
	require_once('mysqli_connect.php');
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		$studentId = mysqli_real_escape_string($dbc, $_POST['studentId']);
		$badgeId = mysqli_real_escape_string($dbc, $_POST['badgeId']);
		switch($action) {
			case 'award':
				$sql = "INSERT INTO student_badge VALUES ($studentId, $badgeId)";
				mysqli_query($dbc, $sql);
				$sql = "UPDATE student SET allTimeBadges = allTimeBadges + 1 WHERE studentId = $studentId";
				mysqli_query($dbc, $sql);
				break;
			case 'remove':
				$sql = "DELETE FROM student_badge WHERE studentId = $studentId AND badgeId = $badgeId";
				mysqli_query($dbc, $sql);
				$sql = "UPDATE student SET allTimeBadges = allTimeBadges - 1 WHERE studentId = $studentId";
				mysqli_query($dbc, $sql);
				break;
		}
	}
?>