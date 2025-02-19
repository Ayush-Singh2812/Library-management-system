// Sample Book Data
const books = [
    {
        title: "The Great Gatsby",
        author: "F. Scott Fitzgerald",
        image: "images/book1.jpg",
        description: "A story of love and betrayal in the Jazz Age.",
        copies: 3
    },
    {
        title: "To Kill a Mockingbird",
        author: "Harper Lee",
        image: "images/book2.jpg",
        description: "A powerful exploration of racial injustice.",
        copies: 5
    },
    {
        title: "1984",
        author: "George Orwell",
        image: "images/book3.jpg",
        description: "A dystopian novel about totalitarianism.",
        copies: 2
    }
];

// DOM Elements
const bookList = document.getElementById('book-list');
const searchInput = document.getElementById('search-input');
const resetSearch = document.getElementById('reset-search');
const bookDetail = document.getElementById('book-detail');
const backButton = document.getElementById('back-button');
const detailImage = document.getElementById('detail-image');
const detailTitle = document.getElementById('detail-title');
const detailAuthor = document.getElementById('detail-author');
const detailDescription = document.getElementById('detail-description');
const detailCopies = document.getElementById('detail-copies');

// Render Book List
function renderBooks(filteredBooks) {
    bookList.innerHTML = '';
    filteredBooks.forEach(book => {
        const bookCard = document.createElement('div');
        bookCard.className = 'book-card';
        bookCard.innerHTML = `
            <img src="${book.image}" alt="${book.title}">
            <h3>${book.title}</h3>
            <p>Author: ${book.author}</p>
        `;
        bookCard.addEventListener('click', () => showBookDetail(book));
        bookList.appendChild(bookCard);
    });
}

// Show Book Detail
function showBookDetail(book) {
    bookList.style.display = 'none';
    bookDetail.style.display = 'block';
    detailImage.src = book.image;
    detailTitle.textContent = book.title;
    detailAuthor.textContent = `Author: ${book.author}`;
    detailDescription.textContent = `Description: ${book.description}`;
    detailCopies.textContent = `Available Copies: ${book.copies}`;
}

// Back to Book List
backButton.addEventListener('click', () => {
    bookDetail.style.display = 'none';
    bookList.style.display = 'flex';
});

// Search Functionality
searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    const filteredBooks = books.filter(book =>
        book.title.toLowerCase().includes(query) ||
        book.author.toLowerCase().includes(query)
    );
    renderBooks(filteredBooks);
});

// Reset Search
resetSearch.addEventListener('click', () => {
    searchInput.value = '';
    renderBooks(books);
});

// Initial Render
renderBooks(books);