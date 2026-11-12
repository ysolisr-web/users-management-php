<?php

declare(strict_types=1);

$rootDir = dirname(__DIR__, 4);
require_once $rootDir . '/Application/Services/Dto/Commands/CreateCursoCommand.php';
require_once $rootDir . '/Application/Services/Dto/Commands/UpdateCursoCommand.php';
require_once $rootDir . '/Application/Services/Dto/Commands/DeleteCursoCommand.php';
require_once $rootDir . '/Application/Services/Dto/Queries/GetCursoByIdQuery.php';
require_once $rootDir . '/Application/Services/Dto/Queries/GetAllCursosQuery.php';

class CursoController
{
    private CreateCursoService $createCursoService;
    private UpdateCursoService $updateCursoService;
    private GetCursoByIdService $getCursoByIdService;
    private GetAllCursosService $getAllCursosService;
    private DeleteCursoService $deleteCursoService;

    public function __construct(
        CreateCursoService $createCursoService,
        UpdateCursoService $updateCursoService,
        GetCursoByIdService $getCursoByIdService,
        GetAllCursosService $getAllCursosService,
        DeleteCursoService $deleteCursoService
    ) {
        $this->createCursoService = $createCursoService;
        $this->updateCursoService = $updateCursoService;
        $this->getCursoByIdService = $getCursoByIdService;
        $this->getAllCursosService = $getAllCursosService;
        $this->deleteCursoService = $deleteCursoService;
    }

    public function handleRequest(): void
    {
        $message = '';
        $selectedCurso = null;
        $editingCurso = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = isset($_POST['action']) ? trim((string) $_POST['action']) : 'create';

            try {
                if ($action === 'update') {
                    $command = new UpdateCursoCommand(
                        (string) ($_POST['id'] ?? ''),
                        (string) ($_POST['nombre'] ?? ''),
                        (float) ($_POST['precio'] ?? 0),
                        (int) ($_POST['horas'] ?? 0),
                        (string) ($_POST['nivel'] ?? ''),
                        (string) ($_POST['profesor'] ?? ''),
                        (string) ($_POST['institucion'] ?? ''),
                        (string) ($_POST['fecha_inscripcion_inicio'] ?? ''),
                        (string) ($_POST['fecha_inscripcion_fin'] ?? ''),
                        (string) ($_POST['fecha_inicio'] ?? ''),
                        (string) ($_POST['fecha_cierre'] ?? ''),
                        (int) ($_POST['num_alumnos'] ?? 0),
                        (string) ($_POST['modalidad'] ?? ''),
                        (string) ($_POST['descripcion'] ?? '')
                    );

                    $this->updateCursoService->execute($command);
                    $message = '¡Curso actualizado exitosamente!';
                } elseif ($action === 'delete') {
                    $id = trim((string) ($_POST['id'] ?? ''));
                    $this->deleteCursoService->execute(new DeleteCursoCommand($id));
                    $message = '¡Curso eliminado exitosamente!';
                } else {
                    $command = new CreateCursoCommand(
                        (string) ($_POST['nombre'] ?? ''),
                        (float) ($_POST['precio'] ?? 0),
                        (int) ($_POST['horas'] ?? 0),
                        (string) ($_POST['nivel'] ?? ''),
                        (string) ($_POST['profesor'] ?? ''),
                        (string) ($_POST['institucion'] ?? ''),
                        (string) ($_POST['fecha_inscripcion_inicio'] ?? ''),
                        (string) ($_POST['fecha_inscripcion_fin'] ?? ''),
                        (string) ($_POST['fecha_inicio'] ?? ''),
                        (string) ($_POST['fecha_cierre'] ?? ''),
                        (int) ($_POST['num_alumnos'] ?? 0),
                        (string) ($_POST['modalidad'] ?? ''),
                        (string) ($_POST['descripcion'] ?? ''),
                        null
                    );

                    $this->createCursoService->execute($command);
                    $message = '¡Curso registrado exitosamente!';
                }
            } catch (Throwable $e) {
                $message = 'Error: ' . $e->getMessage();
            }
        }

        if (isset($_GET['show_id']) && trim((string) $_GET['show_id']) !== '') {
            try {
                $selectedCurso = $this->getCursoByIdService->execute(
                    new GetCursoByIdQuery(trim((string) $_GET['show_id']))
                );
            } catch (Throwable $e) {
                $message = 'Error al consultar el curso: ' . $e->getMessage();
            }
        }

        if (isset($_GET['edit_id']) && trim((string) $_GET['edit_id']) !== '') {
            try {
                $editingCurso = $this->getCursoByIdService->execute(
                    new GetCursoByIdQuery(trim((string) $_GET['edit_id']))
                );
            } catch (Throwable $e) {
                $message = 'Error al cargar curso para edición: ' . $e->getMessage();
            }
        }

        $cursos = $this->getAllCursosService->execute(new GetAllCursosQuery());

        require_once __DIR__ . '/../Presentation/cursos.php';
    }
}