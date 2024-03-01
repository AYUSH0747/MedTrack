<?php
require_once "config.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Case_Number"])) {
    $caseNumber = $_GET["Case_Number"];

    $query = $db->prepare("DELETE FROM medical_records WHERE Case_Number = ?");
    $query->bind_param("i", $caseNumber);


    if ($query->execute()) {
        header("location: deleteReport.php");
        exit;
    } else {
        echo "Error deleting report: " . $query->error;
        header("location: deleteReport.php");
        exit;
    }

    $query->close();
    mysqli_close($db);
} else {
    // Invalid request method or missing case number
    echo "Invalid request.";
    header("location: deleteReport.php");
    exit;
}
?>
