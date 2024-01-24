<?php
include 'db_config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM items WHERE id=$id";
    $conn->query($deleteQuery);
}
$conn->close();
?>

<html>
<body>
<?php while ($row = $result->fetch_assoc()) { ?>
    <div>
        <h2><?php echo $row['title']; ?></h2>
        <p><?php echo $row['description']; ?></p>
        <img src="<?php echo $row['image_path']; ?>" alt="Item Image">
        <a href="delete.php?delete=<?php echo $row['id']; ?>">Delete</a>
    </div>
<?php } ?>
</body>
</html>
