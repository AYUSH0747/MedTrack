<?php
require_once "config.php";
require_once "session.php";

// Function to encrypt sensitive data
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["userid"])) {
    try {
        $Patient_Number = $_SESSION["userid"];
        
        // Encrypt sensitive data
        $Systolic_BP = encryptString($_POST["Systolic_BP"]);
        $Diastolic_BP = encryptString($_POST["Diastolic_BP"]);
        $Respiratory_Rate = encryptString($_POST["Respiratory_Rate"]);
        $Capillary_Refill = encryptString($_POST["Capillary_Refill"]);
        $Body_Temp = encryptString($_POST["Body_Temp"]);
        $Weight = encryptString($_POST["Weight"]);
        $Pulse_Rate = encryptString($_POST["Pulse_Rate"]);
        $Doctor_Name = encryptString($_POST["Doctor_Name"]);
        $Symptoms = encryptString($_POST["Symptoms"]);
        $Diagnosis = encryptString($_POST["Diagnosis"]);
        $Medication = encryptString($_POST["Medication"]);

        // Update medical report
        $updateQuery = $db->prepare("UPDATE medical_records SET Date=?, Symptoms=?, Systolic_BP=?, Diastolic_BP=?, Respiratory_Rate=?, Capillary_Refill=?, Body_Temp=?, Weight=?, Pulse_Rate=?, Diagnosis=?, Medication=?, Doctor_Name=? WHERE Case_Number=? AND Patient_Number=?");
        
        $updateQuery->bind_param(
            "ssssssssssssii",
            $_POST["Date"],
            $Symptoms,
            $Systolic_BP,
            $Diastolic_BP,
            $Respiratory_Rate,
            $Capillary_Refill,
            $Body_Temp,
            $Weight,
            $Pulse_Rate,
            $Diagnosis,
            $Medication,
            $Doctor_Name,
            $_POST["Case_Number"],
            $Patient_Number
        );
        
        $result = $updateQuery->execute();
        
        if ($result) {
            echo "Report updated successfully.";
            header("Location: welcome.php");
            exit;
        } else {
            echo "Error updating report: " . $updateQuery->error;
        }
        
        $updateQuery->close();
        mysqli_close($db);
    } catch (Exception $e) {
        echo "Caught exception: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
