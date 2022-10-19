<?php

namespace Casino\Classes\BJ;
use Casino\Classes\BJ\Player;
use Casino\Classes\BJ\Crupier;
use Casino\Classes\Cards\Shuffler;

class SingleTable {
    private Shuffler $shuffler;
    private Crupier $crupier;
    private Player $player;

    public function __construct(Player $player) {
        $this -> shuffler = new Shuffler();
        $this -> crupier = new Crupier();
        $this -> player = $player;
    }

    public function resetTable(): void {
        $this -> shuffler = new Shuffler();
        $this -> crupier = new Crupier();
    }

    public function getShuffler(): Shuffler {
        return $this -> shuffler;
    }

    public function getCrupier(): Crupier {
        return $this -> crupier;
    }

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
            $this -> removeCards();
        }

        if ($this -> score > 21) {
            $this -> removeCards();
            $this -> player -> getHand() -> checkScore($this -> score);
        }
    }

    public function removeCards(): void {
        $this -> score = 0;
        $this -> cards = [];
    }

    public function getPlayerCard(): void {
        $deck = array_rand($this -> decks);
        
        $this -> player -> giveCard($this -> decks[$deck] -> getRandomCard());
    }
}

?>