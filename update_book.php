<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $copies = $_POST['copies'];
    $description = $_POST['description'];

    // Image Upload Handling
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_path = $target_file;
        $updateQuery = "UPDATE books SET title='$title', author='$author', images='$image_path' WHERE id=$id";
    } else {
        $updateQuery = "UPDATE books SET title='$title', author='$author' WHERE id=$id";
    }

    $updateDetailsQuery = "UPDATE details SET copies='$copies', description='$description' WHERE id=$id";

    if (mysqli_query($conn, $updateQuery) && mysqli_query($conn, $updateDetailsQuery)) {
        echo "<script>alert('Book updated successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
}
?>
