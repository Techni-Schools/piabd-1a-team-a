<?php
require_once "config.php";
require_once "functions.php";
?>
<?php
session_start();
if(!$_SESSION['logedin']){
    header("Location: login.php");
}
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <?php
    renderLinks();
    ?>
</head>
<body>
<main>
    <h1>Witaj, <b><?php echo $_SESSION['username'] ?></b></h1>
</main>
</body>
</html>
<?php
