<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateCursoCommand.php';
require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';

interface CreateCursoUseCase
{
    public function execute(CreateCursoCommand $command): CursoModel;
}