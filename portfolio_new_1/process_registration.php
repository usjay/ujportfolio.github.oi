<?php
session_start();
require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['reg_username'];
    $password = password_hash($_POST['reg_password'], PASSWORD_BCRYPT);
    $email = $_POST['reg_email'];

    
    $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $email]);

    echo "Registration successful!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Success</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #ADFF2F;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 1.5em;
        }

        p {
            margin-top: 10px;
        }

        a {
            color: #000000;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
		div {
  border: 1px solid black;
  margin-top: 100px;
  margin-bottom: 100px;
  margin-right: 150px;
  margin-left: 80px;
  background-color: #00FA9A;
}

.login-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 15px;
}

    </style>
</head>
<body>
   
    <div class="container">
    <img src="wild life.jpg" alt="logo" width="300" height="300">
    <h1>Registration Successful</h1>
    <p>You have successfully registered for our website.</p>
    <p>Here are some of the benefits of being a registered user:</p>
    <ul>
        <li>Access to exclusive content</li>
        <li>Discounts on products and services</li>
        <li>Early access to new features</li>
    </ul>
    <a href="login.php" class="login-button">Click here to login</a>
    <p>Thank you for registering!</p>
</div>

	</div>
</body>
</html>
