<?php

namespace Casino\Classes\BJ;
use Casino\Classes\User;
use Casino\Classes\BJ\Crupier;
use Casino\Classes\Cards\Shuffler;

/**
 * Clase que define una mesa de BlackJack de un solo jugador
 */
class SingleTable {
    private Shuffler $shuffler;
    private Crupier $crupier;
    private User $player;

    /**
     * Constructor de la mesa de BlackJack
     * 
     * @param User $player Jugador que jugará en la mesa
     */
    public function __construct(User $player) {
        $this -> shuffler = new Shuffler();
        $this -> crupier = new Crupier();
        $this -> player = $player;
    }

    /**
     * Restablece la mesa para una nueva mano
     *
     * @return void
     */
    public function reset(): void {
        $this -> shuffler = new Shuffler();
        $this -> crupier = new Crupier();
        $this -> player -> reset();
    }

    /**
     * Obtiene el barajador de la mesa
     *
     * @return Shuffler
     */
    public function getShuffler(): Shuffler {
        return $this -> shuffler;
    }

    /**
     * Obtiene el crupier de la mesa
     *
     * @return Crupier
     */
    public function getCrupier(): Crupier {
        return $this -> crupier;
    }

    /**
     * Obtiene el jugador de la mesa
     *
     * @return User
     */
    public function getPlayer(): User {
        return $this -> player;
    }

    /**
     * Da una carta del barajador al jugador
     *
     * @return void
     */
    public function addPlayerCard(): void {
        $this -> player -> giveCard($this -> shuffler -> getCard());
    }

    /**
     * Da una carta del barajador al crupier
     *
     * @return void
     */
    public function addCrupierCard(): void {
        $this -> crupier -> giveCard($this -> shuffler -> getCard());
    }
}

?>