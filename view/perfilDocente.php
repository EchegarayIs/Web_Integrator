<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - GESA</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include 'menuLateralDocentes.php'; ?>

    <main class="container">
        <div class="header-container" style="margin-bottom: 20px; display: flex; align-items: center;">
            <a href="homeProfesor.php" style="text-decoration: none; color: #5599d4; margin-right: 15px;">
                <span class="material-icons">arrow_back</span>
            </a>
            <h1 class="main-title">Mi Perfil Profesional</h1>
        </div>

        <section class="main">
            <form action="actualizar_password.php" method="POST">
                
                <div class="card" style="margin-bottom: 25px;">
                    <div class="section-title">
                        <h2>Datos Generales</h2>
                        <span>Información no editable por el docente</span>
                    </div>

                    <div class="grid-profile-data" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Nombre(s)</label>
                            <input id="nomdocenteperfil" type="text" value="Eduardo" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Apellido Paterno</label>
                            <input id="appdocenteperfil" type="text" value="Pérez" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Apellido Materno</label>
                            <input id="apmdocenteperfil" type="text" value="García" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">No. de Empleado</label>
                            <input id="noempleadoperfil" type="text" value="EMP-2026-05" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">CURP</label>
                            <input id="curpdocenteperfil" type="text" value="PEGE850101HDFRRG01" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">RFC</label>
                            <input id="rfcdocenteperfil" type="text" value="PEGE850101-ABC" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>

                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Cédula Profesional</label>
                            <input id="ceduladocenteperfil" type="text" value="12345678" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Grado de Estudio</label>
                            <input id="gradoperfil" type="text" value="Maestría en TI" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Especialidad</label>
                            <input id="especialidadperfil" type="text" value="Ciberseguridad" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                    </div>
                </div>

                <div class="two-col">
                    <div class="card" style="border-left: 5px solid #8e8cd8;">
                        <div class="section-title">
                            <h2>Seguridad</h2>
                            <span>Actualizar contraseña de acceso</span>
                        </div>
                        <div style="margin-top: 15px;">
                            <div class="input-group" style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Nueva Contraseña</label>
                                <input id="nuevacontraseniaperfil" type="password" name="new_password" placeholder="••••••••" style="width: 100%; border: 1px solid #ddd; padding: 12px; border-radius: 10px; outline-color: #8e8cd8;">
                            </div>
                            <div class="input-group" style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Confirmar Contraseña</label>
                                <input id="confirmcontraseniap" type="password" name="confirm_password" placeholder="••••••••" style="width: 100%; border: 1px solid #ddd; padding: 12px; border-radius: 10px; outline-color: #8e8cd8;">
                            </div>
                            
                            <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                                <button id="btnGuardarperfil" type="submit" class="btn primary" style="background-color: #8e8cd8; border: none; padding: 12px 30px; border-radius: 12px; cursor: pointer; transition: 0.3s;">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="section-title">
                            <h2>Contacto</h2>
                            <span>Datos registrados</span>
                        </div>
                        <div class="list" style="margin-top: 15px;">
                            <div class="row-item">
                                <div class="mini-icon">email</div>
                                <div>
                                    <p class="title">Correo Electrónico</p>
                                    <p id="correoperfil" class="meta">eduardo.perez@itsoeh.edu.mx</p>
                                </div>
                            </div>
                            <div class="row-item" style="margin-top: 10px;">
                                <div class="mini-icon">phone</div>
                                <div>
                                    <p class="title">Teléfono</p>
                                    <p id="telefonoperfil" class="meta">771-123-4567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
</body>
</html>