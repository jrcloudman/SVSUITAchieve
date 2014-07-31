<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Support Center - REC/HHS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-colorpicker.min.css" rel="stylesheet">
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
				<button class="btn btn-primary" data-toggle="modal" data-target="#badgeModal" id="newBadgeBtn">Add New Badge</button>
				<button class="btn btn-primary" data-toggle="modal" data-target="#badgegroupModal" id="manageBadgegroupsBtn">Manage Badge Groups</button><br /><br />
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
						$sql = "SELECT badge.badgeId, badge.imageFile, badge.badgeName, badge.badgeDescription, badge.badgeType, badge.groupId, badge.dateAdded, badgegroup.badgegroupName
								FROM badge, badgegroup
								WHERE badge.badgegroupId = badgegroup.badgegroupId AND badge.groupId = $groupId";
						$result = mysqli_query($dbc, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo '<tr id="' . $row['badgeId'] . '"><td><img src="images/badges/' . $row['imageFile'] . '" class="admin_badge" /></td><td>' . $row['badgeName'] . '</td><td>' . $row['badgeDescription'] . '</td><td>' . $row['badgeType'] . '</td><td>' . $row['badgegroupName'] . '</td><td>' . $row['dateAdded'] . '</td></tr>';
						}
						echo '</tbody></table></div>';
					}				
				?>
				</div>
			</div>
		</div>
		<div class="modal fade" id="badgeModal" tabindex="-1" role="dialog" aria-labelledby="badgeModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="badgeModalLabel">Create New Badge</h4>
			        </div>
			        <div class="modal-body">
			        	<form class="form-horizontal" id="badgeForm" enctype = "multipart/form-data" action="lib/badge.php" method="post">
			        		<div class="form-group">
				        		<div class="fileinput fileinput-new" data-provides="fileinput">
			        				<div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
			        				<div>
			        					<a href="#" id="chooseExistingBtn" class="btn btn-primary fileinput-new">Choose Existing</a>
			        					<span class="btn btn-primary btn-file"><span class="fileinput-new">Browse...</span><span class="fileinput-exists">Change</span><input type="file" id="badgeImage" name="badgeImage"></span>
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
        						<label for="difficulty" class="col-md-4 control-label">Difficulty</label>
        						<div class="col-md-7">
									<span class="tooltipped" data-toggle="tooltip" data-placement="top" title="Badges on student pages are sorted by difficulty, then by name">
	    								<select class="form-control" id="difficulty" name="difficulty">
	    									<option value="1">Easy</option>
	    									<option value="2">Medium</option>
	    									<option value="3">Hard</option>
	    								</select>
    								</span>
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
	        				<input type="hidden" name="existingImage" id="existingImage" value="">
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-danger" id="badgeFormDelete">Delete Badge</button>
				        <button type="button" class="btn btn-primary" id="badgeFormSubmit">Add</button>
			        </div>
		    	</div>
		    </div>
		</div>
		<div class="modal fade" id="badgeImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel">Choose an Existing Badge Image</h4>
			        </div>
			        <div class="modal-body">
		   				<table id="badgeChooser" class="badge_table">
		   					<?php
		   						$sql = "SELECT DISTINCT imageFile FROM badge";
		   						$result = mysqli_query($dbc, $sql);
		   						while($row = mysqli_fetch_assoc($result)) {
		   							echo '<tr>';
			   						for($i = 0; $i < 5; $i++) {
			   							echo '<td><img class="img-responsive badgeImage" src="images/badges/' . $row['imageFile'] . '"></td>';
			   							if(!($row = mysqli_fetch_assoc($result))) break;
			   						}
			   						echo '</tr>';
		   						}
		   					?>
		   				</table>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
		    	</div>
		    </div>
		</div>
		<div class="modal fade" id="badgegroupModal" tabindex="-1" role="dialog" aria-labelledby="badgegroupModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="badgegroupModalLabel">Manage Badge Groups</h4>
			        </div>
			        <div class="modal-body">
	   					<form class="form-horizontal" id="badgegroupForm">
	        				<input type="hidden" name="badgegroup_groupId" id="badgegroup_groupId" value="">
	   					</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary" id="badgegroupFormSubmit">Save Changes</button>
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
	<script src="scripts/bootstrap-colorpicker.min.js"></script>
	<script src="scripts/managebadges.js"></script>
</body>
</html>
