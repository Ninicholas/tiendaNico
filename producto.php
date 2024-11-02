<?php
session_start();
if (!isset($_SESSION["usuario"]) && !isset($_SESSION["clave"])) {
    header("Location:login.php");
    exit();
}

$idioma = $_GET['idioma'] ?? $_COOKIE['c_idioma'] ?? 'ES';
$archivoCategorias = $idioma === "EN" ? "categorias_en.txt" : "categorias_es.txt";
$nombreProducto = $_GET['item'] ?? '';

$productoEncontrado = null;

$fp = fopen($archivoCategorias, "r");

if ($fp) {
    while (($linea = fgets($fp)) !== false) {
        list($nombre, $id, $descripcion, $imagen, $precio) = explode(";", trim($linea));
        if ($nombre === $nombreProducto) {
            $productoEncontrado = [
                "nombre" => $nombre,
                "id" => $id,
                "descripcion" => $descripcion,
                "imagen" => $imagen,
                "precio" => $precio
            ];
            break;
        }
    }
    fclose($fp);
}

if (!$productoEncontrado) {
    echo "Producto no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($productoEncontrado['nombre']); ?></title>
    <style>
        img.product-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <h2>Bienvenido Usuario: <?php echo $_SESSION["usuario"] ?></h2>
    <h1><?php echo htmlspecialchars($productoEncontrado['nombre']); ?></h1>
    <img src="<?php echo htmlspecialchars($productoEncontrado['imagen']); ?>" alt="<?php echo htmlspecialchars($productoEncontrado['nombre']); ?>" class="product-image">
    <p>ID: <?php echo $id ?></p>
    <p><?php echo htmlspecialchars($productoEncontrado['descripcion']); ?></p>
    <p>Precio: $<?php echo htmlspecialchars($productoEncontrado['precio']); ?></p>
    <a href="cerrarsesion.php">Cerrar Sesión</a> | <a href="panel.php">Volver al Panel</a>
</body>

</html>