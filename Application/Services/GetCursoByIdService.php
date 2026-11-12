<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetCursoByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetCursoByIdPort.php';
require_once __DIR__ . '/Mappers/CursoApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/CursoNotFoundException.php';

final class GetCursoByIdService implements GetCursoByIdUseCase
{
    private GetCursoByIdPort $getCursoByIdPort;

    public function __construct(GetCursoByIdPort $getCursoByIdPort)
    {
        $this->getCursoByIdPort = $getCursoByIdPort;
    }

    public function execute(GetCursoByIdQuery $query): CursoModel
    {
        $cursoId = CursoApplicationMapper::fromGetCursoByIdQueryToCursoId($query);
        $curso = $this->getCursoByIdPort->getById($cursoId);

        if ($curso === null) {
            throw CursoNotFoundException::becauseIdWasNotFound($cursoId->value());
        }

        return $curso;
    }
}