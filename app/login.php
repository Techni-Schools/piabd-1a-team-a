<?php
require_once "config.php";
require_once "functions.php";
$_err = "";
if($_POST){
    $usernameHex = bin2hex($_POST['username']);
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("DB err");
    }
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=UNHEX(?)");
    $stmt->bind_param("s",$usernameHex);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if(password_verify($_POST['password'],$row['password'])){
                session_start();
                $_SESSION['zalogowany'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: index.php");
            }
            else{
                $_err = "BAd username or password";
            }
        }
    }
    else{
        $_err = "Bad username or password";
    }
    $conn->close();
}
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zaloguj się</title>
    <?php
    renderLinks();
    ?>
</head>
<body>
<main>
    <form method="post" class="logregBox">
        <h1>Zaloguj się</h1>
        <input type="text" name="username" placeholder="Nazwa użytkownika...">
        <input type="password" name="password" placeholder="Hasło...">
        <p><a href="register.php">Zarejstruj się</a><input type="submit" value="Zaloguj się"></p>
        <p><?php echo $_err ?></p>
    </form>
</main>
</body>
</html>

