<html>
<head>
    <title>Lista de vacunas</title>
    <script type="text/javascript">
        function confirmar() {
            return confirm('¿Estás seguro de eliminar los datos? Esta acción no se podrá deshacer.');
        }
    </script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>    
<body>
<?php
    include("conexion.php");
    $sql = "SELECT * FROM vacunas";
    $resultado = mysqli_query($con, $sql);
?>

    <h1>Lista de vacunas</h1>
    
    <a href="agregar.php">Registrar nueva vacuna</a><br><br>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $id = $fila['id'];
                    $nombre = $fila['nombre'];
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $nombre; ?></td>
                <td> 
                    <a href="editar.php?id=<?php echo $id; ?>">EDITAR</a> -
                    <a href="eliminar.php?id=<?php echo $id; ?>" onclick="return confirmar()">ELIMINAR</a>
                </td>   
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <?php  
        mysqli_close($con);
    ?>

    <br>
    <a href="dashboard.php">Regresar</a>

</body>
</html>

