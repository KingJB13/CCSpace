<?php
    session_start();
    require_once '../configuration/dbcon.php';

    if(isset($_SESSION['ccs_id']) && $_SESSION['position'] == 'Admin'){
        $sql = "SELECT * FROM ccs_reservation ORDER BY sched_date DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $prof_name = $_SESSION['username'];
        $sql = "SELECT * FROM ccs_reservation WHERE prof_name = :prof_name ORDER BY sched_date DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':prof_name', $prof_name, PDO::PARAM_STR);
        $stmt->execute();
        $prof = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if(isset($_POST['accept'])){
        $res_id = $_POST['reservation_id'];
        $sql = "UPDATE ccs_reservation SET reserve_status = 'Accepted' WHERE reservation_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $res_id);
        $stmt->execute();
    }
    elseif(isset($_POST['reject'])){
        $res_id = $_POST['reservation_id'];
        $sql = "UPDATE ccs_reservation SET reserve_status = 'Rejected' WHERE reservation_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $res_id);
        $stmt->execute();
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
        .reservation{
            padding: 20px;
            height: auto;
        }
        .title{
            height: auto;
            width: 100%;
            margin-bottom: 25px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
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
        .accept{
            padding: 7px 13px;
            background-color: #05a95c;
            border: none;
            border-radius: 10px;
        }
        .reject{
            padding: 7px 13px;
            background-color: #D60B00;
            border: none;
            border-radius: 10px;
        }
        .reservation td{
            vertical-align: top;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php if($_SESSION['position'] == 'Admin'){
        require '../navigation/admin-dashboard.php';
    }
    else{
        require '../navigation/user-dashboard.php';
    } 
    ?>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="reservation">
            <div class="title">
                <div class="title-left">
                    <h1>Reservation</h1>
                </div>
            </div>
            <table>
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <?php
                        if($_SESSION['position']=='Admin'){
                            echo '<th>Action</th>';

                        }
                    ?>
                </thead>
                <tbody>
                <?php 
                if($_SESSION['position'] == 'Admin'){
                    foreach ($result as $res){

                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr>";
                        echo '<form action="reservation.php" method="POST">';
                        echo "<td><input type='hidden' name='reservation_id' value='{$res['reservation_id']}'>{$res['reservation_id']}</td>";
                        echo "<td>{$res['prof_name']}</td>";
                        echo "<td>{$res['room']}</td>";
                        echo "<td>{$res['section']}</td>";
                        echo "<td>{$res['sched_date']}</td>";
                        echo "<td>{$res['time_start']}</td>";
                        echo "<td>{$res['time_end']}</td>";
                        echo "<td>{$res['purpose']}</td>";
                        if($res['reserve_status'] == 'Accepted' || $res['reserve_status'] == 'Rejected'){
                            echo "<td>{$res['reserve_status']}</td>";
                            echo '<td>';
                            echo '<button type="submit" class="accept" name="accept" disabled><ion-icon name="checkmark-outline"></ion-icon></button>';
                            echo '<button type="submit" class ="reject" name="reject" disabled><ion-icon name="close-outline"></ion-icon></button>';
                            echo '</td>';
                        }
                        else{
                            echo "<td>{$res['reserve_status']}</td>";
                            echo '<td>';
                            echo '<button type="submit" class="accept" name="accept"><ion-icon name="checkmark-outline"></ion-icon></button>';
                            echo '<button type="submit" class="reject" name="reject"><ion-icon name="close-outline"></ion-icon></button>';
                            echo '</td>';
                        }
                        echo "</form>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                } else {
                    foreach($prof as $reservation){
                        echo "<tr>";
                        echo "<td>{$reservation['reservation_id']}</td>";
                        echo "<td>{$reservation['prof_name']}</td>";
                        echo "<td>{$reservation['room']}</td>";
                        echo "<td>{$reservation['section']}</td>";
                        echo "<td>{$reservation['sched_date']}</td>";
                        echo "<td>{$reservation['time_start']}</td>";
                        echo "<td>{$reservation['time_end']}</td>";
                        echo "<td>{$reservation['purpose']}</td>";
                        echo "<td>{$reservation['reserve_status']}</td>";
                        echo "</tr>";
                    }
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