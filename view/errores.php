<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Errores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .error-list {
            list-style: disc;
            margin-left: 1.5rem;
            color: #b00;
        }
        .no-errors {
            color: #080;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Errores</h1>
        <?php if (isset($_SESSION['errormsj'])): ?>
            <p>Se han producido los siguientes errores:</p>
            <ul class="error-list">
                <li><?php echo $_SESSION['errormsj']; ?></li>
            </ul>
            <?php unset($_SESSION['errormsj']); ?>
        <?php else: ?>
            <p class="no-errors">No se han registrado errores.</p>
        <?php endif; ?>
    </div>
</body>
</html>