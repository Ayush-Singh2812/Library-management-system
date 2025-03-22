document.addEventListener('DOMContentLoaded', function () {
    const bookList = document.getElementById('book-list');
    const searchInput = document.getElementById('search-input');
    const resetSearch = document.getElementById('reset-search');
    const bookDetail = document.getElementById('book-detail');
    const backButton = document.getElementById('back-button');
    const deleteButton = document.getElementById('delete-button');
    const editButton = document.getElementById('edit-button'); // Select Edit Button
    let currentBookId = null;

    window.showBookDetail = function (book) {
        console.log("Book clicked:", book); // Debugging
        if (!book) {
            alert("Error loading book details.");
            return;
        }

        bookList.style.display = 'none';
        bookDetail.style.display = 'block';

        document.getElementById('detail-image').src = book.images;
        document.getElementById('detail-title').textContent = book.title;
        document.getElementById('detail-author').textContent = `Author: ${book.author}`;
        document.getElementById('detail-description').textContent = `Description: ${book.description}`;
        document.getElementById('detail-copies').textContent = `Available Copies: ${book.copies}`;
        currentBookId = book.id;

        // Ensure Edit Button Works
        editButton.onclick = function () {
            console.log("Edit Button Clicked for ID:", currentBookId); // Debugging
            if (currentBookId) {
                window.location.href = `edit_book.php?id=${currentBookId}`;
            } else {
                alert("Book ID not found!");
            }
        };
    };

    backButton.addEventListener('click', function () {
        bookDetail.style.display = 'none';
        bookList.style.display = 'flex';
    });

    deleteButton.addEventListener('click', function () {
        if (currentBookId && confirm("Are you sure you want to delete this book?")) {
            fetch('delete_book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${currentBookId}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => console.error("Error:", error));
        }
    });

    searchInput.addEventListener('input', function () {
        const query = searchInput.value.toLowerCase();
        const books = document.querySelectorAll('.book-card');
        books.forEach(book => {
            const title = book.querySelector('h3').textContent.toLowerCase();
            const author = book.querySelector('p').textContent.toLowerCase();
            book.style.display = title.includes(query) || author.includes(query) ? "block" : "none";
        });
    });

    resetSearch.addEventListener('click', function () {
        searchInput.value = '';
        document.querySelectorAll('.book-card').forEach(book => book.style.display = "block");
    });
});
