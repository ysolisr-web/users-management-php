<?php

declare(strict_types=1);

class GetAllCursosService
{
    private $cursoRepository;

    public function __construct($cursoRepository)
    {
        $this->cursoRepository = $cursoRepository;
    }

    public function execute(): array
    {
        return $this->cursoRepository->all();
    }
}