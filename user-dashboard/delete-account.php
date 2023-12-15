<?php
session_start();
require_once '../configuration/dbcon.php';

try{
  if(isset($_SESSION['ccs_id'])){
    if(isset($_POST['delete'])){
        $id = $_SESSION['ccs_id'];
        $password = $_POST['password'];
        $sql = "SELECT ccs_password FROM ccs_user WHERE ccs_id = :id"; 
        $stmt= $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();

        if(strlen($password) < 8 || strlen($password) > 32){
          $error_message = "Password must be between 8 and 32 characters long.";
        } else {
          
          if(password_verify($password, $result['ccs_password'])){
            $id = $_SESSION['ccs_id'];
                $sql = "DELETE FROM ccs_user WHERE ccs_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                if($stmt->execute()){
                  echo "<script>alert('Account Deleted Successfully!');window.location='../index.php'</script>";
                }
                else{
                  echo "<script>alert('Error deleting account!')</script>";
                }
          } else {
              $error_message = "Current password is incorrect";
          }
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
<?php require '../navigation/user-dashboard.php';?>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="wrapper">
            <div class="title">
                ENTER PASSWORD TO DELETE ACCOUNT
            </div>
            <form action="delete-account.php" method="POST" class="form">
              <div class="inputfield" <?php echo isset($error_message) ? 'data-error="' . htmlspecialchars($error_message) . '"' : ''; ?>>
                        <label>Password</label>
                        <input type="password" class="input" name="password">
              </div>
              <div class="inputfield">
                <input type="submit" value="Delete Account" id="btn" class="btn" name="delete">
              </div>
            </form>
        </div>
        
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>