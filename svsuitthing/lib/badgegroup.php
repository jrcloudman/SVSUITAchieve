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
?>