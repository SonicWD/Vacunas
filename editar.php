<?php
    include("conexion.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['enviar'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];

            // Verificar si el nombre ya existe
            $verificar_sql = "SELECT * FROM vacunas WHERE nombre = '$nombre' AND id != '$id'";
            $verificar_resultado = mysqli_query($con, $verificar_sql);

            if (mysqli_num_rows($verificar_resultado) > 0) {
                echo "<script language='JavaScript'>
                        alert('El nombre de la vacuna ya existe')
                        location.assign('lista_vacunas.php')
                      </script>";
                exit; // Detener la ejecución si el nombre ya existe
            }

            // Actualizar la vacuna en la base de datos
            $sql = "UPDATE vacunas SET nombre = '$nombre' WHERE id = '$id'";
            $resultado = mysqli_query($con, $sql);

            if ($resultado) {
                echo "<script language='JavaScript'>
                        alert('Los datos fueron actualizados correctamente')
                        location.assign('lista_vacunas.php')
                      </script>";
            } else {
                echo "<script language='JavaScript'>
                        alert('ERROR: Los datos NO fueron actualizados correctamente')
                        location.assign('lista_vacunas.php')
                      </script>";
            }

            mysqli_close($con);
        }
    } else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener los datos de la vacuna a editar
            $sql = "SELECT * FROM vacunas WHERE id = '$id'";
            $resultado = mysqli_query($con, $sql);

            if (mysqli_num_rows($resultado) > 0) {
                $fila = mysqli_fetch_assoc($resultado);
                $nombre = $fila["nombre"];
            } else {
                echo "<script language='JavaScript'>
                        alert('La vacuna no existe')
                        location.assign('lista_vacunas.php')
                      </script>";
                exit; // Detener la ejecución si la vacuna no existe
            }

            mysqli_close($con);
        } else {
            echo "<script language='JavaScript'>
                    alert('No se proporcionó el ID de la vacuna')
                    location.assign('lista_vacunas.php')
                  </script>";
            exit; // Detener la ejecución si no se proporciona el ID
        }
    }
?>
<html>
<head>
    <title>EDITAR</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <h1>Editar vacuna</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"> <br>

        <input type="hidden" name="id" value="<?php echo $id; ?>"> <br>

        <input type="submit" name="enviar" value="Actualizar">
        <a href="lista_vacunas.php">Regresar</a>
    </form>
</body>
</html>
