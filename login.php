<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = md5(($_POST['password']));
  if($email != "" && $password != "") {
    try {
      $query = "select id, name, email, mobile, password, create_date from tbladmin where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        $_SESSION['adminid'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
       header("location: index.php");
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GYM MS | Admin login</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>GYM MS | Admin login</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
           <?php if($msg){?><div class="succWrap" style="color:red;"><strong>Error</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control" name="email" id="email" type="text" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="checkbox" id="togglePassword">
            <label for="togglePassword">Show Password</label>
          </div>
          <div class="form-group">
            <a href="forgot_password.php" class="forgot-password-link">Forgot Password?</a>
          </div>
          <div class="form-group btn-container">
            <input type="submit" name="submit" id="submit" value="SIGN IN" class="btn btn-primary btn-block">
          </div>
          <hr />
          <a href="../index.php">Back to Home Page</a>
        </form>
      </div>
    </section>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
      document.getElementById("togglePassword").addEventListener("change", function() {
        var passwordField = document.getElementById("password");
        passwordField.type = this.checked ? "text" : "password";
      });
    </script>
  </body>
</html>
