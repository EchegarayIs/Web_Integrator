<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargador</title>
    <style>
        /* Contenedor del cargador con el degradado de tu app */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e2e8f0, #c7d2fe);
            z-index: 9999; 
            /* El desvanecido tarda 0.5 segundos en desaparecer */
            transition: opacity 0.5s ease, visibility 0.5s ease; 
        }

        .loader--hidden {
            opacity: 0;
            visibility: hidden;
        }

        /* Contenedor central que une el logo y el anillo */
        .loader-content {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            height: 150px;
        }

        /* Imagen del TecNM en el centro */
        .loader-logo {
            width: 90px;
            height: 90px;
            object-fit: contain;
            position: absolute;
            animation: pulse 1.25s ease-in-out infinite alternate;
        }

        /* Anillo giratorio externo con el azul oscuro institucional */
        .loader-spinner {
            width: 130px;
            height: 130px;
            border: 6px solid rgba(29, 53, 87, 0.15); 
            border-top: 6px solid #1d3557;           
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        /* Animación de rotación del spinner */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Animación de pulso para el logo institucional */
        @keyframes pulse {
            0% { transform: scale(0.95); opacity: 0.9; }
            100% { transform: scale(1.05); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="loader">
        <div class="loader-content">
            <img src="resources/images/tecnm.webp" alt="TecNM Logo" class="loader-logo">
            <div class="loader-spinner"></div>
        </div>
    </div>

    <script>
        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            // Forzamos a que el loader se quede en pantalla 2.5 segundos (2500 milisegundos)
            setTimeout(() => {
                loader.classList.add("loader--hidden");
            }, 2500);

            // Eliminar el elemento del DOM una vez termine la transición de desvanecido
            loader.addEventListener("transitionend", () => {
                if (document.body.contains(loader)) {
                    document.body.removeChild(loader);
                }
            });
        });
    </script>
</body>
</html>