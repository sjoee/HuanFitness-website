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
	<title>About Us</title>
	<meta charset="UTF-8">
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
</head>
<body>
	<!-- Page Preloder -->
	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->                                                                            
	<!-- Page top Section -->
	<section class="page-top-section set-bg"></section>



	<!-- Pricing Section -->
	<section class="pricing-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h2>About Us</h2>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-6">
					<p>HuanFitnessPal is dedicated to helping you achieve your fitness goals. Our state-of-the-art facilities and expert trainers are here to guide you every step of the way.</p>
				</div>
			</div><br><br>
			 <!-- Q&A Section -->
			<section class="qa-section">
			<div class="qa-container">
				<h1 class="title">Frequently Asked Questions</h1>
				
				<div class="qa-item">
					<div class="question">
						What services do you offer?
					</div>
					<div class="answer">
						We offer a comprehensive range of services including aerobics, yoga & pilates, crossfit, spin cycle, weight training, powerlifting, calisthenics, and also nutrition screening. Our team specializes in 
						creating custom solutions tailored to your specific health needs.
					</div>
				</div>

				<div class="qa-item">
					<div class="question">
						How can I get started?
					</div>
					<div class="answer">
						Getting started is easy! Simply start by registering as a new member under login, then choose you prefered package to start! We'll guide 
						you through the entire process step by step.
					</div>
				</div>

				<div class="qa-item">
					<div class="question">
						What are your working hours?
					</div>
					<div class="answer">
						We operate 7 days a week, 5 AM to 11 PM including public holidays. Support is available 24/7 for urgent matters through our emergency contact system.
					</div>
				</div>

				<div class="qa-item">
					<div class="question">
						How do I get in touch with a nutritionist?
					</div>
					<div class="answer">
						Applications for consultation are open under request for nutritionist.
					</div>
				</div>
			</div>
			</section>
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
