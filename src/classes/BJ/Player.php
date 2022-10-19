<?php

namespace Casino\Classes\BJ;
use Casino\Classes\User;
use Casino\Classes\BJ\Hand;
use Casino\Classes\Cards\Card;

/**
 * Clase que define un jugador de BlackJack
 */
class Player extends User {
    private Hand $hand;

    /**
     * Devuelve la mano del jugador
     *
     * @return Hand
     */
    public function getHand(): Hand {
        return $this -> hand;
    }

    /**
     * El jugador hace una apuesta inicial, devuelve true si la apuesta es valida, si no devuelve false
     *
     * @param int $amount Cantidad de fichas que apuesta el jugador
     * @return bool
     */
    public function stake(int $amount): bool {
        if ($amount <= $this -> getChips()) {
            $this -> removeChips($amount);
            $this -> hand = new Hand($amount);

            return true;
        }

        return false;
    }

    /**
     * Añade una nueva carta a la mano devolviendo el valor total de la misma
     *
     * @param Card $card Carta que se añade a la mano
     * @return int
     */
    public function giveCard(Card $card): int {
        $this -> hand -> addCard($card);

        return $this -> hand -> getScore();
    }

    /**
     * Pasa la mano
     *
     * @return bool
     */
    public function spend(): bool {
        $this -> hand -> setPlaying(false);

        return false;
    }

    /**
     * Comprueba la puntuación final con la del crupier
     *
     * @param int $crupierScore Puntuación del crupier
     * @return void
     */
    public function check(int $crupierScore): void {
        $this -> addChips($this -> hand -> checkScore($crupierScore));
    }
}

?>