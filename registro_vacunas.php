<?php
include("conexion.php");

// Obtener el nombre completo de la tabla "personas"
$query = "SELECT nombre_completo FROM personas";
$result = mysqli_query($con, $query);
$personas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Obtener las vacunas de la tabla "vacunas"
$query = "SELECT * FROM vacunas";
$result = mysqli_query($con, $query);
$vacunas = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombreCompleto = ucwords(strtolower($_POST['nombre_completo']));
    $vacunaId = $_POST['vacuna'];
    $fechaAplicacion = $_POST['fecha_aplicacion'];
    $ciudad = ucwords(strtolower($_POST['ciudad']));
    $departamento = ucwords(strtolower($_POST['departamento']));
    $observaciones = $_POST['observaciones'];

    // Obtener el nombre de la vacuna seleccionada
    $vacunaQuery = "SELECT nombre FROM vacunas WHERE id = ?";
    $vacunaStatement = mysqli_prepare($con, $vacunaQuery);
    mysqli_stmt_bind_param($vacunaStatement, "i", $vacunaId);
    mysqli_stmt_execute($vacunaStatement);
    $vacunaResult = mysqli_stmt_get_result($vacunaStatement);
    $vacunaRow = mysqli_fetch_assoc($vacunaResult);
    $nombreVacuna = $vacunaRow['nombre'];

    // Insertar el registro en la tabla "registro_vacunas" utilizando una sentencia preparada
    $query = "INSERT INTO registro_vacunas (nombre_persona, nombre_vacuna, fecha_aplicacion, ciudad, departamento, observaciones) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, "ssssss", $nombreCompleto, $nombreVacuna, $fechaAplicacion, $ciudad, $departamento, $observaciones);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        mysqli_stmt_close($statement);
        mysqli_close($con);
        echo '<div style="background-color: #ccffcc; padding: 10px; color: #006600;">Registro guardado exitosamente.</div>';
        header("Location: dashboard.php");
        exit();
    } else {
        echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">Error al guardar el registro: ' . mysqli_error($con) . '</div>';
    }
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registro de Vacunas</title>
    <link rel="stylesheet" type="text/css" href="estilo_registro_vacunas.css">
</head>
<body>
    
    <?php
    if (!empty($personas)) {
        echo '<div style="background-color: #ccffcc; padding: 10px; color: #006600;">Persona Vacunada: ' . $personas[0]['nombre_completo'] . '</div>';
    } else {
        echo '<div style="background-color: #ffcccc; padding: 10px; color: #cc0000;">No se encontró ningún nombre registrado.</div>';
    }
    ?>
    <h2>Registro de Vacunas</h2>
<form method="POST" action="">
    <label for="nombre_completo">Nombre Completo:</label>
    <input type="text" name="nombre_completo" id="nombre_completo" required><br>

    <label for="vacuna">Vacuna:</label>
    <select name="vacuna" id="vacuna" required>
        <?php
        foreach ($vacunas as $vacuna) {
            echo '<option value="' . $vacuna['id'] . '">' . $vacuna['nombre'] . '</option>';
        }
        ?>
    </select><br>

    <label for="fecha_aplicacion">Fecha de Aplicación:</label>
    <input type="date" name="fecha_aplicacion" id="fecha_aplicacion" required><br>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad" required><br>

    <label for="departamento">Departamento:</label>
    <input type="text" name="departamento" id="departamento" required><br>

    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones"></textarea><br>

    <input type="submit" value="Guardar Registro">
</form>
<button onclick="location.href='dashboard.php'">Regresar</button>

</body>
</html>
