<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombreCompleto = $_POST['nombre_completo'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];

    // Validar los datos ingresados
    if (empty($nombreCompleto) || empty($fechaNacimiento) || empty($genero)) {
        echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Por favor, completa todos los campos.</div>';
    } else {
        // Verificar que el género sea válido
        if ($genero !== 'M' && $genero !== 'F' && $genero !== 'O') {
            echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">El género debe ser \'M\', \'F\' o \'O\'.</div>';
        } else {
            // Convertir el nombre completo a formato de título (iniciales mayúsculas)
            $nombreCompleto = ucwords(strtolower($nombreCompleto));

            // Verificar si la persona ya está registrada
            $query = "SELECT COUNT(*) FROM personas WHERE nombre_completo = '$nombreCompleto' AND fecha_nacimiento = '$fechaNacimiento' AND genero = '$genero'";
            $result = mysqli_query($con, $query);
            $count = mysqli_fetch_array($result)[0];

            if ($count > 0) {
                echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Error</div>';
                echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">La persona ya está registrada.</div>';
            } else {
                // Generar un ID para la persona
                $id = uniqid();

                // Insertar los datos en la tabla "personas"
                $query = "INSERT INTO personas (id, nombre_completo, fecha_nacimiento, genero) VALUES ('$id', '$nombreCompleto', '$fechaNacimiento', '$genero')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    mysqli_close($con);
                    header("Location: ingreso_vacunacion.php");
                    exit();
                } else {
                    echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Error al registrar la persona: ' . mysqli_error($con) . '</div>';
                }
            }
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="estiloreg_persona.css">
</head>
<body>
    <h1>Registro</h1>
    <span>Diligencie los datos de la persona que fue vacunada</span>
    <?php
    include("conexion.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $nombreCompleto = $_POST['nombre_completo'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];
        $genero = $_POST['genero'];

        // Validar los datos ingresados
        if (empty($nombreCompleto) || empty($fechaNacimiento) || empty($genero)) {
            echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Por favor, completa todos los campos.</div>';
        } else {
            // Verificar que el género sea válido
            if ($genero !== 'M' && $genero !== 'F' && $genero !== 'O') {
                echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">El género debe ser \'M\', \'F\' o \'O\'.</div>';
            } else {
                // Convertir el nombre completo a formato de título (iniciales mayúsculas)
                $nombreCompleto = ucwords(strtolower($nombreCompleto));

                // Verificar si la persona ya está registrada
                $query = "SELECT COUNT(*) FROM personas WHERE nombre_completo = '$nombreCompleto' AND fecha_nacimiento = '$fechaNacimiento' AND genero = '$genero'";
                $result = mysqli_query($con, $query);
                $count = mysqli_fetch_array($result)[0];

                if ($count > 0) {
                    
                } else {
                    // Generar un ID para la persona
                    $id = uniqid();

                    // Insertar los datos en la tabla "personas"
                    $query = "INSERT INTO personas (id, nombre_completo, fecha_nacimiento, genero) VALUES ('$id', '$nombreCompleto', '$fechaNacimiento', '$genero')";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        mysqli_close($con);
                        header("Location: ingreso_vacunacion.php");
                        exit();
                    } else {
                        echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Error al registrar la persona: ' . mysqli_error($con) . '</div>';
                    }
                }
            }
        }
    }

    mysqli_close($con);
    ?>

    <form method="POST" action="">
        <label for="nombre_completo">Nombre Completo:</label>
        <input type="text" name="nombre_completo" id="nombre_completo" required><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required><br>

        <label for="genero">Género:</label>
<select name="genero" id="genero" required>
    <option value="M">Masculino</option>
    <option value="F">Femenino</option>
    <option value="O">Otro</option>
</select><br>

<input type="submit" value="Registrar">
</form>
<button onclick="location.href='ingreso_vacunacion.php'">Regresar</button>

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
