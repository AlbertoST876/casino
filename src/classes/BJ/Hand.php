<?php

namespace Casino\Classes\BJ;
use Casino\Classes\Cards\Card;

/**
 * Clase que define una mano de BlackJack
 */
class Hand {
    private int $bet;
    private array $cards;
    private bool $playing;
    private bool $invalidScore;
    private int $score;
    private int $uncheckedAses;

    /**
     * Constructor de la mano
     *
     * @param int $bet Cantidad de fichas apostadas
     */
    public function __construct(int $bet) {
        $this -> bet = $bet;
        $this -> cards = [];
        $this -> playing = true;
        $this -> invalidScore = false;
        $this -> score = 0;
        $this -> uncheckedAses = 0;
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
     * Obtiene las cartas que tiene el jugador en la mano
     *
     * @return array
     */
    public function getCards(): array {
        return $this -> cards;
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
     * Añade una carta dada a la mano
     *
     * @param Card $card Carta a añadir a la mano
     * @return void
     */
    public function giveCard(Card $card): void {
        $this -> cards[] = $card;
        $this -> addScore($card -> getValue());
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
        if (($this -> score > $crupierScore || $crupierScore > 21) && !$this -> invalidScore) return $this -> win();
        
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
        if ($this -> score == $crupierScore && !$this -> invalidScore) return $this -> bet;

        return 0;
    }
}

?>