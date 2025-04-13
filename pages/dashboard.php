<?php require '../resources/resourcecode/function.php';

    checkUserLogin();
    
    $email = "gillianreyespunzal@yahoo.com";
    $userInfo = getUserInfo($email);
    $userID = 23;
    
    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];
         }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../resources/css/styles.css">
    <title>Profile Page</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="dashboard">
            <div class="dashboard-content">
                <h2>Dashboard</h2>
                <!-- Your dashboard content here -->
                <ul>
                    <li>
                        <a href="../parent-folder/index.php" class="nav-link">
                            <img src="../resources/dashboardicons/home.svg" alt="Home">
                            HOME
                        </a>
                    </li>
                    <li>
                        <a href="../pages/menu.php" class="nav-link">
                            <img src="../resources/dashboardicons/get a drink.svg" alt="Get a Drink">
                            GET A DRINK
                        </a>
                    </li>
                    <li>
                        <a href="../pages/dashboard.php" class="nav-link">
                            <img src="../resources/dashboardicons/account.svg" alt="Account">
                            ACCOUNT
                        </a>
                    </li>
                    <li>
                        <a href="../pages/Termsandconditions.php" class="nav-link">
                            <img src="../resources/dashboardicons/Terms of use.svg" alt="Terms of use">
                            TERMS OF USE
                        </a>
                    </li>
                    <li>
                        <a href="../pages/Privacypolicy.php" class="nav-link">
                            <img src="../resources/dashboardicons/priv.svg" alt="Privacy">
                            PRIVACY POLICY
                        </a>
                    </li>
                    <li>
                        <a href="../pages/loggedout.php" class="nav-link">
                            <img src="../resources/dashboardicons/logout.svg" alt="Logout">
                            LOGOUT
                        </a>
                    </li>
                    <!-- Add more links as needed -->
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Profile Area -->
        <div class="profile-area">
            <!-- Profile Box Content -->
            
            <div class="profile-box">
                <div class="profile-picture">
                    <img src="../resources/img/pfp.jpg" alt="pfp">
                </div>
                <div class="user-info">
                    <?php
                        
                        $borrowedInfo = getUsersPendingBorrowInfo($userID);
                   
                    if (!empty($userInfo) && isset($userInfo[0]['first_name'], $userInfo[0]['second_name'], $userInfo[0]['email'], $userInfo[0]['user_id'])) {
                        echo "<p><strong>" . $userInfo[0]['first_name'] . " " . $userInfo[0]['second_name'] . "</strong></p>";
                        echo "<p>Email: " . $userInfo[0]['email'] . "</p>";
                        echo "<p>User ID: " . $userInfo[0]['user_id'] . "</p>";
                    } else {
                        echo "<p>User information not available</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- Borrow Table -->
            <div class="title3">Book/s Currently Borrowed</div>
            <div class="borrowedlist">
                <table>
                    <tr>
                        <th>Borrow ID:</th>
                        <th>Book Title:</th>
                        <th>Date Taken:</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    foreach ($borrowedInfo as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['Borrow ID'] . "</td>";
                        echo "<td>" . $row['Title'] . "</td>";
                        echo "<td>" . $row['Date Taken'] . "</td>";
                        echo "<td>";
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="borrowID" value="' . $row['Borrow ID'] . '">';
                        echo '<button type="submit" name="returnBook">Return</button>';
                        echo '</form>';
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- ... (rest of your HTML content) ... -->
    </div>

    <?php
   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['returnBook'])) {
    $borrowID = $_POST['borrowID'];
    $success = returnBookAndUpdateFee($borrowID);

    if ($success) {
        echo '<script>';
        echo 'var confirmation = confirm("Book status updated successfully. Click OK to continue.");';
        echo 'if (confirmation) { window.location.href = "genres.php"; }';
        echo '</script>';
        exit();
    } else {
        echo '<a>Failed to return book</a>';
    }
}
    ?>
</body>

</html>
