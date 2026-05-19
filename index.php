<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Proyectos - ITSOH</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="view/resources/index.css">
</head>
<body>

    <div class="top-bar">
        <div class="top-bar-container">
            <div class="top-links">
                <a href="https://www.itsoeh.edu.mx/front/" target="_blank"><i class="fa-solid fa-globe"></i> Portal Oficial ITSOEH</a>
                <a href="soporte.php"><i class="fa-solid fa-headset"></i> Mesa de Ayuda</a>
            </div>
            <div class="top-socials">
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <img src="view/resources/images/logo-itsoeh.webp" alt="Logo ITSOEH" class="logo-institucional">
            </div>
            <div class="title-container">
                <h1>Instituto Tecnológico Superior del Occidente de Hidalgo</h1>
                <p class="subtitle">Sistema de Gestión de Proyectos (GACE Web)</p>
            </div>
        </div>
    </header>

    <main class="main-content">
        
        <section class="intro-section">
            <h2>Portal de Accesos</h2>
            <p>Bienvenido al sistema institucional. Por favor, selecciona tu perfil correspondiente para ingresar a tu panel de control.</p>
        </section>

        <div class="wrapper">
            
            <section class="card"> 
                <div class="card-image-container">
                    <img src="view/resources/images/alumnos.jpeg" alt="Estudiantes del instituto">
                </div>
                <div class="info">
                    <h2><i class="fa-solid fa-graduation-cap"></i> Alumnos</h2>
                    <p>Accede a tu panel para gestionar tus proyectos, revisar estatus y subir documentación de manera eficiente.</p>
                    <a href="view/loginAlumno.php" class="btn-entrar">Ingresar al Portal</a>
                </div>
            </section>

            <section class="card"> 
                <div class="card-image-container">
                    <img src="view/resources/images/docentes.jpeg" alt="Docentes en reunión académica">
                </div>
                <div class="info">
                    <h2><i class="fa-solid fa-chalkboard-user"></i> Docentes</h2>
                    <p>Gestiona tus grupos asignados, evalúa los proyectos de tus alumnos y realiza el seguimiento institucional.</p>
                    <a href="view/loginDocente.php" class="btn-entrar">Ingresar al Portal</a>
                </div>
            </section>

            <section class="card"> 
                <div class="card-image-container">
                    <img src="view/resources/images/admins.jpg" alt="Personal de administración">
                </div>
                <div class="info">
                    <h2><i class="fa-solid fa-user-gear"></i> Administradores</h2>
                    <p>Configuración global del sistema, gestión de usuarios, catálogos, reportes y control de periodos escolares.</p>
                    <a href="view/loginAdmin.php" class="btn-entrar">Ingresar al Portal</a>
                </div>
            </section>

        </div>
    </main>

    <br><br><br>

    <footer class="main-footer">
        <div class="footer-container">
            
            <div class="footer-column">
                <h3>Contacto ITSOEH</h3>
                <p><i class="fa-solid fa-location-dot"></i> Paseo del Agrarismo No. 2000, Carr. Mixquiahuala-Tula Km. 2.5, Mixquiahuala de Juárez, Hidalgo. C.P. 42700.</p>
                <p><i class="fa-solid fa-phone"></i> Tel: (738) 735 4000</p>
            </div>

            <div class="footer-column">
                <h3>Enlaces Útiles</h3>
                <ul>
                    <li><a href="#">Aviso de Privacidad</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Reglamento Escolar</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Soporte Técnico GACE</h3>
                <p>¿Tienes problemas para ingresar? Contacta al departamento de Servicios Cómputo o envía un correo a: <a href="mailto:soporte@itsoh.edu.mx">soporte@itsoh.edu.mx</a></p>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 GACE Web - Instituto Tecnológico Superior del Occidente de Hidalgo. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>