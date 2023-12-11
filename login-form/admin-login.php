<?php
  session_start();
  require_once '../configuration/dbcon.php';

  if(isset($_POST['admin-login'])){
      try{
        $email = $_POST['email'];
        $enteredPassword = $_POST['password'];

        if (strlen($enteredPassword) < 8 || strlen($enteredPassword) > 32) {
          $password_error = 'Password must be 8 - 32 characters long';
        } if(!isset($password_error)) {
          $sql = "SELECT * FROM ccs_user WHERE ccs_email = :email";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':email', $email);
          if($stmt->execute()){
              $user = $stmt->fetch();
  
              if ($user) {
                  $ccs_password = $user['ccs_password'];
                  if ($enteredPassword === $ccs_password) {
                      $_SESSION['ccs_id'] = $user['ccs_id'];
                      $_SESSION['position'] = $user['ccs_position'];
                      
                      if($_SESSION['position'] == 'Admin'){
                        header("Location: ../dashboard/dashboard.php");
                        exit();
                      }
                  } else {
                    echo '<script>alert("Invalid Password");window.location.href = "signup.php";</script>';
                    exit();
                  }
              } else {
                echo '<script>alert("User does not Exist");</script>';
              }
          }
          else{
              $error_message = "Error: " . $sql . "<br>" . $pdo->error;
              echo '<script>alert("' . $error_log . '"); window.location.href = "../index.php";</script>';
              exit();

          }
        } else {
          header("Refresh: 0");
          exit();
        }

      }
      catch(PDOException $e){
        $error_log = "Error: " . $e->getMessage();
        echo '<script>alert("' . $error_log . '"); window.location.href = "../index.php";</script>';
        exit();
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
             Login
            </div>
            
            <form action="admin-login.php" method="POST" class="form">
                <div class="inputfield">
                    <label>Email Address</label>
                    <input type="text" class="input" id="email" name="email" required>
                 </div> 

                 <div class="inputfield" <?php echo isset($password_error) ? 'data-error="' . htmlspecialchars($password_error) . '"' : ''; ?>>
                    <label>Password</label>
                    <input type="password" class="input" id="password" name="password" required>
                 </div>  
               
              <div class="inputfield">
                <input type="submit" value="login" id="btn" class="btn" name="admin-login">
              </div>
              <div class="inputfield">
                <p>Not a member?</p><a href="./signup.php">Register</a>
              </div>
              <div class="inputfield">
                <p>Forgot Password?</p><a href="./forgot-password.php">Forgot Password</a>
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