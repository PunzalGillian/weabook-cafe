    <?php require '../resources/resourcecode/function.php'; ?>

    <?php

        if(isset($_GET['Genre'])){

            $genre = urldecode($_GET['Genre']);

        }
    // Pagination settings
    $booksPerPage = 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $booksPerPage;

    // Retrieve random available books with popularity sorting and limit the result
    $totalAvailableBooks = getTotalAvailableBooksCountByGenre($genre);
    $totalAvailablePages = ceil($totalAvailableBooks / $booksPerPage);
    $randomAvailableBooks = getAvailableBookByGenrePopularity($genre, $offset, $booksPerPage);

    // Retrieve random borrowed books with popularity sorting and limit the result
    $totalBorrowedBooks = getTotalBorrowedBooksCountByGenre($genre);
    $totalBorrowedPages = ceil($totalBorrowedBooks / $booksPerPage);
    $randomBorrowedBooks = getBorrowedBookByGenrePopularityWithPagination($genre, $offset, $booksPerPage);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Genre</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../resources/css/styles.css"> 

        <!-- Link tag for Inter font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    </head>
    <body>
    <header>   
            <!-- navigation bar-->
            <div class="top-bar">
                <div class="logo">
                    <a href="../parent-folder/index.php">
                        <img src="../resources/img/logo.svg" alt="Logo">
                    </a>
                </div>
                <div class="nav-links">
                    <a href="../pages/genres.php">GENRE</a>
                    <a href="../pages/menu.php">MENU</a>
                    <a href="../pages/aboutus.php">ABOUT US</a>
                </div>
                <div class="search-container">
                    <form action="info.php" method="get">
                        <input type="text" class="search-box" name="query" placeholder="Search...">
                    </form>
                </div>
                <div class="nav-links">
                <a href="../pages/loggedout.php">LOGOUT</a>
            <a href="../pages/dashboard.php">PROFILE</a>
                </div>
            </div>
        </header>
        <div class="main-content">
            <!-- Available Books Section -->
            <div class="genre-intro"><br><br>
            <div class="title1">Sort by:</div><a class = "book-links" href="genre-Popularity.php?Genre=<?php echo urlencode($genre)?>">Popularity</a>
                                            <a class = "book-links" href="genre-AZ.php?Genre=<?php echo urlencode($genre)?>">Alphabetically</a><br><br><br>
            </div>
            <div class="title1"><h2><?php echo "Available " . $genre . " Manga"; ?></h2></div>
            <div class="flex-container">
                <?php foreach ($randomAvailableBooks as $items) { ?>
                    <div class="box">
                        <a href="info.php?Title=<?php echo urlencode($items['Title']); ?>">
                            <div>
                                <?php
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($items['Images']) . '" height="300px"/>';
                                ?>
                                <h2><a class="book-links" href="info.php?Title=<?php echo urlencode($items['Title']); ?>"><?php echo "" . $items['Title'] . "" ?></a></h2>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- Pagination for Available Books -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalAvailablePages; $i++) { ?>
                    <a href="genre-Popularity.php?Genre=<?php echo urlencode($genre); ?>&page=<?php echo $i; ?>"
                    <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php } ?>
            </div>

    <!-- Borrowed Books Section -->
    <div class="title1"><h2><?php echo "Currently Borrowed " . $genre . " Manga"; ?></h2></div>
            <div class="flex-container">
                <?php foreach ($randomBorrowedBooks as $items) { ?>
                    <div class="box">
                        <a href="info.php?Title=<?php echo urlencode($items['Title']); ?>">
                            <div>
                                <?php
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($items['Images']) . '" height="300px"/>';
                                ?>
                                <h2><a class="book-links" href="info.php?Title=<?php echo urlencode($items['Title']); ?>"><?php echo "" . $items['Title'] . "" ?></a></h2>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- Pagination for Borrowed Books -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalBorrowedPages; $i++) { ?>
                    <a href="genre-Popularity.php?Genre=<?php echo urlencode($genre); ?>&page=<?php echo $i; ?>"
                    <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php } ?>
            </div>
        </div>
        
        
<script>
document.addEventListener('DOMContentLoaded', function () {
    const elements = document.querySelectorAll('.element');
    const body = document.body;
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const paginationLinks = document.querySelectorAll('.pagination a');

    let currentIndex = 0;

    function updateElements() {
        elements.forEach((element, index) => {
            const distance = Math.abs(currentIndex - index);
            const scaleFactor = 0.5 + 0.5 * (1 - distance * 0.25);

            element.style.transform = `translateX(${100 * (index - currentIndex)}%) scale(${scaleFactor})`;
            element.classList.toggle('active', index === currentIndex);
            element.classList.toggle('inactive', index !== currentIndex);
        });

        // Check if any inactive element is visible
        const isInactiveVisible = Array.from(elements).some(element => element.classList.contains('inactive'));
        // Toggle body class for overflow control
        body.classList.toggle('inactive-overflow', isInactiveVisible);
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % elements.length;
        updateElements();
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + elements.length) % elements.length;
        updateElements();
    }

    function handlePaginationClick(index) {
        currentIndex = index;
        updateElements();
    }

    // Ensure the active element is centered on page load
    updateElements();

    nextBtn.addEventListener('click', showNext);
    prevBtn.addEventListener('click', showPrev);

    // Add click event listeners to pagination links
    paginationLinks.forEach((link, index) => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            handlePaginationClick(index);
        });
    });
});
</script>

    </body>
    </html>