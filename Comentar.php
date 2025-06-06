<?php
session_start();
include_once 'ConexPDO.php';
if (!isset($_SESSION['Id_Rol'])) {
    header('Location: Login.php');
    exit();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/materialize.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

<link rel="stylesheet" href="Estilo.css">
    <title>Comentarios</title>
</head>
<body>
    <div class="container">
    <form action="" method="POST">
    <?php
    if (isset($_GET['comentar'])) {
        $comentar = $_GET['comentar'];
        $consulta = "SELECT * FROM publicacion WHERE Id_Publicacion = '$comentar'";
        $conexion = mysqli_connect('localhost','root','','findme_db') or die ('problemas en la conexion');
        $ejecutar = mysqli_query($conexion, $consulta);
        $filas = mysqli_fetch_array($ejecutar);

        $id = $filas['Id_Publicacion'];
        $user = $filas['nombre_usuario'];
        $nombre = $filas['Nombre_Publicacion'];
        $fecha = $filas['Fecha_Publicacion'];
    }
    ?>
<form action="" method="POST">
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-tittle"><?php echo $nombre?></span>
                <p><?php echo $user?></p><br>
                <h6><?php echo $fecha?></h6><br>
            </div>
        </div>
    </div>
</div>

<div>
    <label for="">Comentarios</label>
        <input type="text" name="comentario" id="" placeholder="Ingrese su comentario" maxlength="300" class="validate">
   
    <div>
        <button type="submit" name="subir"><i class="material-icons">chat</i>Postear<i class="material-icons">chat</i></button>
    </div>
    <?php
    if (isset($_POST['subir'])) {
        $comentario = $_POST['comentario'];
        $insertar = "INSERT INTO comentarios(Comentario) VALUES ('$comentario')";
        $resultado = mysqli_query($conexion,$insertar);
        if ($resultado) {
            echo "<script> alert ('Su comentario  ha sido publicado con exito') </script> ";
			echo "<script> windows.open('Comentar.php') </script> ";
        }
    } else {
      echo " <script>alert('Error al subir sus comentarios')</script>";
    }
    
    ?>
    </form>
    </div>
   
</body>
</html>