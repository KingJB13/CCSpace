<?php
  session_start();
  require_once '../configuration/dbcon.php';

  if(isset($_POST['login'])){
      try{
        $email = $_POST['email'];
        $enteredPassword = $_POST['password'];
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@dhvsu\.edu\.ph$/';

        if (!preg_match($emailPattern, $email)) {
          $error = 'Not a dhvsu account';
        } elseif (strlen($enteredPassword) < 8 || strlen($enteredPassword) > 32) {
          $password_error = 'Password must be 8 - 32 characters long';
        } else {
          $sql = "SELECT * FROM ccs_user WHERE ccs_email = :email";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':email', $email);
          if($stmt->execute()){
              $user = $stmt->fetch();
  
              if ($user) {
                  $hashedPassword = $user['ccs_password'];
                  if (password_verify($enteredPassword, $hashedPassword)) {
                      $_SESSION['ccs_id'] = $user['ccs_id'];
                      $_SESSION['username'] = $user['ccs_firstname']." ".$user['ccs_lastname'];
                      $_SESSION['position'] = $user['ccs_position'];
                      
                      if($_SESSION['position'] == 'Admin'){
                        header("Location: ../dashboard/dashboard.php");
                      }
                      else{
                        header("Location: ../main/home.php");
                      }
                  } else {
                    echo '<script>alert("Invalid Password");window.location.href = "signup.php";</script>';
                  }
              } else {
                echo '<script>alert("User does not Exist");</script>';
              }
          }
          else{
              $error_message = "Error: " . $sql . "<br>" . $pdo->error;
              echo '<script>alert("' . $error_log . '"); window.location.href = "../index.php";</script>';

          }
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
    <title>CCSpace</title>
    <style>

    .wrapper{
      max-width: 500px;
      width: 100%;
      background: #fff;
      margin: 50px auto;
      box-shadow: 2px 2px 4px rgba(0,0,0,0.125);
      padding: 30px;
    }

    .wrapper .title{
      font-size: 24px;
      font-weight: 700;
      margin-top: 50px;
      margin-bottom: 25px;
      color: #132043;
      text-align: center;
    }

    .wrapper .form{
      width: 100%;
    }

    .wrapper .form .inputfield{
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }

    .wrapper .form .inputfield:nth-child(7){
        margin-bottom: 20px;
    }


    .wrapper .form .inputfield[data-error] .input{
      border-color: #c92432;
      color: #c92432;
      background: #fffafa;
    }

    .wrapper .form .inputfield[data-error]::after{
        content: attr(data-error);
        font-size: 16px;
        color: #c92432;
        display: block;
        margin: 10px 0;
    }

    .wrapper .form .inputfield label{
      width: 200px;
      color: #757575;
      margin-right: 10px;
      font-size: 14px;
    }

    .wrapper .form .inputfield .input,
    .wrapper .form .inputfield .textarea{
      width: 100%;
      outline: none;
      border: 1px solid #d5dbd9;
      font-size: 15px;
      padding: 8px 10px;
      border-radius: 3px;
      transition: all 0.3s ease;
      text-transform: none;
    }

    .wrapper .form .inputfield .textarea{
      width: 100%;
      height: 125px;
      resize: none;
    }

    .wrapper .form .inputfield .input:focus{
      border: 1px solid #132043;
    }

    .wrapper .form .inputfield p{
      font-size: 14px;
      color: #757575;
    }

    .wrapper .form .inputfield .btn{
      width: 100%;
      padding: 8px 10px;
      font-size: 15px; 
      border: 0px;
      background:  #132043;
      color: #fff;
      cursor: pointer;
      border-radius: 3px;
      outline: none;
    }

    .wrapper .form .inputfield .btn:hover{
      background: #132043;
    }

    .wrapper .form .inputfield:last-child{
      margin-bottom: 0;
    }

    @media (max-width:420px) {
      .wrapper .form .inputfield{
        flex-direction: column;
        align-items: flex-start;
      }
      .wrapper .form .inputfield label{
        margin-bottom: 5px;
      }

    }
    </style>
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
            
            <form action="login.php" method="POST" class="form">
                <div class="inputfield" <?php echo isset($error) ? 'data-error="' . htmlspecialchars($error) . '"' : ''; ?>>
                    <label>Email Address</label>
                    <input type="text" class="input" id="email" name="email" required>
                 </div> 

                 <div class="inputfield" <?php echo isset($password_error) ? 'data-error="' . htmlspecialchars($password_error) . '"' : ''; ?>>
                    <label>Password</label>
                    <input type="password" class="input" id="password" name="password" required>
                 </div>  
               
              <div class="inputfield">
                <input type="submit" value="login" id="btn" class="btn" name="login">
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