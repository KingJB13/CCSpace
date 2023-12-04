<?php
    session_start();
    require_once '../configuration/dbcon.php';

    try{
      if(isset($_POST['verify'])){
        $otp = $_POST['otp'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $middlename = $_SESSION['middlename'];
        $position = $_SESSION['position'];
        $originalotp = $_SESSION['otp'];

        $passwordhash = password_hash($password, PASSWORD_BCRYPT);

        if($otp == $originalotp){
            $sql = 'INSERT INTO ccs_user(ccs_id, ccs_email, ccs_password, ccs_firstname, ccs_lastname, ccs_middlename, ccs_position) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :email, :password, :firstname, :lastname, :middlename, :position)';
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(':email', $email);
            $stmt -> bindParam(':password', $passwordhash);
            $stmt -> bindParam(':firstname', $firstname);
            $stmt -> bindParam(':lastname', $lastname);
            $stmt -> bindParam(':middlename', $middlename);
            $stmt -> bindParam(':position', $position);
            if($stmt->execute()){
                echo '<script>alert("Account Created Successfully");window.location.href = "login.php";</script>';
                exit();
            }
            else{
                echo '<script>alert("Error Creating Account")</script>';
            } 
        }else {
            echo '<script>alert("Invalid OTP")</script>';
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
              Verification
            </div>
            <form action="verify.php" method="POST" class="form" id ="form">              
                <div class="inputfield">
                <label>Insert OTP</label>
                <input type="text" class="input" id="otp" name="otp">
                </div> 
                <div class="inputfield">
                    <input type="submit" value="Verify" id="btn" class="btn" name="verify">
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