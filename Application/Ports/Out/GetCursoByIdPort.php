<?php

require_once __DIR__ . '/../../../Domain/ValueObjects/CursoId.php';

interface GetCursoByIdPort
{
    public function findById(CursoId $id);
}