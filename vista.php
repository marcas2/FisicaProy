<?php
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_line.php');
require_once ('jpgraph/src/jpgraph_scatter.php');

/**
 * Declaración de variables
 */

if (empty($_GET['gravedad'])) {
    $_GET['gravedad'] = 9.81;
}

define('GRAVEDAD', (float)$_GET['gravedad']); // Aceleración m/s^2
define('INCREMENTO_TIEMPO', 0.01); // s

/**
 * Conexion HTML
 */

define('xm', (float)$_GET['x']);
define('ym', (float)$_GET['y']);

/**
 * Formulas proyectiles
 */

// Verificar si GRAVEDAD es distinto de cero
$u = ym / xm;
$theta = atan($u);

$v0 = xm / ($_GET['tiempo'] * cos($theta));

/**
 * Convertir ángulo a radianes
 */

$theta = deg2rad($theta);

$xm = pow($v0, 2) * sin(2 * $theta) / GRAVEDAD;
$ym = pow($v0 * sin($theta), 2) / (2 * GRAVEDAD);

// Calcular el tiempo total de vuelo
if (empty($_GET['tiempo'])) {
    $tiempo = (2 * $v0 * sin($theta)) / GRAVEDAD;
} else {
    $tiempo = $_GET['tiempo'];
}

// Arrays para almacenar las coordenadas x e y del proyectil
$x = array();
$y = array();

// Calcular la posición del proyectil en cada paso de tiempo
$t = 0;
while ($t <= $tiempo) {
    $x[] = $v0 * $t * cos($theta);
    $y[] = $v0 * $t * sin($theta) - 0.5 * GRAVEDAD * pow($t, 2);
    $t += INCREMENTO_TIEMPO;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trayectoria del Proyectil</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>

    <script>
        // Obtener los datos del PHP
        var x = <?php echo json_encode($x); ?>;
        var y = <?php echo json_encode($y); ?>;

        // Crear un contexto de gráfico
        var ctx = document.getElementById('myChart').getContext('2d');

        // Crear el gráfico de dispersión
        var scatterChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Puntos de control',
                    data: [],
                    backgroundColor: 'red',
                    pointRadius: 5
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Distancia (m)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Altura (m)'
                        }
                    }
                }
            }
        });

        // Agregar los puntos de control al gráfico
        for (var i = 0; i < x.length; i++) {
            scatterChart.data.datasets[0].data.push({ x: x[i], y: y[i] });
        }

        // Crear la curva suave utilizando interpolación
        var lineTension = 0.1;
        var smoothLine = {
            label: 'Curva suave',
            data: [],
            backgroundColor: 'blue',
            borderColor: 'blue',
            borderWidth: 2,
            fill: false,
            lineTension: lineTension
        };

        for (var i = 0; i < x.length; i++) {
            smoothLine.data.push({ x: x[i], y: y[i] });
        }

        scatterChart.data.datasets.push(smoothLine);

        // Actualizar el gráfico
        scatterChart.update();
    </script>
</body>
</html>
