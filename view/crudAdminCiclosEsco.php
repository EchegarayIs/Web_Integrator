---

# crudCiclos.php

```php
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>CRUD Ciclos Escolares</title>

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

        <h2>Gestión de Ciclos Escolares</h2>

    </div>

    <div class="actions">

        <a href="#formCiclo"
            class="btn primary"
            style="text-decoration:none;">

            + Registrar Ciclo

        </a>

    </div>

</div>

<div class="card">

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

            <tr>

                <td>1</td>
                <td>Enero - Mayo 2026</td>
                <td>2026-01-10</td>
                <td>2026-05-30</td>

                <td>
                    <span class="tag ok">
                        Activo
                    </span>
                </td>

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

<div class="card" id="formCiclo">

    <div class="section-title">

        <h2>Registrar / Editar Ciclo</h2>

    </div>

    <form method="POST">

        <input type="hidden" name="id_ciclo">

        <div class="form-grid">

            <input type="text" name="nombre" class="input-crud" placeholder="Nombre Ciclo">

            <input type="date" name="fecha_inicio" class="input-crud">

            <input type="date" name="fecha_fin" class="input-crud">

            <select name="estado" class="input-crud">

                <option value="">Estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>

            </select>

        </div>

        <div style="margin-top:20px;">

            <button class="btn primary"
                name="accion"
                value="guardar">

                Guardar Ciclo

            </button>

        </div>

    </form>

</div>

</section>

</main>

</body>
</html>
```
