import {Deck} from "./Deck.js";

export class Shuffler {
    decks;

    constructor() {
        this.decks = [];
        
        for (let deck = 0; deck < 6; deck++) this.decks.push(new Deck());
    }

    getDecks() {
        return this.decks;
    }

    shuffleDecks() {
        for (let deck of this.decks) deck.shuffle();
    }

    getCard() {
        let deckId = Math.floor(Math.random() * this.decks.length);
        
        return this.decks[deckId].getRandomCard();
    }
}