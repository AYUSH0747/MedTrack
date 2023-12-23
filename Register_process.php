<?php
    require_once "config.php";
    require_once "session.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = trim($_POST["fn"]);
        $last_name = trim($_POST["ln"]);
        $username = $_POST["username"];
        $password = $_POST["ps"];
        $confirm_password =  $_POST["cps"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $DOB = $_POST["DOB"];
        $gender = trim($_POST["gender"]);
        $email = trim($_POST["email"]);
        $phone = $_POST["pn"];
        $address = $_POST["address"];

        if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
                $error = '';
            $query->bind_param('s', $email);
            $query->execute();

            $query->store_result();
                if($query->num_rows > 0) {
                    $error .= '<p class="error">The email address is already registered!</p>';
                } else {
                    if (empty($error)) {
                        $insertQuery = $db->prepare("INSERT INTO users (First_Name, Last_Name, Username, Password, DOB, Gender, Email, Mobile_No, Address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
                        $insertQuery -> bind_param("sssssssss", $first_name, $last_name, $username, $password_hash, $DOB, $gender, $email, $phone, $address);
                        $result = $insertQuery->execute();
                        if($result){
                            $error .= '<p class="success">Your registration was successful!</p>';
                            header("Location: https://localhost/Medtrack/login.php");

                            exit;
                        }
                        else{
                            $error .= '<p class="error">Something went wrong!</p>';
                        }
                    }
                    $insertQuery -> close();
                }
        }
        $query->close();


        mysqli_close($db);
    }
    
?>
