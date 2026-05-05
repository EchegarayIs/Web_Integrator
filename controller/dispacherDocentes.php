<?php
session_start();

include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {

        case 'RegistrarDocente':
            require_once("../model/MDocentes.php");
            $nombre = $_POST['nombre'];
            $app = $_POST['app'];
            $apm = $_POST['apm'];
            $estado = 1; // Asumiendo que el estado 1 es activo
            $noEmpleado = $_POST['noEmpleado'];
            $fechaNac = $_POST['fechaNac'];
            $cedula = $_POST['cedula'];
            $contrasenia = $_POST['contrasenia'];
            $confContrasenia = $_POST['confcontrasenia'];
            $especialidad = $_POST['especialidad'];
            $gradoEstudio = $_POST['gradoEstudio'];

            if ($contrasenia !== $confContrasenia) {
                $_SESSION['errormsj'] = "Las contraseñas no coinciden.";
                header('Location: ../view/registroDocentes.php');
                exit();
            }

            $docente = new MDocentes();
            if ($docente->registrar($nombre, $app, $apm, $contrasenia, $estado, $noEmpleado, $fechaNac, $cedula, $especialidad, $gradoEstudio)) {
                $_SESSION['successmsj'] = "Docente registrado exitosamente.";
                header('Location: ../view/registroDocentes.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar el docente.";
                header('Location: ../view/registroDocentes.php');
            }
            break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>