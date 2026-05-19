<?php
$currentFile = basename($_SERVER['PHP_SELF']);
function navClass($target) {
    global $currentFile;
    return $currentFile === $target ? ' active' : '';
}
?>

<div class="sidebar">

    <div class="sidebar-header">
        <h2>
            <span class="material-icons logo-icon">school</span>
            Alumno
        </h2>
    </div>

    <div class="menu-items">

        <a href="alumnosHome.php" class="menu-item<?= navClass('alumnosHome.php') ?>">
            <span class="material-icons">home_location</span>
            <span>Menú</span>
        </a>

        <a href="alumnosPerfil.php" class="menu-item<?= navClass('alumnosPerfil.php') ?>">
            <span class="material-icons">account_circle</span>
            <span>Perfil</span>
        </a>

        <form action="../controller/dispacherAlumnos.php" method="post" style="margin:0;">
            <input type="hidden" name="accion" value="Asistencia">
            <button type="submit" class="menu-item" style="background:none; border:none; width:100%; text-align:left;">
                <span class="material-icons">event_available</span>
                <span>Asistencia</span>
            </button>
        </form> 

        <form action="../controller/dispacherAlumnos.php" method="post" style="margin:0;">
            <input type="hidden" name="accion" value="Grupo">
            <button type="submit" class="menu-item" style="background:none; border:none; width:100%; text-align:left;">
                <span class="material-icons">group</span>
                <span>Grupos</span>
            </button>
        </form>

        <form action="../controller/dispacherAlumnos.php" method="post" style="margin:0;">
            <input type="hidden" name="accion" value="Justificante">
            <button type="submit" class="menu-item" style="background:none; border:none; width:100%; text-align:left;">
                <span class="material-icons">description</span>
                <span>Justificante</span>
            </button>
        </form>

        <hr style="margin: 15px 25px; border: none; border-top: 1px solid #eee;">

        <a href="../controller/logout.php" class="menu-item" style="color: #e74c3c;">
            <span class="material-icons">logout</span>
            <span>Cerrar Sesión</span>
        </a>

    </div>

</div>