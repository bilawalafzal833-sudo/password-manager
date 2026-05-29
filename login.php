<?php

session_start();

require 'classes/Database.php';
require 'classes/User.php';
require 'classes/Encryption.php';

$db = new Database();

$conn = $db->connect();

$userObj = new User($conn);

if($_SERVER['REQUEST_METHOD']
== 'POST'){

    $username =
    $_POST['username'];

    $password =
    $_POST['password'];

    $user =
    $userObj->login(
        $username,
        $password
    );

    if($user){

        $encryption =
        new Encryption();

        $realKey =
        $encryption->decrypt(
            $user['encrypted_key'],
            $password
        );

        $_SESSION['user_id']
        = $user['id'];

        $_SESSION['real_key']
        = $realKey;

        header(
            "Location: dashboard.php"
        );

    } else {

        echo "Invalid Credentials";
    }
}
?>

<form method="POST">

<h2>Login</h2>

<input
type="text"
name="username"
required>

<br><br>

<input
type="password"
name="password"
required>

<br><br>

<button type="submit">
Login
</button>

</form>