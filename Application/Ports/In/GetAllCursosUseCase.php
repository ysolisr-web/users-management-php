<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllCursosQuery.php';
require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';

interface GetAllCursosUseCase
{
    /**
     * @return CursoModel[]
     */
    public function execute(GetAllCursosQuery $query): array;
}