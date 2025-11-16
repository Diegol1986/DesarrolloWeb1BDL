<?php
require_once 'include/funciones.php';
require_login();
$message = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $current = $_POST['current'] ?? '';
    $new = $_POST['new'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    // validar contraseña actual
    $user = user_by_email($_SESSION['correo']);
    if (!$user || !password_verify($current, $user['contrasena'])) {
        $message = 'Clave actual incorrecta.';
    } elseif ($new !== $confirm) {
        $message = 'La nueva clave y la confirmación no coinciden.';
    } elseif (strlen($new) < 8) {
        $message = 'La nueva clave debe tener al menos 8 caracteres.';
    } else {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare('UPDATE USUARIOS SET contrasena = ? WHERE id = ?');
        $stmt->bind_param('si',$hash,$user['id']);
        if ($stmt->execute()) {
            $message = 'Clave actualizada correctamente.';
        } else {
            $message = 'Error al actualizar: ' . $stmt->error;
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Cambiar clave</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center"><div class="col-md-6">
  <div class="card"><div class="card-body">
    <h4>Cambiar clave</h4>
    <?php if($message): ?><div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3"><label>Clave actual</label><input name="current" type="password" class="form-control" required></div>
      <div class="mb-3"><label>Nueva clave</label><input name="new" type="password" class="form-control" required></div>
      <div class="mb-3"><label>Confirmar nueva clave</label><input name="confirm" type="password" class="form-control" required></div>
      <div class="d-flex justify-content-between">
        <a href="bienvenido.php" class="btn btn-link">Volver</a>
        <button class="btn btn-success">Actualizar</button>
      </div>
    </form>
  </div></div></div></div>
</div>
  <?php include 'include/footer.php'; ?>
    </body>
</html>
