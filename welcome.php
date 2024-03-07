<?php
session_start();

// var_dump($_SESSION);

if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"])) {
    header("location: login.php");
    exit;
    echo "Condition is met";
}

$user = $_SESSION["user"];

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>MedTrack</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
            padding: 5px;
            transition: transform 0.3s ease;
        }

        .grid-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .container {
            margin: 0 auto;
        }
        .col-md-3 {
            width: 30%;
            margin: 1%;
        }

        @media (max-width: 992px) {
            .col-md-3 {
                width: 45%;
            }
        }

        @media (max-width: 768px) {
            .col-md-3 {
                width: 100%;
            }
        }
        body {
            background: linear-gradient(to bottom, #ffffff, #f2f5f7); /* Light gradient background */
        }
        
        /* .card {
            width: 400px;
            height: 300px;
            background-color: #f0f0f0;
            border-radius: 20px;
            margin: 20px;
            display: inline-block;
            transition: transform 0.3s ease;
            cursor: pointer;
            
        } */
 
        .card img {
            width: 100%;
            height: 100%;
            transition: opacity 0.5s ease; 
        }

        .card .title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black;
            font-size: 24px;
            opacity: 0;
            transition: opacity 0.5s ease;
            text-align: center;
            z-index: 1;
        }
       
        .container{
            padding-top: 4rem;
        }
        
        .card:hover img {
            opacity: 0;
        }

        .card:hover .title {
            opacity: 1;
        }
        .custom-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;          
        }
     
        
        .card {
            position: relative;
            width: 300px;
            height: 350px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            float: left; 
        }
    </style>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <nav class="navbar bg-body-tertiary fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="welcome.php">MedTrack</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="history.php">History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Reports
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="createReport.php">Add Report</a></li>
                        <li><a class="dropdown-item" href="modifyReport.php">Edit Report</a></li>
                        <li>
                        </li>
                        <li><a class="dropdown-item" href="deleteReport.php">Delete Report</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-danger active" role="button"  aria-pressed="true">Log Out</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>

        <div class="container mt-5" >
        <div class="row">
            <div class="col-md-3 grid-container">
                <div class="card" onclick="window.location.href = './Cardiology.html'">
                <h2 class="title"> <strong> Cardiology </strong></h2>
                <img src="img\Cardiology.png" class="" alt="Image 1">
                </div>
            </div>
            <div class="col-md-3 grid-container">
                <div class="card" onclick="window.location.href = './page2.html'">
                <h2 class="title"> <strong> Dermatology </strong></h2>
                <img src="img\Dermatology.png" class="" alt="Image 1">
                </div>
            </div>
            <div class="col-md-3 grid-container">
                <div class="card" onclick="window.location.href = './page1.html'">
                <h2 class="title"> <strong> Orthopedics </strong></h2>
                <img src="img\Orthopedics.png" class="" alt="Image 1">
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" >
        <div class="row">
            <div class="col-md-3 grid-container">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="" alt="Image 1">
                </div>
            </div>
            <div class="col-md-3 grid-container">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="" alt="Image 1">
                </div>
            </div>
            <div class="col-md-3 grid-container">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="" alt="Image 1">
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" >
        <div class="row">
            <div class="col-md-3 grid-container">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="" alt="Image 1">
                </div>
            </div>
            <div class="col-md-3 grid-container">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="" alt="Image 1">
                </div>
            </div>
            <div class="col-md-3 grid-container">
                <div class="card" onclick="redirectToPage('./login.php')">
                <img src="https://www.topdoctors.co.uk/files/Image/large/58b0424e-411c-4243-9228-4a0725bbab96.jpg" class="" alt="Image 1">
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
    <script>
    window.botpressWebChat.init({
        "composerPlaceholder": "Ask MedTrack",
        "botConversationDescription": "Chatbot by MedTrack",
        "botId": "6fe7f7f6-f116-4c28-968c-a030f2dc711c",
        "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
        "messagingUrl": "https://messaging.botpress.cloud",
        "clientId": "6fe7f7f6-f116-4c28-968c-a030f2dc711c",
        "webhookId": "e0f426d4-4e91-49ad-b5af-da01dedd53e4",
        "lazySocket": true,
        "themeName": "prism",
        "botName": "MedTrack",
        "stylesheet": "https://webchat-styler-css.botpress.app/prod/7c35291d-aaeb-41e6-b830-1a0064fd3508/v26521/style.css",
        "frontendVersion": "v1",
        "useSessionStorage": true,
        "enableConversationDeletion": true,
        "theme": "prism",
        "themeColor": "#2563eb"
    });
    </script>

    </body>
</html>