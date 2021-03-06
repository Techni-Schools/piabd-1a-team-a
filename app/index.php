<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/indexCss.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/recipePopupV2.css">
    <title>FridgeDatabase</title>
    <script src="js/core.js"></script>
</head>
<body onload="init()">
<div class="modal" id="frame">

</div>
<div class="navbar">
    <img class="logo" src="img/fridge.jpeg" alt="Logo">
    <?php
    session_start();
    if($_SESSION['zalogowany']){
        echo '<a href="favList.php">Lista ulubionych</a> ';
        echo '<a href="recipeManager.php">Menedżer przepisów</a> ';
        echo '<a href="logout.php">Wyloguj się</a>';
    }
    else{
        echo '<a href="login.php">Login</a>';
    }
    ?>
    <!--    TODO navbar-->
</div>
<div class="ingred" id="ingred">

</div>
<div class="recipes">
    <input class="search" type="text" placeholder="Search" oninput="reloadRecipes(this)">
    <hr>
    <!--    <img src="img/recipesTemplate.png" alt="TMP">-->
    <div class="recipesList" id="recipesList">

    </div>
</div>
</body>
</html>