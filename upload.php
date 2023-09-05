<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $class = $_POST['class'];
    
    $photo = $_FILES['photo']['name'];
    $video = $_FILES['video']['name'];

    // Move uploaded files to a directory
    $photo_target = "uploads/" . basename($photo);
    $video_target = "uploads/" . basename($video);

    move_uploaded_file($_FILES['photo']['tmp_name'], $photo_target);
    move_uploaded_file($_FILES['video']['tmp_name'], $video_target);

    $sql = "UPDATE `crud` SET `name`='$name', `class`='$class', `photo`='$photo', `video`='$video' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Data updated successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>


