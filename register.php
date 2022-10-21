<?php
    include "./vendor/autoload.php";
    session_start();

    if (isLogin()) {
        header("Location: play.php");
        exit();
    }
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="icon" href="./assets/icons/icon.png">
        <title>AlbertoST Informática - Casino - Registro</title>
    </head>

    <body>
        <main>
            <div class="login">
                <h1>Registro</h1>

                <form action="./index.php" method="post">
                    <div>
                        <label for="email">Correo Electrónico:</label>
                        <input type="text" name="email" maxlength="50" required>
                    </div>

                    <div>
                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" name="username" maxlength="25" required>
                    </div>

                    <div>
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" maxlength="255" required>
                    </div>

                    <div>
                        <input type="submit" name="register" value="Registrarse">
                        <input type="reset" value="Cancelar">
                    </div>

                    <div>
                        <a href="./index.php"><input type="button" value="Volver"></a>
                    </div>
                </form>

                <div class="cards">
                    <?php getCardsAmount(20); ?>
                </div>
            </div>
        </main>
    </body>
</html>