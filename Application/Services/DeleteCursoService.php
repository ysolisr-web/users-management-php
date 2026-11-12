<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteCursoUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetCursoByIdPort.php';
require_once __DIR__ . '/../Ports/Out/DeleteCursoPort.php';
require_once __DIR__ . '/Mappers/CursoApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/CursoNotFoundException.php';

final class DeleteCursoService implements DeleteCursoUseCase
{
    private GetCursoByIdPort $getCursoByIdPort;
    private DeleteCursoPort $deleteCursoPort;

    public function __construct(
        GetCursoByIdPort $getCursoByIdPort,
        DeleteCursoPort $deleteCursoPort
    ) {
        $this->getCursoByIdPort = $getCursoByIdPort;
        $this->deleteCursoPort = $deleteCursoPort;
    }

    public function execute(DeleteCursoCommand $command): void
    {
        $cursoId = CursoApplicationMapper::fromDeleteCommandToCursoId($command);
        $existingCurso = $this->getCursoByIdPort->getById($cursoId);

        if ($existingCurso === null) {
            throw CursoNotFoundException::becauseIdWasNotFound($cursoId->value());
        }

        $this->deleteCursoPort->delete($cursoId);
    }
}