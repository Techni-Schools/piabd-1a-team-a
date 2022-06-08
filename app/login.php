<?php
//require_once "config.php";
require_once "functions.php";
$_err = "";
if($_POST){

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

