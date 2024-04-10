<?php
session_start();

// Verificar si la variable de sesión está establecida
if (!isset($_SESSION['correo'])) {
    // Redirigir al usuario al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

// Obtener el correo de la sesión
$correo = $_SESSION['correo'];

// Obtener los datos del usuario desde la base de datos
include("conexion.php");
include("chatbot.php");
$query = "SELECT * FROM usuarios WHERE correo_electronico='$correo'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Mostrar los datos del usuario
echo "Bienvenido, " . $row['nombre_usuario'] . "!";

// Cerrar la conexión
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagina principal</title>
    <link rel="stylesheet" type="text/css" href="estilodash.css">
</head>
<body>
    <h1>Holi</h1>
    <button onclick="location.href='lista_vacunas.php'">Lista vacunas</button>
    <button onclick="location.href='ingreso_vacunacion.php'">Registra tu vacuna</button>
    <button onclick="location.href='grafica_vacunas.php'">Grafica</button>
    <button onclick="confirmarCerrarSesion()">Cerrar sesión</button>

    <script>
        function confirmarCerrarSesion() {
            if (confirm("¿Estás seguro de cerrar sesión?")) {
                location.href = "cerrar_sesion.php";
            }
        }
    </script>
</body>
</html>


