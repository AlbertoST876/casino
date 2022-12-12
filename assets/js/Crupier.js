export class Crupier {
    score;
    cards;
    playing;
    invalidScore;

    constructor() {
        this.score = 0;
        this.cards = [];
        this.playing = true;
        this.invalidScore = false;
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

    getInvalidScore() {
        return this.invalidScore;
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

        if (this.score > 16) this.playing = false;
        if (this.score > 21) this.invalidScore = true;
    }
}