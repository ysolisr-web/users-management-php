<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Cursos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav a { margin-right: 15px; }
        .alert { padding: 10px; background-color: #e8f5e9; border: 1px solid #4caf50; margin-bottom: 15px; }
        .form-group { margin-bottom: 10px; }
        label { display: block; font-weight: bold; }
        input[type="text"], textarea { width: 100%; max-width: 400px; padding: 6px; }
        button { padding: 8px 16px; cursor: pointer; }
        table { border-collapse: collapse; width: 100%; max-width: 700px; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <nav>
        <a href="?route=home">Inicio</a>
        <a href="?route=cursos">Cursos</a>
    </nav>
    <hr>

    <h1>Gestión de Cursos</h1>

    <?php if (!empty($message)): ?>
        <div class="alert"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <h2>Registrar nuevo curso</h2>
    <form action="?route=cursos.store" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del curso:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <button type="submit">Guardar curso</button>
    </form>

    <h2>Lista de cursos registrados</h2>
    <?php if (empty($cursos)): ?>
        <p>No hay cursos registrados todavía.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td><?php echo htmlspecialchars((string) $curso->id(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($curso->nombre(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($curso->descripcion(), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars((string) $curso->createdAt(), ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>