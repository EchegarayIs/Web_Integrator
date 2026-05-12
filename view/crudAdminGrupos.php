<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: loginAdmin.php');
    exit();
}

require_once __DIR__ . '/../model/MGrupos.php';
$mgrupos = new MGrupos();

$search_query = '';
$grupos = [];

if (isset($_SESSION['grupos_resultados'])) {
    $grupos = $_SESSION['grupos_resultados'];
    $search_query = $_SESSION['search_query'] ?? '';
    unset($_SESSION['grupos_resultados'], $_SESSION['search_query']);
} else {
    $grupos = $mgrupos->consultar();
}

$editarGrupo = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'seleccionarGrupo') {
    $id_grupo = $_POST['id_grupo'] ?? null;
    if (is_numeric($id_grupo)) {
        $editarGrupo = $mgrupos->obtenerPorId($id_grupo);
    }
}

$ciclos = $mgrupos->obtenerCiclos();
$materias = $mgrupos->obtenerMaterias();

$successmsj = $_SESSION['successmsj'] ?? '';
$errormsj = $_SESSION['errormsj'] ?? '';
unset($_SESSION['successmsj'], $_SESSION['errormsj']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Grupos</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<?php include 'menuLateralAdmin.php'; ?>
<main class="container">
    <section class="main">
        <div class="card">
            <div class="section-title">
                <h2>Gestión de Grupos</h2>
                <span>Administración de grupos</span>
            </div>
            <form method="POST" action="../controller/dispacherGrupos.php">
                <input type="hidden" name="accion" value="buscarGrupo">
                <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">
                    <input type="text"
                        name="grupo"
                        class="input-crud"
                        placeholder="Buscar grupo..."
                        style="max-width:300px;"
                        value="<?= htmlspecialchars($search_query) ?>">
                    <button class="btn primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="section-title">
                <h2>Lista de Grupos</h2>
                <span>Grupos registrados</span>
            </div>
            <table class="mini-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupo</th>
                        <th>Semestre</th>
                        <th>Turno</th>
                        <th>Capacidad</th>
                        <th>Materia</th>
                        <th>Ciclo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($grupos)) : ?>
                        <tr>
                            <td colspan="8" style="text-align:center;">No hay grupos registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($grupos as $grupo) : ?>
                            <tr>
                                <td><?= htmlspecialchars($grupo['id_grupo']) ?></td>
                                <td><?= htmlspecialchars($grupo['nombre_grupo']) ?></td>
                                <td><?= htmlspecialchars($grupo['semestre']) ?></td>
                                <td><?= htmlspecialchars($grupo['turno']) ?></td>
                                <td><?= htmlspecialchars($grupo['capacidad']) ?></td>
                                <td><?= htmlspecialchars($grupo['nombre_materia'] ?? '') ?></td>
                                <td><?= htmlspecialchars($grupo['nombre'] ?? '') ?></td>
                                <td>
                                    <div class="table-actions" style="display:flex; gap:8px; flex-wrap:wrap;">
                                        <form method="POST" action="crudAdminGrupos.php" style="display:inline; margin:0;">
                                            <input type="hidden" name="accion" value="seleccionarGrupo">
                                            <input type="hidden" name="id_grupo" value="<?= htmlspecialchars($grupo['id_grupo']) ?>">
                                            <button class="btn" type="submit">Editar</button>
                                        </form>
                                        <form method="POST" action="../controller/dispacherGrupos.php" style="display:inline; margin:0;">
                                            <input type="hidden" name="accion" value="eliminarGrupo">
                                            <input type="hidden" name="id_grupo" value="<?= htmlspecialchars($grupo['id_grupo']) ?>">
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar este grupo?')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card" id="formGrupo">
            <div class="section-title">
                <h2><?= $editarGrupo ? 'Editar Grupo' : 'Registrar Grupo' ?></h2>
                <span><?= $editarGrupo ? 'Actualiza los datos del grupo' : 'Llena los datos para registrar un nuevo grupo' ?></span>
            </div>
            <form method="POST" action="../controller/dispacherGrupos.php">
                <input type="hidden" name="id_grupo" value="<?= $editarGrupo ? htmlspecialchars($editarGrupo['id_grupo']) : '' ?>">
                <input type="hidden" name="accion" value="<?= $editarGrupo ? 'editarGrupo' : 'RegistrarGrupo' ?>">
                <div class="form-grid">
                    <input type="text"
                        name="nombre_grupo"
                        class="input-crud"
                        placeholder="Nombre Grupo"
                        required
                        value="<?= $editarGrupo ? htmlspecialchars($editarGrupo['nombre_grupo']) : '' ?>">

                    <input type="number"
                        name="semestre"
                        class="input-crud"
                        placeholder="Semestre"
                        required
                        value="<?= $editarGrupo ? htmlspecialchars($editarGrupo['semestre']) : '' ?>">

                    <input type="text"
                        name="turno"
                        class="input-crud"
                        placeholder="Turno"
                        required
                        value="<?= $editarGrupo ? htmlspecialchars($editarGrupo['turno']) : '' ?>">

                    <input type="number"
                        name="capacidad"
                        class="input-crud"
                        placeholder="Capacidad"
                        required
                        value="<?= $editarGrupo ? htmlspecialchars($editarGrupo['capacidad']) : '' ?>">

                    <select name="id_materia" class="input-crud" required>
                        <option value="">Selecciona una materia</option>
                        <?php foreach ($materias as $materia) : ?>
                            <option value="<?= htmlspecialchars($materia['id_materia']) ?>" <?= $editarGrupo && $editarGrupo['id_materia'] == $materia['id_materia'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($materia['nombre_materia']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="id_ciclo" class="input-crud" required>
                        <option value="">Selecciona un ciclo</option>
                        <?php foreach ($ciclos as $ciclo) : ?>
                            <option value="<?= htmlspecialchars($ciclo['id_ciclo']) ?>" <?= $editarGrupo && $editarGrupo['id_ciclo'] == $ciclo['id_ciclo'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($ciclo['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">
                    <button class="btn primary" type="submit">
                        <?= $editarGrupo ? 'Actualizar Grupo' : 'Guardar Grupo' ?>
                    </button>
                    <?php if ($editarGrupo) : ?>
                        <a href="crudAdminGrupos.php" class="btn">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
</main>

</body>
</html>