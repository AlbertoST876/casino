import {Secure} from "./Secure.js";

export class Hand {
    bet;
    score;
    cards;
    playing;
    invalidScore;

    secure;

    constructor(bet) {
        this.bet = bet;
        this.score = 0;
        this.cards = [];
        this.playing = true;
        this.invalidScore = false;

        this.secure = undefined;
    }

    getBet() {
        return this.bet;
    }

    getScore() {
        return this.score;
    }

    getCards() {
        return this.cards;
    }

    getCardsCount() {
        return this.cards.length;
    }

    getPlaying() {
        return this.playing;
    }

    setPlaying(status) {
        this.playing = status;
    }

    getInvalidScore() {
        return this.invalidScore;
    }

    getSecure() {
        return this.secure;
    }

    setSecure(bet) {
        this.secure = new Secure(bet);
    }

    giveCard(card) {
        this.cards.push(card);
        this.addScore(card.getValue());
    }

    addScore(value) {
        if (value < 11) this.score += value;
        if (value == "J" || value == "Q" || value == "K") this.score += 10;
        if (value == "A") this.score += 11;

        for (let card of this.cards) {
            if (card.getValue() == "A" && !card.getCheck() && this.score > 21) {
                this.score -= 10;
                card.check();
            }
        }

        if (this.score > 21) {
            this.playing = false;
            this.invalidScore = true;
        }
    }

    check(crupierScore, crupierCountCards) {
        reward = 0;
        reward += (this.score > crupierScore || crupierScore > 21) && !this.invalidScore ? this.win() : this.lose(crupierScore);
        reward += this.secure == undefined ? 0 : secure.check(crupierScore, crupierCountCards);

        return reward;
    }

    win() {
        if (this.score == 21 && this.getCardsCount() == 2) return Math.floor(this.bet * 2.5);

        return this.bet * 2;
    }

    lose(crupierScore) {
        if (this.score == crupierScore && !this.invalidScore) return this.bet;

        return 0;
    }
}