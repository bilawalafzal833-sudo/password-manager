<?php

require 'classes/Database.php';
require 'classes/User.php';

$db = new Database();

$conn = $db->connect();

$user = new User($conn);

if($_SERVER['REQUEST_METHOD']
== 'POST'){

    $username =
    $_POST['username'];

    $password =
    $_POST['password'];

    if(
        $user->register(
            $username,
            $password
        )
    ){

        echo "Registration Successful";

    } else {

        echo "Error";
    }
}
?>

<form method="POST">

<h2>Register</h2>

<input
type="text"
name="username"
placeholder="Username"
required>

<br><br>

<input
type="password"
name="password"
placeholder="Password"
required>

<br><br>

<button type="submit">
Register
</button>

</form>