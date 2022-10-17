<?php

namespace BlackJack\Classes;
use BlackJack\Classes\Deck;
use BlackJack\Classes\Card;

class Shuffler {
    private array $decks;

    public function __construct() {
        for ($deck = 0; $deck < 6; $deck++) $this -> decks[] = new Deck();
    }

    public function getDecks(): array {
        return $this -> decks;
    }

    public function getCountCardsDecks(): int {
        $totalCards = 0;

        foreach ($this -> decks as $deck) $totalCards += $deck -> getCountCards();

        return $totalCards;
    }

    public function shufflerDecks(): void {
        foreach ($this -> decks as $deck) $deck -> shuffler();
    }

    public function getRandomCard(): Card|null {
        if ($this -> getCountCardsDecks() != 0) {
            do {
                $deckId = array_rand($this -> decks);
            } while ($this -> decks[$deckId] -> getCountCards() == 0);
            
            return $this -> decks[$deckId] -> getRandomCard();
        }

        return null;
    }
}

?>