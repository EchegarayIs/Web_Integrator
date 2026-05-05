<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="resources/login.css">
</head>
<body>

<div class="main-wrapper">

    <div class="login-section">
        <!-- Redirige a otro HTML -->

        <form action="../controller/dispacher.php" method="POST" class="form-box">
            <h1>Iniciar Sesión</h1>
            <span>¡Bienvenido!</span>

            <!-- MATRÍCULA -->
            <input 
                id="matricula"
                name="matricula"
                type="text"
                class="input-item"
                placeholder="Matrícula"
                required
                pattern="^[0-9]+$"
                title="Solo números">

            <!-- CONTRASEÑA -->
            <input 
                id="password"
                name="password"
                type="password"
                class="input-item"
                placeholder="Contraseña"
                required
                pattern="^(?=.*[A-Z])(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$"
                title="Mínimo 8 caracteres, una mayúscula y un número o símbolo">

            <input type="hidden" id="accion" name="accion" value="LoginAlumno">
            <input type="submit"  id="btnentrarlogin" class="btn-blue" value="Ingresar">

            <p id="mensaje"></p>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay-content">
            <div class="side-panel side-right">
                <h1>¡Bienvenido!</h1>
                <p>Aquí podras revisar tu actividad académica resultante</p>

                <!-- Ya conecta a registro.html 
                <a href="registro.php" class="btn-outline" style="text-decoration:none;">
                    REGISTRARME
                </a>-->
            </div>
        </div>
    </div>

</div>

</body>
</html>