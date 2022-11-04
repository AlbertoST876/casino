<?php
    include "../vendor/autoload.php";
    session_start();
    
    if (!isLogin()) {
        header("Location: ../index.php");
        exit();
    }

    if (!isset($_SESSION["table"]) || empty($_SESSION["table"])) $_SESSION["table"] = newSingleTableBJ();

    $user = $_SESSION["user"];
    $table = $_SESSION["table"];

    if (isset($_POST["reset"])) $table -> reset();
    if (isset($_POST["request"])) $table -> addPlayerCard();

    if (isset($_POST["stake"])) {
        $table -> getPlayer() -> stake($_POST["amount"]);

        $table -> addPlayerCard();
        $table -> addCrupierCard();
        $table -> addPlayerCard();
    }

    if (isset($_POST["spend"])) {
        $table -> getPlayer() -> spend();

        while ($table -> getCrupier() -> getScore() < 18) $table -> addCrupierCard();
    }
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
                <?php if ($table -> getPlayer() -> getHand() != null) { ?>
                    <h3>Puntuación Crupier: <?php echo $table -> getCrupier() -> getScore(); ?></h3>
                    <?php $table -> getCrupier() -> showCards(); ?>
                <?php } ?>
            </div>

            <div class="player">
                <?php if ($table -> getPlayer() -> getHand() != null) { ?>
                    <h3>Puntuación Jugador: <?php echo $table -> getPlayer() -> getHand() -> getScore(); ?></h3>
                    <?php $table -> getPlayer() -> getHand() -> showCards(); ?>
                <?php } ?>
            </div>

            <div class="buttons">
                <?php if ($table -> getPlayer() -> getHand() != null) echo $table -> getPlayer() -> getHand() -> getBet(); ?>

                <form action="./singlePlayer.php" method="post">
                    <?php if ($table -> getPlayer() -> getHand() == null) { ?>
                        <input type="number" name="amount" min="10" max="<?php echo $user -> getChips(); ?>" required>
                        <input type="submit" name="stake" value="Apostar">
                    <?php } else { ?>
                        <input type="submit" name="request" value="Pedir">
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