<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCSpace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/nav-footer.css">
    <style>
        .container{
            height: auto;
            width: 100%;
            min-height: 100vh;
            padding-bottom: 30px;
        }
        .picture {
            width: 100%;
            height: 30vh;
        }

        .picture img {
            padding-left: 40px;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .aboutus {
            height: auto;
            font-size: 30px;
            padding: 0 50px;
            text-align: center;
        }

        .aboutus p {
            text-align: justify;
            font-weight: bold;
            word-spacing: 1.5px;
        }
        @media (max-width: 952px) {
        .picture img{
            height: 20vh;
        }
        .aboutus p{
            font-size: 16px;
        }
}
    </style>
</head>

<body>
<?php require '../navigation/main-nav.php';?>
            <main>
                <div class="container">
                    <div class="picture">
                        <img src="../img/fox-blur.png" alt="img">
                    </div>
                    <div class="aboutus">
                        <p>At CCSpace, we're dedicated to simplifying your scheduling needs within the CCS building. Our mission is to streamline your workflow by offering an easy-to-use platform that ensures you can always find the perfect space for your meetings and activities. With a commitment to efficiency and user-friendliness, we empower you to make the most of your time at CCS.</p>
                        <br>
                        <p> Founded by a team of passionate professionals who understand the importance of efficient space management, CCSpace was born out of a desire to enhance collaboration and productivity within the CCS community. Our platform is designed with a user-centric approach, harnessing cutting-edge technology to provide up-to-date information on room availability, making it the go-to resource for anyone looking to optimize their time and resources in the CCS building. We take pride in being your trusted partner in creating a seamless and productive environment within the CCS community.</p>
                    </div>
                </div>
            </main>
<?php require '../navigation/main-footer.php';?>
</body>
</html>

