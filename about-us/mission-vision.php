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
            padding: 10%;
            height: 100vh;
        }
        .mission-vision {
            display: flex;
            position: relative;
            flex-direction: column; /* Center horizontally */
            justify-content: center; /* Center vertically */
            height: auto;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            background: rgba(31, 65, 114, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .mission-vision h2 {
            margin-top: 20px;
            color: white;
            text-align: center;
        }
        
        .mission-vision p{
           text-align: justify;
           color: white;
        }

        @media(max-width: 952px){
            .container{
                padding: 20px;
            }
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
                    <div class="mission-vision">
                        <h2>Mission</h2>
                        <br>
                        <p> To make the process of making individual room school schedules as easy and efficient as possible, so that everyone involved can benefit from a seamless educational experience and maximum resource utilization. Our goal is to provide educational institutions with an easy-to-use scheduling tool that reduces conflict and increases efficiency.</p>
                        <br>
                        <h2>Vision</h2>
                        <br>
                        <p> To establish ourselves as the go-to resource for educational institutions in our community by providing a creative, adaptable room scheduling solution that meets the particular requirements of every school. Our goal is to support our schools in efficiently allocating their resources and offering a first-rate educational setting, which will enhance student performance and foster a sense of community among educators.</p>
                        
                    </div>
                </div>
            </main>
<?php require '../navigation/main-footer.php';?>
</body>
</html>

