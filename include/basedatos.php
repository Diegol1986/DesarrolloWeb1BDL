<?php
// archivo donde se encuentra los datos de la base de datos.
$config = require __DIR__ . '/configuracion.php';
// Instanciacion de la conecion a la base de datos.
$mysqli = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
// Si no se logra realizar la conecion devuelvo un error.
if ($mysqli->connect_errno) {
    die('Error conexion MySQL: ' . $mysqli->connect_error);
}
// Seteo de los caracteres.
$mysqli->set_charset('utf8mb4');
