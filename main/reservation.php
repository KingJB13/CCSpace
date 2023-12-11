<?php
  session_start();
  require_once '../configuration/dbcon.php';
  try{
    if(isset($_SESSION['ccs_id']))
    {
      if(isset($_POST['create_reservation'])){
        $professor = $_SESSION['username'];
        $room = $_POST['room'];
        $section = $_POST['section'];
        $subject = $_POST['subject'];
        $timestart = $_POST['time_start'];
        $timeend = $_POST['time_end'];
        $purpose = $_POST['purpose'];
        $rawDate = $_POST['sched_date'];
        
        $pattern = '/^[A-Za-z]+(?: [A-Za-z]+)*$/';
        $dateTime = new DateTime($rawDate);
        $sched_date = $dateTime->format("Y-m-d");
    
        if($timestart != $timeend){
          if($sched_date > date("Y-m-d")){
            if(preg_match($pattern, $purpose)){
              $sql = "INSERT INTO ccs_reservation (reservation_id, prof_name, room, subject, section, sched_date, time_start, time_end, purpose, reserve_status) VALUES (FLOOR(RAND() * (3000000 - 2000000 + 1) + 2000000), :professor, :room, :subject, :section, :sched_date, :time_start, :time_end, :purpose, 'Pending')";
              $stmt = $pdo->prepare($sql);
              $stmt->bindParam(":professor", $professor);
              $stmt->bindParam(":room", $room);
              $stmt->bindParam(":section", $section);
              $stmt->bindParam(":subject", $subject);
              $stmt->bindParam(":time_start", $timestart);
              $stmt->bindParam(":time_end", $timeend);
              $stmt->bindParam(":purpose", $purpose);
              $stmt->bindParam(":sched_date", $sched_date);
                if($stmt->execute()){
                  echo '<script>alert("Reservation Created Successfully");</script>';
                }
                else{
                  echo '<script>alert("Reservation Created Successfully");</script>';
                }
            } else {
              $purpose_error = "Only Characters are allowed";
            }
          } else {
            $date_error = "Invalid date";
          }
        }
        else{
          $end_error = "Time Start and Time End cannot be the same";
        }
      }
    }
    else{
      header("location:../index.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/nav-footer.css">
    <link rel="stylesheet" href= "../styles/input.css">
    <title>CCSpace</title>
</head>
<body>
    <?php require '../navigation/profile-nav.php';?>
    <main>
    <div class="wrapper">
            <div class="title">
              Reservation Form
            </div>
            <form class="form" method="POST" action="reservation.php">
                  <div class="inputfield">
                        <label>Professor Name</label>
                        <?php 
                        $professor = $_SESSION['username'];
                        echo '<input type="text" class="input" name="professor" value="'.$professor.'" disabled>';
                        ?>
                  </div>

                  <div class="inputfield">
                      <label>Rooms</label>
                      <div class="custom_select">
                        <select id="room" name="room" required>
                          <option value="" disabled selected>Select</option>
                          <option value="CS 101">CS 101</option>
                          <option value="COM LAB">COM LAB</option>
                          <option value="ICT LAB">ICT LAB</option>
                        </select>
                      </div>
                  </div> 
                  <div class="inputfield">
                      <label>Section</label>
                      <div class="custom_select">
                        <select id="section" name="section" required>
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
                        <select id="subject" name="subject" required>
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
                        <select id="timestart" name="time_start" required>
                          <option value="" disabled selected>Select</option>
                          <option value="07:00">07:00</option>
                          <option value="10:00">10:00</option>
                          <option value="13:0">13:00</option>
                          <option value="16:00">16:00</option>
                        </select>
                      </div>
                  </div> 
                  <div class="inputfield" <?php echo isset($end_error) ? 'data-error="' . htmlspecialchars($end_error) . '"' : ''; ?>>
                      <label>Duration End</label>
                      <div class="custom_select">
                        <select id="timeend" name="time_end" required>
                          <option value="" disabled selected>Select</option>
                          <option value="10:00">10:00</option>
                          <option value="13:00">13:00</option>
                          <option value="16:00">16:00</option>
                          <option value="19:00">19:00</option>
                        </select>
                      </div>
                  </div>

                  <div class="inputfield" <?php echo isset($date_error) ? 'data-error="' . htmlspecialchars($date_error) . '"' : ''; ?>>
                    <label>Schedule Date</label>
                    <input type="date" id="sched_date" name="sched_date" required>
                  </div>
                  
                  <div class="inputfield" <?php echo isset($purpose_error) ? 'data-error="' . htmlspecialchars($purpose_error) . '"' : ''; ?>>
                    <label>Purpose</label>
                    <textarea class="textarea" placeholder="Type in 255 letters" name="purpose"></textarea>
                  </div>

                  <div class="inputfield">
                  <input type="submit" value="Create Reservation" id="btn" class="btn" name="create_reservation">
                  </div>

                  
            </form>
          </div>
    </main>
    <?php require '../navigation/main-footer.php';?>
</body>
</html>