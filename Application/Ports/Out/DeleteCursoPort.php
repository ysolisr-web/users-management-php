<?php

require_once __DIR__ . '/../../../Domain/ValueObjects/CursoId.php';

interface DeleteCursoPort
{
    public function delete(CursoId $id);
}