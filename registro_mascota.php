<?php
session_start();
require_once('ConexPDO.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

$pdo = conectar();

$id_usuario = $_SESSION['id_usuario'];

$stmt = $pdo->prepare("SELECT nombre_usuario, correo_usuario FROM usuario WHERE Id_usuario = ?");
$stmt->execute([$id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Mascota - Find Me</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/styles_header.css">
    <link rel="stylesheet" href="CSS/styles_reg_masc.css">
</head>
<body style="background: url('IMAGES/reg.jpg') no-repeat center center fixed">
    <header>
        <div class="container">
            <h2 class="logo">Find Me</h2>
            <div class="dropdown">
                <button class="dropbtn">Mi cuenta</button>
                <div class="dropdown-content">
                    <a href="Dueño_perfil_usuario.php">Mi perfil</a>
                    <a href="registro_mascota.php">Registrar Mascota</a>
                    <a href="mis_mascotas.php">Mis Mascotas</a>
                    <a href="publicar.php">Publicar</a>
                    <a href="mis_publicaciones.php">Mis Publicaciones</a>
                    <a href="publicaciones.php">Todas las Publicaciones</a>
                    <a class="dropdown-item" href="cerrarsesion.php"  style="color: red;">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>Registrar Mascota</h2>
        <form action="procesar_mascota.php" method="POST" enctype="multipart/form-data">
            <label for="nombre_mascota">Nombre de la mascota:</label><br>
            <input type="text" name="nombre_mascota" required><br><br>

            <label for="img_mascota">Imagen de la mascota:</label><br>
            <input type="file" name="img_mascota" accept="IMAGE/*" required><br><br>

            <label for="desc_mascota">Descripción:</label><br>
            <textarea name="desc_mascota" id="desc_mascota" rows="5" cols="40" placeholder="Ej: Hembra; 5 años; Beagle; tamaño mediano; etc." required></textarea><br><br>

            <p><strong>Usuario:</strong> <?= htmlspecialchars($usuario['nombre_usuario']) ?></p>
            <p><strong>Contacto:</strong> <?= htmlspecialchars($usuario['correo_usuario']) ?></p>

            <input type="submit" value="Registrar Mascota">
        </form>
    </main>
</body>
</html>
