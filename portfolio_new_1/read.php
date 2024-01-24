<?php
include 'db_config.php';

$readQuery = "SELECT * FROM items";
$result = $conn->query($readQuery);
?>

<html>
<body>
<?php while ($row = $result->fetch_assoc()) { ?>
    <div>
        <h2><?php echo $row['title']; ?></h2>
        <p><?php echo $row['description']; ?></p>
        <img src="<?php echo $row['image_path']; ?>" alt="Item Image">
    </div>
<?php } ?>
</body>
</html>
