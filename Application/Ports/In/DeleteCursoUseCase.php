<?php

require_once __DIR__ . '/../../Commands/DeleteCursoCommand.php';

interface DeleteCursoUseCase
{
    public function execute(DeleteCursoCommand $command);
}