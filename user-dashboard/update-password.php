<?php
    session_start();
    require_once '../configuration/dbcon.php';

    if(isset($_SESSION['ccs_id'])){

        if(isset($_POST['update'])){
            
            $id = $_SESSION['ccs_id'];
            $currentpassword = $_POST['currentpassword'];
            $newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);

            $sql = "SELECT ccs_password FROM ccs_user WHERE ccs_id = :id"; 
            $stmt= $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();

            if(password_verify($currentpassword, $result['ccs_password'])){
                try{
                    $sql = "UPDATE ccs_user SET ccs_password = :newpassword WHERE ccs_id = :id"; 
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":newpassword", $newpassword);
                    $stmt->bindParam(":id", $id);
                    $stmt->execute();
                    header("Location: dashboard.php");
                }
                catch (PDOException $e) {
                    $error_message='Database error: ' . $e->getMessage();
                    sleep(2);
                    header('Location: dashboard.php');
                }
            } else {
                $error_message = "Current password is incorrect";
                sleep(2);
                header('Reload: 0');
            }
        }
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
        .wrapper{
        max-width: 500px;
        width: 100%;
        background: #fff;
        margin: 50px auto;
        box-shadow: 2px 2px 4px rgba(0,0,0,0.125);
        padding: 30px;
      }

      .wrapper .title{
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #132043;
        text-transform: uppercase;
        text-align: center;
      }

      .wrapper .form{
        width: 100%;
      }

      .wrapper .form .inputfield{
        margin-bottom: 15px;
        display: flex;
      }

      .wrapper .form .inputfield:nth-child(7){
          margin-bottom: 20px;
      }

      .wrapper .form .inputfield label{
        width: 200px;
        color: #757575;
        margin-right: 10px;
        font-size: 14px;
      }

      .wrapper .form .inputfield .textarea {
        width: 100%;
        height: 100px;
        resize: none;
        box-sizing: border-box;
        outline: none;
        border: 1px solid #d5dbd9;
        font-size: 15px;
        padding: 15px;
        border-radius: 3px;
        transition: all 0.3s ease;
    }


      .wrapper .form .inputfield .custom_select{
        position: relative;
        width: 100%;
        height: 37px;
      }

      .wrapper .form .inputfield .custom_select:before{
        content: "";
        position: absolute;
        top: 12px;
        right: 10px;
        border: 8px solid;
        border-color: #d5dbd9 transparent transparent transparent;
        pointer-events: none;
      }

      .wrapper .form .inputfield .custom_select select{
        -webkit-appearance: none;
        -moz-appearance:   none;
        appearance:        none;
        outline: none;
        width: 100%;
        height: 100%;
        border: 0px;
        padding: 8px 10px;
        font-size: 15px;
        border: 1px solid #d5dbd9;
        border-radius: 3px;
      }

      .wrapper .form .inputfield .textarea:focus,
      .wrapper .form .inputfield .custom_select select:focus{
        border: 1px solid #132043;
      }

      .wrapper .form .inputfield p{
        font-size: 14px;
        color: #757575;
      }



      .wrapper .form .inputfield .btn{
        width: 100%;
        padding: 8px 10px;
        font-size: 15px; 
        border: 0px;
        background:  #132043;
        color: #fff;
        cursor: pointer;
        border-radius: 3px;
        outline: none;
      }

      .wrapper .form .inputfield .btn:hover{
        background: #132043;
      }

      .wrapper .form .inputfield:last-child{
        margin-bottom: 0;
      }

      @media (max-width:420px) {
        .wrapper .form .inputfield{
          flex-direction: column;
          align-items: flex-start;
        }
        .wrapper .form .inputfield label{
          margin-bottom: 5px;
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
        <div class="wrapper">
            <div class="title">
             UPDATE PASSWORD
            </div>
            <?php if(isset($error_message)):?>
                <div id="error" style="color:red"><p><?php echo $error_message?></p></div>
            <?php endif;?>
            
            <form action="update-password.php" method="POST" class="form">
                 <div class="inputfield">
                    <label>Enter Current Password</label>
                    <input type="password" class="input" id="password" name="currentpassword">
                 </div>  
                 <div class="inputfield">
                    <label>Enter New Password</label>
                    <input type="password" class="input" id="password" name="newpassword">
                 </div>
               
              <div class="inputfield">
                <input type="submit" value="Update Password" id="btn" class="btn" name="update">
              </div>
            </form>
        </div>
        
    </div>
    <script src="../dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>