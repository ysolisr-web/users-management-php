<?php

require_once __DIR__ . '/../../Commands/CreateCursoCommand.php';

interface CreateCursoUseCase
{
    public function execute(CreateCursoCommand $command);
}