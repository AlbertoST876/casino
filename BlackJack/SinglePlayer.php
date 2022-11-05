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
        $user -> removeChips($_POST["amount"]);
        $table -> getPlayer() -> stake($_POST["amount"]);

        updateChipsDB();

        $table -> addPlayerCard();
        $table -> addCrupierCard();
        $table -> addPlayerCard();
    }

    if (isset($_POST["spend"])) {
        $table -> getPlayer() -> spend();

        while ($table -> getCrupier() -> getScore() < 17) $table -> addCrupierCard();
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

    <body class="game">
        <main class="table">
            <div class="crupier">
                <h1>Crupier</h1>

                <h3>Puntuación: <?php echo $table -> getCrupier() -> getScore(); ?></h3>
                <?php $table -> getCrupier() -> showCards(); ?>
            </div>

            <div class="player">
                <h1>Jugador</h1>

                <?php if ($table -> getPlayer() -> getHand() == null) { ?>
                    <h3>Puntuación: 0</h3>
                    <h3>Apuesta: 0</h3>
                <?php } else { ?>
                    <h3>Puntuación: <?php echo $table -> getPlayer() -> getHand() -> getScore(); ?></h3>
                    <h3>Apuesta: <?php echo $table -> getPlayer() -> getHand() -> getBet(); ?></h3>
                    <?php $table -> getPlayer() -> getHand() -> showCards(); ?>
                <?php } ?>
            </div>

            <hr>

            <div class="controls">
                <?php
                    if ($table -> getPlayer() -> getHand() != null) {
                        if (!$table -> getPlayer() -> getHand() -> getPlaying()) {
                            $reward = $table -> getPlayer() -> getHand() -> check($table -> getCrupier() -> getScore());
    
                            $user -> addChips($reward);
                            $table -> getPlayer() -> addChips($reward);

                            updateChipsDB();

                            if ($reward > $table -> getPlayer() -> getHand() -> getBet()) {
                                echo "<div class='result win'>Has Ganado!!</div>";
                            } elseif ($reward == $table -> getPlayer() -> getHand() -> getBet()) {
                                echo "<div class='result tie'>Has Empatado!!</div>";
                            } else {
                                echo "<div class='result lose'>Has Perdido!!</div>";
                            }
                        }
                    }
                ?>

                <h2>Saldo: <?php echo $table -> getPlayer() -> getChips(); ?></h2>

                <form action="./singlePlayer.php" method="post">
                    <?php if ($table -> getPlayer() -> getHand() == null) { ?>
                        <input type="number" name="amount" value="10" min="10" max="<?php echo $user -> getChips(); ?>" required>
                        <input type="submit" name="stake" value="Apostar">
                    <?php } elseif ($table -> getPlayer() -> getHand() -> getPlaying()) { ?>
                        <input type="submit" name="request" value="Pedir">
                        <input type="submit" name="spend" value="Pasar">
                    <?php } else { ?>
                        <input class="exit" type="submit" name="reset" value="Nueva Partida">
                    <?php } ?>
                </form>

                <a href="../play.php"><input class="exit" type="button" value="Salir"></a>
            </div>
        </main>
    </body>
</html>