<?php
session_start();
// Asegúrate de que esta ruta sea la correcta (ej: ../vendor/autoload.php si usaste composer)
require_once '../dompdf/vendor/autoload.php'; 
require_once '../model/MAlumnos.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_SESSION['usuario']['id_alumno'])) {
    die("Sesión no válida.");
}

$idAlumno = $_SESSION['usuario']['id_alumno'];
$nombreAlumno = $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['app'];
$alumnoModel = new MAlumnos();
$asistencias = $alumnoModel->obtenerReporteAsistencia($idAlumno);

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Helvetica'); // Fuente predeterminada estable

$dompdf = new Dompdf($options);

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> <!-- Crítico para acentos y ñ -->
    <style>
        /* Estilos optimizados para PDF */
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .title { font-size: 22px; font-weight: bold; color: #2c3e50; text-transform: uppercase; }
        .info { margin-bottom: 20px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; table-layout: fixed; }
        th { background-color: #2c3e50; color: white; padding: 10px; font-size: 12px; }
        td { border: 1px solid #ddd; padding: 8px; font-size: 11px; text-align: center; word-wrap: break-word; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .asistencia { color: #27ae60; font-weight: bold; }
        .falta { color: #c0392b; font-weight: bold; }
        .retardo { color: #f39c12; font-weight: bold; }
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; height: 30px; text-align: center; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte Detallado de Asistencias</h1>
        <p style="margin: 0;">Ciclo Escolar Actual</p>
    </div>

    <div class="info">
        <strong>Estudiante:</strong> <?php echo mb_strtoupper($nombreAlumno, 'UTF-8'); ?><br>
        <strong>Fecha de generación:</strong> <?php echo date('d/m/Y H:i'); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 20%;">FECHA</th>
                <th style="width: 40%;">MATERIA</th>
                <th style="width: 20%;">GRUPO</th>
                <th style="width: 20%;">ESTADO</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($asistencias)): ?>
                <tr><td colspan="4">No se encontraron registros de asistencia.</td></tr>
            <?php else: ?>
                <?php foreach ($asistencias as $row): 
                    $map = [
                        1 => ['text' => 'ASISTENCIA', 'class' => 'asistencia'],
                        0 => ['text' => 'FALTA', 'class' => 'falta'],
                        2 => ['text' => 'RETARDO', 'class' => 'retardo']
                    ];
                    $status = $map[$row['estado']] ?? ['text' => 'N/A', 'class' => ''];
                ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($row['fecha'])); ?></td>
                    <td style="text-align: left;"><?php echo $row['nombre_materia']; ?></td>
                    <td><?php echo $row['nombre_grupo']; ?></td>
                    <td><span class="<?php echo $status['class']; ?>"><?php echo $status['text']; ?></span></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Página generada por el Sistema de Gestión Académica - <?php echo date('Y'); ?>
    </div>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// "Attachment" => false permite que se abra en el navegador (un solo clic)
$dompdf->stream("Asistencias_".str_replace(' ', '_', $nombreAlumno).".pdf", ["Attachment" => false]);
?>