<?php
$errors = [];
$success = false;
$name = '';
$email = '';
$sanitizedMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate and sanitize data (same as before)

    // If no errors, insert data into the database
    if (empty($errors)) {
        $host = 'localhost';
        $dbUsername = 'root';
        $dbPassword = ''; // No password for localhost, adjust if needed
        $dbName = 'test';

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
			if (empty($name)) {
    $errors[] = "Name is required.";
}
if (empty($email)) {
    $errors[] = "Email is required.";
}
if (empty($message)) {
    $errors[] = "Message is required.";
}

        
        $stmt = $conn->prepare("INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();

        $conn->close();

        $success = true;
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Form Submission Result</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <?php if ($success): ?>
            <h2>Form Submitted Successfully</h2>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Message:</strong> <?php echo $sanitizedMessage; ?></p>
        <?php else: ?>
            <h2>Form Submission Error</h2>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="javascript:history.go(-1)">Go Back</a>
        <?php endif; ?>
    </div>
</body>
</html>
