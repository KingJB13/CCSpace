<?php
if(isset($_POST['register'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $middlename = $_POST['middlename'];
  $position = $_POST['option'];
  $emailPattern = '/^[a-zA-Z0-9._%+-]+@dhvsu\.edu\.ph$/';
  $namePattern = '/^[A-Za-z]+(?: [A-Za-z]+)*$/';

  if (!preg_match($emailPattern, $email)) {
    $error = 'Not a dhvsu account';  
  } elseif (strlen($password) < 8 || strlen($password) > 32) {
    $password_error = 'Password must be 8 - 32 characters long';
  } elseif($password !== $confirm_password){
      $confirmerror = 'Passwords do not match';
  } elseif (!preg_match($namePattern, $firstname)) {
    $firsterror = 'Name should only contain letters';
  } elseif (!preg_match($namePattern, $lastname)) {
    $lasterror = 'Name should only contain letters';
  } if (!empty($middlename) && !preg_match($namePattern, $middlename)) {
    $middleerror = 'Middle name should only contain letters';
  } else {
      session_start();
      require_once '../configuration/dbcon.php';
      require_once 'mail.php';

      $sql = "SELECT * FROM ccs_user WHERE ccs_email = :email";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":email", $email);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        echo '<script>alert("Email already Exist");</script>';
      } else {
        try{
          $_SESSION['email'] = $email;
          $_SESSION['password'] = $confirm_password;
          $_SESSION['firstname'] = $firstname;
          $_SESSION['lastname'] = $lastname;
          $_SESSION['middlename'] = $middlename;
          $_SESSION['position'] = $position;
          $otp = rand(100000, 999999);
          $_SESSION['otp'] = $otp;
          $message = "your code is " . $_SESSION['otp'];
          $subject = "Email verification";
          $recipient = $_SESSION['email'];
          send_mail($recipient, $subject, $message);
          echo '<script>alert("OTP Sent to your email");window.location.href = "verify.php";</script>';
          exit();
        }
        catch(PDOException $e){
          $error_log = "Error: " . $e->getMessage();
          echo '<script>alert("' . $error_log . '"); window.location.href = "../index.php";</script>';
          exit();
        }
      }
  }
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
              Registration Form
            </div>
            <form action="signup.php" method="POST" class="form" id ="form">
              
            <div class="inputfield" <?php echo isset($error) ? 'data-error="' . htmlspecialchars($error) . '"' : ''; ?>>
                    <label>Email Address</label>
                    <input type="text" class="input" id="email" name="email" required>
                 </div> 
                  
                 <div class="inputfield"  <?php echo isset($password_error) ? 'data-error="' . htmlspecialchars($password_error) . '"' : ''; ?>>
                    <label>Password</label>
                    <input type="password" class="input" id="password" name="password" required>
                 </div>  
                 <div class="inputfield" <?php echo isset($confirmerror) ? 'data-error="' . htmlspecialchars($confirmerror) . '"' : ''; ?>>
                    <label>Confirm Password</label>
                    <input type="password" class="input" id="password2" name="confirm-password" required>
                 </div>  

               <div class="inputfield" <?php echo isset($firsterror) ? 'data-error="' . htmlspecialchars($firsterror) . '"' : ''; ?>>
                  <label>First Name</label>
                  <input type="text" class="input" id="firstname" name="firstname" required>
               </div>  
                <div class="inputfield" <?php echo isset($lasterror) ? 'data-error="' . htmlspecialchars($lasterror) . '"' : ''; ?>>
                  <label>Last Name</label>
                  <input type="text" class="input" id="lastname" name="lastname" required>
                  <small></small>
               </div>  
               <div class="inputfield" <?php echo isset($middleerror) ? 'data-error="' . htmlspecialchars($middleerror) . '"' : ''; ?>>
                <label>Middle Name</label>
                <input type="text" class="input" id="middlename" name="middlename">
                </div> 

                <div class="inputfield">
                  <label>Position</label>
                  <div class="custom_select">
                    <select id="position" name="option" required>
                      <option value="" disabled selected>Select</option>
                      <option value="Dean" name="option">Dean</option>
                      <option value="Instructor" name="option">Instructor</option>
                    </select>
                    <small></small>
                  </div>
               </div> 
              <div class="inputfield">
                <input type="submit" value="Register" id="btn" class="btn" name="register">
              </div>
              <div class="inputfield">
                <p>Already have an account?</p><a href="./login.php">Login</a>
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