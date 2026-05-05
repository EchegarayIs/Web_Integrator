<?php
session_start();

include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {

        case 'RegistrarAlumno':
            require_once("../model/MAlumnos.php");
            $nombre = $_POST['nombre'];
            $app = $_POST['app'];
            $apm = $_POST['apm'];
            $estado = 1; // Asumiendo que el estado 1 es activo
            $matricula = $_POST['matricula'];
            $fechaNac = $_POST['fechaNac'];
            $semestre = $_POST['semestre'];
            $idCarrera = $_POST['idCarrera'];
            $contrasenia = $_POST['contrasenia'];
            $confContrasenia = $_POST['confcontrasenia'];

            if ($contrasenia !== $confContrasenia) {
                $_SESSION['errormsj'] = "Las contraseñas no coinciden.";
                header('Location: ../view/registroAlumnos.php');
                exit();
            }

            $alumno = new MAlumnos();
            if ($alumno->registrar($nombre, $app, $apm, $contrasenia, $estado, $matricula, $fechaNac, $semestre, $idCarrera)) {
                $_SESSION['successmsj'] = "Alumno registrado exitosamente.";
                header('Location: ../view/registroAlumnos.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar el alumno.";
                header('Location: ../view/registroAlumnos.php');
            }
            break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>