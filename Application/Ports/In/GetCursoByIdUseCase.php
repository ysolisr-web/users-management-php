<?php

require_once __DIR__ . '/../../Queries/GetCursoByIdQuery.php';

interface GetCursoByIdUseCase
{
    public function execute(GetCursoByIdQuery $query);
}