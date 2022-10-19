<?php

namespace Casino\Classes\Cards;

/**
 * Clase que define una carta
 */
class Card {
    private int $suit;
    private int $value;
    private static $suits = ["Picas", "Corazones", "Tréboles", "Diamantes"];
    private static $values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

    /**
     * Constructor de la carta
     *
     * @param int $suit ID del Palo de la carta
     * @param int $value ID del Valor de la carta
     */
    public function __construct(int $suit, int $value) {
        $this -> suit = $suit;
        $this -> value = $value;
    }

    /**
     * Obtiene el nombre del Palo de la carta
     *
     * @return string
     */
    public function getSuit(): string {
        return self::$suits[$this -> suit];
    }

    /**
     * Obtiene el Valor de la carta
     *
     * @return string
     */
    public function getValue(): string {
        return self::$values[$this -> value];
    }

    /**
     * Obtiene toda la información sobre la carta
     *
     * @return string
     */
    public function getInfo(): string {
        return $this -> getValue() . " de " . $this -> getSuit();
    }

    /**
     * Muestra en una imagen la carta
     *
     * @return void
     */
    public function show(): void {
        echo "<img src='./assets/img/" . $this -> suit . "-" . $this -> value . ".png'>";
    }
}

?>