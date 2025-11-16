<?php
require_once 'include/funciones.php';
include 'include/header.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $captcha = $_POST['captcha'] ?? '';
    // password rules: min 8, at least 1 digit, 1 uppercase, 1 special
    if (!validate_captcha($captcha)) {
        $message = 'Captcha incorrecto.';
		$captcha_question = generate_captcha();
    } elseif (strlen($password) < 8 || !preg_match('/\d/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
        $message = 'La contraseña debe tener mínimo 8 caracteres, al menos 1 número, 1 mayúscula y 1 caracter especial.';
    } else {
        $existing = user_by_email($email);
        if ($existing) {
            $message = 'Usuario ya registrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare('INSERT INTO USUARIOS (nombre,apellido,correo,estado,perfil,contrasena) VALUES (?,?,?,?,?,?)');
            $estado = 'PENDIENTE';
            $perfil = 'USUARIO';
            $stmt->bind_param('ssssss',$nombre,$apellido,$email,$estado,$perfil,$hash);
            if ($stmt->execute()) {
				  echo "<script>
            alert('Usuario Registrado');
            window.location='login.php';
          </script>";
    exit;
            } else {
                $message = 'Error al registrar: ' . $stmt->error;
            }
        }
    }
} else {
    // Generar captcha solo la primera vez que entras a login
    $captcha_question = generate_captcha();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title">Registro de usuario</h3>
          <?php if($message): ?><div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
          <form method="post" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">Nombre</label><input name="nombre" required class="form-control"></div>
              <div class="col-md-6 mb-3"><label class="form-label">Apellido</label><input name="apellido" class="form-control"></div>
            </div>
            <div class="mb-3"><label class="form-label">Correo</label><input name="email" required type="email" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Contraseña</label><input name="password" required type="password" class="form-control"></div>
			<label class="form-label">Resuelva: <?php echo $_SESSION['captcha_question'] ?? $captcha_question; ?></label>
			<input name="captcha" required class="form-control"></div>
            <div class="d-flex justify-content-between">
              <a href="login.php" class="btn btn-link">Volver al login</a>
              <button class="btn btn-success">Solicitar registro</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php include 'include/footer.php'; ?>
    </body>
</html>

