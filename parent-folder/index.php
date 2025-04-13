<?php require '../resources/resourcecode/function.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Weabook Cafe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/styles.css"> 

    <!-- Link tag for Inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css"> 
    
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
            <form action="../pages/info.php" method="post">
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
        <div class="homepageimg">
            <img src="../resources/img/headerblue.webp" alt="homepageimage">
            
            <h1>Welcome to the Library Cafe</h1>
           <p class="sub">Explore our vast collection of books and find your next favorite read.</p>
        </div>

        
        <div class="title1">Today's Picks</div>
        <?php $topBooks = getTopBooks(); ?>

        
        <div class="flex-container">
             <?php foreach($topBooks as $items){?>
            <div class="box">
                            <a href="../pages/info.php?Title=<?php echo urlencode($items['Title']);?>">
                                <div>
                        <?php   
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($items['Images']).'" height="300px"/>';

                        ?> 

                                   <h2><a class="book-links" href="../pages/info.php?Title=<?php echo urlencode($items['Title']);?>"><?php echo "".$items['Title']."<br>"?></a></h2> 
                                </div>
                            </a>

            </div>

            <?php } ?>
        </div>
        <?php 
                $random = getRandomGenre();
                foreach($random as $random){
                    ?>
                    <div><h2 class="title1"><?php echo "Do You like ".$random['Genre']."?";?></h2></div>

        <div class="flex-container">
                     <?php
                    $randomBooks = getRandomBookByGenre($random['Genre']);
                    
                    foreach($randomBooks as $items){
                        ?>
                    <div class="box">

                            <a href="../pages/info.php?Title=<?php echo urlencode($items['Title']);?>">
                                    <div>
                            <?php   
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($items['Images']).'" height="300px"/>';
            
                            ?> 
            
                                        <h2><a class="book-links" href="../pages/info.php?Title=<?php echo urlencode($items['Title']);?>"><?php echo "".$items['Title'].""?></a></h2>
                                    </div>
                                </a>

                    </div>
                            
                    <?php
    
    
    
                    }

    
                
                ?>



                </div>
        
                <?php } ?>
        
       
        
        <br>
        <br>
        <br>
        
                </div>
</body>
</html>
