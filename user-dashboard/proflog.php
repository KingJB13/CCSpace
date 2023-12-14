<?php
    session_start();
    require_once '../configuration/dbcon.php';
try{
    if(isset($_SESSION['ccs_id'])){
        $prof_name = $_SESSION['username'];
        $sql = "SELECT * FROM ccs_log WHERE prof_name = :name ORDER BY log_date DESC LIMIT 25";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $prof_name);
        $stmt->execute();
        $prof = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        session_destroy();
        header("Location: ../index.php");
        exit();
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


        table {
            border-collapse: collapse;
            min-width: 400px;
            margin: 20px;
            table-layout: fixed;
        }
        thead{
            background-color: #1F4172;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            width: auto;
        }

        th {
            background-color: #1F4172;
            border: 1px solid #1F4172;
            color: white;
        }

        .log td,
        .proflog td {
            vertical-align: top;
            text-align: left;
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
        

            <div class="log">
                <table>
                    <thead>
                        <tr>
                            <th>Log ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Room</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($prof as $proflog){
                                echo "<tr>";
                                echo "<td>".$proflog['log_id']."</td>";
                                echo "<td>".$proflog['prof_name']."</td>";
                                echo "<td>".$proflog['log_date']."</td>";
                                echo "<td>".$proflog['room']."</td>";
                                echo "<td>".$proflog['subject']."</td>";
                                echo "<td>".$proflog['section']."</td>";
                                echo "<td>".$proflog['time_start']."</td>";
                                echo "<td>".$proflog['time_end']."</td>";
                                echo "<td>".$proflog['remarks']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
    
            </div>
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>