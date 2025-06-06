<?php
    session_start();
    require_once('ConexPDO.php');

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: Login.php");
        exit();
    }

    $pdo = conectar();
    $id_usuario = $_SESSION['id_usuario'];

    $stmt = $pdo->prepare("SELECT Nombre_Mascota, Desc_Mascota, Img_Mascota, Fecha_Mascota FROM mascota WHERE Id_Usuario = ?");
    $stmt->execute([$id_usuario]);
    $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Mascotas - Find Me</title>   
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/styles_header.css">
    <link rel="stylesheet" href="CSS/styles_mis_masc.css">
</head>
<body style="background: url('IMAGES/mis_msc.jpg') no-repeat center center fixed;">
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
        <h2>Mis Mascotas</h2>
        <?php foreach ($mascotas as $mascota): ?>
            <div class="mascota-card">
                <img src="<?= htmlspecialchars($mascota['Img_Mascota']) ?>" alt="Mascota">
                <div class="mascota-info">
                    <strong><?= htmlspecialchars($mascota['Nombre_Mascota']) ?></strong>
                    <em><?= htmlspecialchars($mascota['Fecha_Mascota']) ?></em>
                    <p><?= nl2br(htmlspecialchars($mascota['Desc_Mascota'])) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
