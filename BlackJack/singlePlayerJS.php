<?php
    include "../vendor/autoload.php";
    session_start();
    
    if (!isLogin()) {
        header("Location: ../index.php");
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
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" href="../assets/icon/icon.png">
        <title>AlbertoST Informática - Casino - BlackJack</title>

        <script type="module">
            import {Player} from "../assets/js/Player.js";
            import {SingleTable} from "../assets/js/SingleTable.js";

            const table = new SingleTable(new Player(<?php $user -> getChips() ?>));

            function stake(amount) {
                if (ST.getPlayer().stake(amount)) {
                    fetch("../src/functions/API/BJ.php", {
                        method: POST,
                        body: JSON.stringify({"action": "stake", "amount": amount})
                    });

                    table.givePlayerCard();
                    table.giveCrupierCard();
                    table.givePlayerCard();
                }
            }

            function secure(amount) {
                if (table.getPlayer().secure(amount)) {
                    fetch("../src/functions/API/BJ.php", {
                        method: POST,
                        body: JSON.stringify({"action": "secure", "amount": amount})
                    });
                }
            }

            function request() {
                table.givePlayerCard();
            }

            function spend() {
                table.getPlayer().spend();
            }

            function reset() {
                table.reset();
            }
        </script>
    </head>

    <body class="game">
        <main class="table">
            <div class="crupier">
                <h1>Crupier</h1>
                <div class="cards"></div>
            </div>

            <div class="player">
                <h1>Jugador</h1>
                <div class="cards"></div>
            </div>

            <hr>

            <div class="controls">
                <a href="../play.php"><input class="exit" type="button" value="Salir"></a>
            </div>
        </main>
    </body>
</html>