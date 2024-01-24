<?php

require_once __DIR__ . '/file_containing_performCrudOperation.php';

$projects = performCrudOperation('read');

if (!empty($projects)) {
    foreach ($projects as $project) {
        echo "ID: " . $project['id'] . "<br>";
        echo "Title: " . $project['title'] . "<br>";
        echo "Description: " . $project['description'] . "<br>";
        echo "Image Path: " . $project['image_path'] . "<br><br>";
    }
} else {
    echo "No projects found.";
}
?>
