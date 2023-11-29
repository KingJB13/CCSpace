<?php
    session_start();
    require_once '../configuration/dbcon.php';
    try {
        if(isset($_SESSION['ccs_id']) && $_SESSION['position'] == 'Admin'){
            $sql = "SELECT count(*) as user_count FROM ccs_user WHERE ccs_position <> 'Admin'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            $user_count = $row['user_count'];

            $sql = "SELECT COUNT(*) as present_count FROM ccs_log  WHERE remarks ='Present' AND log_date >= DATE_FORMAT(log_date, '%Y-%m,-01')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            $present_count = $row['present_count'];

            $sql = "SELECT COUNT(*) as absent_count FROM ccs_log  WHERE remarks ='Absent' AND log_date >= DATE_FORMAT(log_date, '%Y-%m,-01')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch();
            $absent_count = $row['absent_count'];

            $sql = "SELECT * FROM ccs_user WHERE ccs_position <>'Admin'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(isset($_POST['delete'])){
                $id = $_POST['user_id'];
                $sql = "DELETE FROM ccs_user WHERE ccs_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                header("Refresh: 0");
            }

        } else {
            header('Location: ../user-dashboard/dashboard.php');
        }
    } catch (PDOException $e) {
        session_destroy();
        die('Database error: ' . $e->getMessage());
        header('Location: ./index.php');
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
    .countbox{
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 30px;
    }

    .countbox .card{
        position: relative;
        background: #fff;
        padding: 30px;
        background: #1F4172;
        border-radius: 25px;
    }
    .countbox .card .numbers{
        position: relative;
        font-weight: 500;
        font-size: 40px;
        color: #fff;
    }

    .countbox .card .name{
        color: #fff;
        font-size: 18px;
        margin-top: 5px;
    }
    .userdetails{
        position: relative;
        width: 100%;
        padding: 20px;
    }
    .usertable .header h2{
        text-align: left;
        font-size: 30px;
        margin-bottom: 10px;
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
    .userdetails ion-icon{
        color: black;
        font-size: 20px;
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
        <div class="countbox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $user_count; ?></div>
                        <div class="name">User Count</div>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $present_count; ?></div>
                        <div class="name">Monthly Present Count</div>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $absent_count; ?></div>
                        <div class="name">Monthly Absentees</div>
                    </div>
                </div>
        </div>
        <div class="userdetails">
            <div class="usertable">
                <div class="header">
                    <h2>User Information</h2>
                </div>
                <form action="dashboard.php" method="POST">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Middle Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($rows as $user){
                                echo '<tr>';
                                echo "<td><input type='hidden' name='user_id' value='{$user["ccs_id"]}'>{$user['ccs_id']}</td>";
                                echo '<td>'. $user['ccs_firstname'].'</td>';
                                echo '<td>'. $user['ccs_lastname'].'</td>';
                                echo '<td>'. $user['ccs_middlename'].'</td>';
                                echo '<td>'. $user['ccs_position'].'</td>';
                                echo '<td><button type="submit" class="delete" name="delete"><ion-icon name="trash-outline"></ion-icon></button></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
    <script src="../dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>