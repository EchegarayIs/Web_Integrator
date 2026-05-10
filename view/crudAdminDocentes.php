<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>CRUD Docentes</title>

    <link rel="stylesheet"
        href="resources/homeAdmin.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">

</head>

<body>

<?php include 'menuLateralAdmin.php'; 
?>


<main class="container">

    <section class="main">

        <!-- ENCABEZADO -->
        <div class="card">

            <div class="section-title">

                <h2>Gestión de Docentes</h2>

                <span>
                    Administración completa de docentes
                </span>

            </div>

            <div class="actions">

                <a href="#formDocente"
                    class="btn primary"
                    style="text-decoration:none;">

                    + Registrar Docente

                </a>

            </div>

        </div>

        <!-- BUSCADOR -->
        <div class="card">

            <form method="GET">

                <div style="
                    display:flex;
                    justify-content:flex-end;
                    align-items:center;
                    gap:15px;
                    flex-wrap:wrap;
                ">

                    <input type="text"
                        name="buscar"
                        class="input-crud"
                        placeholder="Buscar docente..."
                        style="max-width:300px;">

                    <button class="btn">

                        Buscar

                    </button>

                </div>

            </form>

        </div>

        <!-- TABLA -->
        <div class="card">

            <div class="section-title">

                <h2>Lista de Docentes</h2>

                <span>
                    Docentes registrados
                </span>

            </div>

            <table class="mini-table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <!-- EJEMPLO FOREACH FUTURO -->
                    <?php
                    /*
                    foreach($docentes as $docente){
                    */
                    ?>

                    <tr>

                        <td>
                            1
                        </td>

                        <td>
                            Juan Pérez
                        </td>

                        <td>
                            juan@gmail.com
                        </td>

                        <td>
                            Programación
                        </td>

                        <td>

                            <span class="tag ok">

                                Activo

                            </span>

                        </td>

                        <td>

                            <div class="table-actions">

                                <!-- EDITAR -->
                                <form method="POST">

                                    <input type="hidden"
                                        name="id_docente"
                                        value="1">

                                    <button class="btn"
                                        name="accion"
                                        value="editar">

                                        Editar

                                    </button>

                                </form>

                                <!-- ELIMINAR -->
                                <form method="POST">

                                    <input type="hidden"
                                        name="id_docente"
                                        value="1">

                                    <button class="btn btn-danger"
                                        name="accion"
                                        value="eliminar">

                                        Eliminar

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    <?php
                    /*
                    }
                    */
                    ?>

                </tbody>

            </table>

        </div>

        <!-- FORMULARIO -->
        <div class="card"
            id="formDocente">

            <div class="section-title">

                <h2>

                    Registrar / Editar Docente

                </h2>

                <span>

                    Formulario de registro

                </span>

            </div>

            <form method="POST">

                <!-- ID OCULTO PARA UPDATE -->
                <input type="hidden"
                    name="id_docente">

                <div class="form-grid">

                    <input type="text"
                        name="nombre"
                        class="input-crud"
                        placeholder="Nombre">

                    <input type="text"
                        name="app"
                        class="input-crud"
                        placeholder="Apellido Paterno">

                    <input type="text"
                        name="apm"
                        class="input-crud"
                        placeholder="Apellido Materno">

                    <input type="email"
                        name="correo"
                        class="input-crud"
                        placeholder="Correo Electrónico">

                    <input type="text"
                        name="especialidad"
                        class="input-crud"
                        placeholder="Especialidad">

                    <input type="text"
                        name="grado_estudio"
                        class="input-crud"
                        placeholder="Grado de Estudios">

                    <input type="text"
                        name="curp"
                        class="input-crud"
                        placeholder="CURP">

                    <input type="text"
                        name="rfc"
                        class="input-crud"
                        placeholder="RFC">

                    <input type="text"
                        name="nss"
                        class="input-crud"
                        placeholder="NSS">

                    <input type="tel"
                        name="telefono"
                        class="input-crud"
                        placeholder="Teléfono">

                    <input type="date"
                        name="fecha_nac"
                        class="input-crud">

                    <input type="text"
                        name="no_empleado"
                        class="input-crud"
                        placeholder="Número de Empleado">

                    <input type="password"
                        name="contrasenia"
                        class="input-crud"
                        placeholder="Contraseña">

                </div>

                <div style="margin-top:20px;">

                    <button class="btn primary"
                        name="accion"
                        value="guardar">

                        Guardar Docente

                    </button>

                </div>

            </form>

        </div>

    </section>

</main>

</body>

</html>