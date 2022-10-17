<?php

namespace BlackJack\Classes;

class Card {
    private int $suit;
    private int $value;
    private static $suits = ["Picas", "Corazones", "Tréboles", "Diamantes"];
    private static $values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

    public function __construct(int $suit, int $value) {
        $this -> suit = $suit;
        $this -> value = $value;
    }

    public function getSuit(): string {
        return self::$suits[$this -> suit];
    }

    public function getValue(): string {
        return self::$values[$this -> value];
    }
}

?>