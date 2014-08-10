<?php
	session_start();
	require_once('mysqli_connect.php');
	require_once('PasswordHash.php');
	$username = mysqli_real_escape_string($dbc, $_POST["username"]);
	$password = mysqli_real_escape_string($dbc, $_POST["password"]);

	$sql = "SELECT * FROM student WHERE username='$username'";
	$students = mysqli_query($dbc, $sql);
	$sql = "SELECT * FROM admin WHERE username='$username'";
	$admins = mysqli_query($dbc, $sql);

	if(mysqli_num_rows($students) > 0) {
		$row = mysqli_fetch_assoc($students);
		if(validate_password($password, $row['password'])) {
			$_SESSION['userId'] = $row['studentId'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['permissions'] = 'student';
			echo 'valid';
		}
		else echo 'invalid';
	}
	else if(mysqli_num_rows($admins) > 0) {
		$row = mysqli_fetch_assoc($admins);
		if(validate_password($password, $row['password'])) {
			$_SESSION['userId'] = $row['adminId'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['permissions'] = $row['permissions'];
			echo 'valid';
		}
		else echo 'invalid';
	}
	else echo 'invalid';
?>