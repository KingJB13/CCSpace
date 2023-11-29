<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCSpace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/nav-footer.css">
    <style>
        .container{
            padding: 20px;
        }
        .faqs {
            display: flex;
            position: relative;
            flex-direction: column; /* Center horizontally */
            height: auto;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            background: rgba(31, 65, 114, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .faqs h2 {
            color: white;
            text-align: center;
        }
        
        .faqs p{
           text-align: justify;
           color: white;
        }

        @media(max-width: 952px){
            .faqs h2{
                font-size: 25px;
            }
            .faqs p{
                font-size: 15px
            }
        }

    </style>
</head>

<body>
<?php require '../navigation/main-nav.php';?>
            <main>
                <div class="container">
                    <div class="faqs">
                        <h2>FAQ'S</h2>
                        <br>
                        <p>Q: How do I access the schedule and time log in the web system?</p>
                        <br>
                        <p>A: Log in to your account and navigate to the "Schedule" or "Audit Trail section on the dashboard.</p>
                        <br>
                        <p>Q: Can I add my schedule in the web system?</p>
                        <br>
                        <p>A: No, but you can send a request to the admin through our reservation form.</p>
                        <br>
                        <p>Q: Is it possible to set reminders for upcoming events in the schedule?</p>
                        <br>
                        <p>A: No, the purpose of the website is to provide information and ask for reservation</p>
                        <br>
                        <p>Q: How can I log my working hours using the time log feature?</p>
                        <br>
                        <p>A: You can scan the qr code in the classroom and it will log in or log out based on the status of the room.</p>
                        <br>
                        <p>Q: Is there a way to share my schedule with team members?</p>
                        <br>
                        <p>A: You can see which professor is scheduled on the room.</p>
                        <br>
                        <p>Q: What happens if I forget to log my time for a particular day?</p>
                        <br>
                        <p>A: You will be considered absent but if you actually forgot to log, you can directly go to admin office to correct this.</p>
                        <br>
                        <p>Q: Are there reporting tools to analyze time usage and productivity?</p>
                        <br>
                        <p>A: Yes, your dashboard will tell you about how often you get in your classes early and late.</p>
                        <br>
                        <p>Q: How secure is my schedule and time log data in the web system?</p>
                        <br>
                        <p>A: Your data is securely stored and protected. The web system employs encryption and other security measures to safeguard your schedule and time log information.</p>
                        <br>
                        <p>Q: How do i scan qr code?</p>
                        <br>
                        <p>A: Click the qr-code icon and pick a scanning method either upload image or scan through camera</p>
                        <br>
                        <p>Q: How do i know if i have logged in or logged out?</p>
                        <br>
                        <p>If the initial status is vacant then after you scanned it became occupied, it means that you have successfully logged in and vice versa</p>
                    </div>
                </div>
            </main>
                        
<?php require '../navigation/main-footer.php';?>
</body>
</html>

