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
					<li class="active"><a href="#group1" data-toggle="tab">IT Support Center - REC/HHS</a></li>
					<li><a href="#group2" data-toggle="tab">IT Support Center - Main Campus</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active in" id="group1">
						<table class="table table-hover admin_table">
							<thead>
								<tr>
									<th>Id</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Start Date</th><th>Date Added</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td><td>Ryan</td><td>Bickham</td><td>rcbickha<td>8/21/2011</td><td>6/28/14</td>
								</tr>
								<tr>
									<td>2</td><td>Eric</td><td>DeSmet</td><td>eadesmet<td>8/26/2012</td><td>6/28/14</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="group2">
						<table class="table table-hover admin_table">
							<thead>
								<tr>
									<th>Id</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Start Date</th><th>Date Added</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>3</td><td>John</td><td>Smith</td><td>jdsmith9<td>8/18/2013</td><td>6/29/14</td>
								</tr>
								<tr>
									<td>4</td><td>Jane</td><td>Doe</td><td>jedoe3<td>7/1/2013</td><td>6/29/14</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<button class="btn btn-primary" data-toggle="modal" data-target="#studentModal">Add Student</button>
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
			        	<form class="form-horizontal" id="studentForm" method="post" action="lib/student.php">
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
    							</div>
	        				</div>
			        	</form>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary" id="addStudentSubmit">Add</button>
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
	<script>
		$(function() {
			$('#startDate').datetimepicker({
				pickTime: false
			});
		});
	</script>
</body>
</html>
