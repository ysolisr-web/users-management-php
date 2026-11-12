<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetCursoByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';

interface GetCursoByIdUseCase
{
    public function execute(GetCursoByIdQuery $query): CursoModel;
}