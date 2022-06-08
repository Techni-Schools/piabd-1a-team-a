<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styleAcc.css">
    <link rel="stylesheet" type="text/css" href="css/indexCss.css">
    <link rel="stylesheet" href="css/recipePopupV2.css">
    <title>Account Settings</title>
    <script src="js/core.js"></script>
</head>
<body onload="renderFav()">
<div class="modal" id="frame">

</div>
<div class="navbar">
    <?php
    session_start();
    if($_SESSION['zalogowany']){
        echo '<a href="index.php">Strona główna</a> ';
        echo '<a href="recipeManager.php">Menedżer przepisów</a> ';
        echo '<a href="logout.php">Wyloguj się</a>';
    }
    else{
        echo '<a href="login.php">Login</a>';
    }
    ?>
</div>
<div class="mainList recipesList" id="listBox">

</div>
</body>
</html>