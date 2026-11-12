<?php

declare(strict_types=1);

final class CursoModel
{
    private ?int $id;
    private string $nombre;
    private string $descripcion;
    private ?string $createdAt;

    public function __construct(
        ?int $id,
        string $nombre,
        string $descripcion,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->createdAt = $createdAt;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }
}