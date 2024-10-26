	<header class="header-section">
		<div class="header-bottom">
			<a href="index.php" class="site-logo" style="color:#fff; font-weight:bold; font-size:26px;">
			<h2><i>HUANFITNESS PAL</i></h2><br/>
			</a>
			
			<div class="container">
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="pricing.php">Pricing</a></li>
					<li><a href="trainers.php">Trainers</a></li>
					<li><a href="contact.php">Contact</a></li>
					
					<?php if(strlen($_SESSION['uid'])==0): ?>
						<li><a href="admin/">Admin</a></li>
					<?php else :?>
						<li><a href="booking-history.php">Booking History</a></li>
					<?php endif;?>

					<?php if(strlen($_SESSION['uid'])==0): ?>
						<li><a href="login.php">Login</a></li>
					<?php else :?>
						<li><a href="profile.php">My Profile</a></li>
						<li><a href="changepassword.php">Change Password</a></li>
						<li><a href="logout.php">Logout</a></li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</header>
