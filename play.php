<?php
    include "./vendor/autoload.php";
    session_start();
    isUserLogged();

    $user = $_SESSION["user"];
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="icon" href="./assets/icons/icon.png">
        <title>AlbertoST Informática - Casino - Play</title>
    </head>

    <body>
        <main>
            <h1>Bienvenido <?php echo ucfirst($user -> getName()); ?></h1>
        </main>
    </body>
</html>