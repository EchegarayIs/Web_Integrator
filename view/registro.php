<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="resources/style.css">
</head>
<body>

<div class="main-wrapper">
    <input type="checkbox" id="control" style="display:none;" checked>

    <div class="register-section">
        <form class="form-box" id="formRegistro">
            <h1 style="margin-bottom:15px;">Crear cuenta</h1>

                <!-- NOMBRE -->
                <input
                id="nombreregistro"
                type="text"
                class="input-item"
                placeholder="Nombre(s)"
                required
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras">

            <div class="row">

                <!-- APELLIDO PATERNO -->
                <input
                id="appregistro"
                type="text"
                class="input-item"
                placeholder="Apellido Paterno"
                required
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras">

                <!-- APELLIDO MATERNO -->
                <input
                id="apmregistro"
                type="text"
                class="input-item"
                placeholder="Apellido Materno"
                required
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras">

            </div>

            <div class="row">

                <select id="cmbgenero" class="input-item" required style="color:#888;">
                <option value="" disabled selected>Género</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                </select>

                <!-- IDENTIFICACION -->
                <input
                id="idregistro"
                type="text"
                class="input-item"
                placeholder="Número Identificación"
                required
                pattern="^[0-9]+$"
                title="Solo números">

            </div>

            <div class="row">

                <!-- TELEFONO -->
                <input
                id="telefonoregistro"
                type="tel"
                class="input-item"
                placeholder="Número de Teléfono"
                required
                pattern="^[0-9]{10}$"
                title="Solo 10 números">

                <!-- CORREO -->
                <input
                id="correoregistro"
                type="text"
                class="input-item"
                placeholder="Correo Electrónico"
                required
                pattern="^[a-zA-Z0-9_]+@[a-zA-Z0-9]+\.(com)$"
                title="Solo letras, números o guion bajo antes del @ y debe terminar en .com">

            </div>

            <!-- DOMICILIO -->
            <input
            id="domicilioregistro"
            type="text"
            class="input-item"
            placeholder="Domicilio"
            required
            pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
            title="Solo letras">

            <div class="row">

                <!-- CONTRASEÑA -->
                <input
                id="contraseniaregistro"
                type="password"
                class="input-item"
                placeholder="Contraseña"
                required
                pattern="^(?=.*[A-Z])(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$"
                title="Mínimo 8 caracteres, una mayúscula y un número o símbolo">

                <!-- CONFIRMAR -->
                <input
                id="confcontraseniaregis"
                type="password"
                class="input-item"
                placeholder="Confirmar Contraseña"
                required>

            </div>

            <button id="btnregitrar" class="btn-blue" type="submit">
                REGISTRAR
            </button>

        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay-content">
            <div class="side-panel side-left">
                <h1>¡Bienvenido!</h1>
                <p>¿Ya tienes una cuenta? Inicia sesión aquí.</p>
                <a href="login.html" class="btn-outline" style="text-decoration:none;">
                IR AL LOGIN
                </a>
            </div>
        </div>
    </div>

</div>

</body>
</html>