<?php

namespace Casino\Classes\BJ;
use Casino\Classes\Cards\Card;

/**
 * Clase que define un crupier
 */
class Crupier {
    private array $cards;
    private bool $playing;
    private bool $invalidScore;
    private int $score;
    private int $uncheckedAses;

    /**
     * Constructor del crupier
     */
    public function __construct() {
        $this -> cards = [];
        $this -> playing = true;
        $this -> invalidScore = false;
        $this -> score = 0;
        $this -> uncheckedAses = 0;
    }

    /**
     * Obtiene las cartas que tiene el crupier
     *
     * @return array
     */
    public function getCards(): array {
        return $this -> cards;
    }

    /**
     * Obtiene el numero de cartas que tiene el crupier
     *
     * @return int
     */
    public function getCardsCount(): int {
        return count($this -> cards);
    }

    /**
     * Añade una carta dada a la mano
     *
     * @param Card $card Carta a dar al crupier
     * @return void
     */
    public function giveCard(Card $card): void {
        $this -> cards[] = $card;
        $this -> addScore($card -> getValue());
    }

    /**
     * Muestra las cartas del crupier
     *
     * @return void
     */
    public function showCards(): void {
        foreach ($this -> cards as $card) $card -> showGame();
    }

    /**
     * Obtiene si el crupier sigue jugando
     *
     * @return bool
     */
    public function getPlaying(): bool {
        return $this -> playing;
    }

    /**
     * Devuelve si el crupier a perdido pasándose de 21
     *
     * @return bool
     */
    public function getInvalidScore(): bool {
        return $this -> invalidScore;
    }

    /**
     * Obtiene los puntos ganados con las cartas
     *
     * @return int
     */
    public function getScore(): int {
        return $this -> score;
    }

    /**
     * Añade a la puntuación el valor de la carta
     *
     * @param string $value Valor de la carta
     * @return void
     */
    private function addScore(string $value): void {
        if ($value == "J" || $value == "Q" || $value == "K" || $value == "A") {
            if ($value == "A") {
                $this -> score += 11;
                $this -> uncheckedAses++;
            } else {
                $this -> score += 10;
            }   
        } else {
            $this -> score += $value;
        }

        while ($this -> score > 21 && $this -> uncheckedAses > 0) {
            $this -> score -= 10;
            $this -> uncheckedAses--;
        }

        if ($this -> score > 16) $this -> playing = false;
        if ($this -> score > 21) $this -> invalidScore = true;
    }
}

?>