<?php

namespace Casino\Classes;
use Casino\Classes\BJ\Hand;
use Casino\Classes\BJ\Secure;
use Casino\Classes\Cards\Card;

/**
 * Clase que define un usuario
 */
class User {
    private int $id;
    private string $name;
    private string $password;
    private string $email;
    private int $chips;

    private Hand|null $BJ_hand;
    private Secure|null $BJ_secure;

    /**
     * Constructor del usuario
     *
     * @param int $id ID del usuario
     * @param string $name Nombre del usuario
     * @param int $chips Cantidad de fichas del usuario
     */
    public function __construct(int $id, string $name, string $password, string $email, int $chips) {
        $this -> id = $id;
        $this -> name = $name;
        $this -> password = $password;
        $this -> email = $email;
        $this -> chips = $chips;

        $this -> BJ_hand = null;
        $this -> BJ_secure = null;
    }

    /**
     * Devuelve la ID del usuario
     *
     * @return int
     */
    public function getId(): int {
        return $this -> id;
    }

    /**
     * Devuelve el nombre del usuario
     *
     * @return string
     */
    public function getName(): string {
        return $this -> name;
    }

    /**
     * Obtiene la contraseña del usuario
     *
     * @return string
     */
    public function getPassword(): string {
        return $this -> password;
    }

    /**
     * Obtiene el email del usuario
     *
     * @return string
     */
    public function getEmail(): string {
        return $this -> email;
    }

    /**
     * Obtiene la cantidad de fichas del usuario
     *
     * @return int
     */
    public function getChips(): int {
        return $this -> chips;
    }

    /**
     * Establece la cantidad de fichas del usuario 
     *
     * @param int $amount Cantidad de fichas
     * @return void
     */
    public function setChips(int $amount = 1000): void {
        $this -> chips = $amount;
    }

    /**
     * Añade una cantidad de fichas al usuario
     *
     * @param int $amount Cantidad de fichas a añadir
     * @return void
     */
    public function addChips(int $amount): void {
        $this -> chips += $amount;
    }

    /**
     * Quita una cantidad de fichas al usuario
     *
     * @param int $amount Cantidad de fichas a eliminar
     * @return void
     */
    public function removeChips(int $amount): void {
        $this -> chips -= $amount;
    }

    /**
     * Resetea la mano y el seguro del jugador
     *
     * @return void
     */
    public function reset(): void {
        $this -> BJ_hand = null;
        $this -> BJ_secure = null;
    }

    ///////////////
    // BLACKJACK //
    ///////////////

    /**
     * Devuelve la mano del jugador
     *
     * @return Hand|null
     */
    public function getHand(): Hand|null {
        return $this -> BJ_hand;
    }

    /**
     * Devuelve el seguro del jugador
     *
     * @return Secure|null
     */
    public function getSecure(): Secure|null {
        return $this -> BJ_secure;
    }

    /**
     * El jugador hace una apuesta inicial, devuelve true si la apuesta es valida, si no devuelve false
     *
     * @param int $amount Cantidad de fichas que apuesta el jugador
     * @return bool
     */
    public function stake(int $amount): bool {
        if ($amount <= $this -> getChips()) {
            $this -> removeChips($amount);
            $this -> BJ_hand = new Hand($amount);

            return true;
        }

        return false;
    }

    /**
     * El jugador hace un seguro frente a un BlackJack del crupier
     *
     * @param int $amount Cantidad de fichas que asegura el jugador, siempre menor a la mitad apostada anteriormente
     * @return bool
     */
    public function secure(int $amount): bool {
        if ($amount <= $this -> getChips() && $amount <= floor($this -> BJ_hand -> getBet() / 2 )) {
            $this -> removeChips($amount);
            $this -> BJ_secure = new Secure($amount);

            return true;
        }

        return false;
    }

    /**
     * Añade una nueva carta a la mano devolviendo el valor total de la misma
     *
     * @param Card $card Carta que se añade a la mano
     * @return void
     */
    public function giveCard(Card $card): void {
        $this -> BJ_hand -> addCard($card);
    }

    /**
     * Pasa la mano
     *
     * @return void
     */
    public function spend(): void {
        $this -> BJ_hand -> setPlaying(false);
    }

    /**
     * Comprueba la puntuación final con la del crupier y devuelve las fichas ganadas
     *
     * @param int $crupierScore Puntuación del crupier
     * @return int
     */
    public function check(int $crupierScore): int {
        $reward = $this -> BJ_hand -> check($crupierScore);
        $this -> addChips($reward);

        return $reward;
    }

    /**
     * Comprueba la puntuación y la cantidad de cartas del crupier para saber si has ganado el seguro
     *
     * @param int $crupierScore Puntuación del crupier
     * @param int $crupierCountCards Cantidad de cartas del crupier
     * @return int
     */
    public function checkSecure(int $crupierScore, int $crupierCountCards): int {
        $reward = $this -> BJ_secure -> check($crupierScore, $crupierCountCards);
        $this -> addChips($reward);

        return $reward;
    }
}

?>