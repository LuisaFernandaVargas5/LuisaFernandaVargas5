<?php
$nombremascotaErr = $RazaErr = $edadErr = $emailErr = $SexoErr = $fotoErr = "";
$nombremascota = $Raza = $edad = $email = $Sexo = $comentarios = $fotoRuta = "";

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

  if (empty($_POST["Raza"])) {
    $RazaErr = "La raza es obligatoria";
  } else {
    $Raza = test_input($_POST["Raza"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $Raza)) {
      $RazaErr = "Solo letras y espacios son permitidos";
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

  $comentarios = !empty($_POST["comentarios"]) ? test_input($_POST["comentarios"]) : "";

  if (empty($_POST["Sexo"])) {
    $SexoErr = "El sexo es obligatorio";
  } else {
    $Sexo = test_input($_POST["Sexo"]);
  }

  if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
    $targetDir = "uploads/";
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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario Mascota</title>
  <style>
    body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #cce9f8;
  background-image: url('paw-pattern.jpg');
  background-size: contain;
  margin: 0;
  padding: 40px;
}

h2 {
  color: #e1736f;
  font-size: 28px;
  text-align: center;
  margin-bottom: 20px;
}

form {
  background-color: #fffdf7;
  padding: 30px;
  border-radius: 25px;
  max-width: 500px;
  margin: auto;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

label {
  font-weight: bold;
  display: block;
  margin: 15px 0 5px;
  color: #1a3d7c;
}

input[type="text"],
textarea,
input[type="file"] {
  width: 100%;
  padding: 10px;
  border: 2px solid #ccc;
  border-radius: 12px;
  font-size: 16px;
  background-color: #fefefe;
}

textarea {
  resize: vertical;
  min-height: 80px;
}

input[type="submit"] {
  background-color: #d77a6f;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 15px;
  font-size: 18px;
  cursor: pointer;
  margin-top: 20px;
  width: 100%;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #c86b60;
}

.error {
  color: red;
  font-size: 14px;
}

.pet-options {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.pet-option {
  display: flex;
  flex-direction: column;
  align-items: center;
  cursor: pointer;
}

.pet-option input[type="radio"] {
  display: none;
}

.pet-icon {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background-color: #ffd5d5;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
}

.pet-icon img {
  width: 40px;
  height: 40px;
}

.pet-option input[type="radio"]:checked + .pet-icon {
  outline: 3px solid #1a3d7c;
}

.dog .pet-icon { background-color: #f4c4b3; }
.cat .pet-icon { background-color: #ffddaa; }

  </style>
</head>
<body>

<h2>Registro de Mascota</h2>

<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <label>Tipo de mascota</label>
  <div class="pet-options">
    <label class="pet-option dog">
      <input type="radio" name="tipo" value="perro">
      <div class="pet-icon">
        <img src="dog-icon.png" alt="Perro" />
      </div>
    </label>
    <label class="pet-option cat">
      <input type="radio" name="tipo" value="gato">
      <div class="pet-icon">
        <img src="cat-icon.png" alt="Gato" />
      </div>
    </label>
  </div>

  <label>Nombre de la mascota:</label>
  <input type="text" name="nombre_mascota" value="<?php echo $nombremascota; ?>">
  <span class="error"><?php echo $nombremascotaErr;?></span>

  <label>Raza:</label>
  <input type="text" name="Raza" value="<?php echo $Raza; ?>">
  <span class="error"><?php echo $RazaErr;?></span>

  <label>Edad:</label>
  <input type="text" name="edad" value="<?php echo $edad; ?>">
  <span class="error"><?php echo $edadErr;?></span>

  <label>Email:</label>
  <input type="text" name="email" value="<?php echo $email; ?>">
  <span class="error"><?php echo $emailErr;?></span>

  <label>Sexo:</label>
  <input type="radio" name="Sexo" value="Macho"> Macho
  <input type="radio" name="Sexo" value="Hembra"> Hembra
  <span class="error"><?php echo $SexoErr;?></span><br><br>

  <label>Comentarios:</label>
  <textarea name="comentarios"><?php echo $comentarios; ?></textarea>

  <label>Foto de la mascota:</label>
  <input type="file" name="foto">
  <span class="error"><?php echo $fotoErr;?></span><br><br>

  <input type="submit" value="Enviar">

</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nombremascotaErr && !$RazaErr && !$edadErr && !$emailErr && !$SexoErr && !$fotoErr) {
  echo '
  <div style="
    max-width: 400px;
    margin: 40px auto;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    font-family: Arial, sans-serif;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
  ">';


  if (!empty($fotoRuta)) {
    echo "<img src='$fotoRuta' alt='Foto de la mascota' style='width:100%; height: auto; display: block;'>";
  }

  echo '
    <div style="padding: 20px;">
      <h2 style="margin-top: 0; color: #333;">🐶/🐱 ' . htmlspecialchars($nombremascota) . '</h2>
      <p style="margin: 5px 0;"><strong>📌 Raza:</strong> ' . htmlspecialchars($Raza) . '</p>
      <p style="margin: 5px 0;"><strong>🎂 Edad:</strong> ' . htmlspecialchars($edad) . '</p>
      <p style="margin: 5px 0;"><strong>📧 Contacto:</strong> <a href="mailto:' . htmlspecialchars($email) . '" style="color:#0066cc;">' . htmlspecialchars($email) . '</a></p>
      <p style="margin: 5px 0;"><strong>⚧ Sexo:</strong> ' . htmlspecialchars($Sexo) . '</p>
      <p style="margin-top: 15px;"><strong>📝 Descripción:</strong><br>' . nl2br(htmlspecialchars($comentarios)) . '</p>
    </div>
  </div>';
}
?>


</body>
</html>
