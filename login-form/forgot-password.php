<?php
  session_start();
  require_once '../configuration/dbcon.php';
  require_once 'mail.php';
  
  try{
    if(isset($_POST['forgot_password'])){
      $emailPattern = '/^[a-zA-Z0-9._%+-]+@dhvsu\.edu\.ph$/';
      $email = $_POST['email'];
      $token = bin2hex(random_bytes(16));
      $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
      if (!preg_match($emailPattern, $email)) {
        $error = 'Not a dhvsu account';  
      } 
      if(!isset($error)) {
        $query = "SELECT ccs_email, ccs_password FROM ccs_user WHERE ccs_position = 'Admin'";
        $stmt_smtp = $pdo->prepare($query);
        $stmt_smtp->execute();
        $smtp = $stmt_smtp->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_user WHERE ccs_email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt -> bindParam(':email',$email);
        $stmt -> execute();
        $row = $stmt->fetch();
    
        if($row['ccs_email'] === $email){
          $sql = "UPDATE ccs_user SET reset_token_hash = :token , reset_token_expiry = :expire WHERE ccs_email = :email";
          $stmt = $pdo->prepare($sql);
          $stmt -> bindParam(':token', $token);
          $stmt -> bindParam(':expire', $expiry);
          $stmt -> bindParam(':email', $email);
          $stmt -> execute();
          if($stmt->rowCount() > 0){
            $row_email = $smtp['ccs_email'];
            $row_password = $smtp['ccs_password'];
            $message = "We received a request to reset your password. Click the link to reset your password: http://localhost/CCSpace/login-form/reset-password.php?token=$token";
            $subject = "Password Reset";
            $recipient = $email;
            send_mail($recipient, $subject, $message, $row_email, $row_password);
            echo "<script>alert('Check your inbox for a password reset link');</script>";
          }
        }
      } else {
        header("Refresh: 0");
        exit();
      }
      
  }
    
  }
  catch(PDOException $e){
    $error_log = "Error: " . $e->getMessage();
    echo '<script>alert("' . $error_log . '"); window.location.href = "../index.php";</script>';
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/nav-footer.css">
    <link rel="stylesheet" href= "../styles/input.css">
    <title>CCSpace</title>
</head>
<body>
    <div class="navbar" id="nav">
        <label class="logo"><img src="../img/ccsp.png"></label>
    </div> 
    <main>
        
        <div class="wrapper">
            <div class="title">
             Enter Email
            </div>
            <form action="forgot-password.php" method="POST" class="form">
                <div class="inputfield" <?php echo isset($error) ? 'data-error="' . htmlspecialchars($error) . '"' : ''; ?>>
                    <label>Email Address</label>
                    <input type="text" class="input" id="email" name="email" required>
                </div> 

              <div class="inputfield">
                <input type="submit" value="Forgot Password" id="btn" class="btn" name="forgot_password">
              </div>
              <div class="inputfield">
                <p>Not a member?</p><a href="./signup.php">Register</a>
              </div>

            </form>
        </div>
    </main>
    <footer class="footer">
                <div class="footer-col">
                    <img src="../img/ccsp.png" height="50px" width="200px">
                </div>
                <div class="footer-col">
                    <h2>Company</h2>
                        <ul>
                            <li><a href="../about-us/about-us.php">About Us</a></li>
                            <li><a href="../about-us/mission-vision.php">Mission and Vision</a></li>
                            <li><a href="../about-us/privacy-policy.php">Privacy Policy</a></li>
                            <li><a href="../about-us/faqs.php">FAQ'S</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h2>Socials</h2>
                    <div class="socials">
                        <a href="https://www.facebook.com/dhvsu.ccssc"><i class="fa fa-facebook"></i></a>
                        <a href="mailto:adm1n.ccspace@gmail.com"><i class="fa fa-envelope"></i></a>
                        <a href="https://dhvsu.edu.ph/index.php/academics-menu/bacolor-campus/college-of-computer-studies"><i class="fa fa-globe"></i></a>
                    </div>
                </div>
                <div class="footer-copyright"><p>Copyright ©2023 CCSpace. All Rights Reserved.</p></div>
    </footer>
</body>
</html>