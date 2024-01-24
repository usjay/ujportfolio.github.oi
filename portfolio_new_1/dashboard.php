<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Display user-specific content here
echo "Welcome to your dashboard, User!";
?>
