<?php

namespace Casino\Classes\BJ;
use Casino\Classes\BJ\Player;
use Casino\Classes\BJ\Crupier;
use Casino\Classes\Cards\Shuffler;

/**
 * Clase que define una mesa de BlackJack de un solo jugador
 */
class SingleTable {
    private Shuffler $shuffler;
    private Crupier $crupier;
    private Player $player;

    /**
     * Costructor de la mesa de BlackJack
     * 
     * @param Player $player Jugador que jugará en la mesa
     */
    public function __construct(Player $player) {
        $this -> shuffler = new Shuffler();
        $this -> crupier = new Crupier();
        $this -> player = $player;
    }

    /**
     * Restablece la mesa para una nueva mano
     *
     * @return void
     */
    public function resetTable(): void {
        $this -> shuffler = new Shuffler();
        $this -> crupier = new Crupier();
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
     * @return Player
     */
    public function getPlayer(): Player {
        return $this -> player;
    }

    /**
     * Da una carta del barajador al jugador
     *
     * @return int
     */
    public function addPlayerCard(): int {
        $card = $this -> shuffler -> getCard();
        $card -> show();

        return $this -> player -> giveCard($card);
    }

    /**
     * Da una carta del barajador al crupier
     *
     * @return int
     */
    public function addCrupierCard(): int {
        $card = $this -> shuffler -> getCard();
        $card -> show();

        $this -> crupier -> giveCard($card);

        return $this -> crupier -> getScore();
    }
}

?>