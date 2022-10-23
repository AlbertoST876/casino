<?php
    include "./vendor/autoload.php";
    session_start();

    if (isset($_GET["logout"])) logout();
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="icon" href="./assets/icons/icon.png">
        <title>AlbertoST Informática - Casino - Inicio</title>
    </head>

    <body>
        <header>
            <nav>
                <a class="img" href="./index.php"><img src="./assets/icons/icon.png"></a>

                <ul>
                    <li><a id="actual" href="./index.php">Inicio</a></li>

                    <?php if (!isLogin()) { ?>
                        <li><a href="./login.php">Iniciar Sesión</a></li>
                        <li><a href="./register.php">Registrarse</a></li>
                    <?php } else { ?>
                        <li><a href="./play.php">Jugar</a></li>
                        
                        <li class="logout"><a href="./index.php?logout">Cerrar Sesión</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>
    </body>
</html>