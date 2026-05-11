<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: loginDocente.php");
    exit();
}

require_once("../model/MDocentes.php");

if(!isset($_GET['id_grupo'])){
    header("Location: misGruposDocente.php");
    exit();
}

$idGrupo = $_GET['id_grupo'];

$modelo = new MDocentes();

$alumnos = $modelo->obtenerAlumnosGrupo($idGrupo);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pase de Lista - GESA</title>
    <link rel="stylesheet" href="resources/style.css">
</head>
<body>

<form action="../controller/dispacher.php" method="POST">

<div class="attendance-card">

    <div class="top-bar">

        <a href="misGruposDocente.php" class="back-arrow">
            &#8592;
        </a>

        <input 
            type="date" 
            name="fecha"
            class="date-input"
            value="<?php echo date('Y-m-d'); ?>"
        >

    </div>

    <h2 style="margin-bottom: 15px; color: #2c3e50;">
        Pase de Lista
    </h2>

    <div class="table-scroll-area">

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Nombre del Alumno</th>
                    <th class="center-cell">Asistencia</th>
                    <th class="center-cell">Falta</th>
                    <th class="center-cell">Retardo</th>
                    <th class="center-cell">Justificante</th>
                </tr>

            </thead>

            <tbody>

                <?php

                $contador = 1;

                foreach($alumnos as $alumno){
                ?>

                    <tr>

                        <td>
                            <?php echo $contador; ?>
                        </td>

                        <td>

                            <?php 
                            
                            echo $alumno['app'] . " " . 
                                 $alumno['apm'] . " " . 
                                 $alumno['nombre'];
                            
                            ?>

                        </td>

                        <td class="center-cell">

                            <input 
                                type="radio" 
                                name="asistencia[<?php echo $alumno['id_alumno']; ?>]" 
                                value="0"
                                required
                            >

                        </td>

                        <td class="center-cell">

                            <input 
                                type="radio" 
                                name="asistencia[<?php echo $alumno['id_alumno']; ?>]" 
                                value="3"
                            >

                        </td>

                        <td class="center-cell">

                            <input 
                                type="radio" 
                                name="asistencia[<?php echo $alumno['id_alumno']; ?>]" 
                                value="1"
                            >

                        </td>

                        <td class="center-cell">

                            <input 
                                type="radio" 
                                name="asistencia[<?php echo $alumno['id_alumno']; ?>]" 
                                value="0"
                            >

                        </td>

                    </tr>

                <?php
                
                    $contador++;
                }
                
                ?>

            </tbody>

        </table>

    </div>

    <div class="footer-actions">

        <input 
            type="hidden" 
            name="accion" 
            value="GuardarAsistencia"
        >

        <input 
            type="hidden" 
            name="id_grupo" 
            value="<?php echo $idGrupo; ?>"
        >

        <button type="submit" class="btn-submit">
            ENVIAR
        </button>

    </div>

</div>

</form>

</body>
</html>