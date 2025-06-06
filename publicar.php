<?php
    session_start();
    require_once('ConexPDO.php');

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: Login.php");
        exit();
    }

    $pdo = conectar();
    $id_usuario = $_SESSION['id_usuario'];

    $stmtUser = $pdo -> prepare("SELECT user_usuario FROM usuario WHERE Id_usuario = ?");
    $stmtUser -> execute([$id_usuario]);
    $usuario = $stmtUser -> fetchColumn();

    $stmtLugar = $pdo -> query("SELECT Id_lugar, nombre_localidad, nombre_barrio FROM lugares");
    $lugares = $stmtLugar -> fetchAll(PDO::FETCH_ASSOC);

    $stmtMascota = $pdo->prepare("SELECT Id_Mascota, Nombre_Mascota, Desc_Mascota, Img_Mascota FROM mascota WHERE Id_Usuario = ?");
    $stmtMascota->execute([$id_usuario]);
    $mascotas = $stmtMascota -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar - Find Me</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/styles_header.css">
    <link rel="stylesheet" href="CSS/styles_publi.css">
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
                    <a class="dropdown-item" href="cerrarsesion.php"  style="color: red;">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>Crear Publicacion</h2>
        <form action="procesar_publicacion.php" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre de la Publicacion:</label><br>
            <input type="text" name="nombre_publicacion" required><br><br>

            <label for="mascota">Mascota Perdida:</label><br>
            <select name="mascotaElec" id="selectMascota" required>
                <?php foreach ($mascotas as $mascota): ?>
                    <option 
                        value="<?= $mascota['Id_Mascota'] ?>"
                        data-desc="<?= htmlspecialchars($mascota['Desc_Mascota']) ?>"
                        data-img="<?= htmlspecialchars($mascota['Img_Mascota']) ?>"
                        data-nombre="<?= htmlspecialchars($mascota['Nombre_Mascota']) ?>"
                    >
                        <?= htmlspecialchars($mascota['Nombre_Mascota']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            
            <?php
                $id_mascota = $mascota['Id_Mascota'];
                $stmtMascDesc = $pdo->prepare("SELECT Nombre_Mascota, Desc_Mascota, Img_Mascota FROM mascota WHERE Id_Mascota = ?");
                $stmtMascDesc->execute([$id_mascota]);
                $mascotaDesc = $stmtMascDesc->fetch(PDO::FETCH_ASSOC);
            ?>

            <label for="descripcion">Descripcion de la Publicacion y Mascota:</label><br>
            <textarea name="descripcion_publicacion" id="descMascota" required></textarea><br><br>

            <label for="img">Imagen de Mascota:</label><br>
            <input type="hidden" name="img_mascota" id="imgMascotaInput">
            <img id="imgMascotaPreview" src="" width="150"><br><br>


            <label for="lugar">Lugar de Perdida:</label><br>
            <select name="lugar_publicacion" id="" required>
                <?php foreach ($lugares as $lugar): ?>
                    <option value="<?= $lugar['Id_lugar'] ?>">
                        <?= $lugar['nombre_localidad'] ?> - <?= $lugar['nombre_barrio'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            
            <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
            <input type="hidden" name="nombre_usuario" value="<?= htmlspecialchars($usuario) ?>">

            <br><br><input type="submit" value="Publicar">
        </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('selectMascota');
            const desc = document.getElementById('descMascota');
            const imgInput = document.getElementById('imgMascotaInput');
            const imgPreview = document.getElementById('imgMascotaPreview');

            function actualizarCampos() {
                const selected = select.options[select.selectedIndex];
                const nombre = selected.dataset.nombre || '';
                const descripcion = selected.dataset.desc || '';
                const img = selected.dataset.img || '';

                desc.value = nombre + " - " + descripcion;
                imgInput.value = img;
                imgPreview.src = img ? 'IMAGES/' + img : '';
            }

            actualizarCampos();

            select.addEventListener('change', actualizarCampos);
        });
    </script>
</body>
</html>