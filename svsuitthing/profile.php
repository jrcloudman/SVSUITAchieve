<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Support Center - REC/HHS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
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
		<div class="tab-content">
			<div class="tab-pane fade active in" id="ryan">
				<div class="row">
					<div class="col-md-2">
						<img src="images/ryan.jpg" class="profile img-responsive img-rounded" />
						<ul class="list-unstyled profile_info">
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Start Date"><span class="glyphicon glyphicon-calendar"></span>Started August 21, 2011</li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Email"><span class="glyphicon glyphicon-envelope"></span><a href="mailto:rcbickha@svsu.edu">rcbickha@svsu.edu</a></li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Major"><span class="glyphicon glyphicon-star"></span>Computer Science</li>
							<li class="tooltipped" data-toggle="tooltip" data-placement="left" title="Minor"><span class="glyphicon glyphicon-star-empty"></span>Mathematics</li>
						</ul>
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
			</div>
			<div class="tab-pane fade" id="eric">
				<h3>Eric DeSmet</h3>
			</div>
		</div>
	</div>
	<script src="scripts/jquery-1.11.0.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script>
		$(function() {
			$('.tooltipped').tooltip();
			$('.badgeImage').tooltip();
			$('.badgeImage').click(function() {
				if($(this).hasClass('faded')) {
					$(this).removeClass('faded');
				}
				else {
					$(this).addClass('faded');
				}
			});
		});
	</script>
</body>
</html>