<?php
$db_host = "127.0.0.1"; // Change to your actual database host
$db_user = "root"; // Change to your actual database username
$db_pass = ""; // No password in your case
$db_name = "user"; // Change to your actual database name

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Result</title>
</head>
<body>
    <h1>Registration Result</h1>
   
    
    <p>Sri Lanka, often referred to as the 'Pearl of the Indian Ocean,' is a stunning island nation situated in South Asia. Renowned for its diverse landscapes, Sri Lanka offers everything from pristine beaches and lush tropical rainforests to ancient historical sites and vibrant cities. The country's rich cultural heritage is reflected in its UNESCO-listed sites like the ancient city of Polonnaruwa and the sacred city of Kandy. Visitors can explore the bustling markets of Colombo, the capital, or unwind on the golden shores of Mirissa and Unawatuna. With a warm and welcoming population, delicious cuisine, and a mix of religions and traditions, Sri Lanka is a captivating destination that offers a blend of relaxation, adventure, and cultural exploration.</p>
</body>
</html>
