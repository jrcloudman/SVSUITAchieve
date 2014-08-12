<?php
	require_once('mysqli_connect.php');
	$sql = "SELECT badgeId FROM badge WHERE expirationDate=CURDATE()";
	$result = mysqli_query($dbc, $sql);

	if(mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$sql = "DELETE FROM student_badge WHERE badgeId=" . $row['badgeId'];
		while($row = mysqli_fetch_assoc($result)) {
			$sql += " OR badgeId=" . $row['badgeId'];
		}
		mysqli_query($dbc, $sql);
	}
?>