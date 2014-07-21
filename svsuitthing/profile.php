<!DOCTYPE html>
<html>
<?php
require_once('lib/mysqli_connect.php');
// Connect to db
if (isset($_POST['studentFormSubmit'])) {
	// Assign equivalent values from $_POST array
	$expDate = mysqli_real_escape_string($dbc, $_POST['expGradDate']);
	$aboutMe = mysqli_real_escape_string($dbc, $_POST['aboutMe']);
	$major   = mysqli_real_escape_string($dbc, $_POST['majorField']);
	$minor   = mysqli_real_escape_string($dbc, $_POST['minorField']);

	// Update db attributes
	mysqli_query($dbc,"UPDATE student SET expectedGraduation='$expDate', aboutMe='$aboutMe', major='$major', minor='$minor'
		WHERE FirstName='John' AND LastName='Smith'");

	// Close db
	mysqli_close($dbc);	
}
?>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ITS Support Center - REC/HHS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container body-content">
		<h2>IT Support Center - REC/HHS</h2>
		<hr />
		<ul class="nav nav-tabs">
			<li class="active"><a href="#ryan" data-toggle="tab">Ryan Bickham</a></li>
			<li><a href="#eric" data-toggle="tab">Eric DeSmet</a></li>
		</ul>

		<!-- This divider contains recent cosmetic additions -->
		<div class="tab-content">
			<div class="tab-pane fade active in" id="ryan">
				<div class="row">
					<div class="col-md-2">
						<img src="images/ryan.jpg" class="profile img-responsive img-rounded" />
						<ul class="list-unstyled profile_info">
							<li id="editStudent"><span class="glyphicon glyphicon-pencil"></span><a href="#">Edit Profile...</a></li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Start Date"><span class="glyphicon glyphicon-calendar"></span>Started August 21, 2011</li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Email"><span class="glyphicon glyphicon-envelope"></span><a href="mailto:rcbickha@svsu.edu">rcbickha@svsu.edu</a></li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Major"><span class="glyphicon glyphicon-star"></span>Computer Science</li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Minor"><span class="glyphicon glyphicon-star-empty"></span>Mathematics</li>
						</ul>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">About Me</h3>
							</div>
							<div class="panel-body">
								This is where we'll type interesting things about ourselves.
							</div>
						</div>
					</div>
					<!-- End of additions -->

					<div class="col-md-9">
						<div class="panel-group" id="badge_accordian_ryan">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#badge_accordian_ryan" href="#ryanLevelOne">
											Basic Training
										</a>
										<a class="pull-right" data-toggle="collapse" data-parent="#badge_accordian_ryan" href="#ryanLevelOne">
											10/10 Badges Earned
										</a>
									</h4>
								</div>
								<div id="ryanLevelOne" class="panel-collapse collapse">
									<div class="panel-body">
										Basic Badges Go Here
									</div>
								</div>
							</div>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#badge_accordian_ryan" href="#ryanLevelTwo">
											Standard Badges
										</a>
										<a class="pull-right" data-toggle="collapse" data-parent="#badge_accordian_ryan" href="#ryanLevelTwo">
											6/8 Badges Earned
										</a>
									</h4>
								</div>
								<div id="ryanLevelTwo" class="panel-collapse collapse in">
									<div class="panel-body">
										<table class="table badge_table">
											<tr>
												<td>
													<img src="images/badge.png" class="badgeImage" data-toggle="tooltip" data-placement="top" title="Turned on the EN110 office computer"/>
													<div class="caption">Is the Power Turned On?</div>
												</td>
												<td>
													<img src="images/badge.png" class="badgeImage" data-toggle="tooltip" data-placement="top" title="Took a support call"/>
													<div class="caption">IT Support, How May I Help You?</div>
												</td>												
												<td>
													<img src="images/badge.png" class="badgeImage faded" data-toggle="tooltip" data-placement="top" title="Attended Cherwell training"/>
													<div class="caption">Student of Cherwell</div>
												</td>												
												<td>
													<img src="images/badge.png" class="badgeImage" data-toggle="tooltip" data-placement="top" title="Assisted with an Echo360 recording"/>
													<div class="caption">Lecture Captured</div>
												</td>												
												<td>
													<img src="images/badge.png" class="badgeImage faded" data-toggle="tooltip" data-placement="top" title="Attended Microsoft Office training"/>
													<div class="caption">Office Executive</div>
												</td>
											</tr>
											<tr>
												<td>
													<img src="images/badge.png" class="badgeImage" data-toggle="tooltip" data-placement="top" title="Self explanatory"/>
													<div class="caption">Bought Jeff Lunch</div>
												</td>
												<td>
													<img src="images/badge.png" class="badgeImage" data-toggle="tooltip" data-placement="top" title="Loaded over 100 reams of paper into computer labs"/>
													<div class="caption">Paper Master</div>
												</td>												
												<td>
													<img src="images/badge.png" class="badgeImage" data-toggle="tooltip" data-placement="top" title="Retrieved paper from the loading dock"/>
													<div class="caption">Do You Even Lift?</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#badge_accordian_ryan" href="#ryanLevelThree">
											Semester Awards
										</a>
										<a class="pull-right" data-toggle="collapse" data-parent="#badge_accordian_ryan" href="#ryanLevelThree">
											5/7 Badges Earned
										</a>
									</h4>
								</div>
								<div id="ryanLevelThree" class="panel-collapse collapse">
									<div class="panel-body">
										Advanced Badges Go Here
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="eric">
				<h3>Eric DeSmet</h3>
			</div>
		</div>
	</div>

	<!-- Added Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_x">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="studentForm" method="post" action="profile.php">
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
							<label for="expGradDate" class="col-md-4 control-label">Expected Graduation Date</label>
							<div class="col-md-7">
								<input type="text" data-date-format="YYYY/MM/DD" class="form-control" id="expGradDate" name="expGradDate" placeholder="Expected Graduation Date">
							</div>
						</div> 
						<div class="form-group">
							<label for="aboutMe" class="col-md-4 control-label">About Me</label>
							<div class="col-md-7">
								<textarea class="form-control" rows="3" id="aboutMe" name="aboutMe" placeholder="About Me"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="majorField" class="col-md-4 control-label">Major</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="majorField" name="majorField" placeholder="Major">
							</div>
						</div>
						<div class="form-group">
							<label for="minorField" class="col-md-4 control-label">Minor</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="minorField" name="minorField" placeholder="Minor">
							</div>
						</div>       				
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="studentFormSubmit" name="studentFormSubmit">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/profile.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script src="scripts/moment.min.js"></script>
	<script src="scripts/bootstrap-datetimepicker.js"></script>
</body>
</html>