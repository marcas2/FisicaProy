<?php

require_once('jpgraph/src/jpgraph.php');
require_once('jpgraph/src/jpgraph_line.php');
require_once('jpgraph/src/jpgraph_scatter.php');

function calculateProjectileVariables($v0, $theta, $gravedad)
{
    /**
     * Variables
     */

    define('GRAVEDAD', $gravedad); // Aceleración de la gravedad en m/s^2
    define('INCREMENTO_TIEMPO', 0.01); // Incremento de tiempo en segundos

    $theta = deg2rad($theta); // Convertir el ángulo a radianes

    /**
     * Uso de fórmulas de proyectiles
     */
    // Cálculo de las distancias máximas en x e y
    $xm = pow($v0, 2) * sin(2 * $theta) / GRAVEDAD;
    $ym = pow($v0 * sin($theta), 2) / (2 * GRAVEDAD);

    // Calcular el tiempo total de vuelo
    $tv = (2 * $v0 * sin($theta)) / GRAVEDAD;

    return [
        'xm' => $xm,
        'ym' => $ym,
        'tv' => $tv
    ];
}

if (empty($_GET['gravedad'])) {
    $_GET['gravedad'] = 9.81;
}

$v0 = $_GET['velocidad'] ?? null;
$theta = $_GET['angulo'] ?? null;

if (empty($v0) || empty($theta)) {
    echo "Debe proporcionar la velocidad y el ángulo.";
} else {
    $variables = calculateProjectileVariables($v0, $theta, $_GET['gravedad']);

    /**
     * Array con las cordenadas de x-y
     */
    $x = array();
    $y = array();

    // Calcular la posición del proyectil en cada paso de tiempo
    $t = 0;
    while ($t <= $variables['tv']) {
        $x[] = $v0 * $t * cos($theta);
        $y[] = $v0 * $t * sin($theta) - 0.5 * GRAVEDAD * pow($t, 2);
        $t += INCREMENTO_TIEMPO;
    }

    // Crear el objeto de gráfico
    $graph = new Graph(800, 600);
    $graph->SetScale('linlin');

    // Establecer el título y los nombres de los ejes
    $graph->title->Set("Trayectoria del Proyectil");
    $graph->xaxis->SetTitle("Distancia (m)");
    $graph->yaxis->SetTitle("Altura (m)");

    // Agregar los puntos de control como un gráfico de dispersión
    $scatterPlot = new ScatterPlot($y, $x);
    $scatterPlot->mark->SetType(MARK_FILLEDCIRCLE);
    $scatterPlot->mark->SetFillColor('red');
    $scatterPlot->mark->SetWidth(5);

    // Agregar el gráfico de dispersión al gráfico principal
    $graph->Add($scatterPlot);

    // Crear una curva suave de la trayectoria utilizando interpolación
    $linePlot = new LinePlot($y, $x);
