<?php
    include "./vendor/autoload.php";
    session_start();
    
    if (!isLogin()) {
        header("Location: ./index.php");
        exit();
    }

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
        <header>
            <nav>
                <a class="img" href="./index.php"><img src="./assets/icons/icon.png"></a>
                
                <ul>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a id="actual" href="./play.php">Jugar</a></li>

                    <li class="logout"><a href="./index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Bienvenido <?php echo ucfirst($user -> getName()); ?></h1>

            <div class="deck">
                <?php getDeckCards(); ?>
            </div>
        </main>
    </body>
</html>