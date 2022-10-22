<?php
    include "./vendor/autoload.php";
    session_start();
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
            <a class="img" href="./index.php"><img src="./assets/icons/icon.png"></a>

            <nav>
                <ul>
                    <li><a href="./index.php">Inicio</a></li>

                    <?php if (!isLogin()) { ?>
                        <li><a id="actual" href="./login.php">Iniciar Sesión</a></li>
                        <li><a href="./register.php">Registrarse</a></li>
                    <?php } else { ?>
                        <li><a href="./play.php">Jugar</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </header>

        <main>
            <div class="login">
                <h1>Iniciar Sesión</h1>

                <form action="./login.php" method="post">
                    <div>
                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" name="username" maxlength="25" required>
                    </div>

                    <div>
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" maxlength="255" required>
                    </div>

                    <div>
                        <input type="submit" name="login" value="Iniciar Sesión">
                        <input type="reset" value="Cancelar">
                    </div>

                    <div>
                        <a href="./register.php"><input type="button" value="Registrarse"></a>
                    </div>
                </form>

                <?php
                    if (isset($_POST["login"])) $_SESSION["user"] = login();

                    if (isLogin()) {
                        header("Location: ./play.php");
                        exit();
                    }
                ?>

                <div class="cards">
                    <?php getCardsAmount(20); ?>
                </div>
            </div>
        </main>
    </body>
</html>
