<?php
	session_start();
	require_once('mysqli_connect.php');
	require_once('PasswordHash.php');
	$oldPassword = mysqli_real_escape_string($dbc, $_POST["oldPassword"]);
	$newPassword = mysqli_real_escape_string($dbc, $_POST["newPassword"]);

	$userId = $_SESSION['userId'];

	$group = 'admin';
	$id = 'adminId';
	if($_SESSION['permissions'] == 'student') {
		$group = 'student';
		$id = 'studentId';
	}

	$sql = "SELECT password FROM $group WHERE $id=$userId";
	$result = mysqli_query($dbc, $sql);
	$user = mysqli_fetch_assoc($result); 
	$correctHash = $user['password'];

	if(validate_password($oldPassword, $correctHash)) {
		$newHash = create_hash($newPassword);
		$sql = "UPDATE $group SET password='$newHash' WHERE $id=$userId";
		mysqli_query($dbc, $sql);
		echo 'valid';
	}
	else {
		echo 'invalid';
	}
?>