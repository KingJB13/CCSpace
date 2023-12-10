<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../configuration/dbcon.php';
    try{
        $log_id = $_GET['log_id'];
        $room_name = $_GET['room_name'];
        $professor =$_SESSION['username'];
        $day = date('l');
        $row = null;

        $sql = "SELECT * FROM ccs_reservation WHERE room = :room_name AND sched_date = DATE(NOW()) AND TIME(NOW()) >= TIME(time_start) AND TIME(NOW()) <= TIME(time_end)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':room_name', $room_name);
        $stmt->execute();
        $reserve = $stmt->fetch(PDO::FETCH_ASSOC);
        
        function getSchedule($room_name, $weekday){
            global $pdo;
            $sql = 'SELECT * FROM ccs_schedule WHERE room = :room AND sched_day = :weekday AND TIME(NOW()) >= TIME(time_start) AND TIME(NOW()) <= TIME(time_end)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':room', $room_name);
            $stmt->bindParam(':weekday', $weekday);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }

        }

        switch($day) { 
            case 'Monday':
                $weekday = '1';
                $row = getSchedule($room_name, $weekday); 
                break;
            case 'Tuesday':
                $weekday = '2';
                $row = getSchedule($room_name, $weekday); 
                break;
            case 'Wednesday':
                $weekday = '3';
                $row = getSchedule($room_name, $weekday);
                break;
            case 'Thursday':
                    $weekday = '4';
                    $row = getSchedule($room_name, $weekday);
                    break;
            case 'Friday':
                $weekday = '5';
                $row = getSchedule($room_name, $weekday);
                break;
            case 'Saturday':
                $weekday = '6';
                $row = getSchedule($room_name, $weekday);   
                break;
            default:
                $message = "Sunday is rest day";
                break;
            }

            $sql = "SELECT * FROM ccs_log WHERE log_id = :log_id AND room = :room_name";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':log_id', $log_id);
            $stmt->bindParam(':room_name', $room_name);
            $stmt->execute();
            $logexists = $stmt->fetch(PDO::FETCH_ASSOC);

            if(isset($_POST['time-in'])){
                if(isset($message)){
                    echo '<script>alert("'.$message.'")</script>';
                } else {
                    if($_SESSION['prof_name'] === $professor){
                        header("Location: time-in.php?schedule_id=".$_SESSION['schedule_id']."&room_name=".$room_name);
                        exit();
                    } elseif($_SESSION['prof_name'] !== $professor) {
                        $subject = $_SESSION['subject'];
                        $section = $_SESSION['section'];
                        $sql = 'INSERT INTO ccs_log(log_id, prof_name, room, subject, section, log_date, remarks) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :prof_name, :room_name, :subject, :section, NOW(),"Absent")';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':prof_name', $professor);
                        $stmt->bindParam(':room_name', $room_name);
                        $stmt->bindParam(':subject', $subject);
                        $stmt->bindParam(':section', $section);
                        if($stmt->execute()){
                            header("Location: time-in.php?schedule_id=&room_name=".$room_name);
                        }
                    }
                }
            } elseif(isset($_POST['time-out'])){
                header("Location: time-out.php?log_id=" . $logexists['log_id']."&room_name=".$room_name);
                exit();
            }
    } catch(PDOException $e){
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
        .info{
            height: 700px;
            width: 700px;
            background-color: white;
            border-radius: 20px 0;
        }
        .nav{
            width: 100%;
            height: 80px;
            background-color: #1F4172;
            border-radius: 20px 0 0 0;
            box-shadow: 0 0 30px rgba(0, 0, 0 , 0.20);
        }
        .left{
            float: left;
            padding: 30px;
            color: white;
        }
        .right{
            float: right;
            padding: 30px;
        }
        .right input{
            width: 70px;
            margin: 5px;
            padding: 2px;
            border: none;
            background-color: #0082e6;
            color: white;
            font-size: 15px;
        }
        .content{
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        @media(max-width: 1600px){
            .info{
                height: 500px;
                width: 500px;
            }
        }
        @media(max-width: 767px){
            .info{
                height: 400px;
                width: 400px;
            }
        }
    </style>
</head>
<body>
    <?php require '../navigation/profile-nav.php';?>
    <main>
    <div class="info">
            <div class="nav">
                <div class="left"><h2><?php echo $room_name?></h2></div>
                <div class="right">
                    <form action="room-info.php" method="POST">
                        
                    <?php
                    if(isset($message)){
                        echo '<input type="submit" value="Time In" name="time-in" disabled>';
                        echo '<input type="submit" value="Time Out" name="time-out" disabled>';
                    } else {
                        if(isset($logexists['log_id'])){
                            echo '<input type="submit" value="Time In" name="time-in" disabled>';
                            echo '<input type="submit" value="Time Out" name="time-out">';
                        } elseif(!isset($logexists['log_id'])) {
                            echo '<input type="submit" value="Time In" name="time-in">';
                            echo '<input type="submit" value="Time Out" name="time-out" disabled>';
                        } 
                    }
                    ?>
                    </form>
                </div>
            </div>
            <div class="content">
                <?php 
                if($reserve !== null && isset($reserve['reservation_id']) && $reserve['reserve_status'] == 'Accepted'){
                        $_SESSION['schedule_id'] = $reserve['reservation_id'];
                        $_SESSION['prof_name'] = $reserve['prof_name'];
                        $_SESSION['room'] = $reserve['subject'];
                        $_SESSION['section'] = $reserve['section'];
                        echo '<h3>Schedule ID: '. $reserve['reservation_id'] .'</h3>';
                        echo '<h3>Professor: '. $reserve['prof_name'] .'</h3>';
                        echo '<h3>Subject: '. $reserve['subject'] .'</h3>';
                        echo '<h3>Section: '. $reserve['section'] .'</h3>';
                        $start = $reserve['time_start'];
                        $time = new DateTime($start);
                        $time_start = $time->format('h:i A');
                        echo '<h3>Time Start:'.$time_start.'</h3>';
                        $end = $reserve['time_end'];
                        $time = new DateTime($end);
                        $time_end = $time->format('h:i A');
    
                        echo '<h3>Time End:'.$time_end.'</h3>';
                        echo (!$log_id) ? '<h3>Status: Vacant</h3>' : '<h3>Status: Occupied</h3>';

                } else {
                    if(isset($message)){
                        echo '<h3>'.$message.'</h3>';
                    }
                    else{
                        if($row !== null && isset($row['schedule_id'])){
                            $_SESSION['schedule_id'] = $row['schedule_id'];
                            $_SESSION['prof_name'] = $row['prof_name'];
                            $_SESSION['room'] = $row['subject'];
                            $_SESSION['section'] = $row['section']; 
                            echo '<h3>Schedule ID: '. $row['schedule_id'] .'</h3>';
                            echo '<h3>Professor: '. $row['prof_name'] .'</h3>';
                            echo '<h3>Subject: '. $row['subject'] .'</h3>';
                            echo '<h3>Section: '. $row['section'] .'</h3>';
                            $start = $row['time_start'];
                            $time = new DateTime($start);
                            $time_start = $time->format('h:i A');
                            echo '<h3>Time Start:'.$time_start.'</h3>';
                            $end = $row['time_end'];
                            $time = new DateTime($end);
                            $time_end = $time->format('h:i A');
    
                            echo '<h3>Time End:'.$time_end.'</h3>';
                            echo (!$log_id) ? '<h3>Status: Vacant</h3>' : '<h3>Status: Occupied</h3>';
                            
                        } else {
                            echo '<h3>Status: Vacant</h3>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <?php require '../navigation/main-footer.php';?>
</body>
</html>