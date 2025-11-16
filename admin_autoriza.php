<?php
require_once 'include/funciones.php';
require_admin();
$message = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $uid = intval($_POST['uid']);
    $action = $_POST['action'] ?? '';
    if ($action === 'activate') {
        $stmt = $mysqli->prepare('UPDATE USUARIOS SET estado = ? WHERE id = ?');
        $s = 'ACTIVO';
        $stmt->bind_param('si',$s,$uid);
        $stmt->execute();
        $message = 'Usuario autorizado.';
    } elseif ($action === 'reject') {
        $stmt = $mysqli->prepare('UPDATE USUARIOS SET estado = ? WHERE id = ?');
        $s = 'INACTIVO';
        $stmt->bind_param('si',$s,$uid);
        $stmt->execute();
        $message = 'Usuario rechazado.';
    }
}
$rows = $mysqli->query("SELECT id,nombre,apellido,correo,estado,perfil FROM USUARIOS WHERE estado = 'PENDIENTE'");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Autorizar usuarios</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-4">
  <h3>Solicitudes de registro</h3>
  <?php if($message): ?><div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
  <table class="table table-striped">
    <thead><tr><th>Nombre</th><th>Correo</th><th>Perfil</th><th>Acción</th></tr></thead>
    <tbody>
    <?php while($r = $rows->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($r['nombre'].' '.$r['apellido']); ?></td>
        <td><?php echo htmlspecialchars($r['correo']); ?></td>
        <td><?php echo htmlspecialchars($r['perfil']); ?></td>
        <td>
          <form method="post" class="d-inline">
            <input type="hidden" name="uid" value="<?php echo $r['id']; ?>">
            <button name="action" value="activate" class="btn btn-sm btn-success">Autorizar</button>
          </form>
          <form method="post" class="d-inline">
            <input type="hidden" name="uid" value="<?php echo $r['id']; ?>">
            <button name="action" value="reject" class="btn btn-sm btn-danger">Rechazar</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
  <a href="bienvenido.php" class="btn btn-link">Volver</a>
</div>
  <?php include 'include/footer.php'; ?>
    </body>
</html>