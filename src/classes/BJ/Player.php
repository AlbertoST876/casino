<?php

namespace Casino\Classes\BJ;
use Casino\Classes\User;
use Casino\Classes\BJ\Hand;
use Casino\Classes\BJ\Secure;
use Casino\Classes\Cards\Card;

/**
 * Clase que define un jugador de BlackJack
 */
class Player extends User {
    private Hand|null $hand;
    private Secure|null $secure;

    /**
     * Constructor del jugador
     */
    public function __construct(User $user) {
        parent::__construct($user -> getId(), $user -> getName(), $user -> getPassword(), $user -> getEmail(), $user -> getChips());

        $this -> hand = null;
        $this -> secure = null;
    }

    /**
     * Resetea la mano y el seguro del jugador
     *
     * @return void
     */
    public function reset(): void {
        $this -> hand = null;
        $this -> secure = null;
    }

    /**
     * Devuelve la mano del jugador
     *
     * @return Hand|null
     */
    public function getHand(): Hand|null {
        return $this -> hand;
    }

    /**
     * Devuelve el seguro del jugador
     *
     * @return Secure|null
     */
    public function getSecure(): Secure|null {
        return $this -> secure;
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
     * El jugador hace un seguro frente a un BlackJack del crupier
     *
     * @param int $amount Cantidad de fichas que asegura el jugador, siempre menor a la mitad apostada anteriormente
     * @return bool
     */
    public function secure(int $amount): bool {
        if ($amount <= $this -> getChips() && $amount <= floor($this -> hand -> getBet() / 2 )) {
            $this -> removeChips($amount);
            $this -> secure = new Secure($amount);

            return true;
        }

        return false;
    }

    /**
     * Añade una nueva carta a la mano devolviendo el valor total de la misma
     *
     * @param Card $card Carta que se añade a la mano
     * @return void
     */
    public function giveCard(Card $card): void {
        $this -> hand -> addCard($card);
    }

    /**
     * Pasa la mano
     *
     * @return void
     */
    public function spend(): void {
        $this -> hand -> setPlaying(false);
    }

    /**
     * Comprueba la puntuación final con la del crupier y devuelve las fichas ganadas
     *
     * @param int $crupierScore Puntuación del crupier
     * @return int
     */
    public function check(int $crupierScore): int {
        $reward = $this -> hand -> check($crupierScore);
        $this -> addChips($reward);

        return $reward;
    }

    public function checkSecure(int $crupierScore, int $crupierCountCards): int {
        $reward = $this -> secure -> check($crupierScore, $crupierCountCards);
        $this -> addChips($reward);

        return $reward;
    }
}

?>