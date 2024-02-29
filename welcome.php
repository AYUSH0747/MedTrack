<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["userid"]) || empty($_SESSION["userid"])) {
    header("location: login.php");
    exit;
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MedTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .grid-item {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
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

    <div class="container mt-5">
        <h2 class="mb-4">Disease Categories</h2>

        <div class="grid-container">
            <div class="grid-item">
                <a href="disease_category.php?category=cardio"><img src="cardio_image.jpg" alt="Cardiology"></a>
                <h3>Cardiology</h3>
            </div>
            <div class="grid-item">
                <a href="disease_category.php?category=ent"><img src="ent_image.jpg" alt="ENT"></a>
                <h3>ENT</h3>
            </div>
            <div class="grid-item">
                <a href="disease_category.php?category=pediatrics"><img src="pediatrics_image.jpg" alt="Pediatrics"></a>
                <h3>Pediatrics</h3>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
