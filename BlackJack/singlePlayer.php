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

    if (isset($_POST["spend"])) $user -> spend();
    if (isset($_POST["reset"])) $table -> reset();
    if (isset($_POST["request"])) $table -> addPlayerCard();

    if (isset($_POST["stake"])) {
        if ($user -> stake($_POST["amount"])) {
            updateChipsDB();

            $table -> addPlayerCard();
            $table -> addCrupierCard();
            $table -> addPlayerCard();
        }
    }

    if (isset($_POST["secure"])) {
        if ($user -> secure($_POST["amount"])) updateChipsDB();
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

                <?php
                    if ($user -> getHand() != null) {
                        if (!$user -> getHand() -> getPlaying()) {
                            while ($table -> getCrupier() -> getPlaying()) $table -> addCrupierCard();
                        }
                    }
                ?>

                <h3>Puntuación: <?php echo $table -> getCrupier() -> getScore(); ?></h3>
                <?php $table -> getCrupier() -> showCards(); ?>
            </div>

            <div class="player">
                <h1>Jugador</h1>

                <?php if ($user -> getHand() == null) { ?>
                    <h3>Puntuación: 0</h3>
                    <h3>Apuesta: 0</h3>
                <?php } elseif ($user -> getSecure() != null) { ?>
                    <h3>Puntuación: <?php echo $user -> getHand() -> getScore(); ?></h3>
                    <h3>Apuesta: <?php echo $user -> getHand() -> getBet(); ?></h3>
                    <h3>Seguro: <?php echo $user -> getSecure() -> getBet(); ?></h3>
                    <?php $user -> getHand() -> showCards(); ?>
                <?php } else { ?>
                    <h3>Puntuación: <?php echo $user -> getHand() -> getScore(); ?></h3>
                    <h3>Apuesta: <?php echo $user -> getHand() -> getBet(); ?></h3>
                    <?php $user -> getHand() -> showCards(); ?>
                <?php } ?>
            </div>

            <hr>

            <div class="controls">
                <?php
                    if ($user -> getHand() != null) {
                        if (!$user -> getHand() -> getPlaying()) {
                            $reward = $user -> check($table -> getCrupier() -> getScore());

                            if ($user -> getSecure() != null) $reward += $user -> checkSecure($table -> getCrupier() -> getScore(), $table -> getCrupier() -> getCardsCount());

                            updateChipsDB();

                            if ($reward > $user -> getHand() -> getBet()) {
                                echo "<div class='result win'>Has Ganado!!</div>";
                            } elseif ($reward == $user -> getHand() -> getBet()) {
                                echo "<div class='result tie'>Has Empatado!!</div>";
                            } else {
                                echo "<div class='result lose'>Has Perdido!!</div>";
                            }
                        }
                    }
                ?>

                <h2>Saldo: <?php echo $user -> getChips(); ?></h2>

                <form action="./singlePlayer.php" method="post">
                    <?php if ($user -> getHand() == null) { ?>
                        <input type="number" name="amount" value="10" min="10" max="<?php echo $user -> getChips(); ?>" required>
                        <input type="submit" name="stake" value="Apostar">
                    <?php } elseif ($user -> getHand() -> getPlaying()) { ?>
                        <input type="submit" name="request" value="Pedir">
                        <input type="submit" name="spend" value="Pasar">

                        <?php if ($table -> getCrupier() -> getScore() == 11 && $table -> getCrupier() -> getCardsCount() == 1 && $user -> getSecure() == null) { ?>
                            <div>
                                <input type="number" name="amount" value="0" min="0" max="<?php echo $user -> getChips() < floor($user -> getHand() -> getBet() / 2) ? $user -> getChips() : floor($user -> getHand() -> getBet() / 2); ?>" required>
                                <input type="submit" name="secure" value="Apostar Seguro">
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <input class="exit" type="submit" name="reset" value="Nueva Partida">
                    <?php } ?>
                </form>

                <a href="../play.php"><input class="exit" type="button" value="Salir"></a>
            </div>
        </main>
    </body>
</html>