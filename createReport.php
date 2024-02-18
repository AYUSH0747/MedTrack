<?php
session_start();

// var_dump($_SESSION);
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"])) {
    header("location: login.php");
    exit;
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Report</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <div>
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
                            <li><a class="dropdown-item" href="deleterReport.php">Delete Report</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-danger active" role="button"  aria-pressed="true">Log Out</a>
                        </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="wrapper">
            <div class="title">
            Add Report
            </div>
            <form action="createReport_process.php" method="POST" class="form" name="form1" id="registrationForm" onsubmit="">
            <div class="inputfield" style="margin-bottom: 1px;">
                <label for="DoctorName">Doctor's Name (*)</label>
                <input type="text" name="dn" id="doctor_name" class="input" placeholder="Doctor's Name">
            </div><br> 
                <div class="inputfield">
                <label for="Systole">Blood Pressure(Systole)</label>
                <input type="int" class="input" name="sys" id="sys" placeholder="Systole (in mmHg)">
            </div>
            <div class="inputfield">
                <label for="Diastole">Blood Pressure(Diastole)</label>
                <input type="int" class="input" name="dia" id="dia" placeholder="Diastole (in mmHg)">
            </div>
            <div class="inputfield">
                <label for="RespiratoryRate">Respiratory Rate</label>
                <input type="int" class="input" name="rr" id="rr" placeholder="Respiratory Rate (in BPM)">
            </div>
            <div class="inputfield">
                <label for="CapillaryRefill">Capillary Refill</label>
                <input type="float" class="input" name="cr" id="cr" placeholder="Capillary Refill (in sec)">
            </div>
            <div class="inputfield">
                <label for="BodyTemprature">Body Temprature</label>
                <input type="float" class="input" name="temp" id="temp" placeholder="Body Temprature (in Fahrenheit)">
            </div>
            <div class="inputfield">
                <label for="Weight">Weight</label>
                <input type="float" class="input" name="weight" id="weight" placeholder="Weight (int KG)">
            </div>
            <div class="inputfield">
                <label for="PulseRate">Pulse Rate</label>
                <input type="int" class="input" name="pulse" id="pulse" placeholder="Pulse Rate (in BPM)">
            </div>
            <div class="inputfield">
                <label>Date</label>
                <input type="date" class="input" name="date" id="date">
            </div>
            <div class="inputfield">
                <label for="Symptoms">Symptoms</label>
                <textarea class="textarea" name="symptoms" id="symptoms" placeholder="Symptoms"></textarea>
            </div>
            <div class="inputfield">
                <label for="Diagnosis">Diagnosis</label>
                <textarea class="textarea" name="diagnosis" id="diagnosis" placeholder="Diagnosis"></textarea>
            </div>  
            <div class="inputfield">
                <label for="Medication">Medication</label>
                <textarea class="textarea" name="medication" id="medication" placeholder="Medication"></textarea>
            </div> 
            <div class="inputfield">
                <input type="submit" value="Add Report" class="btn">
            </div>
            </form>
        </div>
    </body>
</html>