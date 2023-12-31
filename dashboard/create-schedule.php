<?php
  session_start();
  require_once '../configuration/dbcon.php';

  if(isset($_SESSION['ccs_id']) && $_SESSION['position'] == 'Admin')
  {
    $sql = "SELECT ccs_firstname, ccs_lastname FROM ccs_user WHERE ccs_position != 'Admin'";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    $result = $stmt->fetchAll();
    if(isset($_POST['create_schedule'])){
        try{
          $professor = $_POST['professor'];
          $room = $_POST['room'];
          $section = $_POST['section'];
          $subject = $_POST['subject'];
          $timestart = $_POST['time_start'];
          $timeend = $_POST['time_end'];
          $sched_day = $_POST['sched_day'];

            if($timestart != $timeend){
              $sql = "INSERT INTO ccs_schedule(schedule_id, prof_name, room, subject, section, sched_day, time_start, time_end) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :professor, :room, :subject, :section, :sched_day,:time_start,:time_end)";
              $stmt = $pdo->prepare($sql);
              $stmt->bindParam(":professor", $professor);
              $stmt->bindParam(":room", $room);
              $stmt->bindParam(":section", $section);
              $stmt->bindParam(":subject", $subject);
              $stmt->bindParam(":time_start", $timestart);
              $stmt->bindParam(":time_end", $timeend);
              $stmt->bindParam(":sched_day", $sched_day);
                if($stmt->execute()){
                  echo "<script>alert('Successfully Created Schedule!'); window.location='dashboard.php';</script>";
                  exit();
                }
                else{
                  echo "<script>alert('Error in creating schedule');</script>";
                }
              }
              else{
                $end_error = "Time Start and Time End cannot be the same";
              }
        }
        catch(PDOException $e){
          $error_log = "Error: " . $e->getMessage();
          echo '<script>alert("' . $error_log . '"); window.location.href = "../index.php";</script>';
          exit();
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
              Create Schedule
            </div>
            <form class="form" method="POST" action="create-schedule.php">
                  <div class="inputfield">
                        <label>Professor Name</label>
                        <div class="custom_select">
                        <select id="room" name="professor">
                          <option value="" disabled selected>Select</option>
                          <?php foreach($result as $rows){
                            $fullName = $rows['ccs_firstname'] . ' ' . $rows['ccs_lastname'];
                            echo "<option value='{$fullName}'>{$fullName}</option>";
                          }
                          ?>
                        </select>
                      </div>
                  </div>

                    <div class="inputfield">
                      <label>Rooms</label>
                      <div class="custom_select">
                        <select id="room" name="room">
                          <option value="" disabled selected>Select</option>
                          <option value="CS 102">CS 102</option>
                          <option value="COM LAB">COM LAB</option>
                          <option value="ICT LAB">ICT LAB</option>
                        </select>
                      </div>
                  </div> 
                  <div class="inputfield">
                      <label>Section</label>
                      <div class="custom_select">
                        <select id="section" name="section">
                          <option value="" disabled selected>Select</option>
                          <option value="IT 3-A">IT 3-A</option>
                          <option value="IT 3-B">IT 3-B</option>
                          <option value="IT 3-C">IT 3-C</option>
                          <option value="IT 3-D">IT 3-D</option>
                          <option value="IT 3-E">IT 3-E</option>
                          <option value="IT 3-F">IT 3-F</option>
                          <option value="IT 3-G">IT 3-G</option>
                          <option value="IT 3-H">IT 3-H</option>
                          <option value="IT 3-I">IT 3-I</option>
                          <option value="IT 3-J">IT 3-J</option>
                          <option value="IT 3-K">IT 3-K</option>
                        </select>
                      </div>
                  </div> 
                  <div class="inputfield">
                      <label>Subject</label>
                      <div class="custom_select">
                        <select id="subject" name="subject">
                          <option value="" disabled selected>Select</option>
                          <option value="DBMS">DBMS</option>
                          <option value="IAS">IAS</option>
                          <option value="MOB DEV">MOB DEV</option>
                          <option value="WEB DEV">WEB DEV</option>
                          <option value="OOP">OOP</option>
                          <option value="CSS">CSS</option>
                          <option value="SAD">SAD</option>
                          <option value="NET">NET</option>
                        </select>
                      </div>
                  </div> 
                  <div class="inputfield">
                      <label>Duration Start</label>
                      <div class="custom_select">
                        <select id="timestart" name="time_start">
                          <option value="" disabled selected>Select</option>
                          <option value="07:00">07:00</option>
                          <option value="10:00">10:00</option>
                          <option value="13:00">13:00</option>
                          <option value="16:00">16:00</option>
                        </select>
                      </div>
                  </div> 
                  <div class="inputfield" <?php echo isset($end_error) ? 'data-error="' . htmlspecialchars($end_error) . '"' : ''; ?>>
                      <label>Duration End</label>
                      <div class="custom_select">
                        <select id="timeend" name="time_end">
                          <option value="" disabled selected>Select</option>
                          <option value="10:00">10:00</option>
                          <option value="13:00">13:00</option>
                          <option value="16:00">16:00</option>
                          <option value="19:00">19:00</option>
                        </select>
                      </div>
                  </div>

                  <div class="inputfield">
                      <label>Schedule Day</label>
                      <div class="custom_select">
                        <select id="schedday" name="sched_day">
                          <option value="0" disabled selected>Select</option>
                          <option value="1">Monday</option>
                          <option value="2">Tuesday</option>
                          <option value="3">Wednesday</option>
                          <option value="4">Thursday</option>
                          <option value="5">Friday</option>
                          <option value="6">Saturday</option>
                        </select>
                      </div>
                  </div>

                  <div class="inputfield">
                  <input type="submit" value="Create Schedule" id="btn" class="btn" name="create_schedule">
                  </div>
            </form>
          </div>
    </div>
    <script src="../scripts/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>