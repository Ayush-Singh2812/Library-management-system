<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Delete book from both tables
    $deleteDetailsQuery = "DELETE FROM details WHERE id = $id";
    $deleteBookQuery = "DELETE FROM books WHERE id = $id";

    if (mysqli_query($conn, $deleteDetailsQuery) && mysqli_query($conn, $deleteBookQuery)) {
        echo "Book deleted successfully.";
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
