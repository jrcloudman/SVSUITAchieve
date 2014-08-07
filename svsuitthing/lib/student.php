<?php
	require_once('mysqli_connect.php');
	require_once('PasswordHash.php');
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$studentId = mysqli_real_escape_string($dbc, $_GET['studentId']);
		$sql = "SELECT * FROM student WHERE studentId=$studentId";
		$result = mysqli_query($dbc, $sql);
		$data = mysqli_fetch_assoc($result);
		$data['startDate'] = date("m/d/Y", strtotime($data['startDate']));
		if($data['expectedGraduation'] != NULL) {
			$data['expectedGraduation'] = date("m/d/Y", strtotime($data['expectedGraduation']));
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
					echo $sql;
					mysqli_query($dbc, $sql);
					break;
				case 'modify':
					$studentId = mysqli_real_escape_string($dbc, $_POST["studentId"]);
					$sqlPw = "";
					if(isset($_POST['tempPassword'])) {
						$password = mysqli_real_escape_string($dbc, $_POST["tempPassword"]);
						$saltedHash = create_hash($password);
						$sqlPw = "password='$saltedHash',";
					}
					$sql = "UPDATE student SET firstName='$firstName', lastName='$lastName', username='$username', " . $sqlPw . "startDate='$startDate' WHERE studentId='$studentId'";
					mysqli_query($dbc, $sql);
					break;
				case 'profile_modify':
					$studentId = mysqli_real_escape_string($dbc, $_POST['studentId']);
					$expDate = mysqli_real_escape_string($dbc, $_POST['expGradDate']);
					$aboutMe = mysqli_real_escape_string($dbc, $_POST['aboutMe']);
					$major = mysqli_real_escape_string($dbc, $_POST['major']);
					$minor = mysqli_real_escape_string($dbc, $_POST['minor']);

					$convDate = date("Y-m-d", strtotime($expDate));
					$expDate = !empty($expDate) ? "'$convDate'" : "NULL";
					$aboutMe = !empty($aboutMe) ? "'$aboutMe'" : "NULL";
					$major = !empty($major) ? "'$major'" : "NULL";
					$minor = !empty($minor) ? "'$minor'" : "NULL";
					$sql = "UPDATE student SET expectedGraduation=$expDate, aboutMe=$aboutMe, major=$major, minor=$minor";
					if($_FILES["profileImage"]["error"] !== UPLOAD_ERR_NO_FILE) {
						if($_FILES["profileImage"]["error"] > 0) {
							$errors[] = "file upload error";
						}
						else {
							do {
								$profileImage = substr(md5(uniqid()), 0, 10) . "." . pathinfo($_FILES["profileImage"]["name"], PATHINFO_EXTENSION);
							}
							while (file_exists("../images/badges/" . $profileImage));
							move_uploaded_file($_FILES["profileImage"]["tmp_name"], "../images/profile/" . $profileImage);
							$sql .= ", profileImage='$profileImage'";
						}
					}

					$sql .= " WHERE studentId=$studentId";
					mysqli_query($dbc, $sql);
					echo $sql;
					break;
				case 'delete':
					$studentId = mysqli_real_escape_string($dbc, $_POST["studentId"]);
					$sql = "DELETE FROM student WHERE studentId = $studentId";
					mysqli_query($dbc, $sql);
					break;
			}
		}
	}
?>