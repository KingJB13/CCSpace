<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/nav-footer.css">
    <link rel="stylesheet" href= "./styles/input.css">
    <title>CCSpace</title>
</head>
<body>
    <div class="navbar" id="nav">
    <label class="logo"><img src="./img/ccsp.png"></label>
    </div> 
    <main>
        
        <div class="wrapper">
            <div class="title">
             Confirm Logout?
            </div>
            
            <form action="logout.php" method="POST" class="form">
            <div class="inputfield">
                <input type="submit" value="Confirm" id="btn" class="btn" name="logout">
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
</html>