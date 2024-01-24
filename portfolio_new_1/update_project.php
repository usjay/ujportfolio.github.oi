<?php
include 'db_connection.php'; // Include the database connection code

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDatabase();
    
    if (isset($_POST['update'])) {
        $projectId = $_POST['update'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $imagePath = $_POST['image_path']; // Existing image path

        // Check if a new image was uploaded
        if (!empty($_FILES['new_image']['name'])) {
            $newImagePath = 'uploads/' . $_FILES['new_image']['name'];
            move_uploaded_file($_FILES['new_image']['tmp_name'], $newImagePath);
            $imagePath = $newImagePath; // Update image path if a new image was uploaded
        }

        $sql = "UPDATE projects SET title = ?, description = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $imagePath, $projectId);

        if ($stmt->execute()) {
            header("Location: crud_operations.php"); // Redirect to the main page after update
        } else {
            echo "Error updating project: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
