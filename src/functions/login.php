<?php

use Casino\Classes\DB;
use Casino\Classes\User;

/**
 * Añade un usuario a la Base de Datos
 *
 * @return User|null
 */
function register(): User|null {
    if (empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["password"])) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $email = $connect -> clearString($_POST["email"]);
        $username = $connect -> clearString($_POST["username"]);
        $password = password_hash($connect -> clearString($_POST["password"]), PASSWORD_DEFAULT);

        $result = $connect -> Select("SELECT username FROM users WHERE username = '$username'");

        if (count($result) == 0) {
            $connect -> Insert("INSERT INTO users (username, password, email) VALUES ('$username', '$password' '$email')");
            $result = $connect -> Select("SELECT id, username, password, email, chips FROM users WHERE username = '$username'");

            return new User($result[0]["id"], $result[0]["username"], $result[0]["password"], $result[0]["email"], $result[0]["chips"]);
        } else {
            echo "<p>El nombre de usuario introducido ya existe</p>";
        }
    }

    return null;
}

/**
 * Inicia sesión de un usuario
 *
 * @return User|null
 */
function login(): User|null {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $username = $connect -> clearString($_POST["username"]);
        $password = $connect -> clearString($_POST["password"]);

        $result = $connect -> Select("SELECT id, username, password, email, chips FROM users WHERE username = '$username'");
        
        if (count($result) == 1 && password_verify($password, $result[0]["password"])) {
            $connect -> Update("UPDATE users SET lastAccess = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $result[0]["id"] . "'");

            return new User($result[0]["id"], $result[0]["username"], $result[0]["password"], $result[0]["email"], $result[0]["chips"]);
        } else {
            echo "<p>Tus credenciales son incorrectas, inténtalo de nuevo</p>";
        }
    }

    return null;
}

/**
 * Cierra la sesión de un usuario
 *
 * @return void
 */
function logout(): void {
    unset($_SESSION["user"]);

    header("Location: ./index.php");
    exit();
}

/**
 * Comprueba si un usuario ha iniciado sesión
 *
 * @return bool
 */
function isLogin(): bool {
    return isset($_SESSION["user"]) || !empty($_SESSION["user"]);
}

/**
 * Si el usuario no ha iniciado sesión, lo manda al index
 *
 * @return void
 */
function isUserLogged(): void {
    if (!isLogin()) {
        header("Location: ./index.php");
        exit();
    }
}

?>