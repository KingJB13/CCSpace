<?php
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../configuration/dbcon.php';
    
    try{
        $schedule_id = $_SESSION['schedule_id'];
        $room_name = $_SESSION['room'];
        $subject = $_SESSION['subject'];
        $section = $_SESSION['section'];
        $profname = $_SESSION['username']; 
        if(isset($_POST['text'])){
            $text = $_POST['text'];
            if(isset($schedule_id)){
                if(password_verify($room_name, $text)){
                    $sql = 'INSERT INTO ccs_log(log_id, prof_name, room, subject, section ,log_date, time_start, remarks) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :prof_name, :room_name, :subject, :section, NOW(),NOW(),"Ongoing")';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':prof_name', $profname);
                    $stmt->bindParam(':room_name', $room_name);
                    $stmt->bindParam(':subject', $subject);
                    $stmt->bindParam(':section', $section);
                    if($stmt->execute()){
                        $sql = "SELECT * FROM ccs_log WHERE room = :room AND remarks = 'Ongoing'";
                        $state = $pdo->prepare($sql);
                        $state->bindParam(':room', $room_name);
                        $state->execute();
                        $result = $state->fetch();
                        $_SESSION['room'] = $result['room'];
                        $_SESSION['log_id'] = $result['log_id'];
                        echo '<script>alert("Time In Success");window.location.href="room-info.php?room_name='.$room_name.'&log_id='.$_SESSION['log_id'].'"</script>';
                        exit();
                    } else{
                        echo '<script>alert("Error: '.$stmt->error().'");window.location.href="time-in.php?schedule_id='.$schedule_id.'&room_name='.$room_name.'"</script>';
                        exit();
                    }
                } else {
                    echo '<script>alert("QR Code does not match");window.location.href="time-in.php?schedule_id='.$schedule_id.'&room_name='.$room_name.'"</script>';
                    exit();
                }
            }
            elseif(!isset($schedule_id)){
                    if(password_verify($room_name, $text)){
                        $sql = 'INSERT INTO ccs_log(log_id, prof_name, room,log_date, time_start, remarks) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :prof_name, :room_name, NOW(),NOW(),"Ongoing")';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':prof_name', $profname);
                        $stmt->bindParam(':room_name', $room_name);
                        if($stmt->execute()){
                            $result = $stmt->fetch();
                            $professor = $_SESSION['prof_name'];
                            $query = 'INSERT INTO ccs_log(log_id, prof_name, room, subject, section, log_date,time_start,time_end, remarks) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :prof_name, :room_name, :subject, :section, NOW(),NOW(),NOW(),"Absent")';
                            $stmt2 = $pdo->prepare($query);
                            $stmt2->bindParam(':prof_name', $professor);
                            $stmt2->bindParam(':room_name', $room_name);
                            $stmt2->bindParam(':subject', $subject);
                            $stmt2->bindParam(':section', $section);
                            $stmt2->execute();
                            echo '<script>alert("Time In Success");window.location.href="room-info.php?log_id="'.$result['log_id']."&room_name=".$result['room'].'</script>';
                            exit();
                        } else{
                            echo '<script>alert("Error: '.$stmt->error().'");window.location.href="time-in.php?schedule_id="'.$schedule_id.'</script>';
                            exit();
                        }
                    } else {
                        echo '<script>alert("QR Code does not match");window.location.href="time-in.php?schedule_id="'.$schedule_id.'</script>';
                        exit();
                    }
            } else {
                header("Location: rooms.php");
                exit();
            }
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
    <script type="text/javascript" src="../scripts/adapter.min.js"></script>
    <script type="text/javascript" src="../scripts/vue.min.js"></script>
    <script type="text/javascript" src="../scripts/instascan.min.js"></script>
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
        .content{
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }
        label{
            margin-left: 20px;
        }
        #preview {
            height: 350px;
            width: 500px;
        }
        form{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #file {
            padding-left: 20px;
        }
        .text{
            width: 50%;
            margin-top: 20px;
        }
        .submit{
            width: 10%;
            margin-top: 20px;
            background-color: #1F4172;
            color: #fff;
            border: none;
            padding: 7px 10px;
            border-radius: 4px;
        }
        @media(max-width: 1600px){
            .info{
                height: 650px;
                width: 500px;
            }
            #preview{
                height: 300px;
                width: 400px;
            }
        }
        @media(max-width: 767px){
            .info{
                height: 600px;
                width: 400px;
            }
            #preview{
                height: 250px;
                width: 300px;
            }
        }
    </style>
</head>
<body>
    <?php require '../navigation/profile-nav.php';?>
    <main>
    <div class="info">
            <div class="nav">
                <div class="left"><h2>Time In</h2></div>
            </div>
            <div class="content">
                <video id="preview"></video>
                <form action="time-in.php" method="POST">
                <label><h3>No Camera? Upload file instead</h3></label>
                <input type="file" name="file" id="file" accept="image/*">
                <input type="text" name="text" id="text" readonly class="text">
                <input type="submit" value="submit" name="timein" class="submit">
                </form>
            </div>
        </div>
    </main>
    <script src="../scripts/time-in.js"></script>
    <?php require '../navigation/main-footer.php';?>
</body>
</html>