<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Cursos - CRUDL</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav a { margin-right: 15px; }
        .alert { padding: 10px; background-color: #e8f5e9; border: 1px solid #4caf50; margin-bottom: 15px; }
        .alert-error { padding: 10px; background-color: #ffebee; border: 1px solid #f44336; margin-bottom: 15px; }
        .card { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; background-color: #fafafa; max-width: 900px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 12px; max-width: 900px; }
        .form-group { margin-bottom: 10px; }
        .form-group-full { grid-column: 1 / -1; margin-bottom: 10px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input[type="text"], input[type="number"], input[type="date"], select, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 6px;
        }
        button, .btn {
            padding: 8px 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border: 1px solid #999;
            background-color: #eee;
            color: #000;
            font-size: 13px;
        }
        .btn-danger { background-color: #ffebee; border-color: #f44336; color: #b71c1c; }
        .btn-cancel { margin-left: 8px; }
        .actions { white-space: nowrap; }
        .actions form { display: inline; }
        .table-wrapper { overflow-x: auto; margin-top: 15px; }
        table { border-collapse: collapse; width: 100%; min-width: 1300px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; font-size: 14px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <nav>
        <a href="?route=home">Inicio</a>
        <a href="?route=cursos">Cursos (CRUDL)</a>
    </nav>
    <hr>

    <h1>Gestión de Cursos (CRUDL)</h1>

    <?php if (!empty($message)): ?>
        <?php $isError = str_starts_with($message, 'Error'); ?>
        <div class="<?php echo $isError ? 'alert-error' : 'alert'; ?>">
            <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <!-- READ: Consultar curso por ID -->
    <div class="card">
        <h3>Consultar curso por ID (Read)</h3>
        <form action="" method="GET" style="display: flex; gap: 10px; align-items: flex-end; max-width: 450px;">
            <input type="hidden" name="route" value="cursos">
            <div style="flex: 1;">
                <label for="show_id">ID del curso:</label>
                <input type="text" id="show_id" name="show_id" placeholder="Ej: 1"
                       value="<?php echo htmlspecialchars((string) ($_GET['show_id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <button type="submit">Consultar</button>
            <?php if ($selectedCurso !== null): ?>
                <a href="?route=cursos" class="btn">Cerrar detalle</a>
            <?php endif; ?>
        </form>

        <?php if ($selectedCurso !== null): ?>
            <hr>
            <h4>Detalle del Curso #<?php echo htmlspecialchars((string) $selectedCurso->id()->value(), ENT_QUOTES, 'UTF-8'); ?></h4>
            <p>
                <strong>Nombre:</strong> <?php echo htmlspecialchars((string) $selectedCurso->nombre(), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Precio:</strong> $<?php echo htmlspecialchars(number_format((float) $selectedCurso->precio()->value(), 2), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Horas:</strong> <?php echo htmlspecialchars((string) $selectedCurso->horas(), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Nivel:</strong> <?php echo htmlspecialchars((string) $selectedCurso->nivel(), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Modalidad:</strong> <?php echo htmlspecialchars((string) $selectedCurso->modalidad(), ENT_QUOTES, 'UTF-8'); ?><br>
                <strong>Profesor:</strong> <?php echo htmlspecialchars((string) $selectedCurso->profesor(), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Institución:</strong> <?php echo htmlspecialchars((string) $selectedCurso->institucion(), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Cupo alumnos:</strong> <?php echo htmlspecialchars((string) $selectedCurso->numAlumnos(), ENT_QUOTES, 'UTF-8'); ?><br>
                <strong>Inscripciones:</strong> <?php echo htmlspecialchars((string) $selectedCurso->fechaInscripcionInicio(), ENT_QUOTES, 'UTF-8'); ?> al <?php echo htmlspecialchars((string) $selectedCurso->fechaInscripcionFin(), ENT_QUOTES, 'UTF-8'); ?> |
                <strong>Duración:</strong> <?php echo htmlspecialchars((string) $selectedCurso->fechaInicio(), ENT_QUOTES, 'UTF-8'); ?> al <?php echo htmlspecialchars((string) $selectedCurso->fechaCierre(), ENT_QUOTES, 'UTF-8'); ?><br>
                <strong>Descripción:</strong> <?php echo htmlspecialchars((string) $selectedCurso->descripcion(), ENT_QUOTES, 'UTF-8'); ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- CREATE / UPDATE: Formulario -->
    <?php
        $isEdit = $editingCurso !== null;
        $valId = $isEdit && $editingCurso->id() !== null ? (string) $editingCurso->id()->value() : '';
        $valNombre = $isEdit ? (string) $editingCurso->nombre() : '';
        $valPrecio = $isEdit ? (string) $editingCurso->precio()->value() : '';
        $valHoras = $isEdit ? (string) $editingCurso->horas() : '';
        $valNivel = $isEdit ? (string) $editingCurso->nivel() : '';
        $valProfesor = $isEdit ? (string) $editingCurso->profesor() : '';
        $valInstitucion = $isEdit ? (string) $editingCurso->institucion() : '';
        $valInsIni = $isEdit ? (string) $editingCurso->fechaInscripcionInicio() : '';
        $valInsFin = $isEdit ? (string) $editingCurso->fechaInscripcionFin() : '';
        $valFecIni = $isEdit ? (string) $editingCurso->fechaInicio() : '';
        $valFecCie = $isEdit ? (string) $editingCurso->fechaCierre() : '';
        $valAlumnos = $isEdit ? (string) $editingCurso->numAlumnos() : '';
        $valModalidad = $isEdit ? (string) $editingCurso->modalidad() : '';
        $valDescripcion = $isEdit ? (string) $editingCurso->descripcion() : '';
    ?>

    <h2><?php echo $isEdit ? 'Editar curso #' . htmlspecialchars($valId, ENT_QUOTES, 'UTF-8') . ' (Update)' : 'Registrar nuevo curso (Create)'; ?></h2>
    <form action="?route=cursos.store" method="POST">
        <input type="hidden" name="action" value="<?php echo $isEdit ? 'update' : 'create'; ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($valId, ENT_QUOTES, 'UTF-8'); ?>">
        <?php endif; ?>

        <div class="form-grid">
            <div class="form-group">
                <label for="nombre">Nombre del curso:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($valNombre, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?php echo htmlspecialchars($valPrecio, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="horas">Horas:</label>
                <input type="number" id="horas" name="horas" min="1" value="<?php echo htmlspecialchars($valHoras, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="nivel">Nivel:</label>
                <select id="nivel" name="nivel" required>
                    <option value="">Seleccione un nivel...</option>
                    <option value="BASICO" <?php echo $valNivel === 'BASICO' ? 'selected' : ''; ?>>Básico</option>
                    <option value="INTERMEDIO" <?php echo $valNivel === 'INTERMEDIO' ? 'selected' : ''; ?>>Intermedio</option>
                    <option value="AVANZADO" <?php echo $valNivel === 'AVANZADO' ? 'selected' : ''; ?>>Avanzado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="profesor">Profesor:</label>
                <input type="text" id="profesor" name="profesor" value="<?php echo htmlspecialchars($valProfesor, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="institucion">Institución:</label>
                <input type="text" id="institucion" name="institucion" value="<?php echo htmlspecialchars($valInstitucion, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_inscripcion_inicio">Inicio de inscripción:</label>
                <input type="date" id="fecha_inscripcion_inicio" name="fecha_inscripcion_inicio" value="<?php echo htmlspecialchars($valInsIni, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_inscripcion_fin">Fin de inscripción:</label>
                <input type="date" id="fecha_inscripcion_fin" name="fecha_inscripcion_fin" value="<?php echo htmlspecialchars($valInsFin, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio del curso:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($valFecIni, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_cierre">Fecha de cierre del curso:</label>
                <input type="date" id="fecha_cierre" name="fecha_cierre" value="<?php echo htmlspecialchars($valFecCie, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="num_alumnos">Número de alumnos:</label>
                <input type="number" id="num_alumnos" name="num_alumnos" min="1" value="<?php echo htmlspecialchars($valAlumnos, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="modalidad">Modalidad:</label>
                <select id="modalidad" name="modalidad" required>
                    <option value="">Seleccione una modalidad...</option>
                    <option value="PRESENCIAL" <?php echo $valModalidad === 'PRESENCIAL' ? 'selected' : ''; ?>>Presencial</option>
                    <option value="VIRTUAL" <?php echo $valModalidad === 'VIRTUAL' ? 'selected' : ''; ?>>Virtual</option>
                    <option value="HIBRIDA" <?php echo $valModalidad === 'HIBRIDA' ? 'selected' : ''; ?>>Híbrida</option>
                </select>
            </div>

            <div class="form-group-full">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($valDescripcion, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>
        </div>

        <button type="submit"><?php echo $isEdit ? 'Actualizar curso' : 'Guardar curso'; ?></button>
        <?php if ($isEdit): ?>
            <a href="?route=cursos" class="btn btn-cancel">Cancelar edición</a>
        <?php endif; ?>
    </form>

    <!-- LIST: Lista completa con acciones -->
    <h2>Lista de cursos registrados (List)</h2>
    <?php if (empty($cursos)): ?>
        <p>No hay cursos registrados todavía.</p>
    <?php else: ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Horas</th>
                        <th>Nivel</th>
                        <th>Profesor</th>
                        <th>Institución</th>
                        <th>Inscripción Inicio</th>
                        <th>Inscripción Fin</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Cierre</th>
                        <th>Alumnos</th>
                        <th>Modalidad</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cursos as $curso): ?>
                        <?php $rowId = $curso->id() !== null ? (string) $curso->id()->value() : ''; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rowId, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->nombre(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars(number_format((float) $curso->precio()->value(), 2), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->horas(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->nivel(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->profesor(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->institucion(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->fechaInscripcionInicio(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->fechaInscripcionFin(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->fechaInicio(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->fechaCierre(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->numAlumnos(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->modalidad(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $curso->descripcion(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) ($curso->createdAt() ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="actions">
                                <a href="?route=cursos&show_id=<?php echo urlencode($rowId); ?>" class="btn">Ver</a>
                                <a href="?route=cursos&edit_id=<?php echo urlencode($rowId); ?>" class="btn">Editar</a>
                                <form action="?route=cursos.store" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este curso?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($rowId, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</body>
</html>