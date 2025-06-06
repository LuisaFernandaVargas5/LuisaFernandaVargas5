<?php
require_once 'ConexPDO.php';
$pdo = conectar();

// Validar que el archivo ha sido subido
/* if (!isset($_FILES['img_mascota']) || $_FILES['img_mascota']['error'] !== UPLOAD_ERR_OK) {
    die("Error al subir la imagen.");
}

// Guardar la imagen
$imgNombre = basename($_FILES['img_mascota']['name']);
$imgRutaTemp = $_FILES['img_mascota']['tmp_name'];
$destino = 'uploads/' . $imgNombre;

if (!move_uploaded_file($imgRutaTemp, $destino)) {
    die("Error al mover la imagen.");
} */

// Datos del formulario
$nombrePublicacion = $_POST['nombre_publicacion'];
$descripcion = $_POST['descripcion_publicacion'];
$lugar = $_POST['lugar_publicacion'];
$id_usuario = $_POST['id_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$id_mascota = $_POST['mascotaElec'];
$fecha = date("Y-m-d");

// Obtener imagen de la mascota seleccionada
$stmtImg = $pdo->prepare("SELECT Img_Mascota FROM mascota WHERE Id_Mascota = ?");
$stmtImg->execute([$id_mascota]);
$img = $stmtImg->fetchColumn();

// Verifica que la imagen se haya encontrado
if (!$img) {
    die("Error: No se encontró imagen de la mascota.");
}

// Insertar en la tabla publicacion
$sql = "INSERT INTO publicacion (Id_Usuario, nombre_usuario, lugar_publicacion, Nombre_Publicacion, Img_Mascota, descripcion_publicacion, Fecha_Publicacion)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario, $nombre_usuario, $lugar, $nombrePublicacion, $img, $descripcion, $fecha]);

echo "<script>alert:Publicación creada con éxito. window.history.back();</script>
";

?>
