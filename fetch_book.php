<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $query = "SELECT books.*, details.description, details.copies 
              FROM books 
              JOIN details ON books.id = details.id 
              WHERE books.id = $book_id";
    $result = mysqli_query($conn, $query);
    
    if ($book = mysqli_fetch_assoc($result)) {
        echo json_encode($book);
    }
}
?>
