<?php
require_once 'include/funciones.php';
include 'include/header.php';
require_login();
?>

<div class="container py-5">
  <div class="card shadow">
    <div class="card-body">
      <h3>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h3>
      <p>Perfil: <?php echo htmlspecialchars($_SESSION['perfil']); ?></p>
    </div>
  </div>
</div>
  <?php include 'include/footer.php'; ?>
    </body>
</html>

