<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateCursoCommand.php';
require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';

interface UpdateCursoUseCase
{
    public function execute(UpdateCursoCommand $command): CursoModel;
}