<?php

declare(strict_types=1);

class CreateCursoService
{
    private $cursoRepository;

    public function __construct($cursoRepository)
    {
        $this->cursoRepository = $cursoRepository;
    }

    public function execute(array $data): void
    {
        if (empty($data['nombre'])) {
            throw new Exception('El nombre del curso es obligatorio.');
        }

        if (empty($data['descripcion'])) {
            throw new Exception('La descripción del curso es obligatoria.');
        }

        $curso = new CursoModel(
            null,
            $data['nombre'],
            $data['descripcion']
        );

        $this->cursoRepository->save($curso);
    }
}