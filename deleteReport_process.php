<?php
require_once "config.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Case_Number"])) {
    $caseNumber = $_GET["Case_Number"];

    // Prepare a DELETE statement
    $query = $db->prepare("DELETE FROM medical_records WHERE Case_Number = ?");
    $query->bind_param("i", $caseNumber);

    // Execute the statement
    if ($query->execute()) {
        // Report successfully deleted, redirect to a success page or back to the deleteReport.php page
        header("location: deleteReport.php");
        exit;
    } else {
        // Error occurred during deletion, handle it accordingly
        echo "Error deleting report: " . $query->error;
    }

    $query->close();
    mysqli_close($db);
} else {
    // Invalid request method or missing case number
    echo "Invalid request.";
}
?>
