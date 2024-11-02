<?php
    session_start();
    session_destroy();

    if(!isset($_COOKIE["c_usuario"]) && !isset($_COOKIE["c_clave"])){
        setcookie("c_usuario","");
        setcookie("c_clave","");
        setcookie("c_idioma", "");
    }

    header("Location:login.php");