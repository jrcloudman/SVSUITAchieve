	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">SVSU IT Student Achievment Tracker</a>
			</div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Groups <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php
								require_once('lib/mysqli_connect.php');
								$sql = "SELECT * FROM studentgroup ORDER BY groupName";
								$result = mysqli_query($dbc, $sql);
								while($row = mysqli_fetch_assoc($result)) {
									echo '<li><a href="profile.php?groupId=' . $row['groupId'] . '">' . $row['groupName'] . "</a></li>";
								}
							?>
						</ul>
					</li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if($_SESSION['permissions'] != 'student') {
							echo '<li><a href="managestudents.php">Admin Panel</a></li>';
						}
					?>
					<li><a href="changepassword.php">Change Password</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
            </div>
		</div>
	</div>