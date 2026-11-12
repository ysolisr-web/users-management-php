<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllCursosUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllCursosPort.php';

final class GetAllCursosService implements GetAllCursosUseCase
{
    private GetAllCursosPort $getAllCursosPort;

    public function __construct(GetAllCursosPort $getAllCursosPort)
    {
        $this->getAllCursosPort = $getAllCursosPort;
    }

    /**
     * @return CursoModel[]
     */
    public function execute(GetAllCursosQuery $query): array
    {
        return $this->getAllCursosPort->getAll();
    }
}