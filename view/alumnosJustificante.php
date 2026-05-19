<?php
session_start();

// 1. Control de acceso: Si la sesión no existe, expulsar al login
if (!isset($_SESSION['usuario']['id_alumno'])) {
    header("Location: ../index.php");
    exit();
}

include_once '../model/MAlumnos.php';
$alumnoModel = new MAlumnos();

$idAlumno = $_SESSION['usuario']['id_alumno'];

// Inicializamos variables para evitar errores de tipo Notice
$misSolicitudes = [];
$docentes = [];
$error = null;

// Bloque Try-Catch para control seguro de excepciones de BD
try {
    $misSolicitudes = $alumnoModel->obtenerJustificantes($idAlumno) ?? [];
    $docentes = $alumnoModel->listarDocentes() ?? []; 
} catch (Exception $e) {
    $error = $e->getMessage();
}

// Obtenemos el ciclo actual de la sesión con fallback seguro
$idCicloActual = $_SESSION['asistenciaGeneral'][0]['id_ciclo'] ?? 1;
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Trámite Justificante</title>
  <link rel="stylesheet" href="resources/alumnosJustificante.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  <div class="container">
    <?php include 'menuLateralAlumnos.php'; ?>

    <div class="grid-main-content">
      
      <?php if(isset($_SESSION['successmsj'])): ?>
        <div class="alert success">
          <?php echo htmlspecialchars($_SESSION['successmsj']); unset($_SESSION['successmsj']); ?>
        </div>
      <?php endif; ?>
      <?php if(isset($_SESSION['errormsj'])): ?>
        <div class="alert error">
          <?php echo htmlspecialchars($_SESSION['errormsj']); unset($_SESSION['errormsj']); ?>
        </div>
      <?php endif; ?>
      <?php if($error): ?>
        <div class="alert error">Error de sistema: <?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <div class="actions">
        <button class="btn ghost active-btn" id="btn-home" onclick="showSection('home')">Inicio</button>
        <button class="btn primary" id="btn-tramite" onclick="showSection('tramite')">Nuevo trámite</button>
        <button class="btn" id="btn-mis" onclick="showSection('mis')">Mis solicitudes</button>
      </div>
      
      <aside class="card section active" id="sec-home">
        <h2>Resumen del perfil</h2>
        <div class="profile">
          <div class="avatar">
            <?php 
              echo substr(htmlspecialchars($_SESSION['usuario']['nombre']), 0, 1) . 
                   substr(htmlspecialchars($_SESSION['usuario']['app'] ?? ''), 0, 1); 
            ?>
          </div>
          <div class="meta">
            <p class="name"><?php echo htmlspecialchars($_SESSION['usuario']['nombre'] . " " . ($_SESSION['usuario']['app'] ?? '')); ?></p>
            <p class="line"><?php echo htmlspecialchars($_SESSION['usuario']['carrera'] ?? 'Estudiante'); ?></p>
          </div>
        </div>

        <div class="kpis">
          <div class="kpi">
            <p class="value"><?php echo count(array_filter($misSolicitudes, fn($s) => $s['estado'] == 2)); ?></p>
            <p class="label">Pendientes</p>
          </div>
          <div class="kpi">
            <p class="value"><?php echo count(array_filter($misSolicitudes, fn($s) => $s['estado'] == 1)); ?></p>
            <p class="label">Aprobadas</p>
          </div>
          <div class="kpi">
            <p class="value"><?php echo count($misSolicitudes); ?></p>
            <p class="label">Total histórico</p>
          </div>
        </div>
      </aside>

      <main class="card section" id="sec-tramite" style="display: none;">
        <h2>Nuevo Justificante</h2>
        <form action="../controller/dispacherAlumnos.php" method="POST">
          <input type="hidden" name="accion" value="TramitarJustificante">
          <input type="hidden" name="idCiclo" value="<?php echo (int)$idCicloActual; ?>">
          <input type="hidden" name="estado" value="2"> 

          <div class="row">
            <div class="full">
              <label>Docente a quien dirige</label>
              <select name="idDocente" required>
                <option value="" disabled selected>Selecciona un docente...</option>
                <?php foreach($docentes as $d): ?>
                  <option value="<?php echo htmlspecialchars($d['id_docente']); ?>">
                    <?php echo htmlspecialchars($d['nombre'] . " " . $d['app'] . " " . ($d['apm'] ?? '')); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div>
              <label>Desde</label>
              <input name="fechaInicio" type="date" required />
            </div>
            <div>
              <label>Hasta</label>
              <input name="fechaFin" type="date" required />
            </div>

            <div class="full">
              <label>Tipo de trámite</label>
              <select name="tipo" required>
                <option value="0">Permiso</option>
                <option value="1">Incapacidad</option>
                <option value="2">Otro</option>
              </select>
            </div>

            <div class="full">
              <label>Motivo principal</label>
              <select name="motivo" required>
                <option value="Enfermedad">Enfermedad</option>
                <option value="Actividad institucional">Actividad institucional</option>
                <option value="Trabajo/Personal">Trabajo / Personal</option>
                <option value="Otro">Otro</option>
              </select>
            </div>

            <div class="full">
              <label>Descripción / Comentarios</label>
              <textarea name="comentarios" rows="3"></textarea>
            </div>
          </div>

          <div class="form-actions">
            <button class="btn primary" type="submit">Enviar Solicitud</button>
          </div>
        </form>
      </main>

      <div class="section report-layout" id="sec-mis" style="display: none;">
        <section class="card report-list">
          <h2>Historial de Solicitudes</h2>
          <table id="reportList">
            <thead>
              <tr>
                <th>Folio</th>
                <th>Periodo Justificado</th>
                <th>Docente</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($misSolicitudes)): ?>
                <tr><td colspan="4" style="text-align:center;">Sin registros.</td></tr>
              <?php else: ?>
                <?php foreach($misSolicitudes as $row): 
                  $badgeClass = ['danger', 'success', 'warning'][$row['estado']] ?? 'neutral';
                  $statusText = ['Rechazado', 'Aprobado', 'Pendiente'][$row['estado']] ?? 'Desconocido';
                  $nombreDocenteCompleto = $row['nombre_docente'] . " " . $row['apellido_paterno_docente'];
                ?>
                  <tr data-id="<?php echo htmlspecialchars($row['id_justificante']); ?>" 
                      data-tipo="<?php echo htmlspecialchars($row['motivo']); ?>" 
                      data-fecha="<?php echo date('d/m/Y', strtotime($row['fecha_inicio'])) . ' al ' . date('d/m/Y', strtotime($row['fecha_fin'])); ?>" 
                      data-estado="<?php echo $statusText; ?>" 
                      data-notas="<?php echo htmlspecialchars($row['comentarios'] ?? 'Sin comentarios adicionales.'); ?>">
                    <td>#<?php echo (int)$row['id_justificante']; ?></td>
                    <td>
                      <small><?php echo date('d/m/y', strtotime($row['fecha_inicio'])); ?> al <?php echo date('d/m/y', strtotime($row['fecha_fin'])); ?></small>
                    </td>
                    <td><?php echo htmlspecialchars($nombreDocenteCompleto); ?></td>
                    <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </section>

        <aside class="card report-details" id="reportDetails">
          <h2>Detalle de la Solicitud</h2>
          <div class="detail-body" id="detailBody">
            <p class="neutral-text">Selecciona una solicitud de la lista para ver el desglose completo de la información.</p>
          </div>
        </aside>
      </div>

    </div>
  </div>

  <script>
    // Sistema Dinámico de Pestañas Corregido
    function showSection(id){
  // 1. Ocultar todas las secciones
  document.querySelectorAll('.section').forEach(s => {
      s.style.display = 'none';
      s.classList.remove('active');
  });
  
  // 2. Desactivar estilos de todos los botones
  document.querySelectorAll('.actions .btn').forEach(b => b.classList.remove('active-btn'));

  // 3. Activar el botón actual
  document.getElementById('btn-' + id).classList.add('active-btn');

  // 4. Obtener la sección destino y el contenedor principal
  const targetSection = document.getElementById('sec-' + id);
  const mainContainer = document.querySelector('.grid-main-content');

  // 5. Lógica de centrado condicional
  if(id === 'mis') {
      // Si es el historial, quitamos el centrado para que use todo el ancho en paralelo
      mainContainer.classList.remove('layout-centrado');
      targetSection.style.display = 'flex'; 
  } else {
      // Si es Inicio o Nuevo Trámite, activamos el centrado estricto
      mainContainer.classList.add('layout-centrado');
      targetSection.style.display = 'block';
  }
  
  targetSection.classList.add('active');
}

    // Lógica Interactiva para la Fila de la Tabla
    const rows = document.querySelectorAll('#reportList tbody tr');
    const details = document.getElementById('reportDetails');
    const detailBody = document.getElementById('detailBody');

    rows.forEach(row => {
      row.addEventListener('click', () => {
        // Obtenemos los dataset de la fila seleccionada
        const id = row.dataset.id;
        const tipo = row.dataset.tipo;
        const fecha = row.dataset.fecha;
        const estado = row.dataset.estado;
        const notas = row.dataset.notas;

        // Construcción limpia y segura del HTML dinámico
        detailBody.innerHTML = `
          <div class="detail-item-box">
             <p><strong>Folio de Trámite:</strong> #${id}</p>
             <p><strong>Motivo / Tipo:</strong> ${tipo}</p>
             <p><strong>Fechas Comprendidas:</strong> ${fecha}</p>
             <p><strong>Estatus Actual:</strong> <span class="status-indicator">${estado}</span></p>
             <p><strong>Comentarios del Alumno:</strong></p>
             <blockquote class="comments-quote">${notas}</blockquote>
          </div>
        `;

        details.classList.add('visible');

        // Resaltar la fila que se clickeó
        rows.forEach(r => r.classList.remove('selected'));
        row.classList.add('selected');
      });
    });
  </script>
</body>
</html>