<?php
  session_start();
  require_once '../configuration/dbcon.php';

  if(isset($_SESSION['ccs_id']))
  {
    if(isset($_POST['create_reservation'])){
        try{
          $professor = $_SESSION['username'];
          $room = $_POST['room'];
          $section = $_POST['section'];
          $subject = $_POST['subject'];
          $timestart = $_POST['time_start'];
          $timeend = $_POST['time_end'];
          $purpose = $_POST['purpose'];
          $rawDate = $_POST['sched_date'];

          $dateTime = new DateTime($rawDate);
          $sched_date = $dateTime->format("Y/m/d");

          if($timestart != $timeend){
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
                $message = "W";
                sleep(2);
                header('location: reservation.php');
              }
              else{
                $message ="Error Updated Schedule";
              }
          }
          else{
            $message = "Time Start and Time End cannot be the same";
            sleep(2);
            header('Refresh: 0');
          }
            
        }
        catch(PDOException $e){
          $message = "Error: " . $e->getMessage();
          sleep(2);
          header('Location: ../index.php');
        }
    }
  }
  else{
    header("location:../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/nav-footer.css">
    <title>CCSpace</title>
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


      .wrapper .form .inputfield .custom_select{
        position: relative;
        width: 100%;
        height: 37px;
      }
      #sched_date{
        position: relative;
        width: 100%;
        height: 37px;
        border: 1px solid #d5dbd9;
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

      .wrapper .form .inputfield .input,
      .wrapper .form .inputfield .sched_date,
      .wrapper .form .inputfield .textarea{
        width: 100%;
        outline: none;
        border: 1px solid #d5dbd9;
        font-size: 15px;
        padding: 8px 10px;
        border-radius: 3px;
        transition: all 0.3s ease;
        text-transform:none;
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
    <?php require '../navigation/profile-nav.php';?>
    <main>
    <div class="wrapper">
            <div class="title">
              Reservation Form
            </div>
            <?php if(isset($message)):?>
                <div id="error" style="color:red"><p><?php echo $message?></p></div>
            <?php endif;?>
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
                  <div class="inputfield">
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

                  <div class="inputfield">
                    <label>Schedule Date</label>
                    <input type="date" id="sched_date" name="sched_date" required>
                  </div>
                  
                  <div class="inputfield">
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