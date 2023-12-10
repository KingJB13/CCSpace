<?php
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../configuration/dbcon.php';
    
    try{
        $schedule_id = $_GET['schedule_id'];
        $room_name = $_GET['room_name'];
        $subject = $_SESSION['subject'];
        $section = $_SESSION['section'];
        $profname = $_SESSION['username']; 
        
        if(isset($_POST['text'])){
            $text = $_POST['text'];
            if($schedule_id){
                if(password_verify($room_name, $text)){
                    $sql = 'INSERT INTO ccs_log(log_id, prof_name, room, subject, section ,log_date, time_start, remarks) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :prof_name, :room_name, :subject, :section, NOW(),NOW(),"Ongoing")';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':prof_name', $profname);
                    $stmt->bindParam(':room_name', $room_name);
                    $stmt->bindParam(':subject', $subject);
                    $stmt->bindParam(':section', $section);
                    if($stmt->execute()){
                        $result = $stmt->fetch();
                        echo '<script>alert("Time In Success");window.location.href="room-info.php?log_id="'.$result['log_id'].'</script>';
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
            elseif($schedule_id === " "){
                if(isset($_POST['submit'])){
                    $sub = $_POST['subject'];
                    $sec = $_POST['section'];

                    if(password_verify($room_name, $text)){
                        $sql = 'INSERT INTO ccs_log(log_id, prof_name, room, subject, section ,log_date, time_start, remarks) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :prof_name, :room_name, :subject, :section, NOW(),NOW(),"Ongoing")';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':prof_name', $profname);
                        $stmt->bindParam(':room_name', $room_name);
                        $stmt->bindParam(':subject', $sub);
                        $stmt->bindParam(':section', $sec);
                        if($stmt->execute()){
                            $result = $stmt->fetch();
                            echo '<script>alert("Time In Success");window.location.href="room-info.php?log_id="'.$result['log_id'].'</script>';
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
        #file {
            padding-left: 20px;
        }
        #form{
            display: none;
            width: 100%;
        }
        #form .input-field{
            padding-left: 50px;
            padding-right: 50px;
            margin: 15px;
            display: block;
            align-items: center;
        }
        #form .input-field .input{
            width: 100%;
            outline: none;
            border: 1px solid #d5dbd9;
            font-size: 15px;
            padding: 5px 8px;
            border-radius: 3px;
            transition: all 0.3s ease;
            text-transform:none;
        }
        #form .input-field .input:focus{
            border: 1px solid #132043;
        }
        #form .input-field .btn{
            margin-left: 230px;
            width: 20%;
            padding: 5px 8px;
            font-size: 15px; 
            border: 0px;
            background:  #132043;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            outline: none;
        }
        #form .input-field .btn:hover{
            background: #fff;
            color: #132043;
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
            #form .input-field .btn{
            width: 100%;
            margin-left: 0;
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
            #form .input-field .btn{
            width: 100%;
            margin-left: 0;
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
                <input type="hidden" name="text" id="text">
                <label><h3>No Camera? Upload file instead</h3></label>
                <input type="file" name="file" id="file" accept="image/*">
                </form>

                <form id="form" action="time-in.php" method ="POST">
                    <div class="input-field">
                        <input type="text" name="subject" id="subject" class="input" placeholder="Subject">
                    </div>

                    <div class="input-field">
                        <input type="text" name="section" id="section" class="input" placeholder="Section">
                    </div>
                    <div class="input-field">
                        <input type="submit" value="Submit" name="submit" class="btn">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../scripts/qrcode.js"></script>
    <?php require '../navigation/main-footer.php';?>
</body>
</html>