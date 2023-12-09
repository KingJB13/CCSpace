<?php
    session_start();
    require_once '../configuration/dbcon.php';

    try {
        if(isset($_SESSION['ccs_id'])){
            $id = $_SESSION['ccs_id'];
            $sql = "SELECT * FROM ccs_user WHERE ccs_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            session_destroy();
            header('Location: ../index.php');
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCSpace</title>
    <link rel="stylesheet" href="../styles/dashboardstruc.css">
    <style>
    .about{
        margin-left: 20px;
        flex: 50%;
        display: table;
        padding: 30px 30px;
        font-size: 20px;
        height: 80vh;
        width: 100%;
    }

    .about h1{
        width: 100%;
        float: left;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 50px;
        font-weight: 500;
    }

    .about ul li{
        list-style: none;
    }

    .about ul{
        margin-top: 50px;

    }
    .about a{
        text-decoration: none;
        background: #1F4172;
        padding: 7px 13px;
        border-radius: 4px;
        color: white;
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
        
        <div class="about">
            <ul>
                <div class="left">
                    <h1>About</h1>
                </div>

            </ul>
            <ul>
                <h3>User ID</h3>
                <li><?php echo isset($results['ccs_id']) ? $results['ccs_id'] : 'N/A'; ?></li>
            </ul>
            <ul>
                <h3>First Name</h3>
                <li><?php echo isset($results['ccs_firstname']) ? $results['ccs_firstname'] : 'N/A'; ?></li>
            </ul>
            <ul>
                <h3>Last Name</h3>
                <li><?php echo isset($results['ccs_lastname']) ? $results['ccs_lastname'] : 'N/A'; ?></li>
            </ul>
            <ul>
                <h3>Middle Name</h3>
                <li><?php echo isset($results['ccs_middlename']) ? $results['ccs_middlename'] : 'N/A'; ?></li>
            </ul>
            <ul>
                <h3>Position</h3>
                <li><?php echo isset($results['ccs_position']) ? $results['ccs_position'] : 'N/A'; ?></li>
            </ul>
            <ul>
                <a href="update-password.php">Update Password</a>
                <a href="delete-account.php">Delete Account</a>
            </ul>
        </div>
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>