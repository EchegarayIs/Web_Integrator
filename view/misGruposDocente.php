<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: loginDocente.php");
    exit();
}

require_once("../model/MDocentes.php");

$idDocente = $_SESSION['usuario']['id_docente'];

$modelo = new MDocentes();

$grupos = $modelo->obtenerGruposDocente($idDocente);

$colores = [
    ['bg' => 'bg-blue', 'txt' => 'txt-blue'],
    ['bg' => 'bg-purple', 'txt' => 'txt-purple'],
    ['bg' => 'bg-green', 'txt' => 'txt-green'],
    ['bg' => 'bg-orange', 'txt' => 'txt-orange'],
    ['bg' => 'bg-red', 'txt' => 'txt-red']
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Grupos - GESA</title>
    <link rel="stylesheet" href="resources/style.css">
</head>
<body>

    <div class="header-container">

        <a href="homeDocente.php" class="back-link">
            &#8592;
        </a>

        <h1 class="main-title">
            Mis Grupos
        </h1>

    </div>

    <div class="groups-container">

        <?php
        
        $i = 0;

        foreach($grupos as $grupo){

            $color = $colores[$i % count($colores)];
        ?>

            <a 
                href="paseLista.php?id_grupo=<?php echo $grupo['id_grupo']; ?>" 
                class="group-card"
            >

                <div class="card-banner <?php echo $color['bg']; ?>">

                    <div class="center-icon-box">

                        <img 
                            src="resources/images/libroprueba.png" 
                            alt="Grupo Icon"
                        >

                    </div>

                    <span class="subject-name">

                        <?php echo $grupo['nombre_materia']; ?>

                    </span>

                </div>

                <div class="card-info">

                    <span class="group-label <?php echo $color['txt']; ?>">

                        <?php echo $grupo['nombre_grupo']; ?>

                    </span>

                </div>

            </a>

        <?php
        
            $i++;
        }
        
        ?>

    </div>

</body>
</html>