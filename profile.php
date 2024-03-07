<?php
require_once "config.php";
require_once "session.php";

if (!isset($_SESSION["userid"]) || empty($_SESSION["userid"])) {
    header("location: login.php");
    exit;
}

$Patient_Number = $_SESSION["userid"];
$user = $_SESSION["user"];

function decryptString(string $s, string $cipher_algo = "aes-256-cbc"): string
{
    global $userEncrypt;

    if (!str_contains($s, ':')) {
        throw new Exception('The provided string does not match the expected format');
    }

    [$iv, $encrypted] = explode(':', $s);

    if (!$decrypted = openssl_decrypt(hex2bin($encrypted), $cipher_algo, hex2bin($userEncrypt), iv: hex2bin($iv))) {
        throw new Exception('Could not decrypt');
    }

    return $decrypted;
}

try {
    $query = $db->prepare("SELECT * FROM users WHERE Patient_Number = ?");
    $query->bind_param("i", $Patient_Number);
    $query->execute();
    $result = $query->get_result();

    if (!$result) {
        echo "Error: " . $query->error;
        exit;
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<title>User Profile</title>";
        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>";
        echo "<link rel='stylesheet' href='style.css'>";
        echo "<style>";
        echo "body {";
        echo "display: flex;";
        echo "align-items: center;";
        echo "justify-content: center;";
        echo "height: 100vh;";
        echo "margin: 0;";
        echo "padding-top: 20px;";
        echo "background-image: url('https://img.freepik.com/free-vector/white-background-with-blue-tech-hexagon_1017-19366.jpg?w=900&t=st=1709404718~exp=1709405318~hmac=c2bc7121338492b34064448c232c4c465e17ba95d99800fde257d798890ee162');"; /* Replace 'path_to_your_image.jpg' with the actual path to your image */
        echo "background-size: cover;";
        echo "background-repeat: no-repeat;";
        echo "background-color: linear-gradient(to bottom, #ffffff, #f2f5f7);";
        // echo "background-image: url('https://img.freepik.com/free-vector/white-background-with-blue-tech-hexagon_1017-19366.jpg?w=900&t=st=1709404718~exp=1709405318~hmac=c2bc7121338492b34064448c232c4c465e17ba95d99800fde257d798890ee162');"
        echo "}";
        echo "table {";
        echo "border-collapse: collapse;";
        echo "border-radius: 10px;";
        echo "overflow: hidden;";
        echo "width: 90%;";
        echo "margin-top: 20px;";
        echo "box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);";
        echo "}";
        echo "th, td {";
        echo "border: 1px solid transparent;";
        echo "text-align: center;";
        echo "padding: 8px;";
        echo "box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);";
        echo "}";
        echo "th {";
        echo "background-color: #f2f2f2;";
        echo "}";
        echo "td {";
        echo "background-color: #cea0e8;";
        echo "}";
        echo "a {";
        echo "text-decoration: none;";
        echo "color: #0066cc;";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>';
        echo "<div>";
        echo '<nav class="navbar bg-body-tertiary fixed-top" data-bs-theme="dark">';
        echo '<div class="container-fluid">';
            echo '<a class="navbar-brand" href="welcome.php">MedTrack</a>';
            echo '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" aria-label="Toggle navigation">';
                echo '<span class="navbar-toggler-icon"></span>';
            echo '</button>';
            echo '<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">';
                echo '<div class="offcanvas-header">';
                    echo '<h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="offcanvas-body">';
                    echo '<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">';
                        echo '<li class="nav-item">';
                            echo '<a class="nav-link active" aria-current="page" href="history.php">History</a>';
                        echo '</li>';
                        echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link active dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Reports </a>';
                            echo '<ul class="dropdown-menu">';
                                echo '<li><a class="dropdown-item" href="createReport.php">Add Report</a></li>';
                                echo '<li><a class="dropdown-item" href="modifyReport.php">Edit Report</a></li>';
                                echo '<li>';
                                echo '</li>';
                                echo '<li><a class="dropdown-item" href="deleteReport.php">Delete Report</a></li>';
                            echo '</ul>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                            echo '<a class="nav-link active" href="profile.php">Profile</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                            echo '<a href="logout.php" class="btn btn-danger active" role="button" aria-pressed="true">Log
                                Out</a>';
                        echo '</li>';
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        echo "</div>";
    echo "</nav>";
        echo "</div>";
        echo "<div class='container'>";
        echo "<h2 align='center'><strong>User Profile</strong></h2>";
        echo "<table class='table table-bordered'>";
        foreach ($row as $key => $value) {
            if ($key === 'Password') {
                continue;
            }
            echo "<tr>";
            echo "<td><strong>$key</strong></td>";
            if ($key === 'DOB' || $key === 'Patient_Number' || $key === 'Email') {
                echo "<td>$value</td>";
            } else {
                echo "<td>";
                try {
                    $decryptedValue = decryptString($value);
                    echo $decryptedValue;
                } catch (Exception $e) {
                    echo "Error decrypting value: " . $e->getMessage();
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "User not found.";
    }

    $query->close();
    mysqli_close($db);
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage();
}
?>
