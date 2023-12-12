<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once '../configuration/dbcon.php';
    try{
        if(isset($_POST['text'])){
            $log_id = $_SESSION['log_id'];
            $room_name = $_SESSION['room'];
            $text = $_POST['text'];
            if($log_id){
                if(password_verify($room_name, $text)){
                    $sql = 'UPDATE ccs_log SET time_end = NOW(), remarks = "Present" WHERE log_id = :log_id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':log_id', $log_id);
                    if($stmt->execute()){
                        $result = $stmt->fetch();
                        echo '<script>alert("Time Out Success");window.location.href="rooms.php"</script>';
                        exit();
                    } else{
                        echo '<script>alert("Error: '.$stmt->error().'");window.location.href="time-out.php?log_id='.$log_id.'&room_name='.$room_name.'"</script>';
                        exit();
                    }
                } else {
                    echo '<script>alert("QR Code does not match");window.location.href="time-out.php?log_id='.$log_id.'&room_name='.$room_name.'"</script>';
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
                height: 500px;
                width: 500px;
            }
            #preview{
                height: 300px;
                width: 400px;
            }
        }
        @media(max-width: 767px){
            .info{
                height: 400px;
                width: 400px;
            }
            #preview{
                height: 400px;
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
                <form action="time-out.php" method="POST">
                <label><h3>No Camera? Upload file instead</h3></label>
                <input type="file" name="file" id="file" accept="image/*">
                <input type="text" name="text" id="text" readonly class="text">
                <input type="submit" value="submit" name="timeout" class="submit">
                </form>
            </div>
        </div>
    </main>
    <script src="../scripts/time-in.js"></script>
    <?php require '../navigation/main-footer.php';?>
</body>
</html>