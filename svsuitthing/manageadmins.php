<?php
	session_start();
	//require_once('lib/session.php');
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
							<th>Id</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Permissions</th><th>Date Added</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once('lib/mysqli_connect.php');
							$sql = "SELECT adminId, firstName, lastName, username, dateAdded, permissions FROM admin";
							$admins= mysqli_query($dbc, $sql);
							while($row = mysqli_fetch_assoc($admins)) {
								$permissions = 'Group';
								if($row['permissions'] == 1) $permissions = 'Full';
								echo '<tr><td class="adminId">' . $row['adminId'] . '</td><td class="firstName">' . $row['firstName'] . '</td><td class="lastName">' . $row['lastName'] . '</td><td class="username">' . $row['username'] . '</td><td class="permissions">' . $permissions . '</td><td>' . $row['dateAdded'] . '</td></tr>';
							}
						?>
					</tbody>
				</table>
				<button class="btn btn-primary" data-toggle="modal" data-target="#adminModal" id="newAdminBtn">Add Administrator</button>
			</div>
		</div>
		<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add New Administrator</h4>
			        </div>
			        <div class="modal-body">
			        	<form class="form-horizontal" id="adminForm" action="lib/admin.php" method="post">
	        				<div class="form-group">
	        					<label for="studentName" class="col-md-4 control-label">Name</label>
	        					<div class="col-md-3">
	        						<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First">
        						</div>
	        					<div class="col-md-4">
	        						<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last">
        						</div>
	        				</div>
	        				<div class="form-group">
    							<label for="username" class="col-md-4 control-label">Username</label>
    							<div class="col-md-7">
	        						<input type="text" class="form-control" id="username" name="username" placeholder="Username">
        						</div>
	        				</div>
	        				<div class="form-group">
        						<label for="tempPassword" class="col-md-4 control-label">Temporary Password</label>
        						<div class="col-md-4">
        							<input type="text" class="form-control" id="tempPassword" name="tempPassword" placeHolder="Temporary Password">
        						</div>
        						<div class="col-md-3">
        							<button type="button" class="btn btn-primary" id="generatePassword">Generate</button>
        							<button type="button" class="btn btn-warning" id="resetPassword">Reset Password</button>
    							</div>
	        				</div>
	        				<div class="form-group">
    							<label for="permissions" class="col-md-4 control-label">Permissions</label>
    							<div class="col-md-7">
									<div class="radio">
										<input type="radio" name="permissions" id="permissions" value="2" checked> Group
									</div>
									<div class="radio">
										<input type="radio" name="permissions" id="permissions" value="1"> Full
									</div>
    							</div>
	        				</div>
	        				<div class="form-group">
    							<label for="groups" class="col-md-4 control-label">Groups</label>
    							<div class="col-md-7">
    								<select class="selectpicker	" name="groups[]" id="groups" data-width="100%" multiple>
										<?php
											$sql = "SELECT groupId, groupName FROM studentgroup ORDER BY groupName";
											$groups = mysqli_query($dbc, $sql);
											while($row = mysqli_fetch_assoc($groups)) {
												echo '<option value="' . $row['groupId'] . '">' . $row['groupName'] . '</option>';
											}
										?>
    								</select>
    							</div>
	        				</div>
	        				<input type="hidden" name="adminId" id="adminId" value="">
	        				<input type="hidden" name="action" id="action" value="add">
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        	<button type="button" class="btn btn-danger" id="adminFormDelete">Delete Administrator</button>
				        <button type="button" class="btn btn-primary" id="adminFormSubmit">Add</button>
			        </div>
		    	</div>
		    </div>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/bootstrap-select.min.js"></script>
	<script src="scripts/manageadmins.js"></script>
</body>
</html>
