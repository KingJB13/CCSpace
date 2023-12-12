<?php
session_start();
if(!isset($_SESSION['ccs_id'])){
header('Location: ../index.php');
}
?>
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
        .container {
            height: auto;
            width: 100%;
        }

        .container .first-container .slide {
            height: auto;
            min-height: auto;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px 9%;
        }

        .container .first-container .slide .content {
            flex: 1 1 350px;
        }

        .container .first-container .slide .image {
            flex: 1 1 350px;
        }

        .container .first-container .slide .image img {
            height: auto;
            max-width: 100%;
        }

        .container .first-container .slide .content p {
            text-align: justify;
            font-size: 20px;
            font-weight: bold;
            color: black;
            padding: 10px 0;
        }

        @media (max-width: 858px) {
            .container .first-container .slide .content {
                flex: 1 1 280px;
            }
            .container .first-container .slide .image {
                flex: 1 1 280px;
            }
            .container .first-container .slide .content p{
                font-size: 15px;
            }
        }

        @media (max-width: 790px){
            .container .first-container .slide .content {
                flex: 1 1 260px;
            }
            .container .first-container .slide .image {
                flex: 1 1 280px;
            }
        }
        @media (max-width: 768px){
            .container .first-container .slide .content {
                flex: 1 1 260px;
            }
            .container .first-container .slide .image {
                flex: 1 1 260px;
            }
        }

        @media (max-width: 640px){
            .container .first-container .slide .content {
                flex: 1 1 200px;
            }
            .container .first-container .slide .image {
                display: none;  
            }
        }

        @media (max-width: 510px){
            .container .first-container .slide .content {
                flex: 1 1 180px;
            }
            .container .first-container .slide .image {
                display: none;
            }

        }
        .container .second-container .slide {
            height: auto;
            width: 100%;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px 9%;
            padding-bottom: 100px;
            
        }

        .container .second-container .slide .border {
            background: rgba(31, 65, 114, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }
        .container .second-container .slide .border .content {
            padding: 20px;
            flex: 1 1 350px;
        }

        .container .second-container .slide .border .image {
            padding: 20px;
            flex: 1 1 350px;
        }

        .container .second-container .slide .border .image img {
            height: auto;
            max-width: 100%;
        }

        .container .second-container .slide .border .content h2 {
            color: white;
            font-size: 35px;
            font-weight: bold;
            text-align: justify;
        }

        .container .second-container .slide .border .content p {
            color: white;
            font-size: 20px;
            padding: 10px 0;
            text-align: justify;
        }

        @media (max-width: 1280px){
            
            .container .second-container .slide .border .content h2 {
                font-size: 20px;
            }
            .container .second-container .slide .border .content p {
                font-size: 18px;
            }
        }

        @media (max-width: 980px){
            .container .second-container .slide {
                padding: 20px 5%;
            }
            .container .second-container .slide .border .content h2 {
                font-size: 18px;
            }
            .container .second-container .slide .border .content p {
                font-size: 13px;
            }
        }
        @media (max-width: 768px){
            .container .second-container .slide .border .image{
                display: none;
            }

        }

        .container .third-container .slide {
            height: auto;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px 9%;
            padding-bottom: 100px;
        }

        .container .third-container .slide .benefit{
            background: rgba(31, 65, 114, 0.8);
            padding: 20px;
            border-radius: 20px;
            color: white;
        }

        .container .third-container .slide .border {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            padding: 20px;
            grid-gap: 40px;
        }
        .container .third-container .slide .border .content{
            background: rgba(31, 65, 114, 0.8);
            padding: 20px;
            border-radius: 20px;
        }

        .container .third-container .slide .border .content h2,
        .container .third-container .slide .border .content p
        {
            color: white;
        }

        .container .fourth-container .slide {
            height: auto;
            width: 100%;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px 9%;
            padding-bottom: 100px;
        }

        .container .fourth-container .slide .content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .container .fourth-container .slide .content .border {
            display: flex;
            
        }
        .container .fourth-container .slide .content .border .img{
            flex: 1 1 350px;
        }  
        .container .fourth-container .slide .content .border .content{
            flex: 1 1 350px;
        } 
        .container .fourth-container .slide .content .border .content h2{
            text-align: justify;
        }
        .container .fourth-container .slide .content .border .content a{
            text-decoration: none;
            background-color: #0082e6;
            color: white;
            padding: 2px 4px;
            border-radius: 5px;
        }    
        .container .fourth-container .slide .content .border .content a:hover{
            color: #1F4172;
            background-color: white;
        }
        .container .fourth-container .slide .content .border .img img {
            max-width: 100%;
            border-radius: 50px 0 0 50px;
        }
        @media (max-width: 768px){
            .container .fourth-container .slide .content .border .content h2{
                font-size: 20px;
            }
        }
        @media (max-width: 586px){
            .container .fourth-container .slide .content .border .content{
                flex: 1 1 180px;
            }   
            .container .fourth-container .slide .content .border .img{
                display: none;
            }      
        }
    </style>
</head>

<body>
<?php require '../navigation/profile-nav.php';?>
    <main>
        <div class="container">
            <div class="first-container">
                <div class="slide">
                    <div class="content">
                        <p>CCSpace simplifies room scheduling, making it easy to find and available spaces in the CCS building with just a few clicks</p>
                        <br>
                        <p>Stay organized and never miss a beat with CCSpace's intuitive scheduling tool, providing real-time access to room availability in the CCS building."</p>
                        <br>
                    </div>
                    <div class="image">
                        <img src="../img/fox-body.png" alt="img">
                    </div> 
                </div>
            </div>
            <div class="second-container">
                <div class="slide">
                    <div class="border">
                        <div class="image">
                            <img src="../img/teacher.png" alt="img">
                        </div>
                            
                        <div class="content">
                            <h2>Fixing Room Scheduling </h2>
                            <br>
                            <p>The scarcity of available rooms in schools is a pervasive issue that often leads to frustration among students and educators alike.</p>
                            <br>
                            <p>As schools struggle to accommodate various classes, extracurricular activities, meetings, and special events, the constant juggling of room assignments becomes a logistical nightmare.</p>
                            <br>
                            <p>Introducing CSSpace, the answer to schools' room scheduling challenges. This platform allows users to view room schedules and make reservations for available rooms, eliminating the need for manual scheduling and ensuring fair access to school facilities, thereby enhancing the overall learning experience.</p>
                        </div> 
                    </div>   
                </div>
            </div> 
            <div class="third-container">
                <div class="slide">
                    <div class="benefit">
                        <h1>What Can You Gain</h1>
                    </div>
                    <div class="border">
                        <div class="content">
                            <h2>Efficient Planning</h2>
                            <br>
                            <p>Having access to the schedules of all rooms at a glance allows for efficient planning of classes, meetings, and activities. This helps schools avoid scheduling conflicts and ensures that rooms are utilized optimally, resulting in a smoother and more organized daily routine.</p>
                        </div>
                        <div class="content">
                            <h2>Optimal Resource Utilization</h2>
                            <br>
                            <p>Users can reserve rooms at their preferred times when they are available, which accommodates their schedules and activities. This flexibility is especially valuable for study groups, special projects, and extracurricular activities.</p>
                        </div>
                        <div class="content">
                            <h2>Productivity</h2>
                            <br>
                            <p>When you can quickly locate available rooms, you spend less time searching and more time using those rooms effectively. This not only saves time but also boosts overall productivity, making it easier to focus on important tasks and activities.</p>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="fourth-container">
                <div class="slide">
                    <div class="content">
                        <div class="border">
                            <div class="img"><img src="../img/bb 1.png" alt="img"></div>
                            <div class="content">
                                <h2>Are you ready to click the button and delve into the schedules of all the available rooms? Your journey to explore the school's room schedules is just a click away! <a href="./rooms.html">Rooms</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>            
<?php require '../navigation/main-footer.php';?>
</body>
</html>

