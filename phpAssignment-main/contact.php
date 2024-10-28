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

session_start();
include 'include/config.php';

if(isset($_POST['submit_user_form'])) { 
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $specifications = $_POST['specifications'];

    $sql = "INSERT INTO tblnutritionmeeting (name, gender, date, specifications) VALUES (:name, :gender, :date, :specifications)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, type: PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':specifications', $specifications, PDO::PARAM_STR);

    if($query->execute()) {
        echo "<script>alert('Your meeting request has been submitted.');</script>";
    } else {
        echo "<script>alert('Failed to submit the form. Please try again.');</script>";
    }
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
            width: 90%; 
            max-width: 900px; 
            height: 60vh;  
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
            border: 0; 
        }
    </style>
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
                    <h2>Contact US</h2>
                </div>
            </div>
        </div>
    </section>

    <!--Meet Nutritionist Form-->
<?php if(strlen($_SESSION['uid'])==0): ?>
    <!-- If user is not logged in, show a Book Now button that redirects to login -->
    <section class="user-form-section spad">
        <div class="container">
            <h2>Request Meeting With Nutritionist <b>(RM20)</b></h2>
            <p>Please <a href="login.php" class="site-btn sb-line-gradient">Log in</a> to book a meeting with our nutritionist.</p>
        </div>
    </section>
<?php else: ?>
    <!-- If user is logged in, show the booking form -->
    <form method="POST" action="">
        <section class="user-form-section spad">
            <div class="container">
                <h2>Request Meeting With Nutritionist <b>(RM20)</b></h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="specifications">Specifications</label>
                    <textarea id="specifications" name="specifications" class="form-control" rows="4" required></textarea>
                </div>
                <button class="site-btn sb-line-gradient" type="submit" name="submit_user_form" class="btn btn-primary">Book Now</button>
            </div>
        </section>
    </form>
<?php endif; ?>


    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
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
