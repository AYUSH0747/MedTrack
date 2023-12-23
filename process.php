<?php
//Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medtrack";

$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Data Processing
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["fn"];
    $last_name = $_POST["ln"];
    $username = $_POST["username"];
    $password = $_POST["ps"];
    $confirm_password =  $_POST["cps"];
    $DOB = $_POST["DOB"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["pn"];
    $address = $_POST["address"];

    //Inserting Data into the database;
    $sql = "INSERT INTO users (First_Name, Last_Name, Username, Password, DOB, Gender, Email, Mobile_No, Address) VALUES ('$first_name', '$last_name', '$username', '$password', '$DOB', '$gender', '$email', '$phone', '$address')";
    if ($conn->query($sql) === TRUE) {
        header("Location: https://localhost/Medtrack/login.php");

        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>