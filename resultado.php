<?php

/**
 * Declaracion de variables
 */

if (empty($_GET['gravedad'])) {
    $_GET['gravedad'] = 9.81;
}
$GRAVEDAD=  $_GET['gravedad'] ;// Aceleración m/s^2
define('INCREMENTO_TIEMPO', 0.01); // s

/**
 * Conexion HTML
 */

$v0 = $_GET['velocidad']; // m/s
$theta = $_GET['angulo']; // Grados

/**
 * Convertir ángulo a radianes
 */

$theta = deg2rad($theta);

/**
 * Formulas proyectiles
 */
$xm = pow($v0, 2) * sin(2 * $theta) / $GRAVEDAD;
$ym = pow($v0 * sin($theta), 2) / (2 * $GRAVEDAD);

/**
 * Tiempo
 */

if (empty($_GET['tiempo'])) {
    $_GET['tiempo'] = (2 * $v0 * sin($theta)) / $GRAVEDAD;
}
$tv = $_GET['tiempo'];


$x = array();
$y = array();

/**
 * Calcular la posicion de proyectil
 */
$t = 0;
while ($t <= $tv) {
    $x[] = $v0 * $t * cos($theta);
    $y[] = $v0 * $t * sin($theta) - 0.5 * $GRAVEDAD * pow($t, 2);
    $t += INCREMENTO_TIEMPO;
}

/**
 *  Convertir los arrays en formato JSON
*/ 
$data = array();
for ($i = 0; $i < count($x); $i++) {
    $data[] = array('x' => $x[$i], 'y' => $y[$i]);
}
/**
 *  Convertir el array en formato JSON
 */

$jsonData = json_encode($data);

/**
 * Integracion HTML
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trayectoria del Proyectil</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="graf">
    <h3>Trayectoria del Proyectil</h3>
    <h3>Tiempo= <?php echo $tv; ?>  Gravedad= <?php echo $GRAVEDAD; ?> </h3>
    <canvas id="scatterChart" width="800" height="400"></canvas>

    <script>
        // Obtener los datos del gráfico desde PHP
        const jsonData = <?php echo $jsonData; ?>;

        // Configuración del gráfico
        const ctx = document.getElementById('scatterChart').getContext('2d');
        const scatterChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Trayectoria del Proyectil',
                    data: jsonData,
                    showLine: false,
                    pointBackgroundColor: 'red',
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: false,
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
    </script>
</body>
</html>
