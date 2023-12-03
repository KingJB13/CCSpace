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