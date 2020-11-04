<?php
    session_start();
    if(!isset($_SESSION['id_user']))
    {
        header("location: systemlogin.cf/index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="shortcut icon" href="./images/acesso.png"/>
    <title>Bem-Vindo!</title>
</head>
<body>
    <div class="container">
        <a href="./index.php"><img src="images/logout.png" id="logout-buttom"></a>
    </div>
</body>
</html>