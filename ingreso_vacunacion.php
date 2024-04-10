<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombreCompleto = $_POST['nombre_completo'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];

    // Verificar los datos en la tabla "personas"
    $query = "SELECT * FROM personas WHERE nombre_completo = '$nombreCompleto' AND fecha_nacimiento = '$fechaNacimiento'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        mysqli_close($con);
        header("Location: registro_vacunas.php");
        exit();
    } else {
        echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Los datos ingresados no coinciden con los registros.</div>';
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ingreso de Vacunación</title>
    
</head>
<body>
    <h1>Ingreso de Vacunación</h1>
    <span>Verifica tus datos para continuar</span>

    <form method="POST" action="">
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" name="nombre_completo" id="nombre_completo" required><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required><br>

        <input type="submit" value="Ingresar">
    </form>
    <button onclick="location.href='registro_persona.php'">Registrar Persona</button>
    <button onclick="location.href='dashboard.php'">Regresar</button>

    <script>
    // Convertir el nombre completo a formato de título (iniciales mayúsculas)
    var nombreCompletoInput = document.getElementById("nombre_completo");
    nombreCompletoInput.addEventListener("input", function() {
        var palabras = nombreCompletoInput.value.toLowerCase().split(" ");
        for (var i = 0; i < palabras.length; i++) {
            palabras[i] = palabras[i].charAt(0).toUpperCase() + palabras[i].slice(1);
        }
        nombreCompletoInput.value = palabras.join(" ");
    });
    </script>
</body>
</html>

