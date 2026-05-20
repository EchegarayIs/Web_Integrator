<?php
session_start();

include_once("../model/conexion.php");

try {
    $accion = $_POST['accion'];
    
    switch ($accion) {
        case 'aceptarJustificante':            
            require_once("../model/MJustificantes.php");
            $id = $_POST['id'];
            $fechaResolucion = date('Y-m-d H:i:s');
            $mJustificantes = new MJustificantes();
            if ($mJustificantes->aceptarJustificante($id, $fechaResolucion)) {
                $_SESSION['successmsj'] = "Justificante aceptado exitosamente.";
            } else {
                $_SESSION['errormsj'] = "Error al aceptar el justificante.";
            }
            $_SESSION['justificantes'] = $mJustificantes->consultarJustificantes(); // Actualizamos la lista de justificantes en sesión
            header('Location: ../view/justificantesAdmin.php');
        break;
        case 'rechazarJustificante':            
            require_once("../model/MJustificantes.php");
            $id = $_POST['id'];
            $fechaResolucion = date('Y-m-d H:i:s');
            $mJustificantes = new MJustificantes();
            if ($mJustificantes->rechazarJustificante($id, $fechaResolucion)) {
                $_SESSION['successmsj'] = "Justificante rechazado exitosamente.";
            } else {
                $_SESSION['errormsj'] = "Error al rechazar el justificante.";
            }
            $_SESSION['justificantes'] = $mJustificantes->consultarJustificantes(); // Actualizamos la lista de justificantes en sesión
            header('Location: ../view/justificantesAdmin.php');
        break;
        case 'mantenerPendiente':
            require_once("../model/MJustificantes.php");
            $id = $_POST['id'];
            $mJustificantes = new MJustificantes();
            if ($mJustificantes->mantenerPendienteJustificante($id)) {
                $_SESSION['successmsj'] = "Justificante mantenido como pendiente.";
            } else {
                $_SESSION['errormsj'] = "Error al mantener el justificante como pendiente.";
            }
            $_SESSION['justificantes'] = $mJustificantes->consultarJustificantes(); // Actualizamos la lista de justificantes en sesión
            header('Location: ../view/justificantesAdmin.php');
        break;
            
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>