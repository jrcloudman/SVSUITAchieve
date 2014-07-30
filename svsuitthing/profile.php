<?php 
	session_start(); 
	require_once('lib/mysqli_connect.php'); 
	$groupId = mysqli_real_escape_string($dbc, $_GET['groupId']);
	$sql = "SELECT * FROM badge WHERE groupId=$groupId ORDER BY badgegroupId, difficulty";
	$badges = array();
	$result = mysqli_query($dbc, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$badges[] = $row;
	}
	$sql = "SELECT * FROM badgegroup WHERE groupId=$groupId";
	$badgegroups = array();
	$result = mysqli_query($dbc, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$badgegroups[] = $row;
	}
?>
<!DOCTYPE html>
<html>
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
		<?php
			$sql = "SELECT groupName FROM studentgroup WHERE groupId=$groupId";
			$result = mysqli_fetch_assoc(mysqli_query($dbc, $sql));
			echo '<h2>' . $result['groupName'] . '</h2>';
		?>
		<hr />
		<ul class="nav nav-tabs">
			<?php
				$adminId = $_SESSION['adminId'];
				$sql = "SELECT * FROM student WHERE groupId=$groupId";
				$result = mysqli_query($dbc, $sql);
				$first = true;
				$students = array();
				while($row = mysqli_fetch_assoc($result)) {
					$students[] = $row;
					echo '<li';
					if($first) {
						echo ' class="active"';
						$first = false;
					}
					echo '><a href="#student' . $row['studentId']  . '" data-toggle="tab">' . $row['firstName'] . ' ' . $row['lastName'] . '</a></li>';
				}
			?>
		</ul>
		<!-- This divider contains recent cosmetic additions -->
		<div class="tab-content">
			<?php
				$first = true;
				foreach($students as $student) {
					echo '<div class="tab-pane';
					if($first) {
						echo ' active';
						$first = false;
					}
					echo '" id=student' . $student['studentId'] . '>';
					echo '<div class="row"><div class="col-md-2">';
					if($student['profileImage'] != NULL) {
						$profileImage = $student['profileImage'];
					}
					else {
						$profileImage = "profileDefault.jpg";
					}
					echo '<img src="images/profile/' . $profileImage . '" class="profile img-reesponsive img-rounded">';
					echo '<ul class="list-unstyled profile_info">';

					$startDate = date("m/d/Y", strtotime($student['startDate']));
					if($student['expectedGraduation'] != NULL) {
						$expectedGrad = date("m/d/Y", strtotime($student['expectedGraduation']));
					}
					else {
						$expectedGrad = '';
					}
					echo '<li id="editStudent"><span class="glyphicon glyphicon-pencil"></span><a href="#">Edit Profile...</a></li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Start Date"><span class="glyphicon glyphicon-calendar"></span>' . $startDate .'</li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Email"><span class="glyphicon glyphicon-envelope"></span><a href="mailto:'. $student['username'] . '@svsu.edu">'. $student['username'] . '@svsu.edu</a></li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Major"><span class="glyphicon glyphicon-star"></span>'. $student['major'] . '</li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Minor"><span class="glyphicon glyphicon-star-empty"></span>' . $student['minor'] . '</li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Exp. Grad Date"><span class="glyphicon glyphicon-calendar"></span>' . $expectedGrad .'</li>';
					?>
					</ul>
					<div class="panel panel-default" id="aboutMePanel">
						<div class="panel-heading" id="aboutMePanelHeading">
							<h3 class="panel-title">About Me</h3>
						</div>
						<div class="panel-body">
							<?php
								echo $row['aboutMe'];
							?>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<?php 
						echo '<div class="panel-group" id="badge_accordian_' . $student['studentId'] . '">'; 
						for($i = 0; $i < count($badgegroups); $i++) {
							echo '<div class="panel"><div class="panel-heading" style="background-color: ' . $badgegroups[$i]['color'] . ';">';
							?>
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#badge_accordian_<?php echo $student['studentId'] ?>" href="#<?php echo $student['studentId'] . '_' . $badgegroups[$i]['badgegroupId']?>">
									<?php echo $badgegroups[$i]['badgegroupName']; ?>
								</a>
								<a class="pull-right" data-toggle="collapse" data-parent="#badge_accordian_ryan" href="<?php echo $student['studentId'] . '_' . $badgegroups[$i]['badgegroupId']?>">
									10/10 Badges Earned
								</a>
							</h4>
						</div>
						<div id="<?php echo $student['studentId'] . '_' . $badgegroups[$i]['badgegroupId']?>" class="panel-collapse collapse">
							<div class="panel-body">
								Basic Badges Go Here
							</div>
						</div>
						</div> <!--/panel-->
						<?php } //End badge group for ?>
				</div> <!--/panel-group-->
				</div> <!--/col-->
				</div> <!--/row-->
				</div> <!--/pane-->
					<?php } //End student for ?>
<!-- 			<div class="tab-pane fade active in" id="ryan">
				<div class="row">
					<div class="col-md-2">
						<img src="images/ryan.jpg" class="profile img-responsive img-rounded" />
						<ul class="list-unstyled profile_info">
						<?php
							$sql = "SELECT username, startDate, major, minor, aboutMe, expectedGraduation FROM student WHERE studentID='11'";
							$student= mysqli_query($dbc, $sql);
							$row = mysqli_fetch_assoc($student);
							$startDate = date("m/d/Y", strtotime($row['startDate']));
							if($row['expectedGraduation'] != NULL) {
								$expectedGrad = date("m/d/Y", strtotime($row['expectedGraduation']));
							}
							else {
								$expectedGrad = '';
							}
							echo '<li id="editStudent"><span class="glyphicon glyphicon-pencil"></span><a href="#">Edit Profile...</a></li>';
							echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Start Date"><span class="glyphicon glyphicon-calendar"></span>' . $startDate .'</li>';
							echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Email"><span class="glyphicon glyphicon-envelope"></span><a href="mailto:'.$row['username'].'@svsu.edu">'.$row['username'].'@svsu.edu</a></li>';
							echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Major"><span class="glyphicon glyphicon-star"></span>'.$row['major'].'</li>';
							echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Minor"><span class="glyphicon glyphicon-star-empty"></span>'.$row['minor'].'</li>';
							echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Exp. Grad Date"><span class="glyphicon glyphicon-calendar"></span>' . $expectedGrad .'</li>';
						?>							
						</ul>
						<div class="panel panel-default" id="aboutMePanel">
							<div class="panel-heading" id="aboutMePanelHeading">
								<h3 class="panel-title">About Me</h3>
							</div>
							<div class="panel-body">
								<?php
									echo $row['aboutMe'];
								?>
							</div>
						</div>
					</div>
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
			</div> -->
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
					<form class="form-horizontal" id="profileForm" method="post" action="profile.php">
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
        				<input type="hidden" name="action" id="action" value="profile_modify">
        				<input type="hidden" name="studentId" id="studentId" value="">     				     				
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