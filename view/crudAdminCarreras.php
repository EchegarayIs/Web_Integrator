# crudCarreras.php

```php
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

        <div class="actions">

            <a href="#formCarrera"
                class="btn primary"
                style="text-decoration:none;">

                + Registrar Carrera

            </a>

        </div>

    </div>

    <div class="card">

        <form method="GET">

            <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">

                <input type="text"
                    name="buscar"
                    class="input-crud"
                    placeholder="Buscar carrera..."
                    style="max-width:300px;">

                <button class="btn">
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

                <tr>

                    <td>1</td>
                    <td>ISC</td>
                    <td>Ingeniería en Sistemas</td>
                    <td>2026-05-09</td>

                    <td>

                        <div class="table-actions">

                            <button class="btn">
                                Editar
                            </button>

                            <button class="btn btn-danger">
                                Eliminar
                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div class="card" id="formCarrera">

        <div class="section-title">

            <h2>Registrar / Editar Carrera</h2>

            <span>
                Formulario de carreras
            </span>

        </div>

        <form method="POST">

            <input type="hidden" name="id_carrera">

            <div class="form-grid">

                <input type="text"
                    name="clave"
                    class="input-crud"
                    placeholder="Clave Carrera">

                <input type="text"
                    name="nombre"
                    class="input-crud"
                    placeholder="Nombre Carrera">

                <input type="date"
                    name="fecha_registro"
                    class="input-crud">

            </div>

            <div style="margin-top:20px;">

                <button class="btn primary"
                    name="accion"
                    value="guardar">

                    Guardar Carrera

                </button>

            </div>

        </form>

    </div>

</section>

</main>

</body>
</html>