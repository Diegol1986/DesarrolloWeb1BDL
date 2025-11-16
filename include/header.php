<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title ?? "Desarrollo Web"; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">DesarroloWeb</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample">
      <ul class="navbar-nav ms-auto">

        <?php if (!empty($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['perfil'] === 'ADMIN'): ?>
                <li class="nav-item"><a class="nav-link" href="admin_autoriza.php">Autorizar usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="lista_usuario.php">Usuarios</a></li>
            <?php endif; ?>

            <li class="nav-item"><a class="nav-link" href="cambio_clave.php">Cambiar clave</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>

        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="registro.php">Registro</a></li>
			<li class="nav-item"><a class="nav-link" href="reseteo_clave.php">Olvide mi Clave</a></li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">

