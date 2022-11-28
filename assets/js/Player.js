import {Hand} from "./Hand.js";

export class Player {
    chips;
    hand;

    constructor(chips) {
        this.chips = chips;
        this.hand = undefined;
    }

    getChips() {
        return this.chips;
    }

    addChips(amount) {
        this.chips += amount;
    }

    removeChips(amount) {
        this.chips -= amount;
    }

    getHand() {
        return this.hand;
    }

    reset() {
        this.hand = undefined;
    }

    stake(amount) {
        if (amount <= this.chips) {
            this.chips -= amount;
            this.hand = new Hand(amount);

            return true;
        }

        return false;
    }

    secure(amount) {
        if (amount <= this.chips && Math.floor(this.hand.getBet() / 2)) {
            this.chips -= amount;
            this.hand.setSecure(amount);

            return true;
        }

        return false;
    }

    giveCard(card) {
        this.hand.giveCard(card);
    }

    spend() {
        this.hand.setPlaying(false);
    }

    check(crupierScore, crupierCountCards) {
        reward = this.hand.check(crupierScore, crupierCountCards);
        this.chips += reward;

        return reward;
    }
}