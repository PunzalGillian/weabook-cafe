<?php require '../resources/resourcecode/function.php'; ?>

<?php
function displayPromptAndRedirect($redirectURL)
{
    echo '<script>';
    echo 'var confirmation = confirm("Book status updated successfully. Click OK to continue.");';
    echo 'if (confirmation) { window.location.href = "' . $redirectURL . '"; }';
    echo '</script>';
}

if (isset($_GET['Title'])) {
    $title = urldecode($_GET['Title']);
} elseif (isset($_GET['query'])) {
    $title = $_GET['query'];
} elseif (isset($_POST['query'])) {
    $title = $_POST['query'];
} else {
    // Default value or handle the case when no query is provided
    $title = ''; // You can set a default value or handle it according to your logic
}




$booksInfo = getInfo($title);

foreach ($booksInfo as $items) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Information</title>
        <link rel="stylesheet" href="../resources/css/styles.css">

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

    <div class="book-container">
        <div class="book-image">
            <a href="info.php?Title=<?php echo urlencode($items['Title']); ?>">
                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($items['Images']) . '" />'; ?>
            </a>
        </div>
        <div class="book-details">
            <div class="section-header"><?php echo $items['Title']; ?></div>
            <div class="header">Author: <?php echo $items['Author'] ?></div>
            <?php
            $genres = array();
            foreach ($booksInfo as $bookInfo) {
                $genres[] = $bookInfo['Genre'];
            }
            ?>
            <div class="header">Genre: <?php echo implode(', ', $genres); ?></div>
            <div class="header">Volume: <?php echo $items['Volumes'] ?></div>
            <div class="header">Times Borrowed: <?php echo $items['Times Borrowed']; ?></div>
            <?php
            $status = ($items['Availability'] == 1) ? "Available" : "Unavailable";
            ?>
            <div class="header <?php echo strtolower($status); ?>">Status: <span><?php echo $status; ?></span></div>
        </div>

        <!-- Button to borrow or return based on availability -->
        <div class="button-container">
            <form method="post" action="">
                <input type="hidden" name="bookTitle" value="<?php echo $items['Title']; ?>">

                <?php
                $userID = 1; // You need to set the correct user ID
                $isBorrowed = checkUserBorrowStatus($userID);

                // Check if the book is available
                if ($items['Availability'] == 1) {
                    // Check if the user already has a book borrowed
                    if (!$isBorrowed) {
                        echo '<button type="submit" name="borrowReturn">';
                        echo getActionButtonLabel($items['Availability']);
                        echo '</button>';
                    } else {
                        // User already has a book borrowed
                        echo '<span class="tooltip header">You already have a book borrowed</span>';
                    }
                } else {
                    // Book is unavailable
                    echo '<span class="tooltip header">Book is unavailable</span>';
                }
                ?>
            </form>
        </div>
    </div>
    </body>

    </html>
    <?php
    break; // Assuming you want to display information for only one book
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrowReturn'])) {
$bookTitle = $_POST['bookTitle'];
$email = "gillianreyespunzal@yahoo.com";
$userInfo = getUserInfo($email);
$userID = 23;
// Check if the book is available
if ($items['Availability'] == 1) {
    $isBorrowed = checkUserBorrowStatus($userID);

    // Check if the user already has a book borrowed
    if (!$isBorrowed) {
        $success = borrowBook($bookTitle, $userID); // Use the book title directly

        if ($success) {
            // Update availability in $items (optional)
            $items['Availability'] = 0;

            // Display prompt and redirect only if the availability is successfully updated
            displayPromptAndRedirect('genres.php');
            exit();
        } else {
            echo '<a>Failed to update book status</a>';
        }
    } else {
        // User already has a book borrowed
        echo '<span class="tooltip header">You already have a book borrowed</span>';
    }
} else {
    // Book is unavailable
    echo '<span class="tooltip header">Book is unavailable</span>';
}
}
?>