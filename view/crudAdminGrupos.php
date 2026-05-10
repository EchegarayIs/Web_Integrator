---

# crudGrupos.php

```php
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>CRUD Grupos</title>

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

        <h2>Gestión de Grupos</h2>

    </div>

    <div class="actions">

        <a href="#formGrupo"
            class="btn primary"
            style="text-decoration:none;">

            + Registrar Grupo

        </a>

    </div>

</div>

<div class="card">

    <table class="mini-table">

        <thead>

            <tr>
                <th>ID</th>
                <th>Grupo</th>
                <th>Semestre</th>
                <th>Turno</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

            <tr>

                <td>1</td>
                <td>4A</td>
                <td>4</td>
                <td>Matutino</td>
                <td>40</td>

                <td>

                    <div class="table-actions">

                        <button class="btn">Editar</button>

                        <button class="btn btn-danger">Eliminar</button>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

</div>

<div class="card" id="formGrupo">

    <div class="section-title">

        <h2>Registrar / Editar Grupo</h2>

    </div>

    <form method="POST">

        <input type="hidden" name="id_grupo">

        <div class="form-grid">

            <input type="text" name="nombre_grupo" class="input-crud" placeholder="Nombre Grupo">

            <input type="number" name="semestre" class="input-crud" placeholder="Semestre">

            <input type="text" name="turno" class="input-crud" placeholder="Turno">

            <input type="number" name="capacidad" class="input-crud" placeholder="Capacidad">

        </div>

        <div style="margin-top:20px;">

            <button class="btn primary"
                name="accion"
                value="guardar">

                Guardar Grupo

            </button>

        </div>

    </form>

</div>

</section>

</main>

</body>
</html>