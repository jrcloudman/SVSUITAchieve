<?php 
	require_once('checkloggedin.php'); 
	if($_SESSION['permissions'] != 'full') {
		header ("Location: unauthorized.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Support Center - REC/HHS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container body-content">
		<h2>Administration Panel</h2>
		<div class="row">
		<?php include 'adminnav.php'; ?>
			<div class="col-md-9">
				<table class="table table-hover admin_table">
					<thead>
						<tr id="tableHeader">
							<th>Id</th><th>Group Name</th><th>Date Added</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once('lib/mysqli_connect.php');
							$sql = "SELECT * FROM studentgroup";
							$groups = mysqli_query($dbc, $sql);
							while($row = mysqli_fetch_assoc($groups)) {
								echo '<tr><td class="groupId">' . $row['groupId'] . '</td><td class="groupName">' . $row['groupName'] . '</td><td>' . $row['dateAdded'] . '</td></tr>';
							}
						?>
					</tbody>
				</table>
				<button class="btn btn-primary" id="newGroupBtn" data-toggle="modal" data-target="#adminModal">Add Group</button>
			</div>
		</div>
		<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add New Group</h4>
			        </div>
			        <div class="modal-body">
			        	<form class="form-horizontal" id="groupForm" method="post">
	        				<div class="form-group">
	        					<label for="groupName" class="col-md-4 control-label">Group Name</label>
	        					<div class="col-md-7">
	        						<input type="text" class="form-control" id="groupName" name="groupName" placeholder="Group Name">
        						</div>
	        				</div>
	        				<input type="hidden" name="groupId" id="groupId" value="">
	        				<input type="hidden" name="action" id="action" value="add">
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-danger" id="groupFormDelete">Delete Group</button>
				        <button type="button" class="btn btn-primary" id="groupFormSubmit">Add</button>
			        </div>
		    	</div>
		    </div>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/bootstrap-select.min.js"></script>
	<script src="scripts/managegroups.js"></script>
</body>
</html>
