
<?php
session_start();

include_once("../model/conexion.php");

try {
    // accion a realizar obtenida del post
    $accion = $_POST['accion'];
    
    switch ($accion) {


        case 'LoginAlumno':
            require_once("../model/MAlumnos.php");
            $matricula = $_POST['matricula'];
            $contrasenia = $_POST['password'];
            $alumno = new MAlumnos();
            $resultado = $alumno->verificar($matricula, $contrasenia);
            if ($resultado) {
                $_SESSION['usuario'] = $resultado;
                header('Location: ../view/homeAlumnos.php');
            } else {
                $_SESSION['errormsj'] = "Matrícula o contraseña incorrecta.";
                header('Location: ../view/loginAlumno.php');
            }
            break;
        case 'LoginDocente':
            require_once("../model/MDocentes.php");
            $noEmpleado = $_POST['noEmpleado'];
            $contrasenia = $_POST['password'];
            $docente = new MDocentes();
            $resultado = $docente->verificar($noEmpleado, $contrasenia);
            if ($resultado) {
                $_SESSION['usuario'] = $resultado;
                header('Location: ../view/homeDocente.php');
            } else {
                $_SESSION['errormsj'] = "Número de empleado o contraseña incorrecta.";
                header('Location: ../view/loginDocente.php');
            }   
            break;
        case 'LoginAdmin':
            require_once("../model/MAdmin.php");
            $noEmpleado = $_POST['noEmpleado'];
            $contrasenia = $_POST['password'];
            $admin = new MAdmin();
            $resultado = $admin->verificar($noEmpleado, $contrasenia);
            if ($resultado) {
                $_SESSION['usuario'] = $resultado;
                header('Location: ../view/homeAdmin.php');
            } else {
                $_SESSION['errormsj'] = "Número de empleado o contraseña incorrecta.";
                header('Location: ../view/loginAdmin.php');
            }   
            break;
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>