<?php
if ($_GET) {
    require "config.php";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("DB err");
    }
    $conn->set_charset("utf8");
    switch ($_GET['type']) {
        case "ingredientsList":
            $stmt = $conn->prepare("SELECT i.id as id, i.name as name, ic.id as catId, ic.name as catName from ingredients i, IngredientsCategory ic WHERE i.category=ic.id ORDER BY catName ASC");
            $stmt->execute();
            $lastCat = -1;
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (!($lastCat == -1 || $lastCat == intval($row['catId']))) {
                        echo "<hr>";
                    }
                    if ($lastCat != intval($row['catId'])) {
                        echo "<p class='ingredHead'>" . $row['catName'] . "</p>";
                    }
                    $lastCat = intval($row['catId']);
                    echo "<p class='ingredChild' onclick='setIngred(this)' id='i" . $row['id'] . "'>" . $row['name'] . "</p>";

                }
            }
            break;
        case "recipesList":
            if ($_GET['q'] != "" && intval($_GET['ingred']) != -1) {
                $stmt = $conn->prepare("SELECT r.name as name, r.id as id, r.description as description, r.photo as photo FROM recipes r, ingredientsList iL WHERE r.id=iL.recipe AND iL.ingred = ? AND LOWER(r.name) like CONCAT('%', LOWER(UNHEX(?)),'%')");
                $q = bin2hex($_GET['q']);
                $stmt->bind_param("is", $_GET['ingred'], $q);

            } else if (intval($_GET['ingred']) != -1) {
                $stmt = $conn->prepare("SELECT r.name as name, r.id as id, r.description as description, r.photo as photo FROM recipes r, ingredientsList iL WHERE r.id=iL.recipe AND iL.ingred = ?");
                $stmt->bind_param("i", $_GET['ingred'],);

            } else if ($_GET['q'] != "") {
                $stmt = $conn->prepare("SELECT r.name as name, r.id as id, r.description as description, r.photo as photo FROM recipes r WHERE LOWER(r.name) like CONCAT('%', LOWER(UNHEX(?)),'%')");
                $q = bin2hex($_GET['q']);
                $stmt->bind_param("s", $q);

            } else {
                $stmt = $conn->prepare("SELECT r.name as name, r.id as id, r.description as description, r.photo as photo FROM recipes r");
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="recipe1" onclick="loadRecipe(this)" id="'.$row['id'].'">
            <p class="recipeHead">'.$row['name'].'</p>
            <div class="recipePhoto"><img src="'.$row['photo'].'"></div>
            <div class="recipeDesc"><p>' . $row['description'] . '</p></div>
        </div>';
                }
            }
            break;
    }
    $conn->close();
}
?>