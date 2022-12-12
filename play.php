<?php
    include "./vendor/autoload.php";
    session_start();
    
    if (!isLogin()) {
        header("Location: ./index.php");
        exit();
    }

    $user = $_SESSION["user"];

    if (isset($_POST["resetChips"])) {
        $user -> setChips(1000);
        updateChipsDB();
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
            <h2>Saldo: <?php echo $user -> getChips(); ?></h2>
            <?php if ($user -> getChips() < 1000) echo "<form action='./play.php' method='post'><input type='submit' name='resetChips' value='Resetear'></form>"; ?>

            <div class="deck">
                <?php getDeckCards(); ?>
            </div>

            <h2>Games</h2>

            <div>
                <h3>BlackJack</h3>
                <p><a href="./BlackJack/singlePlayer.php">SinglePlayer</a></p>
                <p><a href="./BlackJack/singlePlayerJS.php">SinglePlayerJS</a> (En desarrollo)</p>
                <p><a href="./play.php">MultiPlayer</a> (En desarrollo)</p>

                <h3>Poker</h3>
                <p><a href="./play.php">MultiPlayer</a> (En desarrollo)</p>
            </div>
        </main>
    </body>
</html>