<?php

declare(strict_types=1);

interface CursoRepositoryInterface
{
    public function save(CursoModel $curso): void;

    /**
     * @return CursoModel[]
     */
    public function all(): array;
}