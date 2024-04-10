<?php
    include("conexion.php");

    if (mysqli_connect_errno()) {
        echo "1: Connection failed"; // Error 1: Connection failed
        exit();
    }

    $nombre = mysqli_real_escape_string($con, $_POST["nombre"]);
    $edad = mysqli_real_escape_string($con, $_POST["edad"]);
    $genero = mysqli_real_escape_string($con, $_POST["genero"]);
    $correo = mysqli_real_escape_string($con, $_POST["correo"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    $namecheckquery = "SELECT correo_electronico FROM usuarios WHERE correo_electronico='$correo'";
    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); // Error 2: Name check failed

    if (mysqli_num_rows($namecheck) > 0) {
        echo "3: Email already exists";
        exit();
    }

    // Hashear la contraseña antes de almacenarla en la base de datos
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $insertuserquery = "INSERT INTO usuarios (nombre_usuario, edad, genero, correo_electronico, contrasena, fecha_registro) VALUES ('$nombre', '$edad', '$genero', '$correo', '$hash', NOW())";
    mysqli_query($con, $insertuserquery) or die("4: Insert user query failed"); // Error 4: Insert user query failed

    // Registro exitoso, mostrar mensaje y redireccionar
    echo "Registro exitoso. Serás redirigido a la página de inicio en unos segundos...";
    mysqli_close($con);

    // Redireccionar a la página de inicio después de 3 segundos
    header("refresh:3; url=index.html");
    exit();
?>
