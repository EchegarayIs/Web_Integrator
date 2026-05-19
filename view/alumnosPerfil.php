<?php
session_start();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mi Perfil - Sistema Escolar</title>
    <link rel="stylesheet" href="resources/alumnosPerfil.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php include 'menuLateralAlumnos.php'; ?>

<div class="container">
  <header class="topbar">
    <div class="brand">
      <div class="logo">G</div>
      <h1>Mi Perfil de Alumno</h1>
    </div>
    <a href="#" style="text-decoration:none; font-size:14px; color:var(--primary); font-weight:700;">Volver al Inicio</a>
  </header>

  <div class="profile-grid">
    <aside>
      <div class="card">

        <?php

        $perfil = $_SESSION['usuario'] ?? null;

        if ($perfil) {
          echo '<div class="profile-header">';
          echo '  <div class="avatar">👤</div>';
          echo '  <h2 style="margin:0; font-size:18px;">' . htmlspecialchars($perfil['nombre'] . ' ' . $perfil['app'] . ' ' . $perfil['apm']) . '</h2>';
          echo '  <p style="color:var(--muted); font-size:14px; margin:4px 0 12px;">Matrícula: ' . htmlspecialchars($perfil['matricula']) . '</p>';
          echo '  <span class="badge">Estatus: ' . ($perfil['activo'] ? 'Activo' : 'Inactivo') . '</span>';
          echo '</div>';
          
          echo '<div style="border-top:1px solid var(--border); padding-top:20px; margin-top:20px;">';
          echo '  <div class="form-group">';
          echo '    <label>Carrera ID</label>';
          echo '    <input type="text" value="' . htmlspecialchars($perfil['carrera'] ?? 'Carrera no proporcionada') . '" readonly>';
          echo '  </div>';
          echo '  <div class="form-group">';
          echo '    <label>Semestre Actual</label>';
          echo '    <input type="text" value="' . htmlspecialchars(($perfil['semestre'] ?? 'Semestre no proporcionado') . '° Semestre') . '" readonly>';
          echo '  </div>';
          echo '</div>';
        } else {
          echo '<p>No se pudo cargar la información del perfil.</p>';
        }

        ?>
      </div>
    </aside>

    <main>
      <div class="card">
        <form action="../controller/dispacherAlumnos.php" method="post">
          <h3 class="section-title">Información Personal</h3>
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div class="form-group">
              <label>Nombre(s)</label>
              <input type="text" value="<?php echo htmlspecialchars($perfil['nombre'] ?? 'Nombre no proporcionado'); ?>" readonly>
            </div>
            <div class="form-group">
              <label>Apellido Paterno</label>
              <input type="text" value="<?php echo htmlspecialchars($perfil['app'] ?? 'Apellido paterno no proporcionado'); ?>" readonly>
            </div>
          </div>

          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div class="form-group">
              <label>CURP</label>
              <input type="text" value="<?php echo htmlspecialchars($perfil['curp'] ?? 'CURP no proporcionada'); ?>" readonly>
            </div>
            <div class="form-group">
              <label>RFC</label>
              <input type="text" value="<?php echo htmlspecialchars($perfil['rfc'] ?? 'RFC no proporcionado'); ?>" readonly>
            </div>
          </div>

          <h3 class="section-title" style="margin-top:30px;">Datos de Contacto (Editables)</h3>
          <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" value="<?php echo htmlspecialchars($perfil['correo'] ?? 'Correo no proporcionado'); ?>" placeholder="correo@ejemplo.com">
          </div>
          
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div class="form-group">
              <label>Teléfono</label>
              <input type="tel" name="telefono" value="<?php echo htmlspecialchars($perfil['telefono'] ?? 'No. de teléfono no proporcionado'); ?>" placeholder="10 dígitos">
            </div>
            <div class="form-group">
              <label>Nueva Contraseña</label>
              <input 
              type="password" 
              name="contrasenia"
              placeholder="Dejar en blanco para no cambiar "
              pattern="^(?=.*[A-Z])(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$"
              title="Mínimo 8 caracteres, una mayúscula y un número o símbolo">
            </div>
          </div>

          <div class="form-group" style="margin-top:20px;">
            <label>Número de Seguridad Social (NSS)</label>
            <input type="text" value="<?php echo htmlspecialchars($perfil['nss'] ?? 'No. de NSS no proporcionado'); ?>" readonly>
          </div>

          <div style="margin-top:32px;">
            <input type="hidden" name="accion" value="ActualizarPerfil">
            <button type="submit" class="btn-save">Actualizar Información de Perfil</button>
            <p style="text-align:center; font-size:12px; color:var(--muted); margin-top:12px;">
              Los campos en gris no pueden ser modificados por el alumno.
            </p>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>

</body>
</html>