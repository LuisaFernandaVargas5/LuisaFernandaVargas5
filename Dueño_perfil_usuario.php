<?php
    session_start();
    require_once('ConexPDO.php');
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: Login.php");
    exit();
    }

    $pdo = conectar();
    $id_usuario = $_SESSION['id_usuario'];

    $stmt = $pdo -> prepare("SELECT nombre_usuario, apellido_usuario, user_usuario, correo_usuario, img_usuario FROM usuario WHERE Id_usuario = ?");
    $stmt -> execute([$id_usuario]);
    $usuario = $stmt -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/styles_header.css">
    <link rel="stylesheet" href="CSS/styles_perfil.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Dueño - Find Me</title>
</head>
<body style="background: url('IMAGES/BGB.jpg') no-repeat center center fixed">
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
        <div class="perfil-container">
            <div class="sidebar">
                <img src="<?= $usuario['img_usuario'] ?: 'IMAGES/default-profile.png' ?>" alt="Foto de Perfil">
                <h3><?= htmlspecialchars($usuario['nombre_usuario'] . '  ' . htmlspecialchars($usuario['apellido_usuario'])) ?></h3>
                <a href="#">Ver Perfil</a>
                <ul>
                    <li><i class="material-icons">person</i>Cuenta</li>
                    <li><i class="material-icons">vpn_key</i>Cambiar la contraseña</li>
                    <li><i class="material-icons">lock</i>Privacidad</li>
                    <li><i class="material-icons">delete</i>Borrar la cuenta</li>
                </ul>
            </div>
            <div class="main">
                <h2>Cuenta</h2>
                <form action="actualizar_perfil.php" method="POST">
                    <label for="">Usuario</label>
                    <input type="text" name="user" value="<?= htmlspecialchars($usuario['user_usuario']) ?>" readonly>

                    <label for="">Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>">

                    <label for="">Apellido</label>
                    <input type="text" name="apellido" value="<?= htmlspecialchars($usuario['apellido_usuario']) ?>">

                    <label for="">Correo electronico</label>
                    <input type="text" name="correo" value="<?= htmlspecialchars($usuario['correo_usuario']) ?>">

                    <button type="submit">Actualizar Cuenta</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>