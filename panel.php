<?php
session_start();
if (!isset($_SESSION["usuario"]) && !isset($_SESSION["clave"])) {
    header("Location:login.php");
}

$idioma = $_GET['idioma'] ?? $_COOKIE['c_idioma'] ?? 'ES';

if (isset($_GET['idioma'])) {
    setcookie("c_idioma", $idioma, 0);
}

$archivoCategorias = $idioma === "EN" ? "categorias_en.txt" : "categorias_es.txt";
$tituloLista = $idioma === "EN" ? "Product List" : "Lista de Productos";

$categorias = [];
$fp = fopen($archivoCategorias, "r");

if ($fp) {
    while (($linea = fgets($fp)) !== false) {
        list($nombre, $descripcion, $precio) = explode(";", trim($linea));
        $categorias[] = [
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "precio" => $precio
        ];
    }
    fclose($fp);
} else {
    echo "No se pudo abrir el archivo de categorías.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
</head>
<body>
<h1>PANEL PRINCIPAL</h1>
<h2>Bienvenido Usuario: <?php echo $_SESSION["usuario"] ?></h2>

<label>
    <a href="panel.php?idioma=ES">ES (Español)</a> |
    <a href="panel.php?idioma=EN">EN (English)</a>
</label>

<br>
<br>
<a href="cerrarsesion.php">Cerrar Sesión</a>

<h2><?php echo $tituloLista; ?></h2>
<ul>
    <?php foreach ($categorias as $categoria): ?>
        <li>
            <a href="producto.php?item=<?php echo urlencode($categoria['nombre']); ?>">
                <?php echo htmlspecialchars($categoria['nombre']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
