<?php
if ($_GET && $_SESSION['zalogowany']) {
    require "config.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("DB err");
    }
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM fav WHERE user=? AND recipe=?");
    $recipe = intval($_GET['$recipe']);
    $stmt->bind_param("ii",$_SESSION['id'],$recipe);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO fav (user,recipe) VALUES (?,?)");
        $stmt->bind_param("ii",$_SESSION['id'],$recipe);
        $stmt->execute();
        echo "Added";
    }
    else{
        echo "You have it on your list!";
    }
    $conn->close();
}
else{
    echo "login before!";
}