<?php
require_once 'include/funciones.php';
require_admin();
$id = intval($_GET['id'] ?? 0);
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'] ?? '';
    $estado = $_POST['estado'] ?? 'PENDIENTE';
    if (isset($_POST['reset'])) {
        $default = password_hash('12345678', PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare('UPDATE USUARIOS SET contrasena = ? WHERE id = ?');
        $stmt->bind_param('si',$default,$id);
        $stmt->execute();
        $msg = 'Clave reseteada a 12345678';
    } else {
        $stmt = $mysqli->prepare('UPDATE USUARIOS SET nombre = ?, estado = ? WHERE id = ?');
        $stmt->bind_param('ssi',$nombre,$estado,$id);
        $stmt->execute();
        $msg = 'Usuario actualizado.';
    }
}
$row = null;
if ($id) {
    $res = $mysqli->query("SELECT id,nombre,apellido,correo,estado FROM USUARIOS WHERE id = $id LIMIT 1");
    $row = $res->fetch_assoc();
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Editar usuario</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-4">
  <h3>Editar usuario</h3>
  <?php if($msg): ?><div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
  <?php if(!$row): ?><div class="alert alert-warning">Usuario no encontrado</div><?php else: ?>
  <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="mb-3"><label>Nombre</label><input name="nombre" class="form-control" value="<?php echo htmlspecialchars($row['nombre']); ?>"></div>
    <div class="mb-3"><label>Estado</label>
      <select name="estado" class="form-select">
        <option value="PENDIENTE" <?php if($row['estado']==='PENDIENTE') echo 'selected';?>>PENDIENTE</option>
        <option value="ACTIVO" <?php if($row['estado']==='ACTIVO') echo 'selected';?>>ACTIVO</option>
        <option value="INACTIVO" <?php if($row['estado']==='INACTIVO') echo 'selected';?>>INACTIVO</option>
      </select>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-primary">Actualizar</button>
      <button name="reset" value="1" class="btn btn-warning" onclick="return confirm('Resetear clave a 12345678?')">Resetear clave</button>
      <a href="reseteo_clave.php" class="btn btn-link">Volver</a>
    </div>
  </form>
  <?php endif; ?>
</div>
  <?php include 'include/footer.php'; ?>
    </body>
</html>
