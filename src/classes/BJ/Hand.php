<?php

namespace Casino\Classes\BJ;
use Casino\Classes\Cards\Card;

/**
 * Clase que define una mano de BlackJack
 */
class Hand {
    private int $bet;
    private int $score;
    private array $cards;
    private bool $playing;
    private bool $invalidScore;

    /**
     * Constructor de la mano
     *
     * @param int $bet Cantidad de fichas apostadas
     */
    public function __construct(int $bet) {
        $this -> bet = $bet;
        $this -> score = 0;
        $this -> cards = [];
        $this -> playing = true;
        $this -> invalidScore = false;
    }

    /**
     * Obtiene la cantidad apostada
     *
     * @return int
     */
    public function getBet(): int {
        return $this -> bet;
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
     * Obtiene las cartas que tiene el jugador en la mano
     *
     * @return array
     */
    public function getCards(): array {
        return $this -> cards;
    }

    /**
     * Muestra las cartas del jugador
     *
     * @return void
     */
    public function showCards(): void {
        foreach ($this -> cards as $card) $card -> showGame();
    }

    /**
     * Obtiene el numero de cartas que tiene el jugador en la mano
     *
     * @return int
     */
    public function getCardsCount(): int {
        return count($this -> cards);
    }

    /**
     * Obtiene si el jugador sigue jugando
     *
     * @return bool
     */
    public function getPlaying(): bool {
        return $this -> playing;
    }

    /**
     * Modifica si el jugador sigue jugando
     *
     * @return void
     */
    public function setPlaying(bool $status): void {
        $this -> playing = $status;
    }

    /**
     * Devuelve si el jugador a perdido pasándose de 21
     *
     * @return bool
     */
    public function getInvalidScore(): bool {
        return $this -> invalidScore;
    }

    /**
     * Añade una carta dada a la mano
     *
     * @param Card $card Carta a añadir a la mano
     * @return void
     */
    public function addCard(Card $card): void {
        $this -> cards[] = $card;
        $this -> addScore($card -> getValue());
    }

    /**
     * Añade a la puntuación el valor de la carta
     *
     * @param string $value Valor de la carta
     * @return void
     */
    private function addScore(string $value): void {
        if ($value < 11) $this -> score += $value;
        if ($value == "J" || $value == "Q" || $value == "K") $this -> score += 10;
        if ($value == "A") $this -> score += 11;

        foreach ($this -> cards as $card) {
            if ($card -> getValue() == "A" && !$card -> getCheck() && $this -> score > 21) {
                $this -> score -= 10;
                $card -> check();
            }
        }

        if ($this -> score > 21) {
            $this -> playing = false;
            $this -> invalidScore = true;
        }
    }

    /**
     * Comprueba si el jugador gana o pierde la mano
     *
     * @param int $crupierScore Puntuación del crupier
     * @return int
     */
    public function check(int $crupierScore): int {
        if ($crupierScore < $this -> score && !($this -> invalidScore)) return $this -> win();
        
        return $this -> lose($crupierScore);
    }

    /**
     * Si se cumple BlackJack devuelve la apuesta 3 a 2, si no devuelve el doble de lo apostado
     *
     * @return int
     */
    private function win(): int {
        if ($this -> score == 21 && $this -> getCardsCount() == 2) return floor($this -> bet * 2.5);

        return $this -> bet * 2;
    }

    /**
     * Si la puntuación de la mano es menor a la del crupier se devolverán cero fichas, si es igual, se devolverá lo apostado
     *
     * @param int $crupierScore Puntuación del crupier
     * @return int
     */
    private function lose(int $crupierScore): int {
        if ($crupierScore == $this -> score && !($this -> invalidScore)) return $this -> bet;

        return 0;
    }
}

?>