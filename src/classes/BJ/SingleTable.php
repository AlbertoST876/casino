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

    // REVISAR - CÓDIGO ANTIGUO
    public function addCard(): void {
        $deck = array_rand($this -> decks);
        $card = $this -> decks[$deck] -> getRandomCard();

        $this -> cards[] = $card;
        $this -> addScore($card -> getValor());
    }

    private function addScore(string $value): void {
        if ($value == "A") $this -> score += 11;
        if ($value < 11) $this -> score += $value;
        if ($value == "J" || $value == "Q" || $value == "K") $this -> score += 10;

        foreach ($this -> cards as $card) {
            if ($card -> getValor() == "A" && $this -> score > 21) $this -> score -= 10;
        }

        if ($this -> score > 16) {
            $this -> player -> getHand() -> checkScore($this -> score);
        }

        if ($this -> score > 21) {
            $this -> player -> getHand() -> checkScore($this -> score);
        }
    }

    public function getPlayerCard(): void {
        $deck = array_rand($this -> decks);
        
        $this -> player -> giveCard($this -> decks[$deck] -> getRandomCard());
    }
}

?>