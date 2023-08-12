<?php
session_start();
require_once 'db.php'; 

$login_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    
    $stmt = $db->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location:pp.html"); 
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration Page</title>
  <style>

.cover-photo {
  width: 200px;
  height: 10%;
}

.cover-photo {
 margin: 50px; 
  font-weight: bold;
  padding: 50px;
  
}

  /* Global styles */
  body {
    font-family: sans-serif;
	background-color:#00FA9A;
  }

  h1 {
    font-size: 24px;
    margin-top: 10;
	  text-align: center;

  }

  /* Login form */
  .form-container {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 5px solid #ccc;
  }

  .form-container h2 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .form-container input {
    width: 80%;
    padding: 10px;
    border: 2px solid #ccc;
    margin-bottom: 10px;
  }

  .form-container input[type="submit"] {
     background-color: #800000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
			border-radius: 10px;
  }

  /* Register form */
  .register-form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 5px solid #ccc;
  }

  .register-form h2 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .register-form input {
    width: 80%;
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
  }

  .register-form input[type="submit"] {
     background-color: #800000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
			border-radius: 10px;
  }
  body {
  background-color: #fabd00d6;
  }
  
      @keyframes moveHeading {
      0% { transform: translateX(0); }
      100% { transform: translateX(100%); }
    }

    
    .moving-heading {
      animation: moveHeading 50s linear infinite; 
    }

</style>
</head>
<body>
   
   <marquee>
  <img src="1.jpg" alt="Cover photo"width="400" height="400" >
  <img src="2.jpg" alt="Cover photo"width="400" height="400">
  <img src="3.jpg" alt="Cover photo"width="400" height="400">
  <img src="4.jpg" alt="Cover photo"width="400" height="400">
  </marquee>
 <h1 class="moving-heading">
  <span style="font-family: Georgia; font-size: 40px;">Welcome to our wildlife community</span>
  <p>
"Embrace the untamed beauty of the natural world through our wildlife blog.<br> Journey with us as we uncover the mysteries of diverse ecosystems, <br>celebrate the remarkable creatures that inhabit them, <br>and inspire a shared commitment to safeguarding the wonders of our planet's wildlife."
  </p>
</h1>

  
</div>
    <div class="form-container">
        <h2>Login</h2>
        <?php if (!empty($login_error)) { echo "<p id='error_message'>$login_error</p>"; } ?>
        <form id="loginForm" method="POST" action="login.php">
            <label for="login_username">Username:</label>
            <input type="text" id="login_username" name="login_username"><br><br>
            
            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="login_password"><br><br>
            
            <input type="submit" value="Login">
        </form>
    </div>
    <div class="register-form ">
        <h2>Registration</h2>
        <form action="process_registration.php" method="post">
            <label for="reg_username">Username:</label>
            <input type="text" id="reg_username" name="reg_username" required>

            <label for="reg_password">Password:</label>
            <input type="password" id="reg_password" name="reg_password" required>

            <label for="reg_email">Email:</label>
            <input type="email" id="reg_email" name="reg_email" required>

            <div class="clearfix">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
	<br><br><br><br>
	<footer>
  Copyright © 2023 udarajayasooriya. All rights reserved.
</footer>
</body>



</html>
