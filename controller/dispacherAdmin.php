<?php
session_start();

include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {
        case 'LoginAdmin':
            require_once("../model/MAdmin.php");
            $noEmpleado = $_POST['noEmpleado'];
            $contrasenia = $_POST['password'];
            $admin = new MAdmin();
            $resultado = $admin->verificar($noEmpleado, $contrasenia);
            if ($resultado) {
                $_SESSION['admin'] = $resultado;
                header('Location: ../view/homeAdmin.php');
            } else {
                $_SESSION['errormsj'] = "Número de empleado o contraseña incorrecta.";
                header('Location: ../view/loginAdmin.php');
            }   
            break;

        case 'RegistrarAdmin':
            require_once("../model/MAdmin.php");
            $nombre = $_POST['nombre'];
            $app = $_POST['app'];
            $apm = $_POST['apm'];
            $estado = 1; // Asumiendo que el estado 1 es activo
            $noEmpleado = $_POST['noEmpleado'];
            $puesto = $_POST['puesto'];
            $departamento = $_POST['departamento'];
            $contrasenia = $_POST['contrasenia'];
            $confContrasenia = $_POST['confcontrasenia'];

            if ($contrasenia !== $confContrasenia) {
                $_SESSION['errormsj'] = "Las contraseñas no coinciden.";
                header('Location: ../view/registroAdmin.php');
                exit();
            }

            $admin = new MAdmin();
            if ($admin->registrar($nombre, $app, $apm, $contrasenia, $estado, $noEmpleado, $puesto, $departamento)) {
                $_SESSION['successmsj'] = "Administrador registrado exitosamente.";
                header('Location: ../view/registroAdmin.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar el administrador.";
                header('Location: ../view/registroAdmin.php');
            }
        break;    
        
        case 'ReporteGrupos':
            require_once("../view/adminReporteGrupos.php");
        break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>