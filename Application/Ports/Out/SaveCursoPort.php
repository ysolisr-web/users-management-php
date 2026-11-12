<?php

require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';

interface SaveCursoPort
{
    public function save(CursoModel $curso);
}