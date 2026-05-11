<?php
session_start();
include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {
        case 'buscarMateria':
            require_once("../model/MMaterias.php");
            $materia = trim($_POST['materia']);
            $mmaterias = new MMaterias();
            $resultado = $mmaterias->buscar($materia);
            $_SESSION['materias_resultados'] = $resultado;
            $_SESSION['search_query'] = $materia;
            if (empty($resultado)) {
                $_SESSION['errormsj'] = "No se encontraron materias que coincidan con '$materia'.";
            }
            header('Location: ../view/crudAdminMaterias.php');
            exit();
        break;

        case 'RegistrarMateria':
            require_once("../model/MMaterias.php");
            $clave = $_POST['clave'];
            $nombre = $_POST['nombre'];
            $creditos = $_POST['creditos'];
            $horas_semana = $_POST['horas_semana'];
            $estado = $_POST['estado'] ?? 1;
            $mmaterias = new MMaterias();
            $resultado = $mmaterias->registrar($clave, $nombre, $creditos, $horas_semana, $estado);
            if ($resultado) {
                $_SESSION['successmsj'] = "Materia registrada exitosamente.";
                header('Location: ../view/crudAdminMaterias.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar la materia.";
                header('Location: ../view/crudAdminMaterias.php');
            }
            exit();
        break;

        case 'consultarMaterias':
            require_once("../model/MMaterias.php");
            $mmaterias = new MMaterias();
            $resultado = $mmaterias->consultar();
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode([]);
            }
        break;

        case 'editarMateria':
            require_once("../model/MMaterias.php");
            $id_materia = $_POST['id_materia'];
            $clave = $_POST['clave'];
            $nombre = $_POST['nombre'];
            $creditos = $_POST['creditos'];
            $horas_semana = $_POST['horas_semana'];
            $estado = $_POST['estado'] ?? 1;
            $mmaterias = new MMaterias();
            $resultado = $mmaterias->editar($id_materia, $clave, $nombre, $creditos, $horas_semana, $estado);
            if ($resultado) {
                $_SESSION['successmsj'] = "Materia editada exitosamente.";
                header('Location: ../view/crudAdminMaterias.php');
            } else {
                $_SESSION['errormsj'] = "Error al editar la materia.";
                header('Location: ../view/crudAdminMaterias.php');
            }
            exit();
        break;

        case 'eliminarMateria':
            require_once("../model/MMaterias.php");
            $id_materia = $_POST['id_materia'];
            $mmaterias = new MMaterias();
            $resultado = $mmaterias->eliminar($id_materia);
            if ($resultado) {
                $_SESSION['successmsj'] = "Materia eliminada exitosamente.";
                header('Location: ../view/crudAdminMaterias.php');
            } else {
                $_SESSION['errormsj'] = "Error al eliminar la materia.";
                header('Location: ../view/crudAdminMaterias.php');
            }
            exit();
        break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}
?>