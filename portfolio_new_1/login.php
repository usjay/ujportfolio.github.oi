<?php
session_start();
require_once 'db.php'; // Database connection

$login_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    // Retrieve user data from the database
    $stmt = $db->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location:pp.html"); // Redirect to dashboard after successful login
        exit();
    } else {
       $login_error = "Invalid username or password. <br> if  you are not register please register first  " ;
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
  width: 100px; 
  height: 100%;
}

.cover-photo {
  margin: 20px; 
  
}

  /* Global styles */
  body {
    font-family: sans-serif;
  }

  h1 {
    font-size: 24px;
    margin-top: 0;
	  text-align: center;

  }

  /* Login form */
  .form-container {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
  }

  .form-container h2 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .form-container input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
  }

  .form-container input[type="submit"] {
    background-color: #00FA9A;;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
	border-radius: 10px;
  }

  /* Register form */
  .register-form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
  }

  .register-form h2 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .register-form input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
  }

  .register-form input[type="submit"] {
    cursor: pointer;
  }
  
  #redirectButton{
  background-color: #800000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
			border-radius: 10px;
			)
  
  body {
  background-color: #FFFAF;
}
 <script>
        // Clear the login form after submission
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("loginForm").addEventListener("submit", function() {
                document.getElementById("loginForm").reset();
            });

            // Clear the registration form after submission
            document.getElementById("regForm").addEventListener("submit", function() {
                document.getElementById("regForm").reset();
            });
        });
    </script>






</style>
</head>
<body>
   <div class="cover-photo">
  <img src="wild life.jpg" alt="Cover photo">
  </div>
  <p style="font-size: 20px; font-weight: bold; color: #00FA9A;text-align: center; ">Welcome to our community!</p>

    <div class="form-container">
        <h2>Login</h2>
        <?php if (!empty($login_error)) { echo "<p id='error_message'>$login_error</p>"; } ?>
        <form id="loginForm" method="POST" >
            <label for="login_username">Username:</label>
            <input type="text" id="login_username" name="login_username"><br><br>
            
            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="login_password"><br><br>
            
            <input type="submit" value="Login">
			

        </form>
		<div>
		<button id="redirectButton">Click to Redirect</button>

<script>

document.getElementById("redirectButton").addEventListener("click", function() {
  // Redirect to the index.php page
  window.location.href = "index.php";
});
</script>
		
	</div>	
  
</body>
</html>
