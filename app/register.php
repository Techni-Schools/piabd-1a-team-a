<?php
require_once "config.php";
require_once "functions.php";
$_err = "";
if ($_POST) {
    if ($_POST['password'] == $_POST['rePassword']) {
        $usernameHex = bin2hex($_POST['username']);
        $emailHex = bin2hex($_POST['email']);
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            $_err = "Connection failed: " . $conn->connect_error;
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=UNHEX(?)");
        $stmt->bind_param("s", $usernameHex);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_err = "Nazwa użytkownika zajęta";
        }
        else{
            $stmt = $conn->prepare("INSERT INTO users (username,password,email) VALUES (UNHEX(?),?,UNHEX(?))");
            $stmt->bind_param("sss", $usernameHex,$hash,$emailHex);
            $stmt->execute();
            header("Location: login.php");
        }
        $conn->close();

    } else {
        $_err = "Hasła są niezgodne";
    }
}
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zarejstruj się</title>
    <script src="js/passPower.js"></script>
    <?php
    renderLinks();
    ?>
</head>
<body>
<main>
    <form method="post" class="logregBox">
        <h1>Zarejstruj się</h1>
        <input type="text" value="<?php $_POST['username'] ?>" name="username" placeholder="Nazwa użytkownika...">
        <input type="email" value="<?php $_POST['email'] ?>" name="email" placeholder="E-mail...">
        <input type="password" name="password" placeholder="Hasło..." oninput="checkPassPower(this)">
        <div id="passPowerBox">
            <p id="passPowerInf">Hasło Słabe</p>
        </div>
        <input type="password" name="rePassword" placeholder="Powtórz hasło...">
        <p><a href="login.php">Zaloguj się</a><input value="Zarejstruj się" type="submit"></p>
        <p class="err"><?php echo $_err ?></p>
    </form>
</main>

</body>
</html>

