import {Card} from "./Card.js";

export class Deck {
    cards;

    constructor() {
        this.cards = [];
        
        for (let suit = 0; suit < 4; suit++) {
            for (let value = 0; value < 13; value++) this.cards.push(new Card(suit, value));
        }
    }

    getCards() {
        return this.cards;
    }

    shuffle() {
        this.cards.sort(Math.random() - 0.5);
    }

    getRandomCard() {
        let cardId = Math.floor(Math.random() * this.cards.length);
        let card = this.cards.splice(cardId, 1);

        return card[0];
    }
}