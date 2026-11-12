<?php

require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';

interface UpdateCursoPort
{
    public function update(CursoModel $curso);
}