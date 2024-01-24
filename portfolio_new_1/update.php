<form method="post" action="update.php"> <!-- Make sure the action points to the correct file -->
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="text" name="new_title" placeholder="New Title">
    <textarea name="new_description" placeholder="New Description"></textarea>
    <input type="text" name="new_image_path" placeholder="New Image Path">
    <button type="submit" name="update">Update</button>
</form>
