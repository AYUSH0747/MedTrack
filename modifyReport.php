<?php
require_once "config.php";
require_once "session.php";

// var_dump($_SESSION);
if(!isset($_SESSION["userid"]) || empty($_SESSION["userid"])) {
    header("location: login.php");
    exit;
}


$Patient_Number = $_SESSION["userid"];
$user = [];
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

// Fetch medical records for the logged-in user
$query = $db->prepare("SELECT Case_Number, Date FROM medical_records WHERE Patient_Number = ? ORDER BY Date DESC");
$query->bind_param("i", $Patient_Number);
$query->execute();
$result = $query->get_result();

// Check if there are records
if ($result->num_rows > 0) {
    // Display a summary table
    echo "<table border='1'>";
    echo "<tr><th>Serial Number</th><th>Case Number</th><th>Date</th><th>Action</th></tr>";

    $serialNumber = 1; // Initialize serial number

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>"; // Display serial number
        echo "<td>" . $row['Case_Number'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "<td><form action='modify.php' method='GET'><input type='hidden' name='Case_Number' value='" . $row['Case_Number'] . "'><button action='modify.php' type='submit' class='btn btn-secondary'>Modify</button></form></td>";

        echo "</tr>";

        $serialNumber++; // Increment serial number for the next row
    }

    echo "</table>";
} else {
    echo "No medical records found.";
}

$query->close();
mysqli_close($db);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Modify Reports</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
                padding-top: 300px;
            }
            table {
                border-collapse: collapse;
                border-radius: 10px;
                overflow: hidden;
                width: 90%;
                margin-top: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            th, td {
                border: 1px solid transparent;
                text-align: center;
                padding: 8px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }

            th {
                background-color: #f2f2f2;
            }

            td{
                background-color: #cea0e8;
            }

            a {
                text-decoration: none;
                color: #0066cc;
            }
        </style>
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
        </div>
        
    </body>
</html>