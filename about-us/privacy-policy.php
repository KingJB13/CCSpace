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
        .privacy {
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
        .privacy h2 {
            color: white;
            text-align: center;
        }
        
        .privacy p{
           text-align: justify;
           color: white;
        }

        @media(max-width: 952px){
            .privacy h2{
                font-size: 25px;
            }
            .privacy p{
                font-size: 15px
            }
        }

    </style>
</head>

<body>
<?php require '../navigation/main-nav.php';?>  
        <main>
            <div class="container">
                <div class="privacy">
                    <h2>Privacy Policy</h2>
                    <br>
                    <p>Welcome to CCSpace! At CCSpace, we are committed to safeguarding your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and protect your data when you use our website and services. By accessing and using CSSpace, you agree to the terms outlined in this Privacy Policy</p>
                    <br>
                    <p>We collect the following types of information:</p>
                    <br>
                    <p>When you create an account, we ask your name, email address, and other relevant details. Information related to room reservations, including selected dates and times. When you scan a QR code to activate and occupy a room, we collect data related to the scan.</p>
                    <br>
                    <p>We use the collected information for the following purposes:</p>
                    <br>
                    <p>To enable users to view room schedules, check availability, and make reservations. To facilitate the activation of rooms through QR code scans. To send relevant updates, notifications, and information about reservations.</p>
                    <br>
                    <p>However, we may share information in the following instances:</p>
                    <br>
                    <p>When you explicitly grant us permission to share your information. If required by law, we may disclose information to comply with legal obligations.</p>
                    <br>
                    <p>You have the right to:</p>
                    <br>
                    <p>Request access to the personal information we hold about you. Update or correct inaccuracies in your personal information. Request the deletion of your account and associated data.</p>
                    <br>
                    <p>We may update this Privacy Policy periodically. We will notify you of any significant changes, and the latest version will be accessible on our website.</p>
                    <br>
                    <p>If you have any questions or concerns regarding this Privacy Policy, please contact us at CCSpace@email.com.</p>
                    <br>
                    <p>Thank you for trusting CSSpace with your information.</p>
                    </div>
                </div>
        </main>            
<?php require '../navigation/main-footer.php';?>
</body>
</html>

