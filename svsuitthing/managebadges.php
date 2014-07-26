<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Support Center - REC/HHS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
						$adminId = $_SESSION['adminId'];
						$sql = "SELECT studentgroup.groupId, studentgroup.groupName
								FROM studentgroup
								JOIN admin_group ON studentgroup.groupId = admin_group.groupId AND admin_group.adminId = $adminId";
						$result = mysqli_query($dbc, $sql);
						$first = true;
						$groups = array();
						while($row = mysqli_fetch_assoc($result)) {
							$groups[] = $row['groupId'];
							echo '<li';
							if($first) {
								echo ' class="active"';
								$first = false;
							}
							echo '><a href="#group' . $row['groupId']  . '" data-toggle="tab">' . $row['groupName'] . '</a></li>';
						}
					?>
				</ul>
				<button class="btn btn-primary" data-toggle="modal" data-target="#adminModal" id="newBadgeBtn">Add New Badge</button>
				<button class="btn btn-primary" data-toggle="modal" data-target="#badgeGroupModal" id="manageBadgeGroupsBtn">Manage Badge Groups</button><br /><br />
				<div class="tab-content">
				<?php
					$first = true;
					foreach($groups as $groupId) {
						echo '<div class="tab-pane';
						if($first) {
							echo ' active';
							$first = false;
						}
						echo '" id=group' . $groupId . '>';
						echo '<table class="table table-hover admin_table">';
						echo '<thead><tr><th>Image</th><th>Name</th><th>Description</th><th>Type</th><th>Badge Group</th><th>Date Added</th></tr></thead>';
						echo '<tbody>';
						$sql = "SELECT badge.imageFile, badge.badgeName, badge.description, badge.type, badge.groupId, badge.dateAdded, badgegroup.badgegroupName
								FROM badge, badgegroup
								WHERE badge.badgegroupId = badgegroup.badgegroupId AND badge.groupId = $groupId";
						$result = mysqli_query($dbc, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo '<tr><td><img src="images/' . $row['imageFile'] . '" class="admin_badge" /></td><td>' . $row['badgeName'] . '</td><td>' . $row['description'] . '</td><td>' . $row['type'] . '</td><td>' . $row['badgegroupName'] . '</td><td>' . $row['dateAdded'] . '</td></tr>';
						}
						echo '</tbody></table></div>';
					}				
				?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Create New Badge</h4>
			        </div>
			        <div class="modal-body">
			        	<form class="form-horizontal" id="badgeForm" method="post">
			        		<div class="form-group">
				        		<div class="fileinput fileinput-new" data-provides="fileinput">
			        				<div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
			        				<div>
			        					<span class="btn btn-primary btn-file"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" id="badge-file" name="badgeFile"></span>
			        					<a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
		        					</div>
				        		</div>
			        		</div>
        					<div class="form-group">
    							<label for="badgeName" class="col-md-4 control-label">Badge Name</label>
    							<div class="col-md-7">
	        						<input type="text" class="form-control" id="badgeName" name="badgeName" placeholder="Badge Name">
    							</div>
        					</div>
        					<div class="form-group">
    							<label for="badgeDescription" class="col-md-4 control-label">Badge Description</label>
    							<div class="col-md-7">
    								<textarea class="form-control" rows="3" id="badgeDescription" name="badgeDescription"></textarea>
    							</div>
        					</div>
        					<div class="form-group">
        						<label for="badgeGroup" class="col-md-4 control-label">Badge Group</label>
        						<div class="col-md-7">
    								<select class="form-control" id="badgeGroup" name="badgeGroup">
    								</select>
        						</div>
        					</div>
        					<div class="form-group">
    							<label for="badgeType" class="col-md-4 control-label">Badge Type</label>
    							<div class="col-md-7">
									<div class="radio">
										<span class="tooltipped" data-toggle="tooltip" data-placement="right" title="Earned once and does not reset">
											<input type="radio" name="badgeType" value="Standard" checked> Standard
										</span>
									</div>
									<div class="radio">
										<span class="tooltipped" data-toggle="tooltip" data-placement="right" title="Resets at the desired expiration date to be earned multiple times">
											<input type="radio" name="badgeType" id="recurring" value="Recurring">Recurring
										</span>
									</div>    							
								</div>
        					</div>
	        				<div class="form-group">
    							<label for="expirationDate" class="col-md-4 control-label">Expiration Date</label>
    							<div class="col-md-7">
	        						<input type="text" class="form-control" id="expirationDate" name="expirationDate" placeholder="Expiration Date" disabled>
        						</div>
	        				</div>
	        				<input type="hidden" name="groupId" id="groupId" value="">
	        				<input type="hidden" name="badgeId" id="badgeId" value="">
	        				<input type="hidden" name="action" id="action" value="add">
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary" id="badgeFormDelete">Delete Badge</button>
				        <button type="button" class="btn btn-primary" id="badgeFormSubmit">Add</button>
			        </div>
		    	</div>
		    </div>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/bootstrap-select.min.js"></script>
	<script src="scripts/jquery.dataTables.min.js"></script>
	<script src="scripts/dataTables.bootstrap.js"></script>
	<script src="scripts/jasny-bootstrap.min.js"></script>
	<script src="scripts/moment.min.js"></script>
	<script src="scripts/bootstrap-datetimepicker.js"></script>
	<script src="scripts/managebadges.js"></script>
</body>
</html>
