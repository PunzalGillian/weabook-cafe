<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../resources/css/styles.css"> 
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
    <div class="cafe-header">
        <div class="name-logo-text">
            <img src="../resources/img/name-logo.png" alt="name-logo">
        </div> 
    </div>
            <div class="services-row">
                <div class="container-box">
                    <div class="services-box">
                        <img src="../resources/img/manga.png" alt="manga">
                        <h1>Manga</h1>
                        <p>At vero eos et accusamus et iusto odio
                        dignissimos ducimus qui blanditiis praesentium
                        voluptatum deleniti atque corrupti quos
                        dolores et quas molestias excepturi sint
                        occaecati cupiditate non provident, similique
                        sunt in culpa qui officia deserunt mollitia animi,
                        id est laborum et dolorum fuga.</p>
                    </div>    
                </div>
                <div class="container-box">
                    <div class="services-box">
                        <img src="../resources/img/coffee.png" alt="coffee">
                        <h1>Coffee</h1>
                        <p>At vero eos et accusamus et iusto odio
                        dignissimos ducimus qui blanditiis praesentium
                        voluptatum deleniti atque corrupti quos dolores
                        et quas molestias excepturi sint occaecati
                        cupiditate non provident, similique sunt in
                        culpa qui officia deserunt mollitia animi, id est
                        laborum et dolorum fuga.</p>
                    </div>
                </div>
                <div class="container-box">
                    <div class="services-box">
                        <img src="../resources/img/manga.png" alt="manhwa">
                        <h1>Manhwa</h1>
                        <p>At vero eos et accusamus et iusto odio
                        dignissimos ducimus qui blanditiis praesentium
                        voluptatum deleniti atque corrupti quos dolores
                        et quas molestias excepturi sint occaecati
                        cupiditate non provident, similique sunt in
                        culpa qui officia deserunt mollitia animi, id est
                        laborum et dolorum fuga.</p>
                    </div>
                </div>
            </div>
            <div class="name-logo-text">
            <img src="../resources/img/the-team.png" alt="name-logo">
        </div>
        <br><br><br><br><br>

        <div class="team">
            <div class="member">
                <div class="members-pfp">
                    <img src="../resources/img/m1.jpg" alt="mio">
                </div>
            </div>
            <div class="member">
                <div class="members-pfp">
                    <img src="../resources/img/m2.jpg" alt="rosemae">       
                </div>
            </div>
            <div class="member">
                <div class="members-pfp">
                    <img src="../resources/img/m3.jpg" alt="gil">
                </div>
            </div>
            <div class="member">
                <div class="members-pfp">
                    <img src="../resources/img/m4.jpg" alt="rosemae">
                </div>
            </div>
            <div class="member">
                <div class="members-pfp">
                    <img src="../resources/img/m5.jpg" alt="rg">
                </div>
            </div>
        </div>
        <footer class="footer">
        <h1 class="footer-heading">CONTACT US</h1>
        <div class="contact-container">
            <div class="icons">
                <a href="https://www.facebook.com" target="_blank">
                    <img src="../resources/img/fb.svg" alt="facebook">
                </a>
            </div>
            <p>Weabook Cafe</p>
            <div class="icons">
                <a href="tel:555-555-8008" target="_blank">
                    <img src="../resources/img/tel.svg" alt="tel">
                </a>
            </div>
            <p>555-555-8008</p>
        </div>
        <div class="contact-container">
            <div class="icons">
                <a href="mailto:example@example.com" target="_blank">
                    <img src="../resources/img/email.svg" alt="email">
                </a>
            </div>
            <p>weabookcafe@gmail.com</p>
        </div>
    </footer>


        <?php

        // PHP code goes here if you want to dynamically generate content
        ?>
    </div>
    </div>
</body>
</html>