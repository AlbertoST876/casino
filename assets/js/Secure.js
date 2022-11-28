export class Secure {
    bet;

    constructor(bet) {
        this.bet = bet;
    }

    getBet() {
        return this.bet;
    }

    check(crupierScore, crupierCountCards) {
        if (crupierScore == 21 && crupierCountCards == 2) return this.bet * 3;

        return 0;
    }
}