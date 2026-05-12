<?php   
session_start();
include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {
        case 'buscarGrupo':
            require_once("../model/MGrupos.php");
            $grupo = trim($_POST['grupo']);
            $mgrupos = new MGrupos();
            $resultado = $mgrupos->buscar($grupo);
            $_SESSION['grupos_resultados'] = $resultado;
            $_SESSION['search_query'] = $grupo;
            if (empty($resultado)) {
                $_SESSION['errormsj'] = "No se encontraron grupos que coincidan con '$grupo'.";
            }
            header('Location: ../view/crudAdminGrupos.php');
            exit();
        break;

        case 'RegistrarGrupo':
            require_once("../model/MGrupos.php");
            $nombre_grupo = $_POST['nombre_grupo'];
            $semestre = $_POST['semestre'];
            $capacidad = $_POST['capacidad'];
            $turno = $_POST['turno'];
            $id_ciclo = $_POST['id_ciclo'];
            $id_materia = $_POST['id_materia'];
            $mgrupos = new MGrupos();
            $resultado = $mgrupos->registrar($nombre_grupo, $semestre, $capacidad, $turno, $id_ciclo, $id_materia);
            if ($resultado) {
                $_SESSION['successmsj'] = "Grupo registrado exitosamente.";
                header('Location: ../view/crudAdminGrupos.php');
            } else {
                $_SESSION['errormsj'] = "Error al registrar el grupo.";
                header('Location: ../view/crudAdminGrupos.php');
            }
            exit();
        break;

        case 'consultarGrupos':
            require_once("../model/MGrupos.php");
            $mgrupos = new MGrupos();
            $resultado = $mgrupos->consultar();
            if ($resultado) {
                echo json_encode($resultado);
            } else {
                echo json_encode([]);
            }
        break;

        case 'editarGrupo':
            require_once("../model/MGrupos.php");
            $id_grupo = $_POST['id_grupo'];
            $nombre_grupo = $_POST['nombre_grupo'];
            $semestre = $_POST['semestre'];
            $capacidad = $_POST['capacidad'];
            $turno = $_POST['turno'];
            $id_ciclo = $_POST['id_ciclo'];
            $id_materia = $_POST['id_materia'];
            $mgrupos = new MGrupos();
            $resultado = $mgrupos->editar($id_grupo, $nombre_grupo, $semestre, $capacidad, $turno, $id_ciclo, $id_materia);
            if ($resultado) {
                $_SESSION['successmsj'] = "Grupo editado exitosamente.";
                header('Location: ../view/crudAdminGrupos.php');
            } else {
                $_SESSION['errormsj'] = "Error al editar el grupo.";
                header('Location: ../view/crudAdminGrupos.php');
            }
            exit();
        break;

        case 'eliminarGrupo':
            require_once("../model/MGrupos.php");
            $id_grupo = $_POST['id_grupo'];
            $mgrupos = new MGrupos();
            $resultado = $mgrupos->eliminar($id_grupo);
            if ($resultado) {
                $_SESSION['successmsj'] = "Grupo eliminado exitosamente.";
                header('Location: ../view/crudAdminGrupos.php');
            } else {
                $_SESSION['errormsj'] = "Error al eliminar el grupo.";
                header('Location: ../view/crudAdminGrupos.php');
            }
            exit();
        break;
    }
} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}
?>