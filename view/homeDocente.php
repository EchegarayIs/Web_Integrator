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
                                <h1 id="nombredocente" class="name">Eduardo Pérez García</h1>
                                <p class="role">Profesor · <?php echo "Ingeniería en Sistemas"; ?></p>

                                <div class="kv" role="group" aria-label="Datos de Identificación">
                                    <div class="item">
                                        <div class="label">No. Empleado</div>
                                        <div id="noempleado" class="value">EMP-2026-05</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">CURP</div>
                                        <div id="curpdocente" class="value">PEGE850101HDFRRG01</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">RFC</div>
                                        <div id="rfcdocente" class="value">PEGE850101-ABC</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">NSS</div>
                                        <div id="nssdocente" class="value">1234-56-7890-1</div>
                                    </div>
                                </div>

                                <div class="kv" style="margin-top: 15px;">
                                    <div class="item">
                                        <div class="label">Cédula Prof.</div>
                                        <div id="ceduladocente" class="value">12345678</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Especialidad</div>
                                        <div id="especialidaddocente" class="value">Ciberseguridad</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Grado de Estudio</div>
                                        <div id="gradoestudiodocente" class="value">Maestría en TI</div>
                                    </div>
                                    <div class="item">
                                        <div class="label">Registro</div>
                                        <div id="registrodocente" class="value">15/02/2026</div>
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
                                    <p id="correodocente" class="meta">eduardo.perez@itsoeh.edu.mx</p>
                                </div>
                            </div>
                            <div class="row-item">
                                <div class="mini-icon">phone</div>
                                <div>
                                    <p class="title">Teléfono / Celular</p>
                                    <p  id="telefonodocente" class="meta">771-123-4567</p>
                                </div>
                            </div>
                            <div class="row-item">
                                <div class="mini-icon">cake</div>
                                <div>
                                    <p class="title">Fecha de Nacimiento</p>
                                    <p id="fechanacdocente" class="meta">01 de Enero de 1985</p>
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