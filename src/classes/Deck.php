<?php

namespace BlackJack\Classes;
use BlackJack\Classes\Card;

class Deck {
    private array $cards;

    public function __construct() {
        for ($stick = 0; $stick < 4; $stick++) {
            for ($value = 0; $value < 13; $value++) {
                $this -> cards[] = new Card($stick, $value);
            }
        }
    }

    public function getCards(): array {
        return $this -> cards;
    }

    public function getCountCards(): int {
        return count($this -> cards);
    }

    public function shuffler(): void {
        shuffle($this -> cards);
    }

    public function getRandomCard(): Card {
        $cardId = array_rand($this -> cards);
        $card = $this -> cards[$cardId];

        unset($this -> cards[$cardId]);

        return $card;
    }
}

?>