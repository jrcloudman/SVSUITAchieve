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
				<table class="table table-hover admin_table" id="badge_table">
					<thead>
						<tr>
							<th>Image</th><th>Name</th><th>Description</th><th>Type</th><th>Created By</th><th>Date Added</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><img src="images/badge.png" class="admin_badge"/></td><td>Paper Master</td><td>Loaded over 100 reams of paper into computer labs</td><td>Semester Recurring<td>Jeff Roberts</td><td>6/30/14</td>
						</tr>
						<tr>
							<td><img src="images/badge.png" class="admin_badge"/></td><td>Lecture Captured</td><td>Assisted with an Echo360 Recording</td><td>Standard<td>Jeff Roberts</td><td>6/30/14</td>
						</tr>
					</tbody>
				</table>
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
			        	<form class="form-horizontal" id="studentForm" method="post">
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
    							<label for="badgeType" class="col-md-4 control-label">Badge Type</label>
    							<div class="col-md-7">
									<div class="radio">
										<span class="tooltipped" data-toggle="tooltip" data-placement="right" title="Earned once and does not reset">
											<input type="radio" name="badgeType" name="standard" checked> Standard
										</span>
									</div>
									<div class="radio">
										<span class="tooltipped" data-toggle="tooltip" data-placement="right" title="Resets at the beginning of each semester to be earned multiple times">
											<input type="radio" name="badgeType" id="recurring" name="fullPermissions"> Semester Recurring
										</span>
									</div>    							
								</div>
        					</div>
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Add</button>
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
	<script>
		$(function() {
			$('.tooltipped').tooltip();
			$('.selectpicker').selectpicker();
			$('#badge_table').DataTable({
			});
		});
	</script>
</body>
</html>