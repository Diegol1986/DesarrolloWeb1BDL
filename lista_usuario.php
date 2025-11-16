<?php
require_once 'include/funciones.php';
require_admin();
$estado = $_GET['estado'] ?? '';
$where = '';
if ($estado) {
    $estado = $mysqli->real_escape_string($estado);
    $where = "WHERE estado = '$estado'";
}
$q = "SELECT id,nombre,apellido,correo,estado,perfil,fecha_de_actualizacion FROM USUARIOS $where ORDER BY id DESC";
$rows = $mysqli->query($q);
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Usuarios</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-4">
  <h3>Listado de usuarios</h3>
  <div class="mb-3">
    <form method="get" class="d-flex gap-2">
      <select name="estado" class="form-select" style="width:200px">
        <option value="">Todos</option>
        <option value="PENDIENTE">PENDIENTE</option>
        <option value="ACTIVO">ACTIVO</option>
        <option value="INACTIVO">INACTIVO</option>
      </select>
      <button class="btn btn-secondary">Filtrar</button>
    </form>
  </div>
  <table class="table table-bordered">
    <thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Estado</th><th>Perfil</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php while($r = $rows->fetch_assoc()): ?>
      <tr>
        <td><?php echo $r['id']; ?></td>
        <td><?php echo htmlspecialchars($r['nombre'].' '.$r['apellido']); ?></td>
        <td><?php echo htmlspecialchars($r['correo']); ?></td>
        <td><?php echo htmlspecialchars($r['estado']); ?></td>
        <td><?php echo htmlspecialchars($r['perfil']); ?></td>
        <td>
          <a href="editar_usuario.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
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
