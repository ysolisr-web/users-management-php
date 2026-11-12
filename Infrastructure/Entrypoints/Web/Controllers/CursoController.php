<?php

declare(strict_types=1);

class CursoController
{
    private CreateCursoService $createCursoService;
    private GetAllCursosService $getAllCursosService;

    public function __construct(
        CreateCursoService $createCursoService,
        GetAllCursosService $getAllCursosService
    ) {
        $this->createCursoService = $createCursoService;
        $this->getAllCursosService = $getAllCursosService;
    }

    public function handleRequest(): void
    {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->createCursoService->execute($_POST);
                $message = '¡Curso registrado exitosamente!';
            } catch (Exception $e) {
                $message = 'Error al registrar el curso: ' . $e->getMessage();
            }
        }

        $cursos = $this->getAllCursosService->execute();

        require_once __DIR__ . '/../Presentation/cursos.php';
    }
}