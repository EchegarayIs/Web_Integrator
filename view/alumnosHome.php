<?php session_start(); 
echo "Bienvenido, " . ($_SESSION['usuario']['nombre'] ?? 'Usuario') . "!  ";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Alumnos</title>
    <link rel="stylesheet" href="resources/alumnosHome.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include 'menuLateralAlumnos.php'; ?>
  <!-- Top bar -->
  

  <main class="container">
    <div class="grid">

      <!-- Main -->
      <section class="main">
        <!-- Profile summary -->
        <div class="card">
          <div class="profile">
            <div class="avatar" aria-label="Avatar">EI</div>

            <div class="profile-meta">

              <div>
                        <!-- Vista de datos -->
                  <?php
                      $alumno = $alumno = $_SESSION['usuario'] ?? null;

                      if (isset($alumno) && is_array($alumno)) {

                          echo "<h1 class='name'>" . htmlspecialchars($alumno['nombre'] ?? '') . "</h1>";

                          $estado = (($alumno['estado'] ?? 0) == 1) ? 'Activo' : 'Inactivo';

                          echo "<p class='role'>Estudiante · Estado: {$estado}</p>";

                          echo "<div class='kv' role='group' aria-label='Datos generales'>";

                          echo "<div class='item'>
                                  <div class='label'>Matricula</div>
                                  <div class='value'>" . htmlspecialchars($alumno['matricula'] ?? '') . "</div>
                                </div>";

                          echo "<div class='item'>
                                  <div class='label'>Últ. sync</div>
                                  <div class='value'>08:12</div>
                                </div>";

                          echo "<div class='item'>
                                  <div class='label'>Carrera</div>
                                  <div class='value'>" . htmlspecialchars($alumno['carrera'] ?? '') . "</div>
                                </div>";

                          echo "<div class='item'>
                                  <div class='label'>Semestre</div>
                                  <div class='value'>" . htmlspecialchars($alumno['semestre'] ?? '') . "</div>
                                </div>";

                          echo "</div>";

                      } else {
                          echo "<h1 class='name'>Usuario no encontrado</h1>";
                          echo "<p class='role'>No se pudieron cargar los datos del perfil.</p>";
                      }
                      ?>
              </div>
            </div>
          </div>
        </div>

        <!-- KPIs -->
        <div class="card">
          <div class="section-title">
            <h2>Resumen general</h2>
            <span>KPIs del perfil</span>
          </div>

          <?php

            $resumen = $_SESSION['resumen'] ?? null;
            if (isset($resumen) && is_array($resumen)) {
                echo "<div class='kpis'>";

                echo "<div class='kpi'>
                        <div class='top'>
                          <div class='label'>Total de Faltas</div>
                        </div>
                        <div class='value'>" . htmlspecialchars($resumen['numero_faltas'] ?? '0') . "</div>
                        <div class='sub'>totales</div>
                      </div>";

                echo "<div class='kpi'>
                        <div class='top'>
                          <div class='label'>Asistencias</div>
                        </div>
                        <div class='value'>" . htmlspecialchars($resumen['numero_asistencias'] ?? '0') . "</div>
                        <div class='sub'>Totales</div>
                      </div>";

                echo "<div class='kpi'>
                        <div class='top'>
                          <div class='label'>Número de Justificantes</div>
                        </div>
                        <div class='value'>" . htmlspecialchars($resumen['numero_justificantes'] ?? '0') . "</div>
                        <div class='sub'>totales</div>
                      </div>";

                echo "<div class='kpi'>
                        <div class='top'>
                          <div class='label'>Grupos incritos</div>
                        </div>
                        <div class='value'>" . htmlspecialchars($resumen['numero_grupos'] ?? '0') . "</div>
                        <div class='sub'>en total</div>
                      </div>";

                echo "</div>";
            } else {
                echo "<p>No se pudieron cargar los datos del resumen.</p>";
            }

          ?>
        </div>

        <!-- Activity + Alerts -->
        <div class="two-col">
          <div class="card">
            <div class="section-title">
              <h2>Actividad reciente</h2>
              <span>últimos movimientos</span>
            </div>

            <div class="list">

              <?php
                $recientes = $_SESSION['recientes'] ?? null;

                if (isset($recientes) && is_array($recientes)) {

                    foreach ($recientes as $actividad) {

                        $tipo = $actividad['tipo_registro'] ?? '';

                        $icon = '✓';
                        $color = 'var(--success)';
                        $tag = 'ok';
                        $estadoText = 'Completado';
                        $titulo = '';

                        if ($tipo == 'ASISTENCIA') {

                            $titulo = 'Registro de asistencia';

                            if (($actividad['estado'] ?? 0) == 1) {

                                $icon = '✓';
                                $color = 'var(--success)';
                                $tag = 'ok';
                                $estadoText = 'Asistencia';

                            } else if (($actividad['estado'] ?? 0) == 0) {

                                $icon = '×';
                                $color = 'var(--danger)';
                                $tag = 'err';
                                $estadoText = 'Falta';
                            } else if (($actividad['estado'] ?? 0) == 2) {

                                $icon = '!';
                                $color = 'var(--warning)';
                                $tag = 'warn';
                                $estadoText = 'Retardo';
                            }else {

                                $icon = '?';
                                $color = 'var(--muted)';
                                $tag = 'warn';
                                $estadoText = 'Justificado';
                            }
                        }
                        elseif ($tipo == 'JUSTIFICANTE') {

                            $titulo = 'Justificante';

                            if (($actividad['estado'] ?? 0) == 1) {

                                $icon = '✓';
                                $color = 'var(--success)';
                                $tag = 'ok';
                                $estadoText = 'Aprobado';

                            } elseif (($actividad['estado'] ?? 0) == 0) {

                                $icon = '!';
                                $color = 'var(--warning)';
                                $tag = 'warn';
                                $estadoText = 'Pendiente';

                            } else {

                                $icon = '×';
                                $color = 'var(--danger)';
                                $tag = 'err';
                                $estadoText = 'Rechazado';
                            }
                        }

                        // Fecha
                        $fecha = htmlspecialchars($actividad['fecha_evento'] ?? '');

                        // Hora
                        $hora = htmlspecialchars($actividad['hora_evento'] ?? '');

                        // Motivo/comentario
                        $detalle = '';

                        if (!empty($actividad['motivo'])) {
                            $detalle .= htmlspecialchars($actividad['motivo']);
                        }

                        if (!empty($actividad['comentarios'])) {
                            $detalle .= ' · ' . htmlspecialchars($actividad['comentarios']);
                        }

                        echo "
                        <div class='row-item'>

                            <div class='mini-icon' style='color: {$color};'>
                                {$icon}
                            </div>

                            <div>
                                <p class='title'>{$titulo}</p>

                                <p class='meta'>
                                    {$fecha} {$hora}
                                </p>

                                <p class='meta'>
                                    {$detalle}
                                </p>
                            </div>

                            <div class='tag {$tag}'>
                                {$estadoText}
                            </div>

                        </div>
                        ";
                    }
                }
                ?>

            </div>
          </div>

        <!-- Details table + Actions -->
        <div class="two-col">
          <div class="card">
            <div class="section-title">
              <h2>Últimos Justificantes</h2>
              <span>detalle rápido</span>
            </div>

            <table class="mini-table" aria-label="Tabla de detalle rápido">
              <thead>
                <tr>
                  <th>Tipo de justificante</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>

                <?php

                  foreach ($recientes as $actividad) {
                      if (($actividad['tipo_registro'] ?? '') == 'JUSTIFICANTE') {
                          echo "<tr>
                                  <td>" . htmlspecialchars($actividad['motivo'] ?? 'Justificante') . "</td>
                                  <td>" . htmlspecialchars($actividad['fecha_evento'] ?? '') . "</td>
                                  <td><span class='tag " . ((($actividad['estado'] ?? 0) == 1) ? 'ok' : ((($actividad['estado'] ?? 0) == 0) ? 'warn' : 'err')) . "'>" . ((($actividad['estado'] ?? 0) == 1) ? 'Aprobado' : ((($actividad['estado'] ?? 0) == 2) ? 'Pendiente' : 'Rechazado')) . "</span></td>
                                </tr>";
                          break;
                      }
                  }

                ?>  

              </tbody>
            </table>
          </div>

          <div class="card">
            <div class="section-title">
              <h2>Acciones principales</h2>
              <span>atajos</span>
            </div>

            <div class="actions">
              <form method="POST" action="../controller/dispacherAlumnos.php">
                <input type="hidden" name="accion" value="Perfil">
                <button class="btn primary" type="submit" style="flex:1; min-width: 180px;">Actualizar perfil</button>
              </form>
              <form method="POST" action="../controller/dispacherAlumnos.php">
                <input type="hidden" name="accion" value="GenerarReporteAsistencia">
                <button class="btn" type="submit" style="flex:1; min-width: 180px;">Imprimir Reporte de asistencias</button>
              </form>
              <form method="POST" action="../controller/dispacherAlumnos.php">
                <input type="hidden" name="accion" value="GenerarReporteJustificante">
                <button class="btn" type="submit" style="flex:1; min-width: 180px;">Imprimir Reporte de Justificantes</button>
              </form>
            </div>

            <div style="margin-top:14px; color:var(--muted); font-weight:900; font-size:12px; line-height:1.4;">
            </div>
          </div>
        </div>

      </section>
    </div>
  </main>
</body>
</html>