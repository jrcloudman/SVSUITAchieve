<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Support Center - REC/HHS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container body-content">
		<h2>Administration Panel</h2>
		<div class="row">
			<?php include 'adminnav.php'; ?>
			<div class="col-md-9">
				<ul class="nav nav-tabs">
					<?php
						require_once('lib/mysqli_connect.php');
						$sql = "SELECT groupId, groupName FROM studentgroup WHERE ";
						for($i = 0; $i < sizeof($_SESSION['groups']) - 1; $i++) {
							$groupId = $_SESSION['groups'][$i];
							$sql .= "groupId = $groupId OR ";
						}
						$groupId = $_SESSION['groups'][$i];
						$sql .= "groupId = $groupId";
						$result = mysqli_query($dbc, $sql);
						$first = true;
						while($row = mysqli_fetch_assoc($result)) {
							echo '<li';
							if($first) {
								echo ' class="active"';
								$first = false;
							}
							echo '><a href="#group' . $row['groupId']  . '" data-toggle="tab">' . $row['groupName'] . '</a></li>';
						}
					?>
				</ul>
				<div class="tab-content">
				<?php
					$first = true;
					foreach($_SESSION['groups'] as $groupId) {
						echo '<div class="tab-pane';
						if($first) {
							echo ' active in';
							$first = false;
						}
						echo '" id=group' . $groupId . '>';
						echo '<table class="table table-hover admin_table">';
						echo '<thead><tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Start Date</th><th>Date Added</th></tr></thead>';
						echo '<tbody>';
						$sql = "SELECT studentId, firstName, lastName, username, startDate, dateAdded FROM student WHERE groupId=$groupId";
						$result = mysqli_query($dbc, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo '<tr><td class="studentId">' . $row['studentId'] . '</td><td>' . $row['firstName'] . '</td><td>' . $row['lastName'] . '</td><td>' . $row['username'] . '</td><td>' . $row['startDate'] . '</td><td>' . $row['dateAdded'] . '</td></tr>';
						}
						echo '</tbody></table></div>';
					}				
				?>
				<button class="btn btn-primary" data-toggle="modal" data-target="#studentModal" id="newStudentBtn">Add Student</button>
			</div>
		</div>
		<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Add New Student</h4>
			        </div>
			        <div class="modal-body">
			        	<form class="form-horizontal" id="studentForm" method="post">
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
    							<label for="startDate" class="col-md-4 control-label">Start Date</label>
    							<div class="col-md-7">
	        						<input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" >
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
	        				<input type="hidden" name="groupId" id="groupId" value="">
	        				<input type="hidden" name="studentId" id="studentId" value="">
	        				<input type="hidden" name="action" id="action" value="add">
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        	<button type="button" class="btn btn-danger" id="studentFormDelete">Delete Student</button>
				        <button type="button" class="btn btn-primary" id="studentFormSubmit">Add</button>
			        </div>
		    	</div>
		    </div>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/moment.min.js"></script>
	<script src="scripts/bootstrap-datetimepicker.js"></script>
	<script src="scripts/managestudents.js"></script>
</body>
</html>
