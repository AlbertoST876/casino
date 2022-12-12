<?php

use Casino\Classes\Cards\Deck;

/**
 * Obtiene todas las cartas de una baraja y las muestra separadas por palos
 *
 * @return void
 */
function getDeckCards(): void {
    $deck = new Deck();
    $cards = $deck -> getCards();

    for ($i = 0; $i < count($cards); $i++) {
        if ($i == 13 || $i == 26 || $i == 39) echo "<br>";

        $cards[$i] -> showNormal();
    }
}

?>