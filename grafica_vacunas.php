<!DOCTYPE html>
<html>
<head>
    <title>Gráfica de Vacunas más Utilizadas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <canvas id="vacunasChart"></canvas>

    <script>
        // Obtener los datos de la tabla "registro_vacunas" desde la base de datos
        <?php
        // Incluir el archivo de conexión a la base de datos
        include("conexion.php");

        // Obtener los datos de la tabla "registro_vacunas"
        $query = "SELECT nombre_vacuna, COUNT(*) as total FROM registro_vacunas GROUP BY nombre_vacuna ORDER BY total DESC LIMIT 5";
        $result = mysqli_query($con, $query);
        $vacunasData = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_close($con);
        ?>

        // Crear la gráfica de las vacunas más utilizadas
        var vacunasChartCtx = document.getElementById("vacunasChart").getContext("2d");
        new Chart(vacunasChartCtx, {
            type: "bar",
            data: {
                labels: <?php echo json_encode(array_column($vacunasData, 'nombre_vacuna')); ?>,
                datasets: [{
                    label: "Vacunas más utilizadas",
                    data: <?php echo json_encode(array_column($vacunasData, 'total')); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
</body>
</html>
