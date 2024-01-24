<?php
include 'db_config.php';

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imagePath = $_POST['image_path'];

    $query = "INSERT INTO items (title, description, image_path) VALUES ('$title', '$description', '$imagePath')";
    $conn->query($query);
}
$conn->close();
?>

<html>
<body>
<form method="post" action="create.php">
    <input type="text" name="title" placeholder="Title">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="text" name="image_path" placeholder="Image Path">
    <button type="submit" name="create">Create</button>
</form>
</body>
</html>
