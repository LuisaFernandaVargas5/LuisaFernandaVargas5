<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="CSS/styles.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bebas+Neue&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bebas+Neue&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">	
        <title>Login - FindMe</title>
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
if (isset($_SESSION['Id_rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('Location: Administrador.php');
            exit;
        case 2:
            header('Location: Buscador.php');
            exit;
        case 3:
            header('Location: Dueño.php');
            exit;
        default:
            header('Location: Login.php');
            exit;
    }
}
if (isset($_POST['Ingresar'])) {
    $correo = $_POST['email'];
    $clave = $_POST['clave'];
    $db = new Database();
    $query = conectar()->prepare('SELECT * FROM usuario WHERE correo = :email AND contraseña_usuario = :clave');
    $query->execute(['email' => $correo, 'clave' => $clave]);
    $arreglo = $query->fetch(PDO::FETCH_NUM);

    if ($arreglo) {
        $rol = $arreglo[6];
        $_SESSION['Id_rol'] = $rol;
        $_SESSION['correo_usuario'] = $correo;
        switch ($rol) {
            case 1:
                header('Location: Administrador.php');
                exit;
            case 2:
                header('Location: Buscador.php');
                exit;
            case 3:
                header('Location: Dueño.php');
                exit;
            default:
                header('Location: Login.php');
                exit;
        }
    } else {
        echo "<script>alert('Correo o contraseña incorrectos');</script>";
    }
}
?>