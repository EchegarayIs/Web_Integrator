<?php
session_start();
// Ajusta la ruta según tu estructura de carpetas
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

try {
    $justificantes = $alumnoModel->obtenerReporteJustificante($idAlumno);
} catch (Exception $e) {
    die("Error al obtener los datos: " . $e->getMessage());
}

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Helvetica');

$dompdf = new Dompdf($options);

ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 1cm; }
        body { font-family: 'Helvetica', sans-serif; color: #333; font-size: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; color: #2c3e50; text-transform: uppercase; margin: 0; }
        .info { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th { background-color: #2c3e50; color: white; padding: 6px; font-size: 9px; word-wrap: break-word; }
        td { border: 1px solid #ddd; padding: 5px; text-align: center; word-wrap: break-word; vertical-align: middle; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        
        /* Colores de estado */
        .Aprobado { color: #27ae60; font-weight: bold; }
        .Rechazado { color: #c0392b; font-weight: bold; }
        .Pendiente { color: #f39c12; font-weight: bold; }
        
        .footer { position: fixed; bottom: -10px; left: 0; right: 0; height: 20px; text-align: center; font-size: 8px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Reporte de Justificantes Médicos y Permisos</h1>
        <p style="margin: 5px 0 0 0;">Sistema de Gestión Académica - Historial del Alumno</p>
    </div>

    <div class="info">
        <strong>Estudiante:</strong> <?php echo mb_strtoupper($nombreAlumno, 'UTF-8'); ?><br>
        <strong>Ciclo Escolar:</strong> <?php echo $justificantes[0]['nombre_ciclo'] ?? 'N/A'; ?><br>
        <strong>Fecha de Emisión:</strong> <?php echo date('d/m/Y H:i'); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">FECHA SOLICITUD</th>
                <th style="width: 10%;">FECHA DESDE</th>
                <th style="width: 10%;">FECHA HASTA</th>
                <th style="width: 12%;">MOTIVO</th>
                <th style="width: 10%;">TIPO</th>
                <th style="width: 10%;">ESTADO</th>
                <th style="width: 12%;">COMENTARIOS</th>
                <th style="width: 10%;">RESOLUCIÓN</th>
                <th style="width: 16%;">DOCENTE</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($justificantes)): ?>
                <tr><td colspan="9">No se encontraron trámites de justificantes registrados.</td></tr>
            <?php else: ?>
                <?php foreach ($justificantes as $row): ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($row['fecha_solicitud'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['fecha_inicio'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['fecha_fin'])); ?></td>
                    <td><?php echo htmlspecialchars($row['motivo']); ?></td>
                    <td><?php echo $row['tipo_justificante']; ?></td>
                    <td><span class="<?php echo $row['estado_justificante']; ?>"><?php echo $row['estado_justificante']; ?></span></td>
                    <td><?php echo htmlspecialchars($row['comentarios'] ?? 'Sin comentarios'); ?></td>
                    <td><?php echo $row['fecha_resolucion'] ? date('d/m/Y', strtotime($row['fecha_resolucion'])) : '---'; ?></td>
                    <td><?php echo $row['nombre_docente'] . " " . $row['apellido_paterno_docente']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Este documento es un reporte oficial del historial de trámites del alumno - Página generada el <?php echo date('d/m/Y'); ?>
    </div>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf->loadHtml($html);

// Cambiamos a 'landscape' (horizontal) porque son muchas columnas
$dompdf->setPaper('A4', 'landscape'); 

$dompdf->render();

$dompdf->stream("Justificantes_".str_replace(' ', '_', $nombreAlumno).".pdf", ["Attachment" => false]);
?>