<?php
	session_start();
	session_destroy();
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
		$row = mysqli_fetch_assoc($student);
		if(validate_password($password, $row['password'])) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['permissions'] = '3';
			echo 'valid';
		}
		else echo 'invalid';
	}
	else if(mysqli_num_rows($admins) > 0) {
		$row = mysqli_fetch_assoc($admins);
		if(validate_password($password, $row['password'])) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['permissions'] = $row['permissions'];
			if($_SESSION['permissions'] == 2) {
				$adminId = $row['adminId'];
				$sql = "SELECT * FROM admin_group WHERE adminId=$adminId";
				$groups = mysqli_query($dbc, $sql);
				while($row = mysqli_fetch_assoc($groups)) {
					$_SESSION['groups'][] = $row['groupId'];
				}
			}
			echo 'valid';
		}
		else echo 'invalid';
	}
	else echo 'invalid';
?>