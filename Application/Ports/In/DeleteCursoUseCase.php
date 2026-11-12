<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteCursoCommand.php';

interface DeleteCursoUseCase
{
    public function execute(DeleteCursoCommand $command): void;
}