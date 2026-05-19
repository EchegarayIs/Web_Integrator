<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: loginAdmin.php');
    exit();
}

require_once __DIR__ . '/../model/MCiclosEscolares.php';
$mciclos = new MCiclosEscolares();
$search_query = '';
$ciclos = [];

if (isset($_SESSION['ciclos_resultados'])) {
    $ciclos = $_SESSION['ciclos_resultados'];
    $search_query = $_SESSION['search_query'] ?? '';
    unset($_SESSION['ciclos_resultados'], $_SESSION['search_query']);
} else {
    $ciclos = $mciclos->consultar();
}

$editarCiclo = $_SESSION['ciclo_editar'] ?? null;
unset($_SESSION['ciclo_editar']);

$successmsj = $_SESSION['successmsj'] ?? '';
$errormsj = $_SESSION['errormsj'] ?? '';
unset($_SESSION['successmsj'], $_SESSION['errormsj']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Ciclos Escolares</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php include 'menuLateralAdmin.php'; ?>
<main class="container">
<section class="main">
    <div class="card">
        <div class="section-title">
            <h2>Gestión de Ciclos Escolares</h2>
            <span>Administración de ciclos escolares</span>
        </div>
        <form method="POST" action="../controller/dispacherCiclosEscolares.php">
            <input type="hidden" name="accion" value="buscarCicloEscolar">
            <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">
                <input type="text"
                name="ciclo_escolar"
                class="input-crud"
                placeholder="Buscar ciclo..."
                style="max-width:300px;"
                pattern="[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]+"
                title="Solo letras, números, espacios y guiones"
                value="<?= htmlspecialchars($search_query) ?>">
                <button class="btn primary" type="submit">Buscar</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="section-title">
            <h2>Lista de Ciclos</h2>
            <span>Ciclos escolares registrados</span>
        </div>
        <table class="mini-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($ciclos)) : ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No hay ciclos escolares registrados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($ciclos as $ciclo) : ?>
                        <tr>
                            <td><?= htmlspecialchars($ciclo['id_ciclo']) ?></td>
                            <td><?= htmlspecialchars($ciclo['nombre']) ?></td>
                            <td><?= htmlspecialchars($ciclo['fecha_inicio']) ?></td>
                            <td><?= htmlspecialchars($ciclo['fecha_fin']) ?></td>
                            <td>
                                <span class="tag <?= $ciclo['estado'] == 1 ? 'ok' : 'err' ?>">
                                    <?= $ciclo['estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions" style="display:flex; gap:8px; flex-wrap:wrap;">
                                    <form method="POST" action="../controller/dispacherCiclosEscolares.php" style="display:inline; margin:0;">
                                        <input type="hidden" name="accion" value="seleccionarCicloEscolar">
                                        <input type="hidden" name="id_ciclo_escolar" value="<?= htmlspecialchars($ciclo['id_ciclo']) ?>">
                                        <button class="btn" type="submit">Editar</button>
                                    </form>
                                    <form method="POST" action="../controller/dispacherCiclosEscolares.php" style="display:inline; margin:0;">
                                        <input type="hidden" name="accion" value="eliminarCicloEscolar">
                                        <input type="hidden" name="id_ciclo_escolar" value="<?= htmlspecialchars($ciclo['id_ciclo']) ?>">
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar este ciclo escolar?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card" id="formCiclo">
        <div class="section-title">
            <h2><?= $editarCiclo ? 'Editar Ciclo' : 'Registrar Ciclo' ?></h2>
            <span><?= $editarCiclo ? 'Actualiza este ciclo escolar' : 'Llena los datos para registrar un ciclo escolar' ?></span>
        </div>
        <form method="POST" action="../controller/dispacherCiclosEscolares.php">
            <input type="hidden" name="id_ciclo_escolar" value="<?= $editarCiclo ? htmlspecialchars($editarCiclo['id_ciclo']) : '' ?>">
            <input type="hidden" name="accion" value="<?= $editarCiclo ? 'editarCicloEscolar' : 'RegistrarCicloEscolar' ?>">
            <div class="form-grid">
                <input type="text"
                name="nombre"
                class="input-crud"
                placeholder="Nombre Ciclo"
                required
                pattern="[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]+"
                title="Solo letras, números, espacios y guiones"
                value="<?= $editarCiclo ? htmlspecialchars($editarCiclo['nombre']) : '' ?>">
                <input type="date"
                    name="fecha_inicio"
                    class="input-crud"
                    required
                    value="<?= $editarCiclo ? htmlspecialchars($editarCiclo['fecha_inicio']) : '' ?>">
                <input type="date"
                    name="fecha_fin"
                    class="input-crud"
                    required
                    value="<?= $editarCiclo ? htmlspecialchars($editarCiclo['fecha_fin']) : '' ?>">
                <select name="estado" class="input-crud" required>
                    <option value="">Estado</option>
                    <option value="1" <?= $editarCiclo && $editarCiclo['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= $editarCiclo && $editarCiclo['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>
            <div style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">
                <button class="btn primary" type="submit">
                    <?= $editarCiclo ? 'Actualizar Ciclo' : 'Guardar Ciclo' ?>
                </button>
                <?php if ($editarCiclo) : ?>
                    <a href="crudAdminCiclosEsco.php" class="btn">Cancelar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

</section>
</main>
</body>
</html>