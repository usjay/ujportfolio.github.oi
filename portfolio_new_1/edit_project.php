<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Project</h1>
        
        <form action="update_project.php" method="POST" enctype="multipart/form-data">
            <?php
            // Fetch the project details from the database and populate the form fields
            // Use the project ID to fetch the specific project details
            $projectId = $_GET['id'];
            $conn = connectDatabase();
            $sql = "SELECT * FROM projects WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $projectId);
            $stmt->execute();
            $result = $stmt->get_result();
            $project = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            ?>

            <label>Title:</label>
            <input type="text" name="title" value="<?php echo $project['title']; ?>" required>
            <label>Description:</label>
            <textarea name="description" required><?php echo $project['description']; ?></textarea>
            <label>Image Path:</label>
            <input type="text" name="image_path" value="<?php echo $project['image_path']; ?>" required>
            <label>Update Image:</label>
            <input type="file" name="new_image" accept="image/*">
            <input type="hidden" name="update" value="<?php echo $project['id']; ?>">
            <button type="submit">Update Project</button>
        </form>
    </div>
</body>
</html>
