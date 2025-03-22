<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <a href="add_book.php" class="add-book-btn">Add Book</a>
        <input type="text" id="search-input" placeholder="Search by title or author">
        <button id="reset-search">Reset</button>
    </header>

    <main>
        <!-- Book Listing Section -->
        <div id="book-list">
            <?php
            $query = "SELECT books.id, books.title, books.author, books.images, details.copies, details.description 
                      FROM books 
                      INNER JOIN details ON books.id = details.id";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($book = mysqli_fetch_assoc($result)) {
                    $book_json = htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8'); // Fix JSON encoding
                    echo "<div class='book-card' id='book-" . $book['id'] . "' onclick='showBookDetail($book_json)'>";
                    echo "<img src='" . $book['images'] . "' alt='" . $book['title'] . "'>";
                    echo "<h3>" . $book['title'] . "</h3>";
                    echo "<p>Author: " . $book['author'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No books available</p>";
            }
            ?>
        </div>

        <!-- Book Detail Section -->
        <div id="book-detail" style="display: none;">
            <button id="back-button">Back to Book List</button>
            <img id="detail-image" src="" alt="Book Image">
            <h2 id="detail-title"></h2>
            <p id="detail-author"></p>
            <p id="detail-description"></p>
            <p id="detail-copies"></p>
            <button id="delete-button">Delete Book</button>
            <button id="edit-button">Edit </button>
        </div>
    </main>

    <script src="script.js"></script>
</body>
</html>
