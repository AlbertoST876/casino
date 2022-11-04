<?php

use Casino\Classes\DB;
use Casino\Classes\BJ\Hand;
use Casino\Classes\BJ\Player;
use Casino\Classes\BJ\SingleTable;

function newSingleBJTable(): SingleTable {
    return new SingleTable(new Player($_SESSION["user"]));
}

function getPlayerHand(): Hand|null {
    return $_SESSION["table"] -> getPlayer() -> getHand();
}

function playerNewHand(): void {
    $_SESSION["table"] -> getPlayer() -> stake($_POST["chips"]);

    $_SESSION["table"] -> addPlayerCard();
    $_SESSION["table"] -> addCrupierCard();
    $_SESSION["table"] -> addPlayerCard();
}

function playerSpend(): void {
    $_SESSION["table"] -> getPlayer() -> spend();

    while ($_SESSION["table"] -> getCrupier() -> getScore() < 18) {
        $_SESSION["table"] -> addCrupierCard();
    }
}

function showCrupierCards(): void {
    $cards = $_SESSION["table"] -> getCrupier() -> getCards();

    foreach ($cards as $card) $card -> show2();
}

function showPlayerCards(): void {
    $cards = $_SESSION["table"] -> getPlayer() -> getHand() -> getCards();

    foreach ($cards as $card) $card -> show2();
}



?>