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

                        $_SESSION["userid"] = $row['Patient_Number'];
                        $_SESSION["user"] = $row;

                        // var_dump($_SESSION);

                        // echo "Session variables set successfully. ";  For Debugging Purpose
    
                        header("location: welcome.php");
                        exit;
                    } else {
                        $error .= '<p class="error"> The password is not valid.</p>';
                        echo '<script>alert("Incorrect username or password.");</script>';
                        echo '<script>window.location.href = "login.php";</script>';
                        exit;
                    }
                } else {
                    $error .= '<p class="error">Failed to fetch user data.</p>';
                    echo '<script>alert("Failed to fetch user data.");</script>';
                    echo '<script>window.location.href = "login.php";</script>';
                    exit; 
                }
                
            } else {
                $error .= '<p class="error">No User exist with that email address.</p>';
                echo '<script>alert("Incorrect username or password.");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit;
            }
        }
        $query->close();
    }
    mysqli_close($db);
}
?>