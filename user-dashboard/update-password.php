<?php
    session_start();
    require_once '../configuration/dbcon.php';


    try{
      if(isset($_SESSION['ccs_id'])){

        if(isset($_POST['update'])){
            $id = $_SESSION['ccs_id'];
            $currentpassword = $_POST['currentpassword'];
            $newpassword = $_POST['newpassword'];
            $confirmpassword = $_POST['confirm-password'];
            

            $sql = "SELECT ccs_password FROM ccs_user WHERE ccs_id = :id"; 
            $stmt= $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();

            if(strlen($currentpassword) < 8 || strlen($currentpassword) > 32 || strlen($newpassword) < 8 || strlen($newpassword) > 32){
              if(password_verify($currentpassword, $result['ccs_password'])){
                if($newpassword === $confirmpassword){
                  $passwordhash = password_hash($confirmpassword, PASSWORD_BCRYPT);
                    $sql = "UPDATE ccs_user SET ccs_password = :password WHERE ccs_id = :id";
                    $stmt= $pdo->prepare($sql);
                    $stmt->bindParam(':password',$passwordhash);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    echo "<script>alert('Password Successfully Updated!');window.location.href ='dashboard.php'</script>";
                    exit();
                } else {
                    $confirm_message = "Password not matched";
                }
              } else {
                $current_error = "Password is incorrect";
              }
            }
            else {
              $msg = "Password must be 8 - 32 characters long";
              $current_error = $msg;
              $new_error = $msg;
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
    <link rel="stylesheet" href= "../styles/input.css">
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
             UPDATE PASSWORD
            </div>
            <form action="update-password.php" method="POST" class="form">
                 <div class="inputfield" <?php echo isset($current_error) ? 'data-error="' . htmlspecialchars($current_error) . '"' : ''; ?>>
                    <label>Enter Current Password</label>
                    <input type="password" class="input" id="password" name="currentpassword">
                 </div>  
                 <div class="inputfield" <?php echo isset($new_error) ? 'data-error="' . htmlspecialchars($new_error) . '"' : ''; ?>>
                    <label>Enter New Password</label>
                    <input type="password" class="input" id="password" name="newpassword">
                 </div>
                 <div class="inputfield" <?php echo isset($confirm_message) ? 'data-error="' . htmlspecialchars($confirm_message) . '"' : ''; ?>>
                    <label>Retype Password</label>
                    <input type="password" class="input" id="password" name="confirm-password">
                 </div>
              <div class="inputfield">
                <input type="submit" value="Update Password" id="btn" class="btn" name="update">
              </div>
            </form>
        </div>
        
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>