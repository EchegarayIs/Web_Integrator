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
            <span class="material-icons logo-icon">admin_panel_settings</span>
            Administrador
        </h2>
    </div>

    <div class="menu-items">

        <a href="homeAdmin.php" class="menu-item<?= navClass('homeAdmin.php') ?>">
            <span class="material-icons">dashboard</span>
            <span>Menú</span>
        </a>

        <a href="crudAdminCarreras.php" class="menu-item<?= navClass('crudAdminCarreras.php') ?>">
            <span class="material-icons">history_edu</span>
            <span>Carreras</span>
        </a>

        <a href="crudAdminMaterias.php" class="menu-item<?= navClass('crudAdminMaterias.php') ?>">
            <span class="material-icons">menu_book</span>
            <span>Materias</span>
        </a>

        <a href="crudAdminDocentes.php" class="menu-item<?= navClass('crudAdminDocentes.php') ?>">
            <span class="material-icons">school</span>
            <span>Docentes</span>
        </a>

        <a href="crudAdminGrupos.php" class="menu-item<?= navClass('crudAdminGrupos.php') ?>">
            <span class="material-icons">group_work</span>
            <span>Grupos</span>
        </a>

        <a href="crudAdminCiclosEsco.php" class="menu-item<?= navClass('crudAdminCiclosEsco.php') ?>">
            <span class="material-icons">calendar_month</span>
            <span>Ciclos Escolares</span>
        </a>

        <hr style="margin: 15px 25px; border: none; border-top: 1px solid #eee;">

        <a href="../controller/logout.php" class="menu-item" style="color: #e74c3c;">
            <span class="material-icons">logout</span>
            <span>Cerrar Sesión</span>
        </a>

    </div>

</div>