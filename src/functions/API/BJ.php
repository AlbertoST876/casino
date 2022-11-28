<?php

include "../../../vendor/autoload.php";
use Casino\Classes\DB;

/**
 * Actualiza las fichas del usuario en la base de datos
 *
 * @return void
 */
function updateChips(): void {
    $connect = new DB();
    $connect -> Update("UPDATE users SET chips = '" . $_SESSION["user"] -> getChips() . "' WHERE id = '" . $_SESSION["user"] -> getId() . "'");
}

/**
 * Añade fichas al usuario
 *
 * @param int $amount Cantidad de fichas a añadir
 * @return void
 */
function addChips(int $amount): void {
    $_SESSION["user"] -> addChips($amount);
    updateChipsDB();
}

/**
 * Elimina fichas al usuario
 *
 * @param int $amount Cantidad de fichas a eliminar
 * @return void
 */
function removeChips(int $amount): void {
    $_SESSION["user"] -> removeChips($amount);
    updateChipsDB();
}

$_POST = json_decode(file_get_contents("php://input"), true);

if (isset($_POST["action"]) && isset($_POST["amount"])) {
    if ($_POST["action"] == "check") addChips($_POST["amount"]);
    if ($_POST["action"] == "stake" || $_POST["action"] == "secure") removeChips($_POST["amount"]);
}