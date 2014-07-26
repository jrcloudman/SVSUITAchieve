<?php
	require_once('mysqli_connect.php');
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'add':
				$groupName = mysqli_real_escape_string($dbc, $_POST["groupName"]);
				$sql = "INSERT INTO studentgroup(groupName, dateAdded) VALUES ('$groupName', NOW())";
				mysqli_query($dbc, $sql);
				$groupId = mysqli_insert_id($dbc);
				$sql = "INSERT INTO badgegroup(badgegroupName, groupId) VALUES ('Basic Training', $groupId), ('Standard Badges', $groupId), ('Semester Awards', $groupId)";
				mysqli_query($dbc, $sql);
				break;
			case 'modify':
				$groupId = mysqli_real_escape_string($dbc, $_POST["groupId"]);
				$groupName = mysqli_real_escape_string($dbc, $_POST["groupName"]);
				echo $groupId . $groupName;
				$sql = "UPDATE studentgroup SET groupName='$groupName' WHERE groupId=$groupId";
				mysqli_query($dbc, $sql);
				break;
			case 'delete':
				$groupId = mysqli_real_escape_string($dbc, $_POST["groupId"]);
				$sql = "DELETE FROM studentgroup WHERE groupId = $groupId";
				mysqli_query($dbc, $sql);
				break;
		}
	}
?>