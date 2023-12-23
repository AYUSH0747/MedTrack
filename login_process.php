<?php

require_once "config.php";
require_once "session.php";

$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($error)) {
        if($query = $db->prepare("SELECT * FROM users WHERE email = ? ")) {
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if($row){
                    if(password_verify($password, $row['Password'])) {

                        // ***********
                        // if(isset($row['Patient_Number']) && !empty($row['Patient_Number'])) {
                        //     $_SESSION["userid"] = $row['Patient_Number'];
                        //     $_SESSION["user"] = $row;
                        // }
                        // else{
                        //     echo "Patient_Number row is empty";
                        // }

                        // *************
                        // echo "Successful login condition met.";
                        $_SESSION["userid"] = $row['Patient_Number'];
                        $_SESSION["user"] = $row;

                        // var_dump($_SESSION);

                        // echo "Session variables set successfully. ";  For Debuggin Purpose
    
                        header("location: welcome.php");
                        exit;
                    } else {
                        $error .= '<p class="error"> The password is not valid.</p>';
                        echo "The password is not valid.";
                    }
                } else {
                    $error .= '<p class="error">Failed to fetch user data.</p>';
                }
                
            } else {
                $error .= '<p class="error">No User exist with that email address.</p>';
            }
        }
        $query->close();
    }
    mysqli_close($db);
}
?>