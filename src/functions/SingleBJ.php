<?php

use Casino\Classes\Cards\Deck;

/**
 * Obtiene el número de cartas indicado del barajador
 *
 * @param int $amount Cantidad de cartas a obtener
 * @return void
 */
function getCardsAmount(int $amount): void {
    $deck = new Deck();

    for ($i = 0; $i < $amount; $i++) {
        $card = $deck -> getRandomCard();
        $card -> show();
    }
}

?>