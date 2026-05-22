<?php
session_start();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Revisión de Justificantes</title>
  <link rel="stylesheet" href="resources/adminJustificantes.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php include("menuLateralAdmin.php"); ?>

<div class="container">
  <header class="topbar">
    <div class="brand">
      <div class="logo">J</div>
      <div>
        <h1>Revisión de Justificantes</h1>
      </div>
    </div>
  </header>

  <h2>Justificantes pendientes de revisión</h2>

  <table>
    <thead>
      <tr>
        <th>Fecha Solicitud</th>
        <th>Alumno</th>
        <th>Periodo</th>
        <th>Motivo</th>
        <th>Tipo</th>
        <th>Estado Actual</th>
        <th>Fecha Resolución</th>
        <th>Comentarios / Acción</th>
      </tr>
    </thead>
    <tbody>

        <?php
        if (isset($_SESSION['justificantes']) && !empty($_SESSION['justificantes'])) {
            $justificantes = $_SESSION['justificantes'];
        } else {
            $justificantes = [];
        }
        if (isset($justificantes) && !empty($justificantes)) {
            foreach ($justificantes as $justificante) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($justificante['fecha_solicitud']) . "</td>";
                echo "<td><strong>" . htmlspecialchars($justificante['nombre_alumno'] . " " . $justificante['apellido_paterno_alumno'] . " " . $justificante['apellido_materno_alumno']) . "</strong><br><small>Mat. " . htmlspecialchars($justificante['id_alumno']) . "</small></td>";
                echo "<td>" . htmlspecialchars($justificante['fecha_inicio']) . " - " . htmlspecialchars($justificante['fecha_fin']) . "</td>";
                echo "<td>" . htmlspecialchars($justificante['motivo']) . "</td>";
                echo "<td><span class='badge'>" . ($justificante['tipo'] == 1 ? 'Incapacidad' : 'Permiso') . "</span></td>";

                $estadoText = 'PENDIENTE';
                $estadoClass = 'pendiente';
                if ($justificante['estado'] == 1) {
                    $estadoText = 'APROBADO';
                    $estadoClass = 'aprobado';
                } else if ($justificante['estado'] == 0) {
                    $estadoText = 'RECHAZADO';
                    $estadoClass = 'rechazado';
                }else if ($justificante['estado'] == 2) {
                    $estadoText = 'PENDIENTE';
                    $estadoClass = 'pendiente';
                }

                echo "<td><span class='badge $estadoClass'>$estadoText</span></td>";

                echo "<td><input type='date' class='input-fecha' value='" . ($justificante['fecha_resolucion'] ?? '') . "'></td>";

                echo "<td>";
                echo "  <form action='../controller/dispacherJustificante.php' method='POST' class='form-fila-accion'>";
                echo "      <input type='hidden' name='id' value='" . htmlspecialchars($justificante['id_justificante']) . "'>";
                echo "      <textarea name='comentarios' class='comentarios' rows='2' placeholder='Escribe comentarios...'></textarea><br><br>";
                            
                echo "      <div class='acciones'>";
                echo "          <button type='submit' name='accion' value='aceptarJustificante' class='btn btn-aprobar'>Aprobar</button>";
                echo "          <button type='submit' name='accion' value='rechazarJustificante' class='btn btn-rechazar'>Rechazar</button>";
                echo "          <button type='submit' name='accion' value='mantenerPendiente' class='btn btn-pendiente'>Mantener Pendiente</button>";
                echo "      </div>";

                echo "  </form>";
                echo "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9' style='text-align:center;'>No hay justificantes pendientes.</td></tr>";
        }   
        ?>
    </tbody>
  </table>
</div>

</body>
</html>