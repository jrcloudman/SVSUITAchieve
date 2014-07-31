<?php	
	require_once('mysqli_connect.php');
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$groupId = mysqli_real_escape_string($dbc, $_GET['groupId']);
		$sql = "SELECT * FROM badgegroup WHERE groupId=$groupId";
		$result = mysqli_query($dbc, $sql);
		$data = array();
		while($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}
		echo json_encode($data);
	}
	else {
		$badgegroups = array();
		$badgegroups['ids'] = $_POST['badgegroupId'];
		$badgegroups['names'] = $_POST['badgegroupName'];
		$badgegroups['colors'] = $_POST['badgegroupColor'];
		$groupId = mysqli_real_escape_string($dbc, $_POST['badgegroup_groupId']);
		
		for($i = 0; $i < count($badgegroups['ids']); $i++) {
			$sql = "UPDATE badgegroup SET badgegroupName='" . $badgegroups['names'][$i] . "', color='" . $badgegroups['colors'][$i] . "' WHERE badgegroupId=" . $badgegroups['ids'][$i];
			mysqli_query($dbc, $sql); 
		}
	}
?>