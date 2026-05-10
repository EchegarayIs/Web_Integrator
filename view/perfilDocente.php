<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: loginDocente.php");
    exit();
}

$docente = $_SESSION['usuario'];
?>
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
            <form action="../controller/actualizar_password.php" method="POST">
                
                <div class="card" style="margin-bottom: 25px;">
                    <div class="section-title">
                        <h2>Datos Generales</h2>
                        <span>Información no editable por el docente</span>
                    </div>

                    <div class="grid-profile-data" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Nombre(s)</label>
                            <input id="nomdocenteperfil" type="text" value="<?php echo $docente['nombre']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Apellido Paterno</label>
                            <input id="appdocenteperfil" type="text" value="<?php echo $docente['app']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Apellido Materno</label>
                            <input id="apmdocenteperfil" type="text" value="<?php echo $docente['apm']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">No. de Empleado</label>
                            <input id="noempleadoperfil" type="text" value="<?php echo $docente['no_empleado']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">CURP</label>
                            <input id="curpdocenteperfil" type="text" value="<?php echo $docente['curp']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">RFC</label>
                            <input id="rfcdocenteperfil" type="text" value="<?php echo $docente['rfc']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>

                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Cédula Profesional</label>
                            <input id="ceduladocenteperfil" type="text" value="<?php echo $docente['cedula']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Grado de Estudio</label>
                            <input id="gradoperfil" type="text" value="<?php echo $docente['grado_estudio']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 12px; color: #888; margin-bottom: 5px;">Especialidad</label>
                            <input id="especialidadperfil" type="text" value="<?php echo $docente['especialidad']; ?>" readonly style="width: 100%; border: none; background: #f9f9f9; padding: 10px; border-radius: 8px; color: #555;">
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
                                <input 
    id="nuevacontraseniaperfil"
    type="password"
    name="new_password"
    placeholder="••••••••"
    required
    pattern="^(?=.*[A-Z])(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$"
    title="Mínimo 8 caracteres, una mayúscula y un número o símbolo"
    style="width: 100%; border: 1px solid #ddd; padding: 12px; border-radius: 10px; outline-color: #8e8cd8;"
>
                            </div>
                            <div class="input-group" style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px;">Confirmar Contraseña</label>
                                <input 
    id="confirmcontraseniap"
    type="password"
    name="confirm_password"
    placeholder="••••••••"
    required
    style="width: 100%; border: 1px solid #ddd; padding: 12px; border-radius: 10px; outline-color: #8e8cd8;"
>
                                </div>
                            
                            <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                                <button id="btnGuardarperfil" type="submit" class="btn primary" style="background-color: #8e8cd8; border: none; padding: 12px 30px; border-radius: 12px; cursor: pointer; transition: 0.3s;">
                                    Guardar Cambios

                                </button>
                            </div>
                            <?php
if(isset($_SESSION['successmsj'])){
    
    echo "
    <script>
        alert('" . $_SESSION['successmsj'] . "');
        window.location='perfilDocente.php';
    </script>
    ";

    unset($_SESSION['successmsj']);
}

if(isset($_SESSION['errormsj'])){

    echo "
    <script>
        alert('" . $_SESSION['errormsj'] . "');
        window.location='perfilDocente.php';
    </script>
    ";

    unset($_SESSION['errormsj']);
}
?>
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
                                    <p id="correoperfil" class="meta"><?php echo $docente['correo']; ?></p>
                                </div>
                            </div>
                            <div class="row-item" style="margin-top: 10px;">
                                <div class="mini-icon">phone</div>
                                <div>
                                    <p class="title">Teléfono</p>
                                    <p id="telefonoperfil" class="meta"><?php echo $docente['telefono']; ?></p>
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