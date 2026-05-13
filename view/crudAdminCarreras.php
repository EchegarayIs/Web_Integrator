<?php
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: loginAdmin.php');
    exit();
}

require_once __DIR__ . '/../model/MCarreras.php';
$mcarreras = new MCarreras();

$search_query = '';
$carreras = [];

if (isset($_SESSION['carreras_resultados'])) {
    $carreras = $_SESSION['carreras_resultados'];
    $search_query = $_SESSION['search_query'] ?? '';
    unset($_SESSION['carreras_resultados'], $_SESSION['search_query']);
} else {
    $carreras = $mcarreras->consultar();
}

$editarCarrera = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'seleccionarCarrera') {
    $id_carrera = $_POST['id_carrera'] ?? null;
    if (is_numeric($id_carrera)) {
        $editarCarrera = $mcarreras->obtenerPorId($id_carrera);
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

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>CRUD Carreras</title>

    <link rel="stylesheet"
        href="resources/homeAdmin.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">

</head>

<body>

<?php include 'menuLateralAdmin.php'; ?>

<main class="container">

<section class="main">

    <div class="card">
        <div class="section-title">
            <h2>Gestión de Carreras</h2>
            <span>
                Administración completa de carreras
            </span>

        </div>
        <form method="POST" action="../controller/dispacherCarreras.php">
            <input type="hidden" name="accion" value="buscarCarrera">
            <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">
                <input type="text"
                name="carrera"
                class="input-crud"
                placeholder="Buscar carrera..."
                style="max-width:300px;"
                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                title="Solo se permiten letras y espacios"
                value="<?= htmlspecialchars($search_query) ?>">

                <button class="btn primary" type="submit">
                    Buscar
                </button>
            </div>
        </form>

    </div>

    <div class="card">

        <div class="section-title">

            <h2>Lista de Carreras</h2>

            <span>
                Carreras registradas
            </span>

        </div>

        <table class="mini-table">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>
                <?php if (empty($carreras)) : ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No hay carreras registradas.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($carreras as $carrera) : ?>
                        <tr>
                            <td><?= htmlspecialchars($carrera['id_carrera']) ?></td>
                            <td><?= htmlspecialchars($carrera['clave']) ?></td>
                            <td><?= htmlspecialchars($carrera['nombre']) ?></td>
                            <td><?= htmlspecialchars($carrera['fecha_registro']) ?></td>
                            <td>
                                <div class="table-actions" style="display:flex; gap:8px; flex-wrap:wrap;">
                                    <form method="POST" action="crudAdminCarreras.php" style="display:inline; margin:0;">
                                        <input type="hidden" name="accion" value="seleccionarCarrera">
                                        <input type="hidden" name="id_carrera" value="<?= htmlspecialchars($carrera['id_carrera']) ?>">
                                        <button class="btn" type="submit">Editar</button>
                                    </form>
                                    <form method="POST" action="../controller/dispacherCarreras.php" style="display:inline; margin:0;">
                                        <input type="hidden" name="accion" value="eliminarCarrera">
                                        <input type="hidden" name="id_carrera" value="<?= htmlspecialchars($carrera['id_carrera']) ?>">
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('¿Eliminar esta carrera?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>

    </div>

    <div class="card" id="formCarrera">

        <div class="section-title">

            <h2><?= $editarCarrera ? 'Editar Carrera' : 'Registrar Carrera' ?></h2>

            <span>
                Formulario de carreras
            </span>

        </div>

        <form method="POST" action="../controller/dispacherCarreras.php">
            <input type="hidden" name="id_carrera" value="<?= $editarCarrera ? htmlspecialchars($editarCarrera['id_carrera']) : '' ?>">
            <input type="hidden" name="accion" value="<?= $editarCarrera ? 'editarCarrera' : 'RegistrarCarrera' ?>">

            <div class="form-grid">

                <input type="text"
                name="clave"
                class="input-crud"
                placeholder="Clave Carrera"
                required
                pattern="[A-Za-z0-9\-]+"
                title="Solo letras, números y guiones"
                value="<?= $editarCarrera ? htmlspecialchars($editarCarrera['clave']) : '' ?>">

                <input type="text"
                name="nombre"
                class="input-crud"
                placeholder="Nombre Carrera"
                required
                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                title="Solo se permiten letras y espacios"
                value="<?= $editarCarrera ? htmlspecialchars($editarCarrera['nombre']) : '' ?>">

                <input type="date"
                    name="fecha_registro"
                    class="input-crud"
                    required
                    value="<?= $editarCarrera ? htmlspecialchars(explode(' ', $editarCarrera['fecha_registro'])[0]) : date('Y-m-d') ?>">

            </div>

            <div style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">

                <button class="btn primary" type="submit">
                    <?= $editarCarrera ? 'Actualizar Carrera' : 'Guardar Carrera' ?>
                </button>
                <?php if ($editarCarrera) : ?>
                    <a href="crudAdminCarreras.php" class="btn">Cancelar</a>
                <?php endif; ?>

            </div>

        </form>

    </div>

</section>

</main>

</body>
</html>