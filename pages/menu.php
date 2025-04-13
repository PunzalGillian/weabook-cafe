<?php require '../resources/resourcecode/function.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Menu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="main-content">
        <div class="menu">
            <div class="title1">Menu</div>
            <?php
            $categories = [
                "Cold Drinks" => 7,
                "Warm Drinks" => 7,
                "Food" => 7
            ];

            $coldDrinkNames = [
                "Salted Caramel Cream",
                "Coffee with Milk",
                "Chocalate Cream",
                "Cinnamon Caramel",
                "Simple Cold Brew",
                "Pistacho Cream",
                "Nitro Cold Brew"
            ];

            $warmDrinkNames = [
                "Caffè Americano",
                "Caffè Misto",
                "Blonde Roast",
                "Decaf Roast",
                "Dark Roast",
                "Espresso Con Panna",
                "Espresso"
            ];

            $foodNames = [
                "Plain bagel",
                "Butter Croissant",
                "Cheese Danish",
                "Blueberry Muffin",
                "Chocolate Chip Cookie",
                "Ham and Swiss on Baguette",
                "Turkey, Provolone & Pesto on Ciabatta"
            ];

            foreach ($categories as $category => $totalItems) {
                echo "<p class='title2'>$category</p>";
                echo "<div class='menu-items'>";
                for ($i = 1; $i <= $totalItems; $i++) {
                    $imageName = "menu" . str_replace("/", "", str_replace(" ", "", $category)) . $i . ".svg";
                    $itemNames = ($category === "Cold Drinks") ? $coldDrinkNames :
                        (($category === "Warm Drinks") ? $warmDrinkNames : $foodNames);
                    $itemName = $itemNames[$i - 1]; // Adjust index to start from 0
                    echo "<div class='menu-item'>";
                    echo "<img src='../resources/menu/$imageName.svg' alt='$category$i'>";
                    echo "<p>$itemName</p>";
                    echo "</div>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>
