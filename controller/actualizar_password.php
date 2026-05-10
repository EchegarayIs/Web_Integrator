<?php

session_start();

require_once("../model/MDocentes.php");

if(!isset($_SESSION['usuario'])){
    header("Location: ../view/loginDocente.php");
    exit();
}

try{

    $passwordNueva = $_POST['new_password'];
    $confirmarPassword = $_POST['confirm_password'];

    // VALIDAR
    if($passwordNueva != $confirmarPassword){

        $_SESSION['errormsj'] = "Las contraseñas no coinciden.";

        header("Location: ../view/perfilDocente.php");
        exit();
    }

    // VALIDACIÓN DE SEGURIDAD
    if(!preg_match('/^(?=.*[A-Z])(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$/', $passwordNueva)){

        $_SESSION['errormsj'] = "La contraseña no cumple con los requisitos.";

        header("Location: ../view/perfilDocente.php");
        exit();
    }

    $idDocente = $_SESSION['usuario']['id_docente'];

    $docente = new MDocentes();

    $resultado = $docente->actualizarPassword($idDocente, $passwordNueva);

    if($resultado){

        // ACTUALIZAR SESIÓN
        $_SESSION['usuario']['contrasenia'] = $passwordNueva;

        $_SESSION['successmsj'] = "Contraseña actualizada correctamente.";

    }else{

        $_SESSION['errormsj'] = "No fue posible actualizar la contraseña.";
    }

    header("Location: ../view/perfilDocente.php");

}catch(Exception $e){

    $_SESSION['errormsj'] = $e->getMessage();

    header("Location: ../view/perfilDocente.php");
}
?>