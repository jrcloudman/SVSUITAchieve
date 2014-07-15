<?php
	require_once('mysqli_connect.php');
	require_once('PasswordHash.php');
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$adminId = $_GET['adminId'];
		$sql = "SELECT firstName, lastName, username, dateAdded, permissions FROM admin WHERE adminId=$adminId";
		$result = mysqli_query($dbc, $sql);
		$data = mysqli_fetch_assoc($result);
		$data['groups'] = array();

		$sql = "SELECT groupId FROM admin_group WHERE adminId=$adminId";
		$result = mysqli_query($dbc, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$data['groups'][] = $row['groupId'];
		}
		echo json_encode($data);
	}
	else {
		if(isset($_POST['action']) && !empty($_POST['action'])) {
			$action = $_POST['action'];
			if($action == 'add' || $action == 'modify') {
				$firstName = mysqli_real_escape_string($dbc, $_POST["firstName"]);
				$lastName = mysqli_real_escape_string($dbc, $_POST["lastName"]);
				$username = mysqli_real_escape_string($dbc, $_POST["username"]);
				$password = mysqli_real_escape_string($dbc, $_POST["tempPassword"]);
				$permissions = mysqli_real_escape_string($dbc, $_POST["permissions"]);
			}
			switch($action) {
				case 'add':
					$saltedHash = create_hash($password);
					$sql = "INSERT INTO admin(firstName, lastName, username, password, dateAdded, permissions) VALUES 
							('$firstName', '$lastName', '$username', '$saltedHash', NOW(), $permissions)";
					mysqli_query($dbc, $sql);
					
					if($permissions == 2) {
						$adminId = mysqli_insert_id($dbc);
						$sql = "INSERT INTO admin_group(adminId, groupId) VALUES ";
						foreach($_POST['groups'] as $groupId) {
							$sql .= "($adminId, $groupId),";
						}
						$sql = rtrim($sql, ",");
						mysqli_query($dbc, $sql);
					}
					break;
				case 'modify':
					
					break;
				case 'delete':
					break;
			}
		}
	}
?>