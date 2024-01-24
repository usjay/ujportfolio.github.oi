<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <style>
	/* Reset default margin and padding */
body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
}

/* Set a background color */
body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

.container {
    width: 70%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"],
textarea {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 3px;
    align-self: flex-start;
}

/* Add some responsive styles */
@media screen and (max-width: 768px) {
    .container {
        width: 90%;
    }
}

	
	
	
	</style>
</head>
<body>
    <div class="container">
        <h1>Edit Project</h1>
        
        <form action="update_project.php" method="POST" enctype="multipart/form-data">
            <?php
            // Fetch the project details from the database and populate the form fields
            // Use the project ID to fetch the specific project details
            $projectId = $_GET['id'];
            include 'db_connection.php'; // Include the database connection code
            $conn = connectDatabase();
            $sql = "SELECT * FROM projects WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $projectId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $project = $result->fetch_assoc(); // Fetch the project details
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
                <?php
            } else {
                echo "Project not found.";
            }

            $stmt->close();
            $conn->close();
            ?>
        </form>
    </div>
</body>
</html>
