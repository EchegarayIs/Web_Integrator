<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: loginAdmin.php");
    exit();
}

$admin = $_SESSION['admin'];
$nombreCompleto = $admin['nombre'] . " " . $admin['app'] . " " . $admin['apm'];
$rol = $admin['puesto'];
$departamento = $admin['departamento'];
$noEmpleado = $admin['no_empleado'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo Escolar</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <?php include 'menuLateralAdmin.php'; ?>

    <main class="container">
        <div class="grid">
            <section class="main">
                <div class="card">
                    <div class="profile">
                        <div class="avatar" aria-label="Avatar">
                            <?php
                            $iniciales = strtoupper(substr($admin['nombre'], 0, 1) . substr($admin['app'], 0, 1));
                            echo $iniciales;
                            ?>
                        </div>

                        <div class="profile-meta">
                            <div>
                                <h1 class="name">
                                    <?php echo $nombreCompleto; ?>
                                </h1>

                                <p class="role">
                                  <?php echo $rol ?>
                                   · <?php echo $departamento ?>
                                </p>

                                <div class="kv">

                                    <div class="item">
                                        <div class="label">
                                            ID
                                        </div>

                                        <div class="value">
                                            <?php echo $noEmpleado; ?>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="label">
                                            Último acceso
                                        </div>

                                        <div class="value">
                                          Hoy · <?php 
                                              date_default_timezone_set('America/Mexico_City');
                                              $hora = new DateTime();
                                              echo $hora->format('H:i A');
                                              ?>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="label">
                                            Departamento
                                        </div>

                                        <div class="value">
                                            <?php echo $departamento; ?>
                                        </div>
                                    </div>

                                    <div class="item">
                                        <div class="label">
                                            Puesto
                                        </div>

                                        <div class="value">
                                            <?php echo $rol; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DASHBOARD -->
                <div class="card">
                    <div class="section-title">
                        <h2>Resumen General</h2>
                        <span>Información del sistema</span>
                    </div>

                    <div class="kpis">

                        <div class="kpi">

                            <div class="top">
                                <div class="label">
                                    Total Docentes
                                </div>
                            </div>

                            <div class="value">
                                3
                            </div>

                            <div class="sub">
                                Docentes registrados
                            </div>

                        </div>

                        <div class="kpi">
                            <div class="top">
                                <div class="label">
                                    Materias
                                </div>

                                <div class="trend">
                                    Activas
                                </div>
                            </div>

                            <div class="value">
                                3
                            </div>

                            <div class="sub">
                                Materias disponibles
                            </div>
                        </div>

                        <div class="kpi">
                            <div class="top">
                                <div class="label">
                                    Administrativos
                                </div>

                                <div class="trend">
                                    Activos
                                </div>
                            </div>

                            <div class="value">
                                1
                            </div>

                            <div class="sub">
                                Usuarios administrativos
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTIVIDAD Y ALERTAS -->
                <div class="two-col">

                    <!-- ACTIVIDAD -->
                    <div class="card">

                        <div class="section-title">
                            <h2>Actividad Reciente</h2>
                            <span>Últimos movimientos</span>
                        </div>

                        <div class="list">
                            <div class="row-item">
                                <div class="mini-icon">
                                    +
                                </div>

                                <div>
                                    <p class="title">
                                        Nuevo docente registrado
                                    </p>

                                    <p class="meta">
                                        Hace 2 horas
                                    </p>
                                </div>

                                <div class="tag ok">
                                    Registrado
                                </div>
                            </div>
                            <div class="row-item">
                                <div class="mini-icon">
                                    ✓
                                </div>
                                <div>
                                    <p class="title">
                                        Materia actualizada
                                    </p>
                                    <p class="meta">
                                        Hoy · 09:20 AM
                                    </p>
                                </div>
                                <div class="tag ok">
                                    Actualizado
                                </div>
                            </div>
                            <div class="row-item">
                                <div class="mini-icon" style="color: var(--warning);">
                                    !
                                </div>
                                <div>
                                    <p class="title">
                                        Carrera pendiente de revisión
                                    </p>

                                    <p class="meta">
                                        Ayer · 03:00 PM
                                    </p>

                                </div>

                                <div class="tag warn">
                                    Pendiente
                                </div>

                            </div>

                            <div class="row-item">

                                <div class="mini-icon">
                                    ✓
                                </div>

                                <div>

                                    <p class="title">
                                        Nuevo grupo registrado
                                    </p>

                                    <p class="meta">
                                        Hace 1 día
                                    </p>

                                </div>

                                <div class="tag ok">
                                    Completado
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ALERTAS -->
                    <div class="card">

                        <div class="section-title">
                            <h2>Alertas</h2>
                            <span>Estado del sistema</span>
                        </div>

                        <div class="alerts">

                            <div class="alert-card">

                                <div class="alert-icon success">
                                    ✓
                                </div>

                                <div>

                                    <p class="alert-title">
                                        Sistema funcionando correctamente
                                    </p>

                                    <p class="alert-desc">
                                        No se detectaron errores en el sistema escolar.
                                    </p>

                                </div>

                            </div>

                            <div class="alert-card">

                                <div class="alert-icon warning">
                                    !
                                </div>

                                <div>

                                    <p class="alert-title">
                                        Docentes pendientes
                                    </p>

                                    <p class="alert-desc">
                                        Existen docentes sin asignación de grupos.
                                    </p>

                                </div>

                            </div>

                            <div class="alert-card">

                                <div class="alert-icon danger">
                                    ×
                                </div>

                                <div>

                                    <p class="alert-title">
                                        Justificantes pendientes
                                    </p>

                                    <p class="alert-desc">
                                        Hay solicitudes pendientes por revisar.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- TABLA Y ACCIONES -->
                <div class="two-col">

                    <!-- TABLA -->
                    <div class="card">

                        <div class="section-title">
                            <h2>Administrativos Registrados</h2>
                            <span>Vista rápida</span>
                        </div>

                        <table class="mini-table">

                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Puesto</th>
                                    <th>Estado</th>
                                </tr>

                            </thead>

                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Ana Pérez</td>
                                    <td>ana@gmail.com</td>
                                    <td>Administrador</td>
                                    <td>
                                        <span class="tag ok">
                                            Activo
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>Juan López</td>
                                    <td>juan@gmail.com</td>
                                    <td>Control Escolar</td>
                                    <td>
                                        <span class="tag warn">
                                            Pendiente
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>María Sánchez</td>
                                    <td>maria@gmail.com</td>
                                    <td>Recursos Humanos</td>
                                    <td>
                                        <span class="tag ok">
                                            Activo
                                        </span>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <!-- ACCIONES -->
                    <div class="card">

                        <div class="section-title">
                            <h2>Acciones Principales</h2>
                            <span>Accesos rápidos</span>
                        </div>

                        <div class="actions">

                            <form method="POST" action="../controller/dispacherAdmin.php" style="flex:1; min-width:180px;">
                                <input type="hidden" name="accion" value="ReporteGrupos">
                                <button class="btn" type="submit">
                                    Reporte de Grupos
                                </button>
                            </form>

                            <form method="POST" action="../controller/dispacherAdmin.php" style="flex:1; min-width:180px;">
                                <input type="hidden" name="accion" value="ReporteDocentes">
                                <button class="btn" type="submit">
                                    Reporte de Docentes
                                </button>
                            </form>

                            <form method="POST" action="../controller/dispacherAdmin.php" style="flex:1; min-width:180px;">
                                <input type="hidden" name="accion" value="RegistrarAdministrativo">
                                <button class="btn" type="submit">
                                    Registrar Administrativo
                                </button>
                            </form>

                        </div>

                        <div style="
                            margin-top:15px;
                            color: var(--muted);
                            font-size: 13px;
                            line-height: 1.5;
                            font-weight: 700;
                        ">

                            Desde este panel puedes acceder rápidamente
                            a todos los módulos administrativos
                            del sistema escolar.

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>

</body>
</html>