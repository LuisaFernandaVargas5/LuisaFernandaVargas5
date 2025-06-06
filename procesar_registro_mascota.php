<?php
    require_once('ConexPDO.php');
    session_start();

    if (!isset($_SESSION['rol'])) {
        header("Location: Login.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pdo = conectar();

        $id_usuario = $_POST['Id_usuario'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $fecha = date("Y-m-d");

        if (!isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
            $nombreImagen = basename($_FILES['img']['name']);
            $rutaDestino = "IMAGES/" . $nombreImagen;

            if (!file_exists('IMAGES')) {
                mkdir('IMAGES',0777,true);
            }

            if (move_uploaded_file($_FILES['img']['tmp_name'], $rutaDestino)) {
                $stmtPub = $pdo -> prepare("INSERT INTO publicacion (Id_usuario, nombre_usuario, Img_Mascota, descripcion_publicacion, Fecha_Publicacion) VALUES (?,?,?,?,?)");
                $stmtPub -> execute([$id_usuario, $nombre, $nombreImagen, $descripcion, $fecha]);

                $id_publicacion = $pdo -> lastInsertId();

                $stmtMascota = $pdo -> prepare("INSERT INTO mascota (Id_Publicacion, Id_Usuario, Nombre_Mascota, Img_Mascota, Desc_mascota Fecha_Mascota) VALUES (?, ?, ?, ?, ?)");
                $stmtMascota -> execute([$id_publicacion, $id_usuario, $nombre, $descripcion, $nombreImagen, $fecha]);

                echo "<p>Mascota registrada exitosamente.</p>";
                echo "<a href='registrar_mascota2.php'>Registrar otra mascota</a>";
            } else {
                echo "<p>Error al subir la imagen.</p>";
            }
        } else {
            echo "<p>No se ha enviado ninguna imagen o ocurrio un error.</p>";
        }
    } else {
        echo "<p>Acceso denegado.</p>";
    }
?>