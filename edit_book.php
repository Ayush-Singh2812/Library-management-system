<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $query = "SELECT * FROM books JOIN details ON books.id = details.id WHERE books.id = $book_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        echo "Book not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <h2>Edit Book</h2>
    <form action="update_book.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
        <label>Book Name:</label>
        <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
        
        <label>Author Name:</label>
        <input type="text" name="author" value="<?php echo $book['author']; ?>" required>

        <label>No. of Copies:</label>
        <input type="number" name="copies" value="<?php echo $book['copies']; ?>" required>

        <label>Description:</label>
        <textarea name="description" required><?php echo $book['description']; ?></textarea>

        <label>Book Image:</label>
        <input type="file" name="image">
        <img src="<?php echo $book['images']; ?>" alt="Current Image" width="100">

        <button type="submit">Update Book</button>
    </form>
</body>
</html>
