<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/materialize.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="CSS/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Happy+Monkey&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <title>Registro</title>
</head>
<body style="background: url('IMAGES/bgmascotas.jpeg') no-repeat center center fixed; 
            background-size: cover; text-align: center; font-family: Arial, sans-serif;">
    <header>
        <div class="container">
            <h2 class="logo">Find Me</h2>
            <nav>
                <ul>
                    <li class="current"><a href="index.html">Inicio</a></li>
                    <li><a href="Login.php">Iniciar Sesión</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div style="width: 50%; margin: auto; background: rgba(255, 255, 255, 0.85); 
    padding: 20px; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0,0,0,0.2);">

<h2 style="color: #5a3d8a; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">📝 Registro</h2>

<form action="register.php" method="POST" style="font-size: 18px; color: #333;">
    <table align="center" cellpadding="10">
        <tr>
            <td colspan="2" align="center"><h3>¡Bienvenido a FindMe!</h3></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><p>Por favor, complete el siguiente formulario para registrarse.</p></td>
        </tr>
    </table>
<table align="center" cellpadding="10">
    <tr>                              
        <td><b>Nombre completo:</b></td>
        <td><input type="text" name="Nombre" placeholder="Ingrese su nombre" required
                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
    </tr>    
    <tr>                              
        <td><b>Apellidos completos:</b></td>
        <td><input type="text" name="Apellido" placeholder="Ingrese sus apellidos" required
                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
    </tr>                       
    <tr>                              
        <td><b>E-mail:</b></td>
        <td><input type="email" name="Email" placeholder="Ingrese su correo" required
                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
    </tr>
    <tr>                              
        <td><b>Usuario:</b></td>
        <td><input type="text" name="User" placeholder="Ingrese su usuario" required
                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
    </tr>
    <tr>
        <td><b>Contraseña:</b></td>
        <td><input type="password" name="contraseña1" placeholder="Ingrese su contraseña" required
                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
    </tr> 
    <tr>
        <td><b>Confirmar contraseña:</b></td>
        <td><input type="password" name="contraseña2" placeholder="Repita su contraseña" required
                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
    </tr>  
    <tr>
        <td colspan="2" align="center">
        <select name="rol" id="" required>
            <option  disabled selected value="">Elige tu rol</option>
            <option value="2">Buscador</option>
            <option value="3">Dueño de mascota perdida</option>
        </select>
        </td>
    </tr>                         
    <tr>
        <td colspan="2" align="center">
            <input type="submit" name="Registrarse" value="Registrarse" 
                   style="background: #5a3d8a; color: white; padding: 10px 20px; font-size: 16px; 
                          border: none; border-radius: 5px; cursor: pointer;">
        </td>
    </tr>

</table>
</form>
</div>

</body>
<script>
    $(document).ready(function(){
    $('select').formSelect();
    });
  </script>
</html>


<?php
include_once 'ConexPDO.php';
$conexion = mysqli_connect('localhost', 'root', '', 'findme_db') or die("Error de conexion");
if (isset($_POST['Registrarse'])) {
    if ($_POST['contraseña1'] == $_POST['contraseña2']) {
       $nombre = $_POST['Nombre'];
       $apellido = $_POST['Apellido'];
       $correo = $_POST['Email'];
       $usuario = $_POST['User'];
       $contraseña = $_POST['contraseña2'];
       $rol = $_POST['rol'];

       $insertar = "INSERT INTO usuario (nombre_usuario,apellido_usuario,user_usuario, contraseña_usuario, correo_usuario, Id_Rol) VALUES ('$nombre','$apellido','$usuario','$contraseña','$correo','$rol')";
       $resultado = mysqli_query($conexion, $insertar);
       if ($resultado) {
           echo "<script>alert('Usuario registrado exitosamente');</script>";
           echo "<script>window.location.href = 'Login.php';</script>";
       } else {
           echo "<script>alert('Error al registrar el usuario');</script>";
       }
    }else {
        echo "<script>alert('Error las conntraseñas no son correctas');</script>";
    }
}
    
?>
