<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body{
            background-color: #e1c5ff;
        }
    </style>
    <title>Registro de los usuarios</title>
    <?php
	session_start();
	include_once 'ConexPDO.php';
	if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) 
        {
            header('Location: Login.php');
            exit();
        }
	$db = new Database();
	$conexion = $db=conectar();
?>
</head>
<body>
    <a href="Administrador.php" style="text-decoration: none; color:black;"><i class="fa-solid fa-backward">Volver</i></a>
    <div class="container">
        <div class="table-responsive">
            <table class="table align-middle border border-dark">
                <tr>
                <th style="background-color: #ffe1c5;">ID</th>
                <th style="background-color: #ffe1c5;">Nombre</th>
                <th style="background-color: #ffe1c5;">Apellido</th>
                <th style="background-color: #ffe1c5;">Estado del usuario</th>
                <th style="background-color: #ffe1c5;">User</th>
                <th style="background-color: #ffe1c5;">Correo</th>
                <th style="background-color: #ffe1c5;">Rol</th>
                <th style="background-color: #ffe1c5;">Editar</th>
                <th style="background-color: #ffe1c5;">Borrar</th>
                </tr>
             <?php
            $usuarios = $conexion->query('SELECT * FROM usuario')->fetchAll(PDO::FETCH_ASSOC);
            foreach($usuarios as $filas){
             ?>
<tr>
    <td style="background-color: #ffc5e3;"><?php echo $filas['Id_usuario']?></td>
    <td style="background-color: #ffc5e3;"><?php echo $filas['nombre_usuario'] ?></td>
    <td style="background-color: #ffc5e3;"><?php echo $filas['apellido_usuario']?></td>
    <td style="background-color: #ffc5e3;"><?php echo $filas ['estado_usuario']?></td>
    <td style="background-color: #ffc5e3;"><?php echo $filas['user_usuario'] ?></td>
    <td style="background-color: #ffc5e3;"><?php echo $filas['correo_usuario']?></td>
    <td style="background-color: #ffc5e3;"><?php switch ($filas['Id_Rol']) {case 1:echo "Administrador";break; case 2:echo "Dueño de una mascota";break;case 3:echo "Buscador de las mascotas";break; default:echo "Error";break;}?></td>
    <td style="background-color: #ffc5e3;"><a href="?editar=<?php echo $filas['Id_usuario']?>"style="text-decoration: none;" >Editar</a></td>
    <td style="background-color: #ffc5e3;"><a href="?borrar=<?php echo $filas['Id_usuario'];?>" style="text-decoration: none;">Borrar</a></td>
</tr>

<?php
	}
?>
</table>
<?php
if (isset($_GET['editar'])) {
    $Editar_Id = $_GET['editar'];
    $stmt = $conexion->prepare('SELECT * FROM usuario WHERE Id_usuario =:id');
    $stmt->bindParam(':id',$Editar_Id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if ($usuario):
?>
<hr>
<div align="center">
<form action="" method="POST">
<input type="hidden" name="id_usuario" value="<?php echo $usuario['Id_usuario']?>">
Nombre <input type="text" name="nombre" value="<?php echo $usuario['nombre_usuario']?>"><br><br>
Apellido <input type="text" name="apellido" value="<?php echo $usuario['apellido_usuario']?>"><br><br>
Estado del usuario <input type="text" name="estado" value="<?php echo $usuario['estado_usuario']?>"><br><br>
Nombre del usuario <input type="text" name="user" value="<?php $usuario['user_usuario']?>"><br><br>
Email <input type="email" name="correo" value="<?php echo$usuario['correo_usuario']?>"><br><br>
Rol <Select name="rol">
    <option value="dissabled">Elige un nuevo rol</option>
    <option value="1">Administrador</option><br>
    <option value="2">Dueño de una mascota</option>
    <option value="3">Buscador de mascota</option>
</Select><br><br>
<center><input type="submit" name="actualizar" value="Actualizar datos"></center>
</form>
</div>
<?php endif;
} 
?> 

<?php
if (isset($_POST['actualizar'])) {
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $estado = $_POST['estado'];
    $user_name = $_POST['user'];
    $email = $_POST['correo'];
    $rol = $_POST['rol'];

    $sql = "UPDATE usuario SET nombre_usuario=:nombre, apellido_usuario=:apellido, estado_usuario=:estado, user_usuario=:user, correo_usuario=:correo, Id_Rol=:rol WHERE Id_usuario = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre',$nombre);
    $stmt->bindParam(':apellido',$apellido);
    $stmt->bindParam(':estado',$estado);
    $stmt->bindParam(':user',$user_name);
    $stmt->bindParam(':correo',$email);
    $stmt->bindParam(':rol',$rol);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo"<script>window.location = 'Mostrar.php';</script>";
}
?>

<?php
if (isset($_GET['borrar'])) {
    $id = $_GET['borrar'];

    echo<<<HTML
    <div align="center">
    <h3>¿Esta seguro de borrar este usuario?</h3>
    <form method="POST">
    <input type="hidden"name="id_usuario" value="$id">
    <input type="submit" class="btn btn-outline-success" name='confirmar' value='Si, borrar'>
    <a href="Mostrar.php"><input type="submit" class="btn btn-outline-danger" name='cancelar' value='Cancelar'></a>
    </form>
    </div>
    HTML;
}
?>
<?php
if (isset($_POST['confirmar'])) {
    $id = $_POST['id_usuario'];
    $stmt = $conexion->prepare('DELETE FROM usuario WHERE Id_usuario =:id');
    $stmt->bindParam(':id',$id);
    $stmt->execute();
     echo"<script>window.location = 'Mostrar.php';</script>";
}
?>
</div>
    </div>
</body>
</html>