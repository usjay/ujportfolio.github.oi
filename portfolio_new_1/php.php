<?php
// register.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = mysqli_connect("localhost", "username", "password", "dbname");

    // Check if user already exists
    $query = "SELECT * FROM users WHERE name='$name'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "User already exists.";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        mysqli_query($conn, $query);
        echo "Registration successful.";
    }

    mysqli_close($conn);
}
?>

<?php
// login.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $conn = mysqli_connect("localhost", "username", "password", "dbname");

    $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Login successful.";
    } else {
        echo "Login failed.";
    }

    mysqli_close($conn);
}
?>
