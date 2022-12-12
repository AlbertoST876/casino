export class Card {
    suit;
    value;
    check;

    static suits = ["Picas", "Corazones", "Tréboles", "Diamantes"];
    static values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

    constructor(suit, value) {
        this.suit = suit;
        this.value = value;
        this.check = false;
    }

    getInfo() {
        return this.getValue() + " de " + this.getSuit();
    }

    getSuit() {
        return Card.suits[this.suit];
    }

    getValue() {
        return Card.values[this.value];
    }

    getCheck() {
        return this.check;
    }

    check() {
        this.check = true;
    }

    showCrupier() {
        document.querySelector(".crupier .cards").innerHTML += "<img class='card' src='../assets/img/" + this.suit + "-" + this.value + ".png'>";
    }

    showPlayer() {
        document.querySelector(".player .cards").innerHTML += "<img class='card' src='../assets/img/" + this.suit + "-" + this.value + ".png'>";
    }
}