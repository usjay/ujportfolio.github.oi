<?php

function connectDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test"; // Change this to your database name

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function insertProject($conn, $title, $description, $image_path) {
    $sql = "INSERT INTO projects (title, description, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $image_path);
    $stmt->execute();
    $stmt->close();
}

function getProjects($conn) {
    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);
    $projects = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }

    return $projects;
}

function getProjectById($conn, $projectId) {
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
    $stmt->close();

    return $project;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDatabase();
    
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_path = 'uploads/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        insertProject($conn, $title, $description, $image_path);
    }

    if (isset($_POST['delete'])) {
        $projectId = $_POST['delete'];
        $sql = "DELETE FROM projects WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $stmt->close();
    }
    
    if (isset($_POST['update'])) {
        $updateId = $_POST['update'];
        header("Location: edit.php?id=$updateId"); // Redirect to edit page with the project ID
    }
    
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
<style>
  <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 2cm 4cm 3cm 2cm;
            padding: 50px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
			
		
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
			border: 1px solid;
        }

        th {
            background-color:#ADFF2F;
            font-weight: bold;
        }

        td img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        td form {
            display: inline-block;
            margin-right: 5px;
        }

        button {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: red;
        }
		/* Apply some basic styling to the form */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 10px;
    background-color: #f4f4f4;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Style the labels */
label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

/* Style the text input and textarea */
input[type="text"],
textarea {
    width: 90%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* Style the file input button */
input[type="file"] {
    margin-top: 5px;
}

/* Style the submit button */
button[type="submit"] {
    background-color: #ADFF2F;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

</style>
    
</head>
<body>
<section>
    <div class="container">
        <h1>submit your project</h1>
        
        <!-- Add Project Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>Description:</label>
            <textarea name="description" required></textarea>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit" name="add">Add Project</button>
        </form>
        </div>
		</section>
        <!-- List of Projects -->
		<section>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            $conn = connectDatabase();
            $projects = getProjects($conn);
            $conn->close();

            foreach ($projects as $project):
            ?>
            <tr>
                <td><?php echo $project['id']; ?></td>
                <td><?php echo $project['title']; ?></td>
                <td><?php echo $project['description']; ?></td>
                <td><img src="<?php echo $project['image_path']; ?>" alt="Project Image" width="100"></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="delete" value="<?php echo $project['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="" method="POST">
                        <input type="hidden" name="update" value="<?php echo $project['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div></section>
</body>
</html>
