<?php
session_start();
include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {
        case 'buscarCicloEscolar':
            require_once("../model/MCiclosEscolares.php");
            $ciclo_escolar = trim($_POST['ciclo_escolar']);
            $mciclos = new MCiclosEscolares();
            $resultado = $mciclos->buscar($ciclo_escolar);
            $_SESSION['ciclos_resultados'] = $resultado;
            $_SESSION['search_query'] = $ciclo_escolar;
            if (empty($resultado)) {
                $_SESSION['errormsj'] = "No se encontraron ciclos escolares que coincidan con '$ciclo_escolar'.";
            }
            header('Location: ../view/crudAdminCiclosEsco.php');
            exit();
        break;

        case 'RegistrarCicloEscolar':
            require_once("../model/MCiclosEscolares.php");
            $nombre = $_POST['nombre'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $estado = $_POST['estado'] ?? 1;
            $mciclos = new MCiclosEscolares();
            $resultado = $mciclos->registrar($nombre, $fecha_inicio, $fecha_fin, $estado);
            if ($resultado) {
                $_SESSION['successmsj'] = "Ciclo escolar registrado exitosamente.";
                header('Location: ../view/crudAdminCiclosEsco.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar el ciclo escolar.";
                header('Location: ../view/crudAdminCiclosEsco.php');
            }
            exit();
        break;

        case 'consultarCiclosEscolares':
            require_once("../model/MCiclosEscolares.php");
            $mciclos = new MCiclosEscolares();
            $resultado = $mciclos->consultar();
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode([]);
            }
        break;

        case 'editarCicloEscolar':
            require_once("../model/MCiclosEscolares.php");
            $id_ciclo_escolar = $_POST['id_ciclo_escolar'];
            $nombre = $_POST['nombre'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $estado = $_POST['estado'] ?? 1;
            $mciclos = new MCiclosEscolares();
            $resultado = $mciclos->editar($id_ciclo_escolar, $nombre, $fecha_inicio, $fecha_fin, $estado);
            if ($resultado) {
                $_SESSION['successmsj'] = "Ciclo escolar editado exitosamente.";
                header('Location: ../view/crudAdminCiclosEsco.php');
            } else {
                $_SESSION['errormsj'] = "Error al editar el ciclo escolar.";
                header('Location: ../view/crudAdminCiclosEsco.php');
            }
            exit();
        break;

        case 'eliminarCicloEscolar':
            require_once("../model/MCiclosEscolares.php");
            $id_ciclo_escolar = $_POST['id_ciclo_escolar'];
            $mciclos = new MCiclosEscolares();
            $resultado = $mciclos->eliminar($id_ciclo_escolar);
            if ($resultado) {
                $_SESSION['successmsj'] = "Ciclo escolar eliminado exitosamente.";
                header('Location: ../view/crudAdminCiclosEsco.php');
            } else {
                $_SESSION['errormsj'] = "Error al eliminar el ciclo escolar.";
                header('Location: ../view/crudAdminCiclosEsco.php');
            }
            exit();
        break;

        case 'seleccionarCicloEscolar':
            require_once("../model/MCiclosEscolares.php");
            $id_ciclo_escolar = $_POST['id_ciclo_escolar'];
            $mciclos = new MCiclosEscolares();
            $_SESSION['ciclo_editar'] = $mciclos->obtenerPorId($id_ciclo_escolar);
            header('Location: ../view/crudAdminCiclosEsco.php');
            exit();
        break;
    }
} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}
?>