<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./styles/nav-footer.css">
    <title>CCSpace</title>
    <style>
    .landing-container {
    text-align: center;
    }

    .card {
        background: rgba(31, 65, 114, 0.8);
        padding: 100px 300px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card h2{
        font-size: 30px;
        color: white;
    }
    .top-image {
        width: 100%;
        max-width: 300px; 
        margin: 0 auto 20px; 
        border-radius: 10px;
        z-index: 0;
    }

    .signup,
    .login {
        margin: 10px;
        padding: 10px 20px;
        background: #0082e6;
        background-size: cover;
        border-radius: 10px;
        display: inline-block;
        text-decoration: none;
        color: #fff;
    }

    .signup a{
        text-decoration: none;
        color: #fff;
        font-size: 15px;
    }
    .login a {
        text-decoration: none;
        color: #fff;
        font-size: 18px;
    }
    </style>
</head>
<body>
    <div class="navbar" id="nav">

        <label class="logo"><img src="./img/ccsp.png"></label>
    </div> 
    <main>
        <div class="landing-container">
            <div class="card">
                <img src="./img/fox-body.png" alt="img" class="top-image">
                <h2>Get started today and take control of your time! <br> Begin harnessing the power of efficient scheduling.</h2>
                <br>
                <div class="signup"><a href="./login-form/signup.php">Sign Up</a></div>
                <div class="login"><a href="./login-form/login.php">Log In</a></div> 
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-col">
            <img src="./img/ccsp.png" height="50px" width="200px">
        </div>
        <div class="footer-col">
            <h2>Company</h2>
            <ul>
                <li><a href="./about-us/about-us.php">About Us</a></li>
                <li><a href="./about-us/mission-vision.php">Mission and Vision</a></li>
                <li><a href="./about-us/privacy-policy.php">Privacy Policy</a></li>
                <li><a href="./about-us/faqs.php">FAQ'S</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h2>Socials</h2>
            <div class="socials">
                <a href="https://www.facebook.com/dhvsu.ccssc"><i class="fa fa-facebook"></i></a>
                <a href="mailto:ccspace@gmail.com"><i class="fa fa-envelope"></i></a>
                <a href="https://dhvsu.edu.ph/index.php/academics-menu/bacolor-campus/college-of-computer-studies"><i class="fa fa-globe"></i></a>
            </div>
        </div>
        <div class="footer-copyright"><p>Copyright ©2023 CCSpace. All Rights Reserved.</p></div>

</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>