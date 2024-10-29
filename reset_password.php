<?php
require_once('include/config.php');

$msg = "";
if (isset($_GET['token'])) {
  $token = $_GET['token'];

  $query = "SELECT id, token_expiry FROM tbladmin WHERE password_reset_token=:token";
  $stmt = $dbh->prepare($query);
  $stmt->bindParam('token', $token, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row && strtotime($row['token_expiry']) > time()) {
    if (isset($_POST['submit'])) {
      $newPassword = md5(trim($_POST['new_password']));
      $updateQuery = "UPDATE tbladmin SET password=:password, password_reset_token=NULL, token_expiry=NULL WHERE id=:id";
      $updateStmt = $dbh->prepare($updateQuery);
      $updateStmt->bindParam('password', $newPassword, PDO::PARAM_STR);
      $updateStmt->bindParam('id', $row['id'], PDO::PARAM_INT);
      $updateStmt->execute();
      $msg = "Password has been reset successfully.";
    }
  } else {
    $msg = "This link has expired or is invalid.";
  }
} else {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
  <body>
    <h2>Reset Password</h2>
    <?php if ($msg) echo "<p>$msg</p>"; ?>
    <form method="post">
      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" id="new_password" required>
      <button type="submit" name="submit">Reset Password</button>
    </form>
  </body>
</html>
