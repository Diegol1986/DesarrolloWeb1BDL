<?php
// Inicio de las sesiones en todas las actividades.
session_start();
$config = require __DIR__ . '/configuracion.php';
$timeout = $config['session_timeout'] ?? 300;

// session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    // destruir session por inactividad
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['last_activity'] = time();

require_once __DIR__ . '/basedatos.php';

function is_logged_in() {
    return !empty($_SESSION['user_id']);
}
function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
function require_admin() {
    if (!is_logged_in() || ($_SESSION['perfil'] ?? '') !== 'ADMIN') {
        header('Location: login.php');
        exit;
    }
}

function generate_captcha() {
    $a = rand(1,9);
    $b = rand(1,9);
    $_SESSION['captcha'] = ($a + $b);
    return "$a + $b = ?";
}
function validate_captcha($value) {
    return isset($_SESSION['captcha']) && intval($value) === intval($_SESSION['captcha']);
}

function user_by_email($email) {
    global $mysqli;
    $stmt = $mysqli->prepare('SELECT id,nombre,apellido,correo,estado,perfil,contrasena FROM USUARIOS WHERE correo = ? LIMIT 1');
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc();
}
