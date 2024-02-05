<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once "config.php";
require_once "session.php";

function encryptString(string $s, string $cipher_algo = "aes-256-cbc"): string
{
    global $encryptionKey;

    if (!$ivLength = openssl_cipher_iv_length($cipher_algo)) {
        throw new Exception('Could not determine IV length');
    }

    if (!$iv = openssl_random_pseudo_bytes($ivLength)) {
        throw new Exception('Could not generate IV');
    }

    if (!$encrypted = openssl_encrypt($s, $cipher_algo, hex2bin($encryptionKey), iv: $iv)) {
        throw new Exception('Could not encrypt');
    }

    return sprintf(
        "%s:%s",
        bin2hex($iv),
        bin2hex($encrypted),
    );
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION["userid"])) {
            $Patient_Number = $_SESSION["userid"];
            $Date = $_POST["date"];
            $error = "";

            // Encrypt sensitive data
            $Systolic_BP = encryptString($_POST["sys"]);
            $Diastolic_BP = encryptString($_POST["dia"]);
            $Respiratory_Rate = encryptString($_POST["rr"]);
            $Capillary_Refill = encryptString($_POST["cr"]);
            $Body_Temp = encryptString($_POST["temp"]);
            $Weight = encryptString($_POST["weight"]);
            $Pulse_Rate = encryptString($_POST["pulse"]);
            $Doctor_Name = encryptString($_POST["dn"]);
            $Symptoms = encryptString($_POST["symptoms"]);
            $Diagnosis = encryptString($_POST["diagnosis"]);
            $Medication = encryptString($_POST["medication"]);

            $insertQuery = $db->prepare("INSERT INTO medical_records (Date, Symptoms, Systolic_BP, Diastolic_BP, Respiratory_Rate, Capillary_Refill, Body_Temp, Weight, Pulse_Rate, Diagnosis, Medication, Doctor_Name, Patient_Number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ");

            if ($insertQuery === false) {
                throw new Exception('Error preparing query: ' . $db->error);
            }

            $insertQuery->bind_param("ssssssssssssi", $Date, $Symptoms, $Systolic_BP, $Diastolic_BP, $Respiratory_Rate, $Capillary_Refill, $Body_Temp, $Weight, $Pulse_Rate, $Diagnosis, $Medication, $Doctor_Name, $Patient_Number);

            $result = $insertQuery->execute();

            if ($result) {
                echo "Query executed successfully.";
                $error .= '<p class="success">Your registration was successful!</p>';
                header("Location: welcome.php");
                exit;
            } else {
                $error .= '<p class="error">Something went wrong! ' . $insertQuery->error . '</p>';
            }

            $insertQuery->close();
            mysqli_close($db);
        } else {
            echo "Patient_Number is not set in the session";
        }
    }
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage();
}
?>
