<?php
    session_start();
    require_once '../configuration/dbcon.php';
    function getLog($room){
        global $pdo;
        $sql = "SELECT * FROM ccs_log WHERE room = :room AND remarks = 'Ongoing'";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(':room', $room);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
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
        .wrapper{
            padding: 20px;
            height: auto;
            width: 100%;
        }
        .title{
            margin-bottom: 25px;
            width: 100%;
        }
        .card{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            padding: 20px;
            grid-gap: 40px;
        }
        .card-body{
            border-radius: 20px;
            background: white;
            box-shadow: 0 0 30px rgba(0,0,0,0.18);
        }
        .card-body .img{
            padding: 20px;
            position: relative;
            display: block;
        }
        .card-body .img:after{

        }
        .card-body img{
            width: 100%;
            border-radius: 20px 20px 0 0;
        }
        .info {
            padding: 20px 10px;
            text-align: center;
        }
        .info h2{
            color: #1F4172;
            font-weight: 600;
            font-size: 25px;
            margin: 10px 0 15px 0;
        }
        .info a{
            text-decoration: none;
            color: #1F4172;
            font-size: 15px;
            line-height: 30px;
            font-weight: 400;
        }
    </style>
</head>
<body>
    <?php require '../navigation/profile-nav.php';?>
    <main>
    <div class="wrapper">
            <div class="title">
              <h1>Rooms</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="img"><img src="../img/school.png" alt="img"></div>
                    <div class="info">
                        <h2>CS 101</h2>
                        <?php $cs = getLog('CS 101');
                            if($cs === null && !isset($cs['log_id'])){
                                echo '<a href="room-info.php?room_name=CS%20101&log_id=">Information</a>';
                            } else {
                                echo '<a href="room-info.php?room_name=CS%20101&log_id=' . $cs['log_id'] . '">Information</a>';
                            }
                        ?>
                        
                    </div>
                </div>

                <div class="card-body">
                    <div class="img"><img src="" alt="img"></div>
                    <div class="info">
                        <h2>Com Lab</h2>
                        <?php $comlab = getLog('COM LAB');
                            if($comlab === null && !isset($comlab['log_id'])){
                                echo '<a href="room-info.php?room_name=COM%20LAB&log_id=">Information</a>';
                            } else {
                                echo '<a href="room-info.php?room_name=COM%20LAB&log_id=' . $comlab['log_id'] . '">Information</a>';
                            }
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="img"><img src="" alt="img"></div>
                    <div class="info">
                        <h2>ICT Lab</h2>
                        <?php $ict = getLog('ICT LAB');
                            if($ict === null && !isset($ict['log_id'])){
                                echo '<a href="room-info.php?room_name=ICT%20LAB&log_id=">Information</a>';
                            } else {
                                echo '<a href="room-info.php?room_name=ICT%20LAB&log_id=' . $ict['log_id'] . '">Information</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
    </div>
    </main>
    <?php require '../navigation/main-footer.php';?>
</body>
</html>