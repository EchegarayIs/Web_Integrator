<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: loginDocente.php");
    exit();
}

$docente = $_SESSION['usuario'];

$nombreCompleto = $docente['nombre'] . " " . $docente['app'] . " " . $docente['apm'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Profesor - GESA</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include 'menuLateralDocentes.php'; ?>

    <main class="container">
        <div class="grid">
            <section class="main">
                
                <div class="card">
                    <div class="profile">
                        <div class="avatar" aria-label="Avatar">EP</div>

                        <div class="profile-meta">
                            <div>
                                <h1 id="nombredocente" class="name"><?php echo $nombreCompleto; ?></h1>
                                <p class="role">Profesor · <?php echo "Ingeniería en Sistemas"; ?></p>

                                <div class="kv" role="group" aria-label="Datos de Identificación">
                                    <div class="item">
                                        <div class="label">No. Empleado</div>
                                        <div id="noempleado" class="value"><?php echo $docente['no_empleado']; ?></div>
                                    </div>
                                    <div class="item">
                                        <div class="label">CURP</div>
                                        <div id="curpdocente" class="value"><?php echo $docente['curp']; ?></div>
                                    </div>
                                    <div class="item">
                                        <div class="label">RFC</div>
                                        <div id="rfcdocente" class="value"><?php echo $docente['rfc']; ?></div>
                                    </div>
                                    <div class="item">
                                        <div class="label">NSS</div>
                                        <div id="nssdocente" class="value"><?php echo $docente['nss']; ?></div>
                                    </div>
                                </div>

                                <div class="kv" style="margin-top: 15px;">
                                    <div class="item">
                                        <div class="label">Cédula Prof.</div>
                                        <div id="ceduladocente" class="value"><?php echo $docente['cedula']; ?></div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Especialidad</div>
                                        <div id="especialidaddocente" class="value"><?php echo $docente['especialidad']; ?></div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Grado de Estudio</div>
                                        <div id="gradoestudiodocente" class="value"><?php echo $docente['grado_estudio']; ?></div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Registro</div>
                                        <div id="registrodocente" class="value">2026-01-01</div>
                                    </div>
                                </div>
                            </div>

                            <div class="status-badge">
                                <span class="dot" aria-hidden="true"></span>
                                Activo
                            </div>
                        </div>
                    </div>
                </div>

                <div class="two-col">
                    <div class="card">
                        <div class="section-title">
                            <h2>Detalles de contacto</h2>
                            <span>Información personal</span>
                        </div>
                        <div class="list">
                            <div class="row-item">
                                <div class="mini-icon">email</div>
                                <div>
                                    <p class="title">Correo Institucional</p>
                                    <p id="correodocente" class="meta"><?php echo $docente['correo']; ?></p>
                                </div>
                            </div>
                            <div class="row-item">
                                <div class="mini-icon">phone</div>
                                <div>
                                    <p class="title">Teléfono / Celular</p>
                                    <p  id="telefonodocente" class="meta"><?php echo $docente['telefono']; ?></p>
                                </div>
                            </div>
                            <div class="row-item">
                                <div class="mini-icon">cake</div>
                                <div>
                                    <p class="title">Fecha de Nacimiento</p>
                                    <p id="fechanacdocente" class="meta"><?php echo $docente['fecha_nac']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="section-title">
                            <h2>Gestión Académica</h2>
                            <span>Accesos rápidos</span>
                        </div>
                        <div class="actions">
                            <button id="btnmisgrupos" class="btn primary" type="button" style="flex:1; min-width: 150px;">Mis grupos</button>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>
</body>
</html>