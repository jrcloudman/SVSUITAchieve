<?php session_start();
	require_once('mysqli_connect.php');
	if (!(isset($_SESSION['userId']) && $_SESSION['userId'] != '') || $_SESSION['permissions'] == 'student') {
	    header("HTTP/1.1 401 Unauthorized");
    	exit();
	}
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$badgeId = mysqli_real_escape_string($dbc, $_GET['badgeId']);
		$sql = "SELECT * FROM badge WHERE badgeId=$badgeId";
		$result = mysqli_query($dbc, $sql);
		$data = mysqli_fetch_assoc($result);
		$data['expirationDate'] = date("m/d/Y", strtotime($data['expirationDate']));
		echo json_encode($data);
	}
	else {
		$errors = array();
		if(isset($_POST['action']) && !empty($_POST['action'])) {
			$action = $_POST['action'];
			if($action == 'add' || $action == 'modify') {
				$groupId = mysqli_real_escape_string($dbc, $_POST["groupId"]);
				$badgeName = mysqli_real_escape_string($dbc, $_POST["badgeName"]);
				$badgeDescription = mysqli_real_escape_string($dbc, $_POST["badgeDescription"]);
				$badgeGroup = mysqli_real_escape_string($dbc, $_POST["badgeGroup"]);
				$badgeType = mysqli_real_escape_string($dbc, $_POST["badgeType"]);
				$difficulty = mysqli_real_escape_string($dbc, $_POST["difficulty"]);
				if(isset($_POST["expirationDate"])) {
					$expirationDate = mysqli_real_escape_string($dbc, $_POST["expirationDate"]);
					$expirationDate = date("Y-m-d", strtotime($expirationDate));
				}
				if($_FILES["badgeImage"]["error"] !== UPLOAD_ERR_NO_FILE) {
					if($_FILES["badgeImage"]["error"] > 0) {
						$errors[] = "file upload error";
					}
					else {
						do {
							$badgeImage = substr(md5(uniqid()), 0, 10) . "." . pathinfo($_FILES["badgeImage"]["name"], PATHINFO_EXTENSION);
						}
						while (file_exists("../images/badges/" . $badgeImage));
						move_uploaded_file($_FILES["badgeImage"]["tmp_name"], "../images/badges/" . $badgeImage);
					}
				}
				else {
					$badgeImage = mysqli_real_escape_string($dbc, $_POST["existingImage"]);
					if(!file_exists("../images/badges/" . $badgeImage)) {
						$errors[] = "existing image does not exist";
					}
				}
			}
			if(!empty($errors)) {
				echo $errors[0];
			}
			else {
				switch($action) {
					case 'add':
						$sql = "INSERT INTO badge(badgeName, imageFile, badgeDescription, badgeType, badgeGroupId, groupId, dateAdded, difficulty, expirationDate) VALUES 
								('$badgeName', '$badgeImage', '$badgeDescription', '$badgeType', $badgeGroup, $groupId, NOW(), $difficulty, ";
						if(isset($expirationDate)) {
							$sql .= "'$expirationDate')"; 
						}
						else {
							$sql .= "NULL)";
						}
						mysqli_query($dbc, $sql);
						break;
					case 'modify':
						$badgeId = mysqli_real_escape_string($dbc, $_POST["badgeId"]);
						$sql = "UPDATE badge SET badgeName='$badgeName', badgeDescription='$badgeDescription', badgeType='$badgeType', badgeGroupId=$badgeGroup, difficulty=$difficulty";
						if(isset($expirationDate)) {
							$sql .= ", expirationDate='$expirationDate'";
						}
						if(isset($badgeImage)) {
							$sql .= ", imageFile='$badgeImage'";
						}
						$sql .= "WHERE badgeId=$badgeId";
						mysqli_query($dbc, $sql);
						break;
					case 'delete':
						$badgeId = mysqli_real_escape_string($dbc, $_POST["badgeId"]);
						$sql = "DELETE FROM badge WHERE badgeId=$badgeId";
						mysqli_query($dbc, $sql);
						break;
				}
			}
		}
	}
?>