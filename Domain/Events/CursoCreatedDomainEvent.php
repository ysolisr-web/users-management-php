<?php

require_once __DIR__ . '/DomainEvent.php';
require_once __DIR__ . '/../Models/CursoModel.php';

class CursoCreatedDomainEvent extends DomainEvent
{
    private $curso;

    public function __construct(CursoModel $curso)
    {
        parent::__construct('curso.created');
        $this->curso = $curso;
    }

    public function curso()
    {
        return $this->curso;
    }

    public function payload()
    {
        return $this->curso->toArray();
    }
}