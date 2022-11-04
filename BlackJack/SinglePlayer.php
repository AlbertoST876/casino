<?php
    include "../vendor/autoload.php";
    session_start();
    
    if (!isLogin()) {
        header("Location: ../index.php");
        exit();
    }

    $user = $_SESSION["user"];

    if (isset($_POST["reset"])) unset($_SESSION["table"]);
    if (!isset($_SESSION["table"])) $_SESSION["table"] = newSingleBJTable();

    $table = $_SESSION["table"];

    if (isset($_POST["stake"])) playerNewHand();
    if (isset($_POST["spend"])) playerSpend();
    if (isset($_POST["newCard"])) $table -> addPlayerCard();
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" href="../assets/icons/icon.png">
        <title>AlbertoST Informática - Casino - BlackJack</title>
    </head>

    <body>
        <main class="table">
            <div class="crupier">
                <h3>Puntuación Crupier: <?php echo $table -> getCrupier() -> getScore(); ?></h3>
                <?php showCrupierCards(); ?>
            </div>

            <div class="player">
                <?php if (getPlayerHand() != null) { ?>
                    <h3>Puntuación Jugador: <?php echo $table -> getPlayer() -> getHand() -> getScore(); ?></h3>
                    <?php showPlayerCards(); ?>
                <?php } ?>
            </div>

            <div class="buttons">
                <?php if (getPlayerHand() != null) echo $table -> getPlayer() -> getHand() -> getBet(); ?>

                <form action="./singlePlayer.php" method="post">
                    <?php if (getPlayerHand() == null) { ?>
                        <input type="number" name="chips" min="10" max="<?php echo $user -> getChips(); ?>" required>
                        <input type="submit" name="stake" value="Apostar">
                    <?php } else { ?>
                        <input type="submit" name="newCard" value="Pedir carta">
                        <input type="submit" name="spend" value="Pasar">
                    <?php } ?>

                    <?php if ($table -> getCrupier() -> getScore() > 16) { ?>
                        <input type="submit" name="reset" value="Resetear Mesa">
                    <?php } ?>
                </form>
            </div>
        </main>
    </body>
</html>