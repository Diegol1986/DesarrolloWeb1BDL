<?php
require_once 'include/funciones.php';
include 'include/header.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $captcha = $_POST['captcha'] ?? '';
    if (!validate_captcha($captcha)) {
        $message = 'Captcha incorrecto.';
		 $captcha_question = generate_captcha(); 
    } else {
        $u = user_by_email($email);
        if ($u && password_verify($password, $u['contrasena'])) {
            if ($u['estado'] !== 'ACTIVO') {
                $message = 'Usuario no activo. Contacte al administrador.';
            } else {
                // crear session
                $_SESSION['user_id'] = $u['id'];
                $_SESSION['nombre'] = $u['nombre'];
                $_SESSION['correo'] = $u['correo'];
                $_SESSION['perfil'] = $u['perfil'];
                $_SESSION['last_activity'] = time();
                header('Location: bienvenido.php');
                exit;
            }
        } else {
            $message = 'Credenciales incorrectas.';
        }
    }
} else {
    // Generar captcha solo la primera vez que entras a login
    $captcha_question = generate_captcha();
}
?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title mb-3">Iniciar sesión</h3>
          <?php if($message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
          <?php endif; ?>
          <form method="post" novalidate>
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input required name="email" type="email" class="form-control" />
            </div>
            <div class="mb-3">
              <label class="form-label">Clave</label>
              <input required name="password" type="password" class="form-control" />
            </div>
            <div class="mb-3">
			<label class="form-label">Resuelva: <?php echo $_SESSION['captcha_question'] ?? $captcha_question; ?></label>
              <input required name="captcha" type="text" class="form-control" />
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <a href="registro.php">Solicitar registro</a>
              <a href="reseteo_clave.php">Olvidé mi clave</a>
            </div>
            <div class="mt-3">
              <button class="btn btn-primary w-100">Ingresar</button>
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
