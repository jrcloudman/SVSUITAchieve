<?php
	require_once('mysqli_connect.php');
	require_once('PasswordHash.php');
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$badgeId = mysqli_real_escape_string($dbc, $_GET['badgeId']);
		$sql = "SELECT * FROM badge WHERE badgeId=$badgeId";
		$result = mysqli_query($dbc, $sql);
		$data = mysqli_fetch_assoc($result);
		echo json_encode($data);
	}
	else {
		if(isset($_POST['action']) && !empty($_POST['action'])) {
			$action = $_POST['action'];
			if($action == 'add' || $action == 'modify') {
				$groupId = mysqli_real_escape_string($dbc, $_POST["groupId"]);
				$badgeName = mysqli_real_escape_string($dbc, $_POST["badgeName"]);
				$badgeDescription = mysqli_real_escape_string($dbc, $_POST["badgeDescription"]);
				$badgeGroup = mysqli_real_escape_string($dbc, $_POST["badgeGroup"]);
				$badgeType = mysqli_real_escape_string($dbc, $_POST["badgeType"]);
			}
			switch($action) {
				case 'add':
					$sql = "INSERT INTO badge(badgeName, imageFile, description, type, badgeGroupId, groupId, dateAdded, difficulty, expirationDate) VALUES 
							('$badgeName', '', '$badgeDescription', '$badgeType', $badgeGroup, $groupId, NOW(), 1, ";
					if(isset($_POST['expirationDate'])) {
						$sql .= ($_POST['expirationDate'] . ")");
					}
					else {
						$sql .= "NULL)";
					}
					mysqli_query($dbc, $sql);
					break;
				case 'modify':
					break;
				case 'delete':
					break;
			}
		}
	}
?>