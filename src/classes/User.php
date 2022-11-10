<?php

namespace Casino\Classes;

/**
 * Clase que define un usuario
 */
class User {
    private int $id;
    private string $name;
    private string $password;
    private string $email;
    private int $chips;

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
}

?>