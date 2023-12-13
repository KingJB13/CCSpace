<?php
session_start();
require_once '../configuration/dbcon.php';

try{
    if(isset($_SESSION['ccs_id']) && $_SESSION['position'] == 'Admin'){
        // CS 102
        $sql = "SELECT * FROM ccs_schedule WHERE room = 'CS 102' AND time_start = '7:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $csseven = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE room = 'CS 102' AND time_start = '10:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $csten = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE room = 'CS 102' AND time_start = '13:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $csone = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        $sql = "SELECT * FROM ccs_schedule WHERE room = 'CS 102' AND time_start = '16:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $csfour = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //COM LAB
        $sql = "SELECT * FROM ccs_schedule WHERE room = 'COM LAB' AND time_start = '7:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comseven = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE room = 'COM LAB' AND time_start = '10:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comten = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE room = 'COM LAB' AND time_start = '13:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comone = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        $sql = "SELECT * FROM ccs_schedule WHERE room = 'COM LAB' AND time_start = '16:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $comfour = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //ICT LAB
        $sql = "SELECT * FROM ccs_schedule WHERE room = 'ICT LAB' AND time_start = '7:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $ictseven = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE room = 'ICT LAB' AND time_start = '10:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $ictten = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE room = 'ICT LAB' AND time_start = '13:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $ictone = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        $sql = "SELECT * FROM ccs_schedule WHERE room = 'ICT LAB' AND time_start = '16:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $ictfour = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCSpace</title>
    <link rel="stylesheet" href="../styles/dashboardstruc.css">
    <style>
        .title{
            height: auto;
            width: 100%;
            margin-bottom: 25px;
        }
        .title-left{
            float: left;
        }
        .options{
            float: right;
        }
        .options a{
            text-decoration: none;
            color: black;
            font-size: 20px;
        }

        .content{
            padding: 20px;
            height: auto;
        }
        .content h2{
            margin-top: 50px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }
        thead{
            background-color: #1F4172;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #1F4172;
            border: 1px solid #1F4172;
            color: white;
        }

        .schedule td {
            vertical-align: top;
            text-align: center;
        }
        @media(max-width: 952px){
            th, td{
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <?php require '../navigation/admin-dashboard.php'; ?>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <div class="title-left">
                    <h1>Schedule</h1>
                </div>
                <div class="options">
                <?php 
                    if($_SESSION['position'] == 'Admin')
                    {
                        echo '<a href="create-schedule.php"><ion-icon name="add-outline"></ion-icon></a>';
                        echo '<a href="update-schedule.php"><ion-icon name="pencil-outline"></ion-icon></a>';
                        echo '<a href="delete-schedule.php"><ion-icon name="trash-outline"></ion-icon></a>';
                    }
                ?>
                </div>
            </div>
            <table class="schedule">
                <h2>CS 102</h2>
                <thead>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </thead>    
                <tbody>
                <?php

                    $times = array(
                        "7:00 AM - 10:00 AM",
                        "10:00 AM - 1:00 PM",
                        "1:00 PM - 4:00 PM",
                        "4:00 PM - 7:00 PM"
                    );
                    $seven = "07:00";
                    $ten = "10:00";
                    $one = "13:00";
                    $four = "16:00";

                    foreach ($times as $time) {
                        echo "<tr>";
                        echo "<td style='width: 100px'><p>{$time}</p></td>";

                        $days = array(1, 2, 3, 4, 5, 6);

                        foreach ($days as $day) {
                            $found = false;

                            if ($time == "7:00 AM - 10:00 AM"){
                                foreach ($csseven as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "10:00 AM - 1:00 PM"){
                                foreach ($csten as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "1:00 PM - 4:00 PM"){
                                foreach ($csone as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "4:00 PM - 7:00 PM"){
                                foreach ($csfour as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }

                            if (!$found) {
                                echo "<td><p>-</p></td>";
                            }
                        }

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <table class="schedule">
                <h2>COM LAB</h2>
                <thead>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </thead>    
                <tbody>
                <?php

                    $times = array(
                        "7:00 AM - 10:00 AM",
                        "10:00 AM - 1:00 PM",
                        "1:00 PM - 4:00 PM",
                        "4:00 PM - 7:00 PM"
                    );
                    $seven = "07:00";
                    $ten = "10:00";
                    $one = "13:00";
                    $four = "16:00";

                    foreach ($times as $time) {
                        echo "<tr>";
                        echo "<td style='width: 100px'><p>{$time}</p></td>";

                        $days = array(1, 2, 3, 4, 5, 6);

                        foreach ($days as $day) {
                            $found = false;

                            if ($time == "7:00 AM - 10:00 AM"){
                                foreach ($comseven as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "10:00 AM - 1:00 PM"){
                                foreach ($comten as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "1:00 PM - 4:00 PM"){
                                foreach ($comone as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "4:00 PM - 7:00 PM"){
                                foreach ($comfour as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }

                            if (!$found) {
                                echo "<td><p>-</p></td>";
                            }
                        }

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <table class="schedule">
            <h2>ICT LAB</h2>
                <thead>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </thead>    
                <tbody>
                <?php

                    $times = array(
                        "7:00 AM - 10:00 AM",
                        "10:00 AM - 1:00 PM",
                        "1:00 PM - 4:00 PM",
                        "4:00 PM - 7:00 PM"
                    );
                    $seven = "07:00";
                    $ten = "10:00";
                    $one = "13:00";
                    $four = "16:00";

                    foreach ($times as $time) {
                        echo "<tr>";
                        echo "<td style='width: 100px'><p>{$time}</p></td>";

                        $days = array(1, 2, 3, 4, 5, 6);

                        foreach ($days as $day) {
                            $found = false;

                            if ($time == "7:00 AM - 10:00 AM"){
                                foreach ($ictseven as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "10:00 AM - 1:00 PM"){
                                foreach ($ictten as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "1:00 PM - 4:00 PM"){
                                foreach ($ictone as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "4:00 PM - 7:00 PM"){
                                foreach ($ictfour as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }

                            if (!$found) {
                                echo "<td><p>-</p></td>";
                            }
                        }

                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>