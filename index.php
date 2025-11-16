<?php
$message = '';
include 'include/header.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Iniciando</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title mb-3">Bienvenido a la practica de Desarrollo Web Diego Limaicos</h3>
          <?php if($message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
          <?php endif; ?>
		  
		  
          <form method="post" novalidate>

            <div class="d-flex justify-content-between align-items-center">
              <a href="register.php">Solicitar registro</a>
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
  <?php include 'include/footer.php'; ?>
    </body>
</html>

