<?php
session_start();
require_once('ConexPDO.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

$id = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$correo = $_POST['correo'];

$pdo = conectar();
$stmt = $pdo->prepare("UPDATE usuario SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ? WHERE Id_usuario = ?");
$stmt->execute([$nombre, $apellidos, $correo, $id]);

header("Location: Dueño_perfil_usuario.php");
exit();
