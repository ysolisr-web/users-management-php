<?php

require_once __DIR__ . '/../../Queries/GetAllCursosQuery.php';

interface GetAllCursosUseCase
{
    public function execute(GetAllCursosQuery $query);
}