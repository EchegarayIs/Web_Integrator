<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Lateral</title>
  
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="resources/style.css">
</head>
<body>

  <!-- Menú Lateral -->
  <?php include "menuLateralAdmin.php"; ?>

  <!-- Contenido Principal (solo para demostración) -->
  
<div class="main-wrapper">
    <input type="checkbox" id="control" style="display:none;" checked>

    <div class="register-section">
        <form action="../controller/dispacherAdmin.php" method="POST" class="form-box" id="formRegistro">
            <h1 style="margin-bottom:15px;">Alta - Administrativos</h1>

                <!-- NOMBRE -->
                <input
                id="nombre"
                name="nombre"
                type="text"
                class="input-item"
                placeholder="Nombre(s)"
                required
                minlength="3"
                maxlength="40"
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras y espacios"
                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

            <div class="row">

                <!-- APELLIDO PATERNO -->
                <input
                id="app"
                name="app"
                type="text"
                class="input-item"
                placeholder="Apellido Paterno"
                required
                minlength="3"
                maxlength="30"
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras y espacios"
                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                <!-- APELLIDO MATERNO -->
                <input
                id="apm"
                name="apm"
                type="text"
                class="input-item"
                placeholder="Apellido Materno"
                required
                minlength="3"
                maxlength="30"
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras y espacios"
                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

            </div>

            <div class="row">

                <!-- IDENTIFICACION -->
                <input
                id="noEmpleado"
                name="noEmpleado"
                type="text"
                class="input-item"
                placeholder="Número Identificación"
                required
                pattern="^[0-9]+$"
                title="Solo números">

                <!-- Puesto -->
                <input
                id="puesto"
                name="puesto"
                type="text"
                class="input-item"
                placeholder="Puesto"
                required
                minlength="3"
                maxlength="50"
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras y espacios"
                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                
                <!-- CURP -->
                <input
                id="curp"
                name="curp"
                type="text"
                class="input-item"
                placeholder="CURP"
                required
                pattern="^^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z0-9]\d$"
                title="CURP inválida">

                <!-- RFC -->
                <input
                id="rfc"
                name="rfc"
                type="text"
                class="input-item"
                placeholder="RFC"
                required
                pattern="^[A-ZÑ&]{3,4}\d{6}[A-Z0-9]{3}$"
                title="RFC inválido">


            </div>

            <div class="row">

                <!-- Correo Electrónico -->
                <input
                id="correo"
                name="correo"
                type="email"
                class="input-item"
                placeholder="Correo Electrónico"
                required
                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                title="Correo electrónico inválido">

                <!-- NUMERO DE TELEFONO -->
                <input
                id="telefono"
                name="telefono"
                type="text"
                class="input-item"
                placeholder="Número de Teléfono"
                required
                pattern="^(?:\+?52\s?)?(?:0)?\d{2,3}[-\s]?\d{7,8}$"
                title="Número de teléfono inválido">

            </div>

            <div class="row">

                <!-- departamento -->
                <input
                id="departamento"
                name="departamento"
                type="text"
                class="input-item"
                placeholder="Departamento"
                required
                minlength="3"
                maxlength="50"
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras y espacios"
                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
                
            </div>

            <div class="row">

                <!-- CONTRASEÑA -->
                <input
                id="contrasenia"
                name="contrasenia"
                type="password"
                class="input-item"
                placeholder="Contraseña"
                required
                pattern="^(?=.*[A-Z])(?=.*[A-Za-z])(?=.*[\d\W]).{8,}$"
                title="Mínimo 8 caracteres, una mayúscula y un número o símbolo">

                <!-- CONFIRMAR -->
                <input
                id="confcontrasenia"
                name="confcontrasenia"
                type="password"
                class="input-item"
                placeholder="Confirmar Contraseña"
                required>

            </div>

            <input type="hidden" id="accion" name="accion" value="RegistrarAdmin">
            <input type="submit"  id="btnRegistrar" class="btn-blue" value="Registrar">

        </form>
    </div>

</div>

</body>
</html>