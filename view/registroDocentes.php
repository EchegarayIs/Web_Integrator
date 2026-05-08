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
  <?php include "menuLateralDocentes.php"; ?>

  <!-- Contenido Principal (solo para demostración) -->
  
<div class="main-wrapper">
    <input type="checkbox" id="control" style="display:none;" checked>

    <div class="register-section">
        <form action="../controller/dispacherDocentes.php" method="POST" class="form-box" id="formRegistro">
            <h1 style="margin-bottom:15px;">Crear cuenta</h1>

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

                <!-- Fecha  naciemiento -->
                <input
                id="fechaNac"
                name="fechaNac"
                type="date"
                class="input-item"
                placeholder="Fecha de Nacimiento"
                required>

            </div>

            <div class="row">

                <!-- Cedula -->
                <input
                id="cedula"
                name="cedula"
                type="text"
                class="input-item"
                placeholder="Cédula"  
                required
                pattern="^[0-9]+$"
                title="Solo números">

                <!-- Especialidad -->
                <input
                id="especialidad"
                name="especialidad"
                type="text"
                class="input-item"
                placeholder="Especialidad"
                required
                minlength="3"
                maxlength="50"
                pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
                title="Solo letras y espacios"
                oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

            </div>

    
            <!-- Grado de estudio -->
            <input
            id="gradoEstudio"
            name="gradoEstudio"
            type="text"
            class="input-item"
            placeholder="Grado de Estudio"
            required
            minlength="3"
            maxlength="50"
            pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
            title="Solo letras y espacios"
            oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

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

            <input type="hidden" id="accion" name="accion" value="RegistrarDocente">
            <input type="submit"  id="btnRegistrar" class="btn-blue" value="Registrar">

        </form>
    </div>

</div>

</body>
</html>