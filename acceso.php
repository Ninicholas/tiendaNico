<?php
    session_start();

    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    if ($usuario == "Nico" && $clave == "1234") {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["clave"] = $clave;

        if(isset($_POST["recordarme"])) {
            setcookie("c_usuario",$usuario, 0);
            setcookie("c_clave", $clave, 0);
        }else{
            setcookie("c_usuario","");
            setcookie("c_clave","");
        }

        header("Location:panel.php");
    } else{
        header("Location:login.php");
    }