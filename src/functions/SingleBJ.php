<?php

use Casino\Classes\Cards\Deck;
use Casino\Classes\Cards\Shuffler;

/**
 * Obtiene el número de cartas indicado del barajador
 *
 * @param int $amount Cantidad de cartas a obtener
 * @return void
 */
function getCardsAmount(int $amount): void {
    $shuffler = new Shuffler();

    for ($i = 0; $i < $amount; $i++) {
        $card = $shuffler -> getCard();
        $card -> show();
    }
}

function getDeckCards(): void {
    $deck = new Deck();
    $cards = $deck -> getCards();

    for ($i = 0; $i < count($cards); $i++) {
        if ($i == 13 || $i == 26 || $i == 39) echo "<br>";

        $cards[$i] -> show();
    }
}

?>