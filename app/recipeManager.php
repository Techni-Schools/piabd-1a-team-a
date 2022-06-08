<?php
require "config.php";
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("DB err");
}
$_cats = "";
$conn->set_charset("utf8");
$stmt = $conn->prepare("SELECT * FROM IngredientsCategory");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $_cats .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
}
$_ingred = "";
$conn->set_charset("utf8");
$stmt = $conn->prepare("SELECT i.id as id, i.name as name, ic.id as catId, ic.name as catName from ingredients i, IngredientsCategory ic WHERE i.category=ic.id ORDER BY catName ASC");
$stmt->execute();
$result = $stmt->get_result();
$_ingredients = "";
$first = true;
if ($result->num_rows > 0) {
    $arr = 'var listaNazw = [';
    $arr2 = 'var listaIndeks = [';
    while ($row = $result->fetch_assoc()) {
        if (!$first) {
            $arr .= ",";
            $arr2 .= ",";
        }
        $arr .= "'" . $row['name'] . " (" . $row['catName'] . ")'";
        $arr2 .= $row['id'];
        $first = false;
        $_ingredients .= "<option value='" . $row['id'] . "'>" . $row['name'] . " (" . $row['catName'] . ")</option>";
    }
    $arr .= "]";
    $arr2 .= "]";
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/recipeManager.css">
    <title>Add/Remove Recipes</title>
    <script src="js/core.js"></script>
    <script src="js/prodList.js"></script>
    <link rel="stylesheet" type="text/css" href="css/indexCss.css">
    <script>
        <?php
        echo $arr;
        echo "\n";
        echo $arr2;
        ?>
    </script>
</head>
<body onload="loadRecipes()">
<div class="navbar">
    <img class="logo" src="img/fridge.jpeg" alt="Logo">
    <?php
    session_start();
    if ($_SESSION['zalogowany']) {
        echo '<a href="favList.php">Lista ulubionych</a> ';
        echo '<a href="index.php">Strona główna</a> ';
        echo '<a href="logout.php">Wyloguj się</a>';
    } else {
        echo '<a href="login.php">Login</a>';
    }
    ?>
</div>
<div class="myRecipe rec" id="recipesList"> my recipes</div>
<div class="addRecipe rec">
    <form method="get" class="addRecipeForm">
        <h1>Add Recipe</h1>
        <input type="text" name="recipeName" placeholder="Name" class="nameDesc">
        <textarea type="text" name="recipeDesc" placeholder="Description" class="nameDesc"></textarea>
        <input type="text" placeholder="image url" name="recipePhoto"><br>
        <select id="lst">
            <?php
            echo $_ingredients;
            ?>
        </select>
        <input type="hidden" name="ingred" value="" id="formLst">
        <button type="button" onclick="add()">Dodaj skladnik</button>
        <input type="submit" name="submit">
        <p id="lista"></p>
    </form>
</div>
<div class="removeRecipe rec"><h1>Ingred Manager</h1>
    <form action="">
        <input type="text" name="icName" placeholder="Ingred category">
        <button name="addIC">Add</button>
    </form>
    <form action="">
        <input type="text" name="iName" placeholder="Ingred name">
        <select name="ic">
            <?php
            echo $_cats;
            ?>
        </select>
        <button name="addI">Add</button>
    </form>
    <form action="">
        <select name="ic">
            <?php
            echo $_cats;
            ?>
        </select>
        <button name="removeIC">Remove</button>
    </form>
    <form action="">
        <select name="i">
            <?php
            echo $_ingredients;
            ?>
        </select>
        <button name="removeI">Remove</button>
    </form>
</div>

</body>
</html>