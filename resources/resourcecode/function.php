<?php

require 'config.php';

function dbConnect(){
  //remove 4306
  if(!$conn = mysqli_connect(Server, Username, Password, Database)){
      echo "Connection Failed";
      return FALSE;
    } else { 
             return $conn; 
            }
    
}

function getGenre(){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Genre From genre");

  while($row = $result -> fetch_assoc()){

    $genre[] = $row;

  } 

  return $genre;

}

function getFirstHalfGenre(){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Genre From genre ORDER BY `Genre ID` ASC LIMIT 5");

  while($row = $result -> fetch_assoc()){

    $genre[] = $row;

  } 

  return $genre;

}

function getSecondHalfGenre(){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Genre From genre Where `Genre ID` > 5 ORDER BY `Genre ID` ASC Limit 5");

  while($row = $result -> fetch_assoc()){

    $genre[] = $row;

  } 

  return $genre;

}

function getBookByGenre($genre){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM  books left join books_genre 
  on books.`Book ID` = books_genre.`Book ID` left join genre on books_genre.`Genre ID` = genre.`Genre ID`
  Where Genre = '{$genre}'");

  while($row = $result -> fetch_assoc()){

    $bookData[] = $row;

  }

    return $bookData;

}
//changes
function getAvailableBookByGenrePopularity($genre, $offset, $limit) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 1 ORDER BY `Times Borrowed` DESC
      LIMIT {$offset}, {$limit}");

  while ($row = $result->fetch_assoc()) {
      $bookData[] = $row;
  }

  return $bookData;
}


function getBorrowedBookByGenrePopularity($genre, $offset, $limit) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 0 ORDER BY `Times Borrowed` DESC
      LIMIT {$offset}, {$limit}");

  while ($row = $result->fetch_assoc()) {
      $bookData[] = $row;
  }

  return $bookData;
}
function getBorrowedBookByGenreAZ($genre, $offset, $limit) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 0 ORDER BY `Title` ASC
      LIMIT {$offset}, {$limit}");

  $bookData = [];

  while ($row = $result->fetch_assoc()) {
      $bookData[] = $row;
  }

  return $bookData;
}



function getAvailableBookByGenre($genre, $offset, $limit) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 1 ORDER BY `Title` ASC
      LIMIT {$offset}, {$limit}");

  $bookData = [];

  while ($row = $result->fetch_assoc()) {
      $bookData[] = $row;
  }

  return $bookData;
}


function getBorrowedBookByGenre($genre){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM  books left join books_genre 
  on books.`Book ID` = books_genre.`Book ID` left join genre on books_genre.`Genre ID` = genre.`Genre ID`
  Where Genre = '{$genre}' AND Availability = 0 ORDER BY `Title` ASC");

  while($row = $result -> fetch_assoc()){

    $bookData[] = $row;

  }

    return $bookData;

}

function getInfo($title) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images, Availability, Volumes, Genre, `Times Borrowed` FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Title = '{$title}'");

  if ($result) {
      $bookInfo = array();

      // Fetch book information
      while ($row = $result->fetch_assoc()) {
          $bookInfo[] = $row;
      }

      return $bookInfo;
  } else {
      // Handle the case when there's an error in the query
      echo "Error fetching book information: " . mysqli_error($mysqli);
      return array();
  }
}

function getRandomGenre(){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Genre From genre ORDER BY rand() LIMIT 3");

  while($row = $result -> fetch_assoc()){

    $genreRandom[] = $row;

  } 

  return $genreRandom;

}

function getRandomBookByGenre($genre){

  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images, Genre FROM  books left join books_genre 
  on books.`Book ID` = books_genre.`Book ID` left join genre on books_genre.`Genre ID` = genre.`Genre ID`
  Where Genre = '{$genre}' ORDER BY rand() LIMIT 6");

  while($row = $result -> fetch_assoc()){

    $bookRandomData[] = $row;

  }

    return $bookRandomData;

}

function getTopBooks() {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, `Times Borrowed`, Images FROM books ORDER BY rand() LIMIT 6");

  while ($row = $result->fetch_assoc()) {
      $topBookData[] = $row;
  }

  return $topBookData;
}

/* added functions to enable update status */
function borrowBook($title, $userID) {
  $mysqli = dbConnect();

  $title = mysqli_real_escape_string($mysqli, $title);

  // Check if the user already has a book borrowed
  if (checkUserBorrowStatus($userID)) {
      return false; // User already has a book borrowed
  }

  // Get the book ID based on the title
  $bookIDQuery = "SELECT `Book ID` FROM books WHERE Title = '{$title}'";
  $bookIDResult = mysqli_query($mysqli, $bookIDQuery);

  if (!$bookIDResult) {
      return false; // Failed to get book ID
  }

  $bookIDRow = mysqli_fetch_assoc($bookIDResult);
  $bookID = $bookIDRow['Book ID'];

  // Update the book's availability and borrow count
  $updateQuery = "UPDATE books SET Availability = 0, `Times Borrowed` = `Times Borrowed` + 1 WHERE `Book ID` = $bookID";
  $result = mysqli_query($mysqli, $updateQuery);

  if ($result) {
      // Insert borrow data
      $insertBorrowQuery = "INSERT INTO borrow (`User ID`, `Book ID`, `Date Taken`, `Date Return`, `Fee`) VALUES ('$userID', '$bookID', current_timestamp(), NULL, NULL)";
      mysqli_query($mysqli, $insertBorrowQuery);

      // Fetch updated book details using the book ID
      $selectQuery = "SELECT * FROM books WHERE `Book ID` = $bookID";
      $updatedResult = mysqli_query($mysqli, $selectQuery);
      $updatedBookDetails = $updatedResult->fetch_assoc();
      return $updatedBookDetails;
  } else {
      return false; // Failed to update
  }
}


function returnBookAndUpdateFee($borrowID) {
  $mysqli = dbConnect();

  $borrowID = mysqli_real_escape_string($mysqli, $borrowID);

  // Fetch borrow details
  $borrowDetailsQuery = "SELECT * FROM borrow WHERE `Borrow ID` = $borrowID";
  $borrowDetailsResult = mysqli_query($mysqli, $borrowDetailsQuery);

  if (!$borrowDetailsResult) {
      return false; // Failed to fetch borrow details
  }

  $borrowDetails = mysqli_fetch_assoc($borrowDetailsResult);

  if ($borrowDetails) {
      // Update Date Return and Fee in the borrow table
      $dateReturned = new DateTime();
      $dateTaken = new DateTime($borrowDetails['Date Taken']);
      $daysDifference = $dateReturned->diff($dateTaken)->days;
      $fee = ($daysDifference > 0) ? 40 : 20;

      $updateBorrowQuery = "UPDATE borrow SET `Date Return` = current_timestamp(), `Fee` = $fee WHERE `Borrow ID` = $borrowID";
      $updateBorrowResult = mysqli_query($mysqli, $updateBorrowQuery);

      // Check the result of the update query
      if (!$updateBorrowResult) {
          return false; // Failed to update borrow details
      }

      // Update book availability back to 1
      $updateBookQuery = "UPDATE books SET Availability = 1 WHERE `Book ID` = {$borrowDetails['Book ID']}";
      $updateBookResult = mysqli_query($mysqli, $updateBookQuery);

      // Check the result of the update query
      if (!$updateBookResult) {
          return false; // Failed to update book availability
      }

      return true; // Success
  } else {
      return false; // Borrow entry not found
  }
}



function getStatusLabel($availability) {
  return $availability == 1 ? "Available" : "Unavailable";
}

// Function to get action button label
function getActionButtonLabel($availability) {
  return $availability == 1 ? 'Borrow' : 'Return';
}






function checkUserBorrowStatus($userID) {
  $mysqli = dbConnect();
  
  $userID = mysqli_real_escape_string($mysqli, $userID);

  // Check if the user has a pending borrow entry
  $result = mysqli_query($mysqli, "SELECT * FROM borrow WHERE `User ID` = $userID AND `Date Return` IS NULL");

  return mysqli_num_rows($result) > 0;
}



/*dashboard user info*/

function getUserInfo($email){


$mysqli = dbConnect();

$result = mysqli_query($mysqli, "SELECT `id`,`user_id`, `first_name`, `second_name`, `email` FROM users WHERE `email` = '{$email}' ");

while($row = $result -> fetch_assoc()){

  $userData[] = $row;

}

return $userData;

}

function getUsersBorrowedInfo($userID){

$mysqli = dbConnect();

$result = mysqli_query($mysqli, "SELECT `Book ID`, `Borrow ID`, `Date Taken` FROM borrow WHERE `User ID` = '{$userID}'");

while($row = $result -> fetch_assoc()) {

$borrowedInfo[] = $row;

}

return $borrowedInfo;

}



function getUsersPendingBorrowInfo($userID) {
  $mysqli = dbConnect();
  $userID = mysqli_real_escape_string($mysqli, $userID);

  $query = "SELECT borrow.`Borrow ID`, borrow.`Book ID`, books.`Title`, borrow.`Date Taken`
            FROM borrow
            JOIN books ON borrow.`Book ID` = books.`Book ID`
            WHERE borrow.`User ID` = '$userID'
              AND borrow.`Date Return` IS NULL
              AND borrow.`Fee` IS NULL";

  $result = mysqli_query($mysqli, $query);

  $borrowedInfo = array();
  while ($row = mysqli_fetch_assoc($result)) {
      $borrowedInfo[] = $row;
  }

  return $borrowedInfo;
}

function getBorrowedBooksInfo($bookNum) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT `Title` FROM books LEFT JOIN borrow ON books.`Book ID` = borrow.`Book ID` WHERE books.`Book ID` = '{$bookNum}'");

  if ($result) {
      $borrowedBooksInfo = array();

      while ($row = $result->fetch_assoc()) {
          $borrowedBooksInfo[] = $row;
      }

      return $borrowedBooksInfo;
  } else {
      return array(); // Return an empty array if the query fails
  }
}

/*idk where i use it, but lets put it*/
function findLatestBorrowedBook($userID){

$mysqli = dbConnect();

$result = mysqli_query($mysqli, "SELECT `Book ID`, `Borrow ID`, `Date Return`, `Date Taken` FROM borrow WHERE `User ID` = '{$userID}' ORDER BY `Borrow ID` DESC LIMIT 1");

while($row = $result -> fetch_assoc()) {

  $borrowedInfo[] = $row;

}

return $borrowedInfo;

}



/*check user*/
function checkUserLogin() {
  // Start the session
  session_start();

  // Check if the user email is set in the session
  if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
      $email = $_SESSION['email'];

      // Check if the email exists in the database
      $mysqli = dbConnect(); // Assuming you have a function for database connection

      $result = mysqli_query($mysqli, "SELECT COUNT(*) as count FROM users WHERE email = '{$email}'");
      $row = mysqli_fetch_assoc($result);

      if ($row['count'] > 0) {
          // Email exists, user is logged in
          return true;
      } else {
          // Email doesn't exist, possibly a session tampering
          redirectToLogin();
      }
  } else {
      // User email is not set in the session, user is not logged in
      redirectToLogin();
  }
}

function redirectToLogin() {
  // Redirect to the login page
  header("Location: ../logsign/login.php");
  exit();
}
//test changes
function countAvailableBooksByGenre($genre) {
  $mysqli = dbConnect();
  $genre = mysqli_real_escape_string($mysqli, $genre);

  $result = mysqli_query($mysqli, "SELECT COUNT(*) as count FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 1");

  if ($result) {
      $row = $result->fetch_assoc();
      return $row['count'];
  } else {
      return 0; // Return 0 if there is an error or no records found
  }
}

function getTotalAvailableBooksCountByGenre($genre) {
  $mysqli = dbConnect();

  $countQuery = "SELECT COUNT(*) as total FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 1";

  $countResult = mysqli_query($mysqli, $countQuery);
  
  $row = mysqli_fetch_assoc($countResult);

  return $row['total'];
}

function getTotalBorrowedBooksCountByGenre($genre) {
  $mysqli = dbConnect();

  // Adjust the table and column names based on your database structure
  $countQuery = "SELECT COUNT(*) as total FROM books
    LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
    LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
    WHERE Genre = '{$genre}' AND Availability = 0";

  $countResult = mysqli_query($mysqli, $countQuery);

  $row = mysqli_fetch_assoc($countResult);

  return $row['total'];
}

function getBorrowedBookByGenrePopularityWithPagination($genre, $offset, $limit) {
  $mysqli = dbConnect();

  $result = mysqli_query($mysqli, "SELECT Title, Author, Images FROM books
      LEFT JOIN books_genre ON books.`Book ID` = books_genre.`Book ID`
      LEFT JOIN genre ON books_genre.`Genre ID` = genre.`Genre ID`
      WHERE Genre = '{$genre}' AND Availability = 0 ORDER BY `Times Borrowed` DESC
      LIMIT {$offset}, {$limit}");

  $bookData = [];

  while ($row = $result->fetch_assoc()) {
      $bookData[] = $row;
  }

  return $bookData;
}

