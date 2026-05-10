---

# crudMaterias.php

```php
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>CRUD Materias</title>

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

            <h2>Gestión de Materias</h2>

            <span>
                Administración de materias
            </span>

        </div>

        <div class="actions">

            <a href="#formMateria"
                class="btn primary"
                style="text-decoration:none;">

                + Registrar Materia

            </a>

        </div>

    </div>

    <div class="card">

        <form method="GET">

            <div style="display:flex; justify-content:flex-end; gap:15px; flex-wrap:wrap;">

                <input type="text"
                    name="buscar"
                    class="input-crud"
                    placeholder="Buscar materia..."
                    style="max-width:300px;">

                <button class="btn">
                    Buscar
                </button>

            </div>

        </form>

    </div>

    <div class="card">

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

                <tr>

                    <td>1</td>
                    <td>POO01</td>
                    <td>Programación Orientada a Objetos</td>
                    <td>5</td>
                    <td>6</td>

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

    <div class="card" id="formMateria">

        <div class="section-title">

            <h2>Registrar / Editar Materia</h2>

        </div>

        <form method="POST">

            <input type="hidden" name="id_materia">

            <div class="form-grid">

                <input type="text" name="clave_materia" class="input-crud" placeholder="Clave Materia">

                <input type="text" name="nombre_materia" class="input-crud" placeholder="Nombre Materia">

                <input type="number" name="creditos" class="input-crud" placeholder="Créditos">

                <input type="number" name="horas_semana" class="input-crud" placeholder="Horas Semana">

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

                    Guardar Materia

                </button>

            </div>

        </form>

    </div>

</section>

</main>

</body>
</html>
```