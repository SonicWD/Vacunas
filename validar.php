<?php

$correo = $_POST["correo"];
$password = $_POST["password"];
session_start();
$_SESSION['correo'] = $correo;

include("conexion.php");

$namecheckquery = "SELECT correo_electronico, contrasena FROM usuarios WHERE correo_electronico='" . $correo . "';";
$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); // Error 2: Name check failed

if (mysqli_num_rows($namecheck) != 1) {
    // Correo no existe
    echo '<script>alert("El correo no existe"); window.location.href = "index.html";</script>';
    exit();
}

$existinginfo = mysqli_fetch_assoc($namecheck);
$storedPassword = $existinginfo["contrasena"];

if (password_verify($password, $storedPassword)) {
    // Contraseña correcta
    // Redirigir al usuario a dashboard.php
    header("Location: dashboard.php");
    exit();
} else {
    // Contraseña incorrecta
    echo '<script>alert("Contraseña incorrecta"); window.location.href = "index.html";</script>';
    exit();
}

mysqli_close($con);
?>


