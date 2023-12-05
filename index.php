<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Recipe App, food, dishes, menu, fast food, burger, pizza, chinese, italian, indian">
    <meta name="description" content="Find your everyday cooking inspiration on Recipe Website. Discover recipes, cooks, videos, and how-tos based on the food you love.">
    <title>Bon Appetite</title>
  <!--Google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/icons8-bagel-96.png" type="image/icon type">
    <link rel="stylesheet" href="assets/scroll.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php
session_start();

// Assuming you have a variable $username that holds the logged-in username
// Replace this with your actual variable or method to retrieve the username
if (isset($username)) {
    $_SESSION['username'] = $username;
}
?>

    <section>
        <header>
            <a href="index.php" class="logo">Bon Appetite</a>
            <ul class="navlist">
              <li><a href="index.php">Home</a></li>
              <li><a href="Preference.html" target="_blank">Preference</a></li>
              <?php
        if (isset($_SESSION['username'])) {
            // If the user is logged in, display the welcome message and Sign Out link
            echo '<li><a href="logout.php">Sign Out</a></li>';
        } else {
            // If the user is not logged in, display the Sign Up and Login links
            echo '<li><a href="signup.php">Sign Up</a></li>';
            echo '<li><a href="login.php">Login</a></li>';
        }
        ?>
            </ul>
          </header>
        <div class="container initial">
            <lottie-player src="https://assets9.lottiefiles.com/temp/lf20_nXwOJj.json"  background="transparent"  speed="1"  style="height: 200px;"  loop  autoplay></lottie-player>
            <h1 class="brand"><?php
            if (isset($_SESSION['username'])) {
                echo 'Welcome, ' . $_SESSION['username'];
            } else {
                echo "What's your Dish?";
            }
            ?></h1>
            <form>
                <input type="text" placeholder="Search Your Recipe...">
                <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_tnrzlN.json" mode="bounce" background="transparent"  speed="1"  style="width: 80px; height: 80px;"  loop  autoplay></lottie-player>
                <!--<ion-icon name="search"></ion-icon>-->
            </form>
            <div class="search-result">
                <!--   
                <div class="item">
                    <img src="./assets/amirali-mirhashemian-sc5sTPMrVfk-unsplash.jpg" alt="">
                    <div class="flex-container">
                    <h1 class="title">This is a recipe item</h1>
                    <a class="view-btn" href="#">View Recipe</a>
                    </div>
                    <p class="item-data">Calories: 120</p>
                </div>
                -->
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="assets/script.js"></script>
</body>
</html>