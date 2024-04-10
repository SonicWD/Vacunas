<?php
    // Verificar si se proporciona el parámetro de ID
    if (!isset($_GET['id'])) {
        echo "<script language='JavaScript'>
                alert('No se proporcionó el ID de la vacuna')
                location.assign('lista_vacunas.php')
              </script>";
        exit; // Detener la ejecución del código si no se proporciona el ID
    }

    $id = $_GET['id'];
    include("conexion.php");

    // Validar y escapar el ID
    $id = mysqli_real_escape_string($con, $id);

    $sql = "DELETE FROM vacunas WHERE id = '$id'";
    $resultado = mysqli_query($con, $sql);

    if ($resultado) {
        echo "<script language='JavaScript'>
                alert('Los datos fueron eliminados correctamente')
                location.assign('lista_vacunas.php')
              </script>";
    } else {
        echo "<script language='JavaScript'>
                alert('ERROR: Los datos NO fueron eliminados correctamente')
                location.assign('lista_vacunas.php')
              </script>";
    }

    mysqli_close($con);
?>
