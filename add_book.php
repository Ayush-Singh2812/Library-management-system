<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $copies = $_POST['copies'];
    $description = $_POST['description'];

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = $target_file;

        $sql_books = "INSERT INTO books (title, author, images) VALUES ('$title', '$author', '$image_path')";
        if (mysqli_query($conn, $sql_books)) {
            $book_id = mysqli_insert_id($conn);
            $sql_details = "INSERT INTO details (id, copies, description) VALUES ('$book_id', '$copies', '$description')";
            mysqli_query($conn, $sql_details);
            echo "<script>alert('Book added successfully!'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <h2>Add a New Book</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Book Title" required><br>
        <input type="text" name="author" placeholder="Author Name" required><br>
        <input type="number" name="copies" placeholder="Number of Copies" required><br>
        <textarea name="description" placeholder="Book Description" required></textarea><br>
        <input type="file" name="image" required><br>
        <button type="submit">Add Book</button>
    </form>
</body>
</html>
