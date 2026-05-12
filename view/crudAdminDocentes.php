<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: loginAdmin.php');
    exit();
}

require_once __DIR__ . '/../model/MDocentes.php';
$mdocentes = new MDocentes();

$search_query = '';
$docentes = [];

if (isset($_SESSION['docentes_resultados'])) {
    $docentes = $_SESSION['docentes_resultados'];
    $search_query = $_SESSION['search_query'] ?? '';
    unset($_SESSION['docentes_resultados'], $_SESSION['search_query']);
} else {
    $docentes = $mdocentes->consultar();
}

$editarDocente = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'seleccionarDocente') {
    $id_docente = $_POST['id_docente'] ?? null;
    if (is_numeric($id_docente)) {
        $editarDocente = $mdocentes->obtenerDocentePorId($id_docente);
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
    <title>CRUD Docentes</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php include 'menuLateralAdmin.php'; ?>

<main class="container">
    <section class="main">
        <div class="card">
            <div class="section-title">
                <h2>Gestión de Docentes</h2>
                <span>Administración de docentes</span>
            </div>
            <form method="POST" action="../controller/dispacherDocentes.php">
                <input type="hidden" name="accion" value="buscarDocente">
                <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">
                    <input type="text"
                        name="docente"
                        class="input-crud"
                        placeholder="Buscar docente..."
                        style="max-width:300px;"
                        value="<?= htmlspecialchars($search_query) ?>">
                    <button class="btn primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="section-title">
                <h2>Lista de Docentes</h2>
                <span>Docentes registrados</span>
            </div>

            <table class="mini-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>No. Empleado</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($docentes)) : ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No hay docentes registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($docentes as $docente) : ?>
                            <tr>
                                <td><?= htmlspecialchars($docente['id_docente'] ?? '') ?></td>
                                <td><?= htmlspecialchars($docente['nombre'] . ' ' . $docente['app'] . ' ' . $docente['apm']) ?></td>
                                <td><?= htmlspecialchars($docente['no_empleado']) ?></td>
                                <td><?= htmlspecialchars($docente['especialidad']) ?></td>
                                <td>
                                    <span class="tag <?= $docente['activo'] == 1 ? 'ok' : 'err' ?>">
                                        <?= $docente['activo'] == 1 ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions" style="display:flex; gap:8px; flex-wrap:wrap;">
                                        <form method="POST" action="crudAdminDocentes.php" style="display:inline; margin:0;">
                                            <input type="hidden" name="accion" value="seleccionarDocente">
                                            <input type="hidden" name="id_docente" value="<?= htmlspecialchars($docente['id_docente']) ?>">
                                            <button class="btn" type="submit">Editar</button>
                                        </form>
                                        <form method="POST" action="../controller/dispacherDocentes.php" style="display:inline; margin:0;">
                                            <input type="hidden" name="accion" value="eliminarDocente">
                                            <input type="hidden" name="id_docente" value="<?= htmlspecialchars($docente['id_docente']) ?>">
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar este docente?')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card" id="formDocente">
            <div class="section-title">
                <h2><?= $editarDocente ? 'Editar Docente' : 'Registrar Docente' ?></h2>
                <span>Formulario de docentes</span>
            </div>

            <form method="POST" action="../controller/dispacherDocentes.php">
                <input type="hidden" name="id_docente" value="<?= $editarDocente ? htmlspecialchars($editarDocente['id_docente']) : '' ?>">
                <input type="hidden" name="accion" value="<?= $editarDocente ? 'editarDocente' : 'RegistrarDocente' ?>">

                <div class="form-grid">
                    <input type="text"
                        name="nombre"
                        class="input-crud"
                        placeholder="Nombre"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['nombre']) : '' ?>">

                    <input type="text"
                        name="app"
                        class="input-crud"
                        placeholder="Apellido Paterno"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['app']) : '' ?>">

                    <input type="text"
                        name="apm"
                        class="input-crud"
                        placeholder="Apellido Materno"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['apm']) : '' ?>">

                    <input type="email"
                        name="correo"
                        class="input-crud"
                        placeholder="Correo Electrónico"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['correo']) : '' ?>">

                    <input type="text"
                        name="noEmpleado"
                        class="input-crud"
                        placeholder="Número de Empleado"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['no_empleado']) : '' ?>">

                    <input type="text"
                        name="curp"
                        class="input-crud"
                        placeholder="CURP"
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['curp']) : '' ?>">

                    <input type="text"
                        name="rfc"
                        class="input-crud"
                        placeholder="RFC"
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['rfc']) : '' ?>">

                    <input type="text"
                        name="nss"
                        class="input-crud"
                        placeholder="NSS"
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['nss']) : '' ?>">

                    <input type="tel"
                        name="telefono"
                        class="input-crud"
                        placeholder="Teléfono"
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['telefono']) : '' ?>">

                    <input type="date"
                        name="fechaNac"
                        class="input-crud"
                        required
                        value="<?= $editarDocente ? htmlspecialchars(explode(' ', $editarDocente['fecha_nac'])[0]) : '' ?>">

                    <input type="text"
                        name="cedula"
                        class="input-crud"
                        placeholder="Cédula Profesional"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['cedula']) : '' ?>">

                    <input type="text"
                        name="especialidad"
                        class="input-crud"
                        placeholder="Especialidad"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['especialidad']) : '' ?>">

                    <input type="text"
                        name="gradoEstudio"
                        class="input-crud"
                        placeholder="Grado de Estudios"
                        required
                        value="<?= $editarDocente ? htmlspecialchars($editarDocente['grado_estudio']) : '' ?>">

                    <select name="estado" class="input-crud" required>
                        <option value="">Estado</option>
                        <option value="1" <?= (isset($editarDocente['activo']) && $editarDocente['activo'] == 1) ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= (isset($editarDocente['activo']) && $editarDocente['activo'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                    </select>

                    <?php if (!$editarDocente) : ?>
                        <input type="password"
                            name="contrasenia"
                            class="input-crud"
                            placeholder="Contraseña"
                            required>

                        <input type="password"
                            name="confcontrasenia"
                            class="input-crud"
                            placeholder="Confirmar Contraseña"
                            required>
                    <?php else: ?>
                        <input type="password"
                            name="contrasenia"
                            class="input-crud"
                            placeholder="Nueva contraseña (opcional)">

                        <input type="password"
                            name="confcontrasenia"
                            class="input-crud"
                            placeholder="Confirmar nueva contraseña">

                        <p style="font-size:0.85rem; color:#555; margin:0; grid-column: span 2;">
                            Dejar vacío para conservar la contraseña actual.
                        </p>
                    <?php endif; ?>
                </div>

                <div style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">
                    <button class="btn primary" type="submit">
                        <?= $editarDocente ? 'Actualizar Docente' : 'Guardar Docente' ?>
                    </button>
                    <?php if ($editarDocente) : ?>
                        <a href="crudAdminDocentes.php" class="btn">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

    </section>
</main>

</body>
</html>