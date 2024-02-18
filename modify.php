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
    global $encryptionKey;

    if (!str_contains($s, ':')) {
        throw new Exception('The provided string does not match the expected format');
    }

    [$iv, $encrypted] = explode(':', $s);

    if (!$decrypted = openssl_decrypt(hex2bin($encrypted), $cipher_algo, hex2bin($encryptionKey), iv: hex2bin($iv))) {
        throw new Exception('Could not decrypt');
    }

    return $decrypted;
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Case_Number"])) {
        $caseNumber = $_GET["Case_Number"];

        $query = $db->prepare("SELECT * FROM medical_records WHERE Patient_Number = ? AND Case_Number = ?");
        $query->bind_param("ii", $Patient_Number, $caseNumber);
        $query->execute();

        $result = $query->get_result();

        if (!$result) {
            echo "Error: " . $query->error;
            exit;
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);

            // Decrypt the encrypted values
            $decryptedRow = [];
            foreach ($row as $key => $value) {
                if ($key === 'Patient_Number' || $key === 'Case_Number' || $key === 'Date') {
                    $decryptedRow[$key] = $value;
                    continue;
                }

                // Check if the value is empty before decryption
                if (!empty($value)) {
                    try {
                        // Decrypt the value
                        $decryptedValue = decryptString($value);
                        $decryptedRow[$key] = $decryptedValue;
                    } catch (Exception $e) {
                        // Handle decryption errors
                        echo "Error decrypting value for key: $key. " . $e->getMessage() . "\n";
                    }
                } else {
                    // If empty, use the original empty value
                    $decryptedRow[$key] = $value;
                }
            }

            // // Display decrypted values and input fields for editing
            // echo "<form action='updateReport.php' method='POST'>";
            // foreach ($decryptedRow as $key => $value) {
            //     echo "<div>";
            //     echo "<label for='$key'>$key:</label>";
            //     echo "<input type='text' id='$key' name='$key' value='$value'>";
            //     echo "</div>";
            // }
            // echo "<input type='hidden' name='Case_Number' value='$caseNumber'>";
            // echo "<input type='submit' value='Update'>";
            // echo "</form>";
        } else {
            echo "Report not found.";
        }

        $query->close();
        mysqli_close($db);
    } else {
        echo "Invalid request.";
    }
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding-top: 200px;
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

        td {
            background-color: #cea0e8;
        }

        a {
            text-decoration: none;
            color: #0066cc;
        }

        .btn-save {
        display: block;
        margin: 20px auto; /* Adjust margin as needed */
        text-align: center;
        }
    </style>
</head>
<body>
<div>
    <nav class="navbar bg-body-tertiary fixed-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="welcome.php">MedTrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
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
                            <a class="nav-link active dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link active" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-danger active" role="button" aria-pressed="true">Log
                                Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    
</div>

<form action="modify_process.php" method="POST">
    <table border='1'>
        <?php foreach ($decryptedRow as $key => $value): ?>
            <?php if ($key !== 'Patient_Number'): ?>
                <tr>
                    <td><strong><?= $key ?></strong></td>
                    <?php if ($key === 'Case_Number'): ?>
                        <td style="background-color: #cea0e8;"><?= $value ?></td>
                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
                    <?php else: ?>
                        <td style="background-color: #cea0e8; padding: 4px;">
                            <input type="text" name="<?= $key ?>" value="<?= $value ?>" style="box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); background: inherit; padding: 4px;">
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    <button type="submit" class="btn btn-primary btn-save" style="margin-top: 10px; margin-left: auto; margin-right: auto; display: block;">Save Changes</button>
</form>









