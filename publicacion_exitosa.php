<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>¡Publicación Exitosa!</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eaf7f6;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 50px;
      flex-direction: column;
    }
    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 400px;
      width: 100%;
      text-align: center;
      margin-bottom: 20px;
    }
    .card img {
      width: 100%;
      height: auto;
      display: block;
    }
    .card-content {
      padding: 20px;
    }
    .card-content h2 {
      margin: 0;
      color: #2c3e50;
    }
    .card-content p {
      margin: 8px 0;
      color: #555;
    }
    .card-content a {
      color: #0077cc;
      text-decoration: none;
    }
    .card-content a:hover {
      text-decoration: underline;
    }
    .btn {
      background-color: #0066cc;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      text-decoration: none;
      display: inline-block;
    }
    .btn:hover {
      background-color: #004999;
    }
  </style>
</head>
<body>

<?php
$nombremascota = $_SESSION['nombremascota'] ?? '';
$edad = $_SESSION['edad'] ?? '';
$email = $_SESSION['email'] ?? '';
$Sexo = $_SESSION['Sexo'] ?? '';
$Descripcion = $_SESSION['Descripcion'] ?? '';
$fotoRuta = $_SESSION['fotoRuta'] ?? '';
?>

<div class="card">
  <?php if (!empty($fotoRuta)) { ?>
    <img src="<?php echo $fotoRuta; ?>" alt="Foto de la mascota">
  <?php } ?>
  <div class="card-content">
    <h2>🐶/🐱 <?php echo htmlspecialchars($nombremascota); ?></h2>
    <p><strong>🎂 Edad:</strong> <?php echo htmlspecialchars($edad); ?></p>
    <p><strong>📧 Contacto:</strong> <a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></p>
    <p><strong>⚧ Sexo:</strong> <?php echo htmlspecialchars($Sexo); ?></p>
    <p><strong>📝 Descripción:</strong><br><?php echo nl2br(htmlspecialchars($Descripcion)); ?></p>
  </div>
</div>

<a href="registro_mascota.php" class="btn">Registrar otra mascota</a>

</body>
</html>
