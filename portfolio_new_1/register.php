<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'db.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert user into the database
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    echo "Registration successful!";
}
?>

<form method="POST" action="register.php">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Register">
</form>
