<?php
session_start();
require_once '../configuration/dbcon.php';

    if(isset($_SESSION['ccs_id'])){
        $prof_name = $_SESSION['username'];
        $sql = "SELECT * FROM ccs_schedule WHERE prof_name = :prof_name AND time_start = '7:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':prof_name',$prof_name);
        $stmt->execute();
        $schedseven = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE prof_name = :prof_name AND time_start = '10:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':prof_name',$prof_name);
        $stmt->execute();
        $schedten = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM ccs_schedule WHERE prof_name = :prof_name AND time_start = '13:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':prof_name',$prof_name);
        $stmt->execute();
        $schedone = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        $sql = "SELECT * FROM ccs_schedule WHERE prof_name = :prof_name AND time_start = '16:00' ORDER BY sched_day ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':prof_name',$prof_name);
        $stmt->execute();
        $schedfour = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    else
    {
        session_destroy();
        header("Location: ../index.php");
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
<?php require '../navigation/user-dashboard.php';?>
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
            </div>
            <table class="schedule">
                    <h2>SCHEDULE</h2>
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
                                foreach ($schedseven as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p><br><p>{$schedule['room']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "10:00 AM - 1:00 PM"){
                                foreach ($schedten as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p><br><p>{$schedule['room']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "1:00 PM - 4:00 PM"){
                                foreach ($schedone as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p><br><p>{$schedule['room']}</p></td>";
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            elseif ($time == "4:00 PM - 7:00 PM"){
                                foreach ($schedfour as $schedule) {
                                    if ($schedule['sched_day'] == $day) {
                                        echo "<td><p>{$schedule['section']}</p> <br> <p>{$schedule['subject']}</p> <br> <p>{$schedule['prof_name']}</p><br><p>{$schedule['room']}</p></td>";
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