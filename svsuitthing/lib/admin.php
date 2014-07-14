<?php
	require_once('mysqli_connect.php');
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'get':
				break;
			case 'add':
				break;
			case 'modify':
				break;
			case 'delete':
				break;
		}
	}
?>