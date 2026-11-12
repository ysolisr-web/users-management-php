<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateCursoUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveCursoPort.php';
require_once __DIR__ . '/Mappers/CursoApplicationMapper.php';

final class CreateCursoService implements CreateCursoUseCase
{
    private SaveCursoPort $saveCursoPort;

    public function __construct(SaveCursoPort $saveCursoPort)
    {
        $this->saveCursoPort = $saveCursoPort;
    }

    public function execute(CreateCursoCommand $command): CursoModel
    {
        $curso = CursoApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveCursoPort->save($curso);
    }
}