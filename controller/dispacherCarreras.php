<?php
session_start();

include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {
        case 'buscarCarrera':
            require_once("../model/MCarreras.php");
            $carrera = trim($_POST['carrera']);
            $mcarreras = new MCarreras();
            $resultado = $mcarreras->buscar($carrera);
            $_SESSION['carreras_resultados'] = $resultado;
            $_SESSION['search_query'] = $carrera;
            if (empty($resultado)) {
                $_SESSION['errormsj'] = "No se encontraron carreras que coincidan con '$carrera'.";
            }
            header('Location: ../view/crudAdminCarreras.php');
            exit();
        break;

        case 'RegistrarCarrera':
            require_once("../model/MCarreras.php");
            $clave = $_POST['clave'];
            $nombre = $_POST['nombre'];
            $fecha_registro = date('Y-m-d H:i:s');
            $mcarreras = new MCarreras();
            $resultado = $mcarreras->registrar($clave, $nombre, $fecha_registro);
            if ($resultado) {
                $_SESSION['successmsj'] = "Carrera registrada exitosamente.";
                header('Location: ../view/crudAdminCarreras.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar la carrera.";
                header('Location: ../view/crudAdminCarreras.php');
            }
            exit();
        break;
        
        case 'consultarCarreras':
            require_once("../model/MCarreras.php");
            $mcarreras = new MCarreras();
            $resultado = $mcarreras->consultar();
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode([]);
            }
        break;

        case 'editarCarrera':
            require_once("../model/MCarreras.php");
            $id_carrera = $_POST['id_carrera'];
            $clave = $_POST['clave'];
            $nombre = $_POST['nombre'];
            $fecha_registro = $_POST['fecha_registro'] ?? date('Y-m-d');
            $mcarreras = new MCarreras();
            $resultado = $mcarreras->editar($id_carrera, $clave, $nombre, $fecha_registro);
            if ($resultado) {
                $_SESSION['successmsj'] = "Carrera editada exitosamente.";
                header('Location: ../view/crudAdminCarreras.php');
            } else {
                $_SESSION['errormsj'] = "Error al editar la carrera.";
                header('Location: ../view/crudAdminCarreras.php');
            }
            exit();
        break;

        case 'eliminarCarrera':
            require_once("../model/MCarreras.php");
            $id_carrera = $_POST['id_carrera'];
            $mcarreras = new MCarreras();
            $resultado = $mcarreras->eliminar($id_carrera);
            if ($resultado) {
                $_SESSION['successmsj'] = "Carrera eliminada exitosamente.";
                header('Location: ../view/crudAdminCarreras.php');
            } else {
                $_SESSION['errormsj'] = "Error al eliminar la carrera.";
                header('Location: ../view/crudAdminCarreras.php');
            }
            exit();
        break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>