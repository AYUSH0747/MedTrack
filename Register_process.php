<?php
    require_once "config.php";
    require_once "session.php";

    function encryptString(string $s, string $cipher_algo = "aes-256-cbc"): string
    {
        global $userEncrypt;

        if (!$ivLength = openssl_cipher_iv_length($cipher_algo)) {
            throw new Exception('Could not determine IV length');
        }

        if (!$iv = openssl_random_pseudo_bytes($ivLength)) {
            throw new Exception('Could not generate IV');
        }

        if (!$encrypted = openssl_encrypt($s, $cipher_algo, hex2bin($userEncrypt), iv: $iv)) {
            throw new Exception('Could not encrypt');
        }

        return sprintf(
            "%s:%s",
            bin2hex($iv),
            bin2hex($encrypted),
        );
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = encryptString(trim($_POST["fn"]));
        $last_name = encryptString(trim($_POST["ln"]));
        $username = encryptString($_POST["username"]);
        $password = $_POST["ps"];
        $confirm_password =  encryptString($_POST["cps"]);
        $password_hash = encryptString(password_hash($password, PASSWORD_DEFAULT));
        $DOB = $_POST["DOB"];
        $gender = encryptString(trim($_POST["gender"]));
        $email = trim($_POST["email"]);
        $phone = encryptString($_POST["pn"]);
        $address = encryptString($_POST["address"]);

        if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
                $error = '';
            $query->bind_param('s', $email);
            $query->execute();

            $query->store_result();
                if($query->num_rows > 0) {
                    $error .= '<p class="error">The email address is already registered!</p>';
                    echo '<script>alert("The email address is already registered!");</script>';
                    echo '<script>window.location.href = "login.php";</script>';
                    exit;
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
                            echo '<script>alert("Something went wrong! Please try again later");</script>';
                            echo '<script>window.location.href = "Register.php";</script>';
                            exit;
                        }
                    }
                    $insertQuery -> close();
                }
        }
        $query->close();


        mysqli_close($db);
    }
    
?>
