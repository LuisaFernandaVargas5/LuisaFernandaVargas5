<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - FindMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css">
</head>
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

<body>
<header>
    <div class="container">
        <h2 class="logo"><a href="Administrador.php"style="text-decoration: none; color: #ff6f61;">Find Me</a></h2>
        <nav>
            <ul>
                <div class="dropdown">
                    <button class="btn btn-custom" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="current"><a class="dropdown-item" href="Administrador.php"style="text-decoration: none;">Inicio</a></li>
                        <li><a class="dropdown-item" href="cerrarsesion.php" style="color: red; text-decoration: none;">
                            Cerrar Sesión
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                            </svg>
                        </a></li>
                    </ul>
                </div>   
            </ul> 
        </nav>
    </div>
</header>
<section id="showcase" style="background: url('IMAGES/showcase.jpg') no-repeat center center/cover;">
        <div class="overlay">
            <div class="container">
            <h1>Bienvenido Administrador <?php echo $_SESSION['user_usuario']; ?> 🐾</h1>
            </div>
        </div>
    </section>
    <section id="boxes">
        <div class="container">
            <div class="box position-absolute bottom-0 start-0">
                <a href="publicar.php"style="text-decoration: none;">
                <i class="fas fa-dog"></i>
                <h3>Reportar mascota perdida</h3>
                <p>Ayuda a reunir a las familias con sus compañeros peludos.</p></a>
            </div>
            <div class="box position-absolute bottom-0 start-50 translate-middle-x">
                <a href="mascotaencontrada.php" style="text-decoration: none;">
                <i class="fas fa-search-location"></i>
                <h3>Reportar mascota encontrada</h3>
                <p>Informa si has encontrado una mascota perdida.</p></a>
            </div>
            <div class="box position-absolute bottom-0 end-0">
                
                <i class="fas fa-shield-alt"></i>
                <h3>Comunidad activa</h3>
                <p>Conéctate con otros dueños y amantes de los animales.</p>
            </div>

            <div class="box">
            <i class="fas fa-shield-alt">
            <a href="Mostrar.php" style="text-decoration: none;"></i>
            <h3>Revisa a los usuarios</h3>
            <p>Aqui encontraras un registro completo de los usuarios</p></a>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>