<?php
session_start();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ver Pase de Lista</title>
  <link rel="stylesheet" href="resources/alumnosAsistencia.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php 
  include 'menuLateralAlumnos.php';
  
  $grupos = $_SESSION['asistenciaGeneral'] ?? [];
  
  // 1. Determinar el ID seleccionado (si no hay POST, usamos el primero del array)
  if (isset($_POST['id_g'])) {
      $grupo_actual = $_POST['id_g'];
  } else {
      $grupo_actual = !empty($grupos) ? $grupos[0]['id_grupo'] : null;
  }

  // 2. Variables para mostrar en la interfaz
  $datos_seleccionados = null;

  // 3. Buscar los datos específicos del grupo seleccionado
  foreach ($grupos as $grupo) {
      if ($grupo['id_grupo'] == $grupo_actual) {
          $datos_seleccionados = $grupo;
          break; // Salimos del ciclo al encontrarlo
      }
  }
?>

  <main class="container">
     <header class="topbar">
      <div class="brand">
        <div class="logo">PL</div>
        <div>
          <h1>Mi pase de lista</h1>
          <p class="subhead">Selecciona una materia para ver tu historial. (Solo puede ver su propio historial)</p>
        </div>
      </div>
    </header>
    <br>

    <!-- MENÚ DE GRUPOS -->
    <section class="group-selector-card">
      <h3>Mis Grupos Inscritos</h3>
      <form method="POST" action="" class="group-grid">
        <?php
          if(empty($grupos)) {
            echo "<p>No estás inscrito en ningún grupo.</p>";
          } else {
            foreach($grupos as $g) {
              $selected_class = ($grupo_actual == $g['id_grupo']) ? 'btn-selected' : '';
              echo "<button type='submit' name='id_g' value='{$g['id_grupo']}' 
                      class='btn-post-group $selected_class'>{$g['id_grupo']}. {$g['nombre_grupo']}</button>";
            }
          }
        ?>
      </form>
    </section>

    <div class="grid">
      <!-- Panel izquierdo: Resumen -->
      <section class="card">
        <h2>Resumen del estudiante</h2>
        
        <?php if ($datos_seleccionados): ?>
          <div class="profile">
            <div class="avatar"><?php echo substr($_SESSION['usuario']['nombre'], 0, 2); ?></div>
            <div class="meta">
              <p class="name"><?php echo $_SESSION['usuario']['nombre']; ?></p>
              <p class="line"><?php echo $_SESSION['usuario']['carrera']; ?></p>
            </div>
          </div>

          <div class="row2">
            <div class="detail-item">
              <p class="k">Grupo</p>
              <p class="v"><?php echo $datos_seleccionados['nombre_grupo']; ?></p>
            </div>
            <div class="detail-item">
              <p class="k">Periodo</p>
              <p class="v"><?php echo $datos_seleccionados['nombre_ciclo']; ?></p>
            </div>
          </div>

          <div class="kpis">
            <div class="kpi">
              <p class="value"><?php echo $datos_seleccionados['numero_clases']; ?></p>
              <p class="label">Clases</p>
            </div>
            <div class="kpi">
              <p class="value"><?php echo $datos_seleccionados['numero_asistencias']; ?></p>
              <p class="label">Asistencias</p>
            </div>
            <div class="kpi">
              <p class="value">
                <?php 
                  $total = $datos_seleccionados['numero_clases'];
                  $presen = $datos_seleccionados['numero_asistencias'];
                  echo ($total > 0) ? round(($presen / $total) * 100, 2) . '%' : '0%'; 
                ?>
              </p>
              <p class="label">Porcentaje</p>
            </div>
          </div>
        <?php else: ?>
          <p>Selecciona un grupo para ver el resumen.</p>
        <?php endif; ?>
      </section>

      <!-- Panel derecho: Tabla -->
      <section class="card">
        <h2>Detalle de Asistencia</h2>
        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              include_once '../model/MAlumnos.php';
              $alumno = new MAlumnos();
              
              // Llamada a tu función (ahora sabemos que devuelve un array simple de filas)
              $asistencias = $alumno->obtenerAsistencias($_SESSION['usuario']['id_alumno'], $grupo_actual);

              if ($asistencias && count($asistencias) > 0) {
                foreach ($asistencias as $asis) {
                  
                  $estado = htmlspecialchars($asis['estado']);
                  $estado_texto = ($asis['estado'] == 0 ? 'falta' : ($asis['estado'] == 1 ? 'presente' : ($asis['estado'] == 2 ? 'retardo' : 'desconocido'))); // Capitalizar la primera letra
                  $clase_badge = 'neutral'; 

                  // Lógica de colores para los badges
                  if (stripos($estado_texto, 'asistió') !== false || stripos($estado_texto, 'presente') !== false) {
                      $clase_badge = 'ok';
                  } elseif (stripos($estado_texto, 'falta') !== false || stripos($estado_texto, 'no asistió') !== false) {
                      $clase_badge = 'bad';
                  } elseif (stripos($estado_texto, 'retardo') !== false) {
                      $clase_badge = 'neutral'; 
                  }

                  echo "<tr>
                          <td>" . date('d/m/Y', strtotime($asis['fecha'])) . "</td>
                          <td><span class='badge $clase_badge'>$estado_texto</span></td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='2' style='text-align:center;'>No hay registros de asistencia para este grupo.</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </section>
    </div>
  </main>
</body>
</html>