<?php
require_once 'ConexPDO.php';
$pdo = conectar(); 

$lugar = $_GET['lugar'] ?? '';
$fecha = $_GET['fecha'] ?? '';
$palabra = $_GET['palabra'] ?? '';

$sql = "SELECT p.*, l.nombre_localidad, l.nombre_barrio 
        FROM publicacion p
        JOIN lugares l ON p.lugar_publicacion = l.Id_lugar
        WHERE 1=1";

$parametros = [];

if (!empty($lugar)) {
    $sql .= " AND (l.nombre_localidad LIKE :lugar_localidad OR l.nombre_barrio LIKE :lugar_barrio)";
    $parametros['lugar_localidad'] = "%$lugar%";
    $parametros['lugar_barrio'] = "%$lugar%";
}
if (!empty($fecha)) {
    $sql .= " AND p.Fecha_Publicacion = :fecha";
    $parametros['fecha'] = $fecha;
}
if (!empty($palabra)) {
    $sql .= " AND (p.Nombre_Publicacion LIKE :palabra1 OR p.descripcion_publicacion LIKE :palabra2)";
    $parametros['palabra1'] = "%$palabra%";
    $parametros['palabra2'] = "%$palabra%";
}

$consulta = $pdo->prepare($sql);

$consulta->execute($parametros);
$publicaciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones - Find Me</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/style_publicaciones.css">
</head>
<body>
    <header>
        <div class="container">
            <h2 class="logo">Find Me</h2>
            <nav>
                <ul>
                    <li class="current"><a href="index.html">Inicio</a></li>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <h1>Publicaciones</h1>
        <form method="GET" class="filtros">
            <input type="text" name="lugar" placeholder="Buscar por lugar" value="<?= htmlspecialchars($lugar) ?>">
            <input type="date" name="fecha" value="<?= htmlspecialchars($fecha) ?>">
            <input type="text" name="palabra" placeholder="Palabras clave" value="<?= htmlspecialchars($palabra) ?>">
            <button type="submit">Filtrar</button>
        </form>

        <div class="lista-publicaciones">
            <?php if ($publicaciones): ?>
                <?php foreach ($publicaciones as $pub): ?>
                    <div class="publicacion">
                        <img src="IMAGES/mascotas/<?= htmlspecialchars($pub['Img_Mascota']) ?>" alt="Imagen de la Mascota">
                        <h3><?= htmlspecialchars($pub['Nombre_Publicacion']) ?></h3>
                        <p><?= nl2br(htmlspecialchars($pub['descripcion_publicacion'])) ?></p>
                        <p><strong>Localidad:</strong> <?= htmlspecialchars($pub['nombre_localidad']) ?>, <?= htmlspecialchars($pub['nombre_barrio']) ?></p>
                        <p><strong>Fecha:</strong> <?= date("d/m/Y", strtotime($pub['Fecha_Publicacion'])) ?></p>
                        <div style="clear: both;"></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron publicaciones con esos filtros.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
