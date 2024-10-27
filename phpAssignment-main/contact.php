<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid=$_SESSION['uid'];

if(isset($_POST['submit']))
{ 
$pid=$_POST['pid'];


$sql="INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";

$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Package has been booked.');</script>";
echo "<script>window.location.href='booking-history.php'</script>";

}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Gym Management System</title>
	<meta charset="UTF-8">
	<meta name="description" content="Ahana Yoga HTML Template">
	<meta name="keywords" content="yoga, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>

	<style>
		/* Google Maps container styling */
		.google-map {
			width: 90%;  /* Adjust width as needed */
			max-width: 900px;  /* Maximum width for larger screens */
			height: 60vh;  /* Adjust height for laptop screen */
			margin: 0 auto;  /* Center horizontally */
			position: relative;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		/* Google Maps iframe styling */
		.google-map iframe {
			width: 100%;
			height: 100%;
			position: absolute;
			left: 0;
			top: 0;
			border: 0; /* Remove border for a cleaner look */
		}
	</style>
</head>
<body>
	<!-- Page Preloder -->
	

	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->

	

	                                                                              
	<!-- Page top Section -->
	<section class="page-top-section set-bg">
		<!-- <div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto text-white">
					<h2>Contact US</h2>
				</div>
			</div>
		</div> -->
	</section>



	<!-- Pricing Section -->
	<section class="pricing-section spad">
		<div class="container">
			<div class="section-title text-center">
				<!-- <img src="img/icons/logo-icon.png" alt=""> -->
				<h2>About Us</h2>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-6">
					<p><strong>Email : </strong> huanfitnesspal@gmail.com</p>
					<p><strong>Contact No : </strong> +60 18-335 9302</p>
					<p><strong>Opening Hours : </strong> Opened Daily from 0500 to 2300<br></p>
					<p><strong>Address : </strong> HuanFitness Centre, Persiaran Kewajipan, USJ 8, 47600 Subang Jaya, Selangor</p>
				</div>
			</div><br>
		</div><br>
		<div class="google-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.1460721647964!2d101.5918573!3d3.0555553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4ce986444105%3A0xe53f7dd9557013bc!2sPersiaran%20Kewajipan%2C%20Selangor!5e0!3m2!1sen!2smy!4v1730007277441!5m2!1sen!2smy" 
				width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</section>
	

	
	<!-- Footer Section -->
	<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->

	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!-- Search model end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
