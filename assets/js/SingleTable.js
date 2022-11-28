import {Crupier} from "./Crupier.js";
import {Shuffler} from "./Shuffler.js";

export class SingleTable {
    shuffler;
    crupier;
    player;

    constructor(player) {
        this.shuffler = new Shuffler();
        this.crupier = new Crupier();
        this.player = player;
    }

    reset() {
        this.shuffler = new Shuffler();
        this.crupier = new Crupier();
        this.player.reset();
    }

    getShuffler() {
        return this.shuffler;
    }

    getCrupier() {
        return this.crupier;
    }

    getPlayer() {
        return this.player;
    }

    giveCrupierCard() {
        card = this.shuffler.getCard();
        card.showCrupier();

        this.crupier.giveCard(card);
    }

    givePlayerCard() {
        card = this.shuffler.getCard();
        card.showPlayer();

        this.player.getHand().giveCard(card);
    }
}