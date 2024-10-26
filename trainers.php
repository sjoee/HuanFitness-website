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

</head>
<body>
	<!-- Page Preloder -->
	

	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->

	

	                                                                              
	<!-- Page top Section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto text-white">
					<h2>Trainers</h2>
				</div>
			</div>
		</div>
	</section>



	<!-- Trainers Section -->
	<section id="trainers">
            <h2>Meet Our Trainers</h2>
            <div class="trainer-grid">
                <div class="trainer-card">
                    <!-- Replace with actual image -->
                    <img src="img/trainer/trainer1.jpeg" alt="Trainer 1" class="trainer-image">
                    <h3>Jenny Talia</h3>
                    <p>Aerobic</p>
                </div>
                <div class="trainer-card">
                    <!-- Replace with actual image -->
                    <img src="img/trainer/trainer2.jpeg" alt="Trainer 2" class="trainer-image">
                    <h3>Joanna C. McKuchi</h3>
                    <p>Yoga & Pilates</p>
                </div>
                <div class="trainer-card">
                    <!-- Replace with actual image -->
                    <img src="img/trainer/trainer3.jpeg" alt="Trainer 3" class="trainer-image">
                    <h3>Rae Piste</h3>
                    <p>CrossFit</p>
                </div>
                <div class="trainer-card">
                    <!-- Replace with actual image -->
                    <img src="img/trainer/trainer4.jpeg" alt="Trainer 1" class="trainer-image">
                    <h3>Jack Kanoff</h3>
                    <p>Weight Training</p>
                </div>
                <div class="trainer-card">
                    <!-- Replace with actual image -->
                    <img src="img/trainer/trainer6.jpeg" alt="Trainer 2" class="trainer-image">
                    <h3>Barry McKockiner</h3>
                    <p>Powerlifting</p>
                </div>
                <div class="trainer-card">
                    <!-- Replace with actual image -->
                    <img src="img/trainer/trainer7.jpeg" alt="Trainer 3" class="trainer-image">
                    <h3>Hue G. Rection  </h3>
                    <p>Nutritionist</p>
                </div>
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
