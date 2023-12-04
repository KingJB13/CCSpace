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
    <link rel="stylesheet" href="../styles/homepage.css">
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
                                    <img src="../img/bb 1.png" alt="img">
                                    <h2>Are you ready to click the button and delve into the schedules of all the available rooms? Your journey to explore the school's room schedules is just a click away!</h2>
                                </div>
                                <div class="link">
                                    <a href="./rooms.php">Rooms</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>            
<?php require '../navigation/main-footer.php';?>
</body>
</html>

