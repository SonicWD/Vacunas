<html>
<head>
    <title>AGREGAR</title>
    <link rel="stylesheet" type="text/css" href="estilonv.css">
</head>
<body>
<?php
    if (isset($_POST['enviar'])) {
        $nombre = $_POST['nombre'];

        if (empty($nombre)) {
            echo "<script language='JavaScript'>
                    alert('El campo de nombre no puede estar vacío')
                    location.assign('lista_vacunas.php')
                </script>";
            exit; // Detener la ejecución del código si el nombre está vacío
        }

        include("conexion.php");

        // Validar y escapar el nombre ingresado por el usuario
        $nombre = mysqli_real_escape_string($con, $nombre);

        // Verificar si la vacuna ya existe
        $verificar_sql = "SELECT * FROM vacunas WHERE nombre = '$nombre'";
        $verificar_resultado = mysqli_query($con, $verificar_sql);

        if (mysqli_num_rows($verificar_resultado) > 0) {
            echo "<script language='JavaScript'>
                    alert('La vacuna ya existe')
                    location.assign('lista_vacunas.php')
                </script>";
        } else {
            // Insertar la vacuna en la base de datos
            $insertar_sql = "INSERT INTO vacunas (nombre) VALUES ('$nombre')";
            $resultado = mysqli_query($con, $insertar_sql);

            if ($resultado) {
                echo "<script language='JavaScript'>
                        alert('Los datos fueron ingresados correctamente')
                        location.assign('lista_vacunas.php')
                    </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('ERROR: Los datos NO fueron ingresados correctamente')
                        location.assign('lista_vacunas.php')
                    </script>";
            }
        }

        mysqli_close($con);
    }
?>

<h1>Agregar nueva vacuna</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre"><br>
    <input type="submit" name="enviar" value="AGREGAR">
    <a href="lista_vacunas.php">Regresar</a>
</form>

</body>
</html>
