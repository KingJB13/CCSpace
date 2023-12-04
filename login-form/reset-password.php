<?php
  session_start();
  require_once '../configuration/dbcon.php';

  try {
    $token = $_GET['token'];
  
    $sql = "SELECT * FROM ccs_user WHERE reset_token_hash = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($result['reset_token_hash'])){
      echo '<script>alert("token not found");</script>';
    }
    
    if(strtotime($result['reset_token_expiry']) <= time()){
      echo '<script>alert("Token expired, please generate a new token.");</script>';
    }
  } catch (PDOException $e) {
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
              Reset Password
            </div>            
            <form action="reset-password-process.php" method="POST" class="form">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token)?>">
                 <div class="inputfield" <?php echo isset($confirm_error) ? 'data-error="' . htmlspecialchars($confirm_error) . '"' : ''; ?>>
                    <label>New Password</label>
                    <input type="password" class="input" id="password" name="password" required>
                 </div>  
                 <div class="inputfield" <?php echo isset($confirmerror) ? 'data-error="' . htmlspecialchars($confirmerror) . '"' : ''; ?>>
                    <label>Confirm Password</label>
                    <input type="password" class="input" id="password" name="confirm_password"> 
                 </div>
              <div class="inputfield">
                <input type="submit" value="Reset Password" id="btn" class="btn" name="reset">
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
                        <a href="mailto:dhvsu.ccssc@gmail.com"><i class="fa fa-envelope"></i></a>
                        <a href="https://dhvsu.edu.ph/index.php/academics-menu/bacolor-campus/college-of-computer-studies"><i class="fa fa-globe"></i></a>
                    </div>
                </div>
                <div class="footer-copyright"><p>Copyright ©2023 CCSpace. All Rights Reserved.</p></div>
    </footer>
</body>
</html>