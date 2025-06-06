<?php
    session_start();
    require_once('ConexPDO.php');

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: Login.php");
        exit();
    }

    $pdo = conectar();
    $id_usuario = $_SESSION['id_usuario'];

    $stmt = $pdo->prepare("SELECT Nombre_Publicacion, descripcion_publicacion, Img_Mascota, Fecha_Publicacion FROM publicacion WHERE Id_Usuario = ? ORDER BY Fecha_Publicacion DESC");
    $stmt->execute([$id_usuario]);
    $publicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Publicaciones - Find Me</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/styles_header.css">
    <link rel="stylesheet" href="CSS/styles_mis_p.css">
</head>
<body>
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
                    <a class="dropdown-item" href="cerrarsesion.php" style="color: red;">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>Mis Publicaciones</h2>
        <?php foreach ($publicaciones as $pub): ?>
            <div class="publicacion">
                <img src="IMAGES/mascotas/<?= htmlspecialchars($pub['Img_Mascota']) ?>" width="120" alt="Imagen de mascota">
                <h3><?= htmlspecialchars($pub['Nombre_Publicacion']) ?></h3>
                <p><?= nl2br(htmlspecialchars($pub['descripcion_publicacion'])) ?></p>
                <small>Publicado el <?= date("d/m/Y", strtotime($pub['Fecha_Publicacion'])) ?></small>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
