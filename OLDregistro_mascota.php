<?php 

?> 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Mascota Perdida</title>
  <link rel="stylesheet" href="CSS/styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      color: #333;
      padding: 30px;
      text-align: center;
    }
    h2 {
      color: #0066cc;
    }
    form {
      background-color: white;
      display: inline-block;
      padding: 25px 40px;
      border-radius: 10px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
      text-align: left;
    }
    input[type="text"], input[type="file"], textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .error {
      color: red;
      font-size: 0.9em;
    }
    input[type="submit"] {
      background-color: #0066cc;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #004999;
    }

  </style>
</head>
<body>
    <header>
        <div class="container">
            <h2 class="logo">Find Me</h2>
            <nav>
                <ul>
                    <li class="current"><a href="index.html">Inicio</a></li>
                    <li><a href="Login.php">Iniciar Sesión</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>
<h2>Registro de Mascota</h2>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">lo 

<?php
$nombremascotaErr  = $edadErr = $emailErr = $SexoErr = $fotoErr = "";
$nombremascota  = $edad = $email = $Sexo = $Descripcion = $fotoRuta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (empty($_POST["nombre_mascota"])) {
    $nombremascotaErr = "El nombre de la mascota es obligatorio";
  } else {
    $nombremascota = test_input($_POST["nombre_mascota"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nombremascota)) {
      $nombremascotaErr = "Solo letras y espacios son permitidos";
    }
  }

  if (empty($_POST["edad"])) {
    $edadErr = "La edad es obligatoria";
  } else {
    $edad = test_input($_POST["edad"]);
    if (!preg_match("/[0-9]+/", $edad)) {
      $edadErr = "Debe incluir al menos un número entero positivo";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "El email es obligatorio";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato de email inválido";
    }
  }

  $Descripcion = !empty($_POST["Descripcion"]) ? test_input($_POST["Descripcion"]) : "";

  if (empty($_POST["Sexo"])) {
    $SexoErr = "El sexo es obligatorio";
  } else {
    $Sexo = test_input($_POST["Sexo"]);
  }

  if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) mkdir($targetDir, 0755, true);
    $targetFile = $targetDir . basename($_FILES["foto"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
      $fotoErr = "El archivo no es una imagen válida.";
    } elseif ($_FILES["foto"]["size"] > 5000000) {
      $fotoErr = "El archivo es demasiado grande.";
    } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
      $fotoErr = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
    } else {
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
        $fotoRuta = $targetFile;
      } else {
        $fotoErr = "Hubo un error al subir la imagen.";
      }
    }
  } else {
    $fotoErr = "Debe seleccionar una imagen.";
  }

  // Si no hay errores, redirigir
  if (!$nombremascotaErr && !$edadErr && !$emailErr && !$SexoErr && !$fotoErr) {
    $_SESSION['nombremascota'] = $nombremascota;
    $_SESSION['edad'] = $edad;
    $_SESSION['email'] = $email;
    $_SESSION['Sexo'] = $Sexo;
    $_SESSION['Descripcion'] = $Descripcion;
    $_SESSION['fotoRuta'] = $fotoRuta;
    header("Location: publicacion_exitosa.php");
    exit;
  }
}
?>

<form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label>Nombre de la mascota:</label>
  <input type="text" name="nombre_mascota">
  <span class="error"><?php echo $nombremascotaErr; ?></span>

  <label>Descripción:</label>
  <textarea name="Descripcion" placeholder="Raza, características, color, etc."></textarea>

  <label>Foto de la mascota:</label>
  <input type="file" name="foto">
  <span class="error"><?php echo $fotoErr; ?></span>

  <br><br>
  <input type="submit" value="Registrar Mascota">
</form>

</body>
</html>
