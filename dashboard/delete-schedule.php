<?php
session_start();
require_once '../configuration/dbcon.php';

try{
  if(isset($_SESSION['ccs_id']) &&($_SESSION['position'] == 'Admin')){
    if(isset($_POST['delete-schedule'])){
        $id = $_POST['schedule_id'];
        $sql = "DELETE FROM ccs_schedule WHERE schedule_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
          echo "<script>alert('Successfully deleted!');window.location.href = 'dashboard.php'</script>";
          exit();
        } else {
          echo "<script>alert('Error deleting schedule!');window.location.href = 'dashboard.php'</script>";
          exit();
        }
    }
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
    <link rel="stylesheet" href="../styles/input.css">
</head>

<body>
<?php require '../navigation/admin-dashboard.php'?>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="wrapper">
            <div class="title">
                Enter Schedule ID to Delete Schedule
            </div>

            <form action="delete-schedule.php" method="POST" class="form">
              <div class="inputfield">
                        <label>Schedule ID</label>
                        <input type="text" class="input" name="schedule_id">
              </div>
              <div class="inputfield">
                <input type="submit" value="Delete Schedule" id="btn" class="btn" name="delete-schedule">
              </div>
            </form>
        </div>
        
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>