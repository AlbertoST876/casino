<?php

use Casino\Classes\DB;
use Casino\Classes\BJ\Player;
use Casino\Classes\BJ\SingleTable;

function newSingleTableBJ(): SingleTable {
    return new SingleTable(new Player($_SESSION["user"]));
}

?>