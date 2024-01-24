

// php code that user data transfer into sql database


<?php
// functions file
include_once("functions.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (insertUser($name, $email, $password)) {
        echo "Registration successful!";
    } else {
        echo "Error registering user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
    <h1>Registration</h1>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>






//  insert user details into the database
function insertUser($name, $email, $password) {
    $conn = connectDatabase();
    
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

//  php code for user feedback insert in to sql database

<?php
include_once("functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if (insertFeedback($name, $email, $message)) {
        echo "Thank you for your feedback!";
    } else {
        echo "Error submitting feedback.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <h1>Feedback Form</h1>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="message">Message:</label>
        <textarea name="message" rows="4" required></textarea><br><br>

        <input type="submit" value="Submit Feedback">
    </form>
</body>
</html>







//  insert user feedback into the database
function insertFeedback($name, $email, $message) {
    $conn = connectDatabase();
    
    $sql = "INSERT INTO feedback (name, mail, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}











// database connect code  and insert data into project

<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

//  establish a database connection
function connectDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// insert project details into the database
function insertProject($title, $description, $imagePath) {
    $conn = connectDatabase();
    
    // Prepare and execute INSERT SQL query
    
    $sql = "INSERT INTO projects (title, description, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $imagePath);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}



?>




// form validdation part

function validateForm() {
    $errors = [];

    // Check if username is empty
    if (empty($_POST['reg_username'])) {
        $errors['reg_username'] = 'Username is required.';
    }

    // Check if password is empty
    if (empty($_POST['reg_password'])) {
        $errors['reg_password'] = 'Password is required.';
    }

    // Check if email is empty
    if (empty($_POST['reg_email'])) {
        $errors['reg_email'] = 'Email is required.';
    }

    // Check if email is valid
    if (!filter_var($_POST['reg_email'], FILTER_VALIDATE_EMAIL)) {
        $errors['reg_email'] = 'Invalid email address.';
    }

    return $errors;
}








// insert project function
function insertProject() {
    // Get the project details from the POST request
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_path = $_POST['image_path'];

    // Connect to the database
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');

    // Insert the project details into the database
    $stmt = $db->prepare('INSERT INTO projects (title, description, image_path) VALUES (?, ?, ?)');
    $stmt->execute([$title, $description, $image_path]);

   
    $project_id = $db->lastInsertId();

    
    return $project_id;
}




//retrive project


function getProjects() {
    $conn = connectDatabase();
    
    //  execute  SELECT SQL query
    $sql = "SELECT id, title, description, image_path FROM projects";
    $result = $conn->query($sql);

    $projects = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }

    return $projects;
}



 <?php foreach ($projects as $project) { ?>
            <div class="project">
                <h3><?php echo $project['title']; ?></h3>
                <p><?php echo $project['description']; ?></p>
                <img src="<?php echo $project['image_path']; ?>" alt="Project Image">
            </div>
        <?php } ?>




// update project
//  update project information in the database
function updateProject($id, $title, $description, $imagePath) {
    $conn = connectDatabase();

    $sql = "UPDATE projects SET title=?, description=?, image_path=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $description, $imagePath, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}




<?php
include_once("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["project_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $imagePath = $_POST["image_path"];

    if (updateProject($id, $title, $description, $imagePath)) {
        echo "Project updated successfully!";
    } else {
        echo "Error updating project.";
    }
}

// Get project data for pre-filling the form
if (isset($_GET["id"])) {
    $conn = connectDatabase();
    $id = $_GET["id"];
    $sql = "SELECT * FROM projects WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <h1>Edit Project</h1>

    <form method="post">
        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
        
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $project['title']; ?>"><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description"><?php echo $project['description']; ?></textarea><br><br>
        
        <label for="image_path">Image Path:</label>
        <input type="text" name="image_path" value="<?php echo $project['image_path']; ?>"><br><br>
        
        <input type="submit" value="Update Project">
    </form>
</body>
</html>
        
		
		
		
		
		
		
		
		
		
		//delete project
		
		
		
		
		
		
		
		//  delete projects from the database
function deleteProject($id) {
    $conn = connectDatabase();

    $sql = "DELETE FROM projects WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


<?php
include_once("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["project_id"];

    if (deleteProject($id)) {
        echo "Project deleted successfully!";
    } else {
        echo "Error deleting project.";
    }
}

// for display
if (isset($_GET["id"])) {
    $conn = connectDatabase();
    $id = $_GET["id"];
    $sql = "SELECT * FROM projects WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <h1>Delete Project</h1>

    <p>Are you sure you want to delete this project?</p>
    <h2><?php echo $project['title']; ?></h2>
    <p><?php echo $project['description']; ?></p>
    <img src="<?php echo $project['image_path']; ?>" alt="Project Image">

    <form method="post">
        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
        <input type="submit" value="Delete Project">
    </form>
</body>
</html>






