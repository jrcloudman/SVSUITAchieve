<?php
	require_once('mysqli_connect.php');
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'add':
				$groupId = mysqli_real_escape_string($dbc, $_POST["groupId"]);
				$firstName = mysqli_real_escape_string($dbc, $_POST["firstName"]);
				$lastName = mysqli_real_escape_string($dbc, $_POST["lastName"]);
				$username = mysqli_real_escape_string($dbc, $_POST["username"]);
				$tempPassword = mysqli_real_escape_string($dbc, $_POST["tempPassword"]);

				$sql = "INSERT INTO student(groupId, firstName, lastName, username, password) VALUES ($groupId, '$firstName', '$lastName', '$username', '$tempPassword')";
				$result = mysqli_query($dbc, $sql);
				if($result) echo "success";
				else echo "failure";
				break;
			case 'modify':
				break;
			case 'delete':
				break;
		}
	}
?>