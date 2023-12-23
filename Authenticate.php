<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'medtrack';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if( mysqli_connect_errno()){
    exit('Failed to connect to the server: ' . mysqli_connect_error());
}
if( !isset($_POST['username'], $_POST['password'])){
    exit('Please fill both the username and password fields!');
}

if($stmt = $con->prepare('SELECT Patient_Number, password FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();

    $stmt->store_result();
    if($stmt->nums_rows > 0){
        $stmt->bind_result($Patient_Number, $Password);
        $stmt->fetch();

        if(password_verify($_POST['password'], $Password)){
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['Username'];
            $_SESSION['Patient_Number'] = $Patient_Number;
            echo 'Welcome' . $_SESSION['username'] . '!';
        }
        else {
            echo 'Incorrect Username or Password!';
        }
    }
    else {
        echo 'Incorrect Username or Password';
    }

    $stmt->close();
}
?>