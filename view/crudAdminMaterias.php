
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: loginAdmin.php');
    exit();
}

require_once __DIR__ . '/../model/MMaterias.php';
$mmaterias = new MMaterias();

$search_query = '';
$materias = [];

if (isset($_SESSION['materias_resultados'])) {
    $materias = $_SESSION['materias_resultados'];
    $search_query = $_SESSION['search_query'] ?? '';
    unset($_SESSION['materias_resultados'], $_SESSION['search_query']);
} else {
    $materias = $mmaterias->consultar();
}

$editarMateria = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'seleccionarMateria') {
    $id_materia = $_POST['id_materia'] ?? null;
    if (is_numeric($id_materia)) {
        $editarMateria = $mmaterias->obtenerPorId($id_materia);
    }
}

$successmsj = $_SESSION['successmsj'] ?? '';
$errormsj = $_SESSION['errormsj'] ?? '';
unset($_SESSION['successmsj'], $_SESSION['errormsj']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Materias</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php include 'menuLateralAdmin.php'; ?>

<main class="container">
    <section class="main">
        <div class="card">
            <div class="section-title">
                <h2>Gestión de Materias</h2>
                <span>Administración de materias</span>
            </div>
            <form method="POST" action="../controller/dispacherMaterias.php">
                <input type="hidden" name="accion" value="buscarMateria">
                <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">
                    <input type="text"
                        name="materia"
                        class="input-crud"
                        placeholder="Buscar materia..."
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
                <h2>Lista de Materias</h2>
                <span>Materias registradas</span>
            </div>

            <table class="mini-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Clave</th>
                        <th>Materia</th>
                        <th>Créditos</th>
                        <th>Horas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($materias)) : ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">No hay materias registradas.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($materias as $materia) : ?>
                            <tr>
                                <td><?= htmlspecialchars($materia['id_materia']) ?></td>
                                <td><?= htmlspecialchars($materia['clave_materia']) ?></td>
                                <td><?= htmlspecialchars($materia['nombre_materia']) ?></td>
                                <td><?= htmlspecialchars($materia['creditos']) ?></td>
                                <td><?= htmlspecialchars($materia['horas_semana']) ?></td>
                                <td>
                                    <span class="tag <?= $materia['estado'] == 1 ? 'ok' : 'err' ?>">
                                        <?= $materia['estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions" style="display:flex; gap:8px; flex-wrap:wrap;">
                                        <form method="POST" action="crudAdminMaterias.php" style="display:inline; margin:0;">
                                            <input type="hidden" name="accion" value="seleccionarMateria">
                                            <input type="hidden" name="id_materia" value="<?= htmlspecialchars($materia['id_materia']) ?>">
                                            <button class="btn" type="submit">Editar</button>
                                        </form>
                                        <form method="POST" action="../controller/dispacherMaterias.php" style="display:inline; margin:0;">
                                            <input type="hidden" name="accion" value="eliminarMateria">
                                            <input type="hidden" name="id_materia" value="<?= htmlspecialchars($materia['id_materia']) ?>">
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar esta materia?')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card" id="formMateria">
            <div class="section-title">
                <h2><?= $editarMateria ? 'Editar Materia' : 'Registrar Materia' ?></h2>
                <span>Formulario de materias</span>
            </div>

            <form method="POST" action="../controller/dispacherMaterias.php">
                <input type="hidden" name="id_materia" value="<?= $editarMateria ? htmlspecialchars($editarMateria['id_materia']) : '' ?>">
                <input type="hidden" name="accion" value="<?= $editarMateria ? 'editarMateria' : 'RegistrarMateria' ?>">

                <div class="form-grid">
                    <input type="text"
                        name="clave"
                        class="input-crud"
                        placeholder="Clave Materia"
                        required
                        pattern="[A-Za-z0-9\-]+"
                        title="Solo letras, números y guiones"
                        value="<?= $editarMateria ? htmlspecialchars($editarMateria['clave_materia']) : '' ?>">

                    <input type="text"
                        name="nombre"
                        class="input-crud"
                        placeholder="Nombre Materia"
                        required
                        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                        title="Solo letras y espacios"
                        value="<?= $editarMateria ? htmlspecialchars($editarMateria['nombre_materia']) : '' ?>">

                    <input type="number"
                        name="creditos"
                        class="input-crud"
                        placeholder="Créditos"
                        required
                        min="1"
                        max="20"
                        value="<?= $editarMateria ? htmlspecialchars($editarMateria['creditos']) : '' ?>">

                    <input type="number"
                        name="horas_semana"
                        class="input-crud"
                        placeholder="Horas Semana"
                        required
                        min="1"
                        max="40"
                        value="<?= $editarMateria ? htmlspecialchars($editarMateria['horas_semana']) : '' ?>">

                    <select name="estado" class="input-crud" required>
                        <option value="">Estado</option>
                        <option value="1" <?= (isset($editarMateria['estado']) && $editarMateria['estado'] == 1) ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= (isset($editarMateria['estado']) && $editarMateria['estado'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>

                <div style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">
                    <button class="btn primary" type="submit">
                        <?= $editarMateria ? 'Actualizar Materia' : 'Guardar Materia' ?>
                    </button>
                    <?php if ($editarMateria) : ?>
                        <a href="crudAdminMaterias.php" class="btn">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

    </section>
</main>
</body>
</html>