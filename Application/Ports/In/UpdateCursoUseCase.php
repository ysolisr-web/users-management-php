<?php

require_once __DIR__ . '/../../Commands/UpdateCursoCommand.php';

interface UpdateCursoUseCase
{
    public function execute(UpdateCursoCommand $command);
}