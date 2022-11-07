<?php

namespace Casino\Classes\BJ;

/**
 * Clase que define un seguro
 */
class Secure {
    private int $bet;

    /**
     * Constructor del seguro
     *
     * @param int $bet Cantidad de fichas apostada al seguro
     */
    public function __construct(int $bet) {
        $this -> bet = $bet;
    }

    /**
     * Devuelve la cantidad apostada del seguro
     *
     * @return int
     */
    public function getBet(): int {
        return $this -> bet;
    }

    /**
     * Comprueba si se gana el seguro frente al crupier
     *
     * @param int $crupierScore Puntuación del crupier
     * @param int $crupierCountCards Cantidad de cartas que tiene el crupier
     * @return int
     */
    public function check(int $crupierScore, int $crupierCountCards): int {
        if ($crupierScore == 21 && $crupierCountCards == 2) return $this -> bet * 3;

        return 0;
    }
}

?>