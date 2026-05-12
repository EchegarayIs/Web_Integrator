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
            $correo = $_POST['correo'] ?? '';
            $estado = 1; // Asumiendo que el estado 1 es activo
            $noEmpleado = $_POST['noEmpleado'];
            $fechaNac = $_POST['fechaNac'];
            $cedula = $_POST['cedula'];
            $curp = $_POST['curp'] ?? '';
            $rfc = $_POST['rfc'] ?? '';
            $nss = $_POST['nss'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
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
            if ($docente->registrar($nombre, $app, $apm, $contrasenia, $estado, $noEmpleado, $fechaNac, $cedula, $especialidad, $gradoEstudio, $correo, $curp, $rfc, $nss, $telefono)) {
                $_SESSION['successmsj'] = "Docente registrado exitosamente.";
                header('Location: ../view/registroDocentes.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar el docente.";
                header('Location: ../view/registroDocentes.php');
            }
            exit();
        break;

        case 'buscarDocente':
            require_once("../model/MDocentes.php");
            $docente = trim($_POST['docente']);
            $mdocentes = new MDocentes();
            $resultado = $mdocentes->buscar($docente);
            $_SESSION['docentes_resultados'] = $resultado;
            $_SESSION['search_query'] = $docente;
            if (empty($resultado)) {
                $_SESSION['errormsj'] = "No se encontraron docentes que coincidan con '$docente'.";
            }
            header('Location: ../view/crudAdminDocentes.php');
            exit();
        break;

        case 'consultarDocentes':
            require_once("../model/MDocentes.php");
            $docente = new MDocentes();
            $resultado = $docente->consultar();
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode([]);
            }
            exit();
        break;

        case 'editarDocente':
            require_once("../model/MDocentes.php");
            $id_docente = $_POST['id_docente'];
            $nombre = $_POST['nombre'];
            $app = $_POST['app'];
            $apm = $_POST['apm'];
            $correo = $_POST['correo'] ?? '';
            $contrasenia = $_POST['contrasenia'] ?? '';
            $confContrasenia = $_POST['confcontrasenia'] ?? '';
            $activo = $_POST['estado'] ?? 1;
            $noEmpleado = $_POST['noEmpleado'];
            $fechaNac = $_POST['fechaNac'];
            $cedula = $_POST['cedula'];
            $curp = $_POST['curp'] ?? '';
            $rfc = $_POST['rfc'] ?? '';
            $nss = $_POST['nss'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $especialidad = $_POST['especialidad'];
            $gradoEstudio = $_POST['gradoEstudio'];

            $docente = new MDocentes();
            if (empty($contrasenia)) {
                $actual = $docente->obtenerDocentePorId($id_docente);
                $contrasenia = $actual['contrasenia'] ?? $contrasenia;
            } elseif ($contrasenia !== $confContrasenia) {
                $_SESSION['errormsj'] = "Las contraseñas no coinciden.";
                header('Location: ../view/crudAdminDocentes.php');
                exit();
            }

            if ($docente->editar($id_docente, $nombre, $app, $apm, $contrasenia, $activo, $noEmpleado, $fechaNac, $cedula, $curp, $rfc, $nss, $telefono, $especialidad, $gradoEstudio)) {
                $_SESSION['successmsj'] = "Docente editado exitosamente.";
                header('Location: ../view/crudAdminDocentes.php');
            } else {
                $_SESSION['errormsj'] = "Error al editar el docente.";
                header('Location: ../view/crudAdminDocentes.php');
            }
            exit();
        break;

        case 'eliminarDocente':
            require_once("../model/MDocentes.php");
            $id_docente = $_POST['id_docente'];
            $docente = new MDocentes();
            $resultado = $docente->eliminar($id_docente);
            if ($resultado) {
                $_SESSION['successmsj'] = "Docente eliminado exitosamente.";
                header('Location: ../view/crudAdminDocentes.php');
            } else {
                $_SESSION['errormsj'] = "Error al eliminar el docente.";
                header('Location: ../view/crudAdminDocentes.php');
            }
            exit();
        break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>