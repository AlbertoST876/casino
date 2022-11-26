<?php

namespace Casino\Classes\Cards;
use Casino\Classes\Cards\Card;

/**
 * Clase que define una baraja de cartas
 */
class Deck {
    private array $cards;

    /**
     * Constructor de la baraja
     */
    public function __construct() {
        for ($suit = 0; $suit < 4; $suit++) {
            for ($value = 0; $value < 13; $value++) {
                $this -> cards[] = new Card($suit, $value);
            }
        }
    }

    /**
     * Obtiene todas las cartas de la baraja
     *
     * @return array
     */
    public function getCards(): array {
        return $this -> cards;
    }

    /**
     * Baraja todas las cartas de la baraja
     *
     * @return void
     */
    public function shuffle(): void {
        shuffle($this -> cards);
    }

    /**
     * Obtiene una carta aleatoria de la baraja
     *
     * @return Card
     */
    public function getRandomCard(): Card {
        $cardId = array_rand($this -> cards);
        $card = $this -> cards[$cardId];

        unset($this -> cards[$cardId]);

        return $card;
    }
}

?>