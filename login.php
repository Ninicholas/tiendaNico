<?php 
    $usuario_recordado = isset($_COOKIE['c_usuario'])? $_COOKIE['c_usuario']:'';
    $clave_recordada = isset($_COOKIE['c_clave'])? $_COOKIE['c_clave']:'';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form method="post" action="acceso.php">
        <label>Usuario</label><br>
        <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario_recordado); ?>" required><br>
        <label>Clave</label><br>
        <input type="password" name="clave" value="<?php echo htmlspecialchars($clave_recordada); ?>" required> <br>
        <input type="checkbox" name="recordarme"> Recordarme <br>
        <br>
        <label> 
            <input type="submit">
        </label>
    </form>


</body>

</html>