<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/styles.css">
        <title>Login - FindMe</title>
        <style>
            a{
                text-decoration: none;
            }
        </style>
    </head>
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
    <body style="background: url('IMAGES/bgmascotas.jpeg') no-repeat center center fixed; 
                 background-size: cover; text-align: center; font-family: Arial, sans-serif;">

        <div style="width: 50%; margin: auto; background: rgba(255, 255, 255, 0.85); 
                    padding: 20px; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0,0,0,0.2);">
            
            <h2 style="color: #5a3d8a; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">🔐 Iniciar Sesión</h2>
            
            <form method="POST" action="#">                   
                <table align="center" cellpadding="10">
                    <tr>                              
                        <td><b>E-mail:</b></td>
                        <td><input type="email" name="email" placeholder="Ingrese su correo" required
                                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
                    </tr>
                    <tr>
                        <td><b>Contraseña:</b></td>
                        <td><input type="password" name="clave" placeholder="Ingrese su contraseña" required
                                   style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;"></td>
                    </tr>                           
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Ingresar" name="Ingresar"
                                   style="background: #5a3d8a; color: white; padding: 10px 20px; font-size: 16px; 
                                          border: none; border-radius: 5px; cursor: pointer;">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<?php
include_once 'ConexPDO.php';
session_start();
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('Location: Administrador.php');
            exit;
        case 2:
            header('Location: Buscador.php');
            exit;
        case 3:
            header('Location: Dueño_perfil_usuario.php');
            exit;
    }
}
if (isset($_POST['Ingresar'])) {
    $usuario = $_POST['user_usuario'];
    $correo = $_POST['email'];
    $clave = $_POST['clave'];
    $db = new Database();
    $conn = $db=conectar();
    $query = $conn->prepare('SELECT * FROM usuario WHERE correo_usuario = :email AND contraseña_usuario = :clave');
    $query->execute(['email' => $correo, 'clave' => $clave]);
    $arreglo = $query->fetch(PDO::FETCH_NUM);

    if ($arreglo == true ) {
        $username = $arreglo[4];
        $rol = $arreglo[8];
        $_SESSION['user_usuario'] = $username;
        $_SESSION['rol'] = $rol;
        $_SESSION['correo_usuario'] = $correo;
        $_SESSION['id_usuario'] = $arreglo[0];
        switch ($rol) {
            case 1:
                header('Location: Administrador.php');
                break;
            case 2:
                header('Location: Buscador.php');
                break;
            case 3:
                header('Location: Dueño_perfil_usuario.php');
                break;
            default:
                header('Location: Login.php');
                break;
        }
    } else {
        echo "<script>alert('Correo o contraseña incorrectos');</script>";
    }
}
?>