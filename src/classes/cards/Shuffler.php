<?php

namespace Casino\Classes\Cards;
use Casino\Classes\Cards\Deck;
use Casino\Classes\Cards\Card;

/**
 * Clase que define un barajador
 */
class Shuffler {
    private array $decks;

    /**
     * Constructor del barajador
     */
    public function __construct() {
        for ($deck = 0; $deck < 6; $deck++) {
            $this -> decks[] = new Deck();
            $this -> decks[$deck] -> shuffle();
        }
    }

    /**
     * Obtiene las barajas del barajador
     *
     * @return array
     */
    public function getDecks(): array {
        return $this -> decks;
    }

    /**
     * Obtiene una carta aleatoria de una de las barajas del barajador
     *
     * @return Card
     */
    public function getCard(): Card {
        return $this -> decks[array_rand($this -> decks)] -> getRandomCard();
    }
}

?>