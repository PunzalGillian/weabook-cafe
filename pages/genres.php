<?php require '../resources/resourcecode/function.php'; ?>



<!DOCTYPE html>
<html>
<head>
    <title>Genre</title>
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
        <div class="genre-intro">
            <br><br>
            <div class="title1">Genres</div>
            <table class="invisible-table">
                <tr>
                    <?php
                    $genre = getFirstHalfGenre();
                    foreach($genre as $items) {
                        echo '<td><a class="book-links" href="genre-AZ.php?Genre=' . urlencode($items["Genre"]) . '">' . $items['Genre'] . '</a></td>';
                    }
                    ?>
                </tr>
                <tr>
                    <?php
                    $genre = getSecondHalfGenre();
                    foreach($genre as $items) {
                        echo '<td><a class="book-links" href="genre-AZ.php?Genre=' . urlencode($items["Genre"]) . '">' . $items['Genre'] . '</a></td>';
                    }
                    ?>
                </tr>
            </table>
                
        <br><br>
        </div>


      
        <?php 
                $random = getRandomGenre();
                foreach($random as $random){
                    ?>
                    <div><h2 class="title1"><?php echo "Do You like ".$random['Genre']."?";?></h3></div>

        <div class="flex-container">
                     <?php
                    $randomBooks = getRandomBookByGenre($random['Genre']);
                    
                    foreach($randomBooks as $items){
                        ?>
                    <div class="box">

                            <a href="info.php?Title=<?php echo urlencode($items['Title']);?>">
                                    <div>
                            <?php   
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($items['Images']).'" height="300px"/>';
            
                            ?> 
            
                                        <h2><a class="book-links" href="info.php?Title=<?php echo urlencode($items['Title']);?>"><?php echo "".$items['Title'].""?></a></h2>
                                    </div>
                                </a>

                    </div>
                            
                    <?php
    
    
    
                    }

    
                
                ?>



        </div>
        
                <?php } ?>

        </div>
        <br>
        <br>
        <br>
  
</body>
</html>
