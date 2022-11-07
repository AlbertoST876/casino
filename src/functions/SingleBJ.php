<?php

use Casino\Classes\DB;
use Casino\Classes\BJ\Player;
use Casino\Classes\BJ\SingleTable;

/**
 * Inicia una nueva mesa
 *
 * @return SingleTable
 */
function newSingleTableBJ(): SingleTable {
    return new SingleTable(new Player($_SESSION["user"]));
}

/**
 * Actualiza las fichas del jugador en la base de datos
 *
 * @return void
 */
function updateChipsDB(): void {
    $connect = new DB();
    $connect -> Update("UPDATE users SET chips = '" . $_SESSION["user"] -> getChips() . "' WHERE id = '" . $_SESSION["user"] -> getId() . "'");
}

?>