<?php

use Casino\Classes\Cards\Shuffler;

function getShufflerCards(): void {
    $shuffler = new Shuffler();
    $decks = $shuffler -> getDecks();

    foreach ($decks as $deck) {
        $cards = $deck -> getCards();

        foreach ($cards as $card) $card -> show();
    }
}

?>