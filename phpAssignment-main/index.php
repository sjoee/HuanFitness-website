<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid = $_SESSION['uid'];

if (isset($_POST['submit'])) { 
    $pid = $_POST['pid'];

    $sql = "INSERT INTO tblbooking (package_id,userid) VALUES (:pid,:uid)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Package has been booked.');</script>";
    echo "<script>window.location.href='booking-history.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>HuanFitnessPal - Your Health Companion</title>
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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .pricing-section {
            position: relative;
            padding: 50px 0; /* Add some vertical padding */
            min-height: 100vh; /* Ensure it fills the viewport */
            background-image: url('img/backsplash.jpg'); /* Set background on pricing section */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat; /* Prevent tiling */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(249, 242, 240, 0.87); /* Adjusted opacity for less sheer */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1; /* Ensure overlay is on top */
        }

        .section-title {
            position: relative;
            z-index: 2; /* Bring the title above the overlay */
            text-align: center; /* Center the text */
        }

        .quote {
            font-size: 2rem;
			font-family: "Playfair Display", sans-serif;
            color: #333; /* Dark text color for contrast */
            font-style: bold;
			font-size: 60px;	
			color: #222;
        }

		.button {
            padding: 20px 80px;
            font-size: 1rem;
            color: #fdfdfd; /* Light text color */
            background: linear-gradient(145deg, #f65d5d 0%, #fdb07d 100%); /* Gradient background */
            border: none;
            border-radius: 30px;
            text-decoration: none; /* Remove underline */
            text-align: center; /* Center text */
            cursor: pointer;
		}

        .button:hover {
            background: linear-gradient(145deg, #c34b4b 0%, #d19f6b 100%); /* Darker gradient on hover */
            color: #eaeaea; /* Darker shade of white */
		}
    </style>
</head>
<body>

    <!-- Header Section -->
    <?php include 'include/header.php';?>
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg">
        <!-- Optional content can go here -->
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="overlay"></div>
        <div class="container">
            <div class="section-title">
                <br><br>	<p class="quote">BRINGING YOU TO A HEALTHIER LIFE FOR YOUR BEAUTIFUL FUTURE</p><br><br><br><br><br>	
				<a href="pricing.php" class="button"><b>JOIN US NOW</b></a>
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
