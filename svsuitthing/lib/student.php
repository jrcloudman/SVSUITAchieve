<?php
	require_once('mysqli_connect.php');
	require_once('PasswordHash.php');
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$studentId = $_GET['studentId'];
		$sql = "SELECT * FROM student WHERE studentId=$studentId";
		$result = mysqli_query($dbc, $sql);
		$data = mysqli_fetch_assoc($result);
		$data['startDate'] = date("m/d/Y", strtotime($data['startDate']));
		echo json_encode($data);
	}
	else {
		if(isset($_POST['action']) && !empty($_POST['action'])) {
			$action = $_POST['action'];
			if($action == 'add' || $action == 'modify') {
				$firstName = mysqli_real_escape_string($dbc, $_POST["firstName"]);
				$lastName = mysqli_real_escape_string($dbc, $_POST["lastName"]);
				$username = mysqli_real_escape_string($dbc, $_POST["username"]);
				$startDate = mysqli_real_escape_string($dbc, $_POST["startDate"]);
				$startDate = date("Y-m-d", strtotime($startDate));
				$groupId = mysqli_real_escape_string($dbc, $_POST["groupId"]);
			}
			switch($action) {
				case 'add':
					$password = mysqli_real_escape_string($dbc, $_POST["tempPassword"]);
					$saltedHash = create_hash($password);
					$sql = "INSERT INTO student(groupId, firstName, lastName, username, password, startDate, dateAdded, allTimeBadges) VALUES 
							($groupId, '$firstName', '$lastName', '$username', '$saltedHash', '$startDate', NOW(), 0)";
					mysqli_query($dbc, $sql);
					break;
				case 'modify':
					$adminId = mysqli_real_escape_string($dbc, $_POST["adminId"]);
					$sqlPw = "";
					if(isset($_POST['tempPassword'])) {
						$password = mysqli_real_escape_string($dbc, $_POST["tempPassword"]);
						$saltedHash = create_hash($password);
						$sqlPw = "password='$saltedHash',";
					}
					$sql = "UPDATE admin SET firstName='$firstName', lastName='$lastName', username='$username', " . $sqlPw . "permissions='$permissions' WHERE adminId='$adminId'";
					mysqli_query($dbc, $sql);
					if($permissions == 2) { 
						$sql = "DELETE FROM admin_group WHERE adminId='$adminId'";
						mysqli_query($dbc, $sql);
						insertGroups($dbc, $adminId);
					}
					break;
				case 'delete':
					$studentId = mysqli_real_escape_string($dbc, $_POST["studentId"]);
					$sql = "DELETE FROM student_badge WHERE studentId = $studentId";
					mysqli_query($dbc, $sql);
					$sql = "DELETE FROM student WHERE studentId = $studentId";
					mysqli_query($dbc, $sql);
					break;
			}
		}
	}
?>