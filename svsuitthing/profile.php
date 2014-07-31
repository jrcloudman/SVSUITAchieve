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
					$studentId = $student['studentId'];
					echo '<div class="tab-pane';
					if($first) {
						echo ' active';
						$first = false;
					}
					echo '" id=student' . $studentId . '>';
					echo '<div class="row"><div class="col-md-2">';
					if($student['profileImage'] != NULL) {
						$profileImage = $student['profileImage'];
					}
					else {
						$profileImage = "profileDefault.jpg";
					}
					echo '<img src="images/profile/' . $profileImage . '" class="profile img-responsive img-rounded">';
					echo '<ul class="list-unstyled profile_info">';

					$startDate = date("m/d/Y", strtotime($student['startDate']));
					if($student['expectedGraduation'] != NULL) {
						$expectedGrad = date("m/d/Y", strtotime($student['expectedGraduation']));
					}
					else {
						$expectedGrad = NULL;
					}
					echo '<li id="editStudent"><span class="glyphicon glyphicon-pencil"></span><a href="#">Edit Profile...</a></li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Start Date"><span class="glyphicon glyphicon-calendar"></span>' . $startDate .'</li>';
					echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Email"><span class="glyphicon glyphicon-envelope"></span><a href="mailto:'. $student['username'] . '@svsu.edu">'. $student['username'] . '@svsu.edu</a></li>';
					if(isset($student['major'])) {
						echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Major"><span class="glyphicon glyphicon-star"></span>'. $student['major'] . '</li>';
					}
					if(isset($student['minor'])) {
						echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Minor"><span class="glyphicon glyphicon-star-empty"></span>' . $student['minor'] . '</li>';
					}
					if(isset($expectedGrad)) {
						echo '<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Exp. Grad Date"><span class="glyphicon glyphicon-calendar"></span>' . $expectedGrad .'</li>';
					}
					?>
					</ul>
					<?php if(isset($student['aboutMe'])) { ?>
					<div class="panel panel-default" id="aboutMePanel">
						<div class="panel-heading" id="aboutMePanelHeading">
							<h3 class="panel-title">About Me</h3>
						</div>
						<div class="panel-body">
							<?php
								echo $student['aboutMe'];
							?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-10">
					<?php 
						echo '<div class="panel-group" id="badge_accordian_' . $studentId . '">'; 
						$sql = "SELECT badgeId FROM student_badge WHERE studentId=$studentId";
						$earnedBadges = array();
						$result = mysqli_query($dbc, $sql);
						while($row = mysqli_fetch_assoc($result)) {
							$earnedBadges[] = $row['badgeId'];
						}
						$j = 0;
						$first = true;
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
						<div id="<?php echo $student['studentId'] . '_' . $badgegroups[$i]['badgegroupId']?>" class="panel-collapse collapse <?php if($first) {echo 'in'; $first=false;} ?>">
							<div class="panel-body">
								<table class="table badge_table">
									<?php
										$colCount = 0;
										echo '<tr>';
										while(isset($badges[$j]) && $badges[$j]['badgegroupId'] == $badgegroups[$i]['badgegroupId']) {
											echo '<td><img src="images/badges/' . $badges[$j]['imageFile'] . '" class="badgeImage ';
											if(!in_array($badges[$j]['badgeId'], $earnedBadges)) {
												echo 'faded';
											}
											echo '" id="' . $studentId . '_' . $badges[$j]['badgeId'] . '" data-toggle="tooltip" data-placement="top" title="' . $badges[$j]['badgeDescription'] . '"><div class="caption">' . $badges[$j]['badgeName'] . '</div></td>';
											$j++;
											$colCount++;
											if($colCount == 5) {
												echo '</tr><tr>';
												$colCount = 0;
											}
										}
										while($colCount != 5) {
											echo '<td></td>';
											$colCount++;
										}
										echo '</tr>';
									?>
								</table>
							</div>
						</div>
						</div> <!--/panel-->
						<?php } //End badge group for ?>
				</div> <!--/panel-group-->
				</div> <!--/col-->
				</div> <!--/row-->
				</div> <!--/pane-->
					<?php } //End student for ?>
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