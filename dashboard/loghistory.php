<?php
    session_start();
    require_once '../configuration/dbcon.php';

    if(isset($_SESSION['ccs_id']) && $_SESSION['position'] == 'Admin'){
        $prof_name = $_SESSION['username'];
        $sql = "SELECT * FROM ccs_log ORDER BY log_date DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        header("Location: ../user-dashboard/proflog.php");
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


    </style>
</head>

<body>
<?php require '../navigation/admin-dashboard.php'?>
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $log){
                            echo "<tr>";
                            echo "<td>".$log['log_id']."</td>";
                            echo "<td>".$log['prof_name']."</td>";
                            echo "<td>".$log['log_date']."</td>";
                            echo "<td>".$log['room']."</td>";
                            echo "<td>".$log['subject']."</td>";
                            echo "<td>".$log['section']."</td>";
                            echo "<td>".$log['time_start']."</td>";
                            echo "<td>".$log['time_end']."</td>";
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