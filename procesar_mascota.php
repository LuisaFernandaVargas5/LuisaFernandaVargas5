<?php
session_start();
include_once('ConexPDO.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_mascota'];
    $descripcion = $_POST['desc_mascota'];
    $imgNombre = $_FILES['img_mascota']['name'];
    $imgTmp = $_FILES['img_mascota']['tmp_name'];
    $imgDestino = 'IMAGES/mascotas/' . basename($imgNombre);

    if (!file_exists('IMAGES/mascotas')) {
        mkdir('IMAGES/mascotas', 0777, true);
    }

    if (move_uploaded_file($imgTmp, $imgDestino)) {
        try {
            $db = conectar();
            $id_usuario = $_SESSION['id_usuario'];

            $stmtInsert = $db->prepare("INSERT INTO mascota (Id_Usuario, Nombre_Mascota, Img_Mascota, Desc_Mascota, Fecha_Mascota, Estado_Mascota) 
                                        VALUES (:Id_usuario, :nombre, :img, :descripcion, NOW(), 1)");
            $stmtInsert->execute([
                'Id_usuario' => $id_usuario,
                'nombre' => $nombre,
                'img' => $imgDestino,
                'descripcion' => $descripcion
            ]);

            echo "<script>alert('Mascota registrada correctamente'); window.location.href = 'mis_mascotas.php';</script>";
        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Error al subir la imagen');</script>";
    }
} else {
    echo "<script>alert('Acceso no válido');</script>";
}
?>
