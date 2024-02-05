<?php
require_once "config.php";
require_once "session.php";

function decryptString(string $s, string $cipher_algo = "aes-256-cbc"): string
{
    global $userEncrypt;

    if (!str_contains($s, ':')) {
        throw new Exception('The provided string does not match the expected format');
    }

    [$iv, $encrypted] = explode(':', $s);

    if (!$decrypted = openssl_decrypt(hex2bin($encrypted), $cipher_algo, hex2bin($userEncrypt), iv: hex2bin($iv))) {
        throw new Exception('Could not decrypt');
    }

    return $decrypted;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailInput = $_POST['email'];
    $passwordInput = $_POST['password'];

    if ($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
        $query->bind_param('s', $emailInput);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row && isset($row['Email'])) {
                $encryptedPasswordHash = $row['Password'];
                $decryptedPasswordHash = decryptString($encryptedPasswordHash);

                if (password_verify($passwordInput, $decryptedPasswordHash)) {
                    $_SESSION["userid"] = $row['Patient_Number'];
                    $_SESSION["user"] = $row;

                    header("location: welcome.php");
                    exit;
                } else {
                    $error .= '<p class="error"> The password is not valid.</p>';
                    echo '<script>alert("Incorrect username or password.");</script>';
                    echo '<script>window.location.href = "login.php";</script>';
                    exit;
                }
            } else {
                $error .= '<p class="error">Failed to fetch user data or email is not set.</p>';
                echo '<script>alert("Failed to fetch user data or email is not set.");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                exit;
            }
        } else {
            $error .= '<p class="error">No User exists with that email address.</p>';
            echo '<script>alert("Incorrect username or password.");</script>';
            echo '<script>window.location.href = "login.php";</script>';
            exit;
        }
    }
    $query->close();
}
mysqli_close($db);
?>