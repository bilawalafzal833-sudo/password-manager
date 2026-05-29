<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'classes/Database.php';
require 'classes/PasswordGenerator.php';
require 'classes/PasswordRecord.php';

$db = new Database();
$conn = $db->connect();

$generator = new PasswordGenerator();
$passwordRecord = new PasswordRecord($conn);

$generatedPassword = '';

if (isset($_POST['generate'])) {

    $generatedPassword = $generator->generate(
        (int)$_POST['uppercase'],
        (int)$_POST['lowercase'],
        (int)$_POST['numbers'],
        (int)$_POST['special']
    );
}

if (isset($_POST['save'])) {

    $passwordRecord->savePassword(
        $_SESSION['user_id'],
        $_POST['website'],
        $_POST['websiteUser'],
        $_POST['password'],
        $_SESSION['real_key']
    );

    echo "<p>Password Saved!</p>";
}

$passwords = $passwordRecord->getPasswords(
    $_SESSION['user_id']
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Password Manager Dashboard</h1>

<hr>

<h2>Password Generator</h2>

<form method="POST">

    Uppercase:
    <input type="number" name="uppercase" required>

    <br><br>

    Lowercase:
    <input type="number" name="lowercase" required>

    <br><br>

    Numbers:
    <input type="number" name="numbers" required>

    <br><br>

    Special Characters:
    <input type="number" name="special" required>

    <br><br>

    <button type="submit" name="generate">
        Generate Password
    </button>

</form>

<?php if ($generatedPassword): ?>

    <h3>Generated Password</h3>

    <input
        type="text"
        value="<?php echo $generatedPassword; ?>"
        readonly>

<?php endif; ?>

<hr>

<h2>Save Password</h2>

<form method="POST">

    Website Name:

    <input
        type="text"
        name="website"
        required>

    <br><br>

    Username / Email:

    <input
        type="text"
        name="websiteUser"
        required>

    <br><br>

    Password:

    <input
        type="text"
        name="password"
        value="<?php echo $generatedPassword; ?>"
        required>

    <br><br>

    <button type="submit" name="save">
        Save Password
    </button>

</form>

<hr>

<h2>Saved Password Records</h2>

<table border="1">

<tr>
    <th>Website</th>
    <th>Username</th>
    <th>Date Created</th>
</tr>

<?php foreach ($passwords as $row): ?>

<tr>

    <td>
        <?php echo $row['website_name']; ?>
    </td>

    <td>
        <?php echo $row['website_username']; ?>
    </td>

    <td>
        <?php echo $row['created_at']; ?>
    </td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="logout.php">Logout</a>

</body>
</html>