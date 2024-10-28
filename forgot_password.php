<?php
require_once('include/config.php');

$msg = "";
if (isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  if (!empty($email)) {
    try {
      $query = "SELECT id FROM tbladmin WHERE email=:email";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $updateQuery = "UPDATE tbladmin SET password_reset_token=:token, token_expiry=:expiry WHERE email=:email";
        $updateStmt = $dbh->prepare($updateQuery);
        $updateStmt->bindParam('token', $token, PDO::PARAM_STR);
        $updateStmt->bindParam('expiry', $expiry, PDO::PARAM_STR);
        $updateStmt->bindParam('email', $email, PDO::PARAM_STR);
        $updateStmt->execute();

        $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token;
        mail($email, "Password Reset Request", "Click here to reset your password: " . $resetLink);
        $msg = "A password reset link has been sent to your email.";
      } else {
        $msg = "No account found with that email.";
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  } else {
    $msg = "Please enter your email address.";
  }
}
?>
<!DOCTYPE html>
<html>
  <body>
    <h2>Forgot Password</h2>
    <form method="post">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
      <button type="submit" name="submit">Send Reset Link</button>
    </form>
    <p><?php echo $msg; ?></p>
  </body>
</html>
