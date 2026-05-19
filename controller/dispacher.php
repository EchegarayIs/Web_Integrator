
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
            $resumen = $alumno->resumenGeneral($resultado['id_alumno']);
            $recientes = $alumno->actividadReciente($resultado['id_alumno']);
            if ($resultado) {
                $_SESSION['usuario'] = $resultado;
                $_SESSION['resumen'] = $resumen;
                $_SESSION['recientes'] = $recientes;
                header('Location: ../view/alumnosHome.php');
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
        case 'GuardarAsistencia':

            require_once("../model/MDocentes.php");

            $idGrupo = $_POST['id_grupo'];

            $fecha = $_POST['fecha'];

            $hora = date("H:i:s");

            $idDocente = $_SESSION['usuario']['id_docente'];

            $asistencias = $_POST['asistencia'];

            $docente = new MDocentes();

            // OBTENER ID_DOCENTE_GRUPO
            $docenteGrupo = $docente->obtenerDocenteGrupo(
                $idDocente,
                $idGrupo
            );

            $idDocenteGrupo = $docenteGrupo['id_docente_grupo'];

            foreach ($asistencias as $idAlumno => $estado) {

                // OBTENER ID_ALUMNO_GRUPO
                $alumnoGrupo = $docente->obtenerAlumnoGrupo(
                    $idAlumno,
                    $idGrupo
                );

                $idAlumnoGrupo = $alumnoGrupo['id_alumno_grupo'];

                $docente->guardarAsistencia(
                    $fecha,
                    $hora,
                    $estado,
                    $idAlumnoGrupo,
                    $idDocenteGrupo
                );
            }

            echo "
<script>

    alert('Lista guardada correctamente');

    window.location.href='../view/misGruposDocente.php';

</script>
";

            break;
<<<<<<< HEAD
=======
            
>>>>>>> 2168162cbb749a51f62ca038dcc58b76f650e736
    }

} catch (Exception $ex) {
    $_SESSION['errormsj'] = $ex->getMessage();
    header("Location: ../view/errores.php");
}

?>