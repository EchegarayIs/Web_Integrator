<?php
session_start();

include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {

        case 'home':
            header('Location: ../view/alumnosHome.php');
        break;

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

        case 'Perfil':
                header('Location: ../view/alumnosPerfil.php');
        break;

        case 'ActualizarPerfil':
                require_once("../model/MAlumnos.php");
                $idAlumno = $_SESSION['usuario']['id_alumno'];
                $correo = $_POST['correo'] ?? null;
                $telefono = $_POST['telefono'] ?? null;
                $contrasenia = $_POST['contrasenia'] ?? $_SESSION['usuario']['contrasenia'];

                $alumno = new MAlumnos();
                if ($alumno->actualizarPerfil($idAlumno, $correo, $telefono, $contrasenia)) {
                    $_SESSION['successmsj'] = "Perfil actualizado exitosamente.";
                    session_destroy();
                    header('Location: ../view/loginAlumno.php');
                } else {
                    $_SESSION['errormsj'] = "Error al actualizar el perfil.";
                    header('Location: ../view/alumnosPerfil.php');
                }
        break;

        case 'Asistencia':
                require_once("../model/MAlumnos.php");
                $idAlumno = $_SESSION['usuario']['id_alumno'];
                $alumno = new MAlumnos();
                $asistenciaGeneral = $alumno->generalAsistencias($idAlumno);

                if ($asistenciaGeneral !== false) {
                    $_SESSION['asistenciaGeneral'] = $asistenciaGeneral;
                    header('Location: ../view/alumnosAsistencia.php');
                } else {
                    $_SESSION['errormsj'] = "Error al obtener el historial de asistencias.";
                    header('Location: ../view/alumnosAsistencia.php');
                }
        break;

        case 'Grupo':
                header('Location: ../view/alumnosGrupo.php');
        break;

        case 'InscribirGrupo':
                require_once("../model/MAlumnos.php");
                $idAlumno = $_SESSION['usuario']['id_alumno'];
                $idGrupo = $_POST['idGrupo'];

                $alumno = new MAlumnos();
                if ($alumno->inscribirGrupo($idAlumno, $idGrupo)) {
                    $_SESSION['successmsj'] = "Inscripción realizada exitosamente.";
                    header('Location: ../view/alumnosGrupo.php');
                } else {
                    $_SESSION['errormsj'] = "Error al inscribir el grupo.";
                    header('Location: ../view/alumnosGrupo.php');
                }
        break;

        case 'Justificante':
                header('Location: ../view/alumnosJustificante.php');
        break;

        case 'TramitarJustificante':
                require_once("../model/MAlumnos.php");
                $idAlumno = $_SESSION['usuario']['id_alumno'];
                $idDocente = $_POST['idDocente'];
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFin = $_POST['fechaFin'];
                $idCiclo = $_POST['idCiclo'];
                $motivo = $_POST['motivo'];
                $tipo = $_POST['tipo'];
                $estado = $_POST['estado'];
                $comentarios = $_POST['comentarios'] ?? null; 

                $alumno = new MAlumnos();
                if ($alumno->tramitarJustificante($idAlumno, $idDocente, $fechaInicio, $fechaFin, $idCiclo, $motivo, $tipo, $estado, $comentarios)) {
                    $_SESSION['successmsj'] = "Justificante tramitado exitosamente.";
                    header('Location: ../view/alumnosJustificante.php');
                } else {
                    $_SESSION['errormsj'] = "Error al tramitar el justificante.";
                    header('Location: ../view/alumnosJustificante.php');
                }
                
        break;  
        case 'GenerarReporteAsistencia':
            // No necesitas lógica extra, solo redireccionar al archivo que procesa dompdf
            header('Location: ../view/AlumnosReportesAsistencia.php');
        break;

        case 'GenerarReporteJustificante':
            header('Location: ../view/AlumnosReportesJustificante.php');
        break;
            
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>