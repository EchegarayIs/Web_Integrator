<?php
session_start();
require_once '../model/MAlumnos.php';
$alumnoModel = new MAlumnos();
$idAlumno = $_SESSION['usuario']['id_alumno'];

// Cargar datos reales
$inscritos = $alumnoModel->obtenerGruposInscritos($idAlumno);
$disponibles = $alumnoModel->obtenerGruposDisponibles($idAlumno);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Mis Grupos</title>
  <link rel="stylesheet" href="resources/alumnosGrupo.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php include 'menuLateralAlumnos.php'; ?>

<div class="container">
  <header class="topbar">
    <div class="brand">
      <div class="logo">G</div>
      <h1>Mis Grupos</h1>
    </div>
  </header>

  <!-- MENSAJES DE FEEDBACK -->
  <?php if(isset($_SESSION['successmsj'])): ?>
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
        <?= $_SESSION['successmsj']; unset($_SESSION['successmsj']); ?>
    </div>
  <?php endif; ?>

  <!-- GRUPOS INSCRITOS -->
  <h2>Grupos en los que estoy inscrito</h2>
  <div class="grid">
    <?php if(empty($inscritos)): ?>
        <p>No estás inscrito en ningún grupo aún.</p>
    <?php else: ?>
        <?php foreach($inscritos as $g): ?>
        <div class="card">
          <div class="card-header">
            <div>
              <p class="materia"><?= $g['nombre_materia'] ?></p>
              <p class="grupo"><?= $g['nombre_grupo'] ?> - Turno <?= $g['turno'] ?></p>
            </div>
            <span class="status">✓ Activo</span>
          </div>
          <div class="info">
            <div class="info-item"><span class="label">Semestre</span><span class="value"><?= $g['semestre'] ?></span></div>
            <div class="info-item"><span class="label">Ciclo</span><span class="value"><?= $g['nombre_ciclo'] ?></span></div>
            <div class="info-item"><span class="label">Inscrito el</span><span class="value"><?= date('d/m/Y', strtotime($g['fecha_inscripcion'])) ?></span></div>
          </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- GRUPOS DISPONIBLES -->
  <h2>Grupos disponibles para inscribirme</h2>
  <table>
    <thead>
      <tr>
        <th>Grupo</th>
        <th>Semestre</th>
        <th>Ciclo</th>
        <th>Materia</th>
        <th>Clave</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
      <?php if(empty($disponibles)): ?>
          <tr><td colspan="6" style="text-align:center;">No hay grupos disponibles por el momento.</td></tr>
      <?php else: ?>
          <?php foreach($disponibles as $d): ?>
          <tr>
            <td><strong><?= $d['nombre_grupo'] ?></strong><br><small><?= $d['turno'] ?></small></td>
            <td><?= $d['semestre'] ?></td>
            <td><?= $d['nombre_ciclo'] ?></td>
            <td><?= $d['nombre_materia'] ?></td>
            <td><?= $d['semestre'] ?></td>
            <td>
                <form action="../controller/dispatcherAlumnos.php" method="POST">
                    <input type="hidden" name="accion" value="InscribirGrupo">
                    <input type="hidden" name="idGrupo" value="<?= $d['id_grupo'] ?>">
                    <button type="submit" class="btn-inscribir">Unirme</button>
                </form>
            </td>
          </tr>
          <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>