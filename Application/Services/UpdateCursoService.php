<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateCursoUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetCursoByIdPort.php';
require_once __DIR__ . '/../Ports/Out/UpdateCursoPort.php';
require_once __DIR__ . '/Mappers/CursoApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/CursoNotFoundException.php';

final class UpdateCursoService implements UpdateCursoUseCase
{
    private GetCursoByIdPort $getCursoByIdPort;
    private UpdateCursoPort $updateCursoPort;

    public function __construct(
        GetCursoByIdPort $getCursoByIdPort,
        UpdateCursoPort $updateCursoPort
    ) {
        $this->getCursoByIdPort = $getCursoByIdPort;
        $this->updateCursoPort = $updateCursoPort;
    }

    public function execute(UpdateCursoCommand $command): CursoModel
    {
        $curso = CursoApplicationMapper::fromUpdateCommandToModel($command);
        $existingCurso = $this->getCursoByIdPort->getById($curso->id());

        if ($existingCurso === null) {
            throw CursoNotFoundException::becauseIdWasNotFound($curso->id()->value());
        }

        return $this->updateCursoPort->update($curso);
    }
}