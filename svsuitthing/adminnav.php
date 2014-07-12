			<?php $url = strrchr($_SERVER['PHP_SELF'], '/'); ?>
			<div class="col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li class="<?php echo ($url == '/managestudents.php' ? ' active' : '');?>"><a href="managestudents.php">Manage Students</a></li>
					<li class="<?php echo ($url == '/managebadges.php' ? ' active' : '');?>"><a href="managebadges.php">Manage Badges</a></li>
					<li class="nav-divider"></li>
					<li class="<?php echo ($url == '/managegroups.php' ? ' active' : '');?>"><a href="managegroups.php">Manage Groups</a></li>
					<li class="<?php echo ($url == '/manageadmins.php' ? ' active' : '');?>"><a href="manageadmins.php">Manage Administrators</a></li>
					<li class="<?php echo ($url == '/allbadges.php' ? ' active' : '');?>"><a href="allbadges.php">All Badges</a></li>
				</ul>
			</div> 