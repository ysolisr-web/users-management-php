<?php

declare(strict_types=1);

final class CursoEntity
{
    private string $id;
    private string $nombre;
    private float $precio;
    private int $horas;
    private string $nivel;
    private string $profesor;
    private string $institucion;
    private string $fechaInscripcionInicio;
    private string $fechaInscripcionFin;
    private string $fechaInicio;
    private string $fechaCierre;
    private int $numAlumnos;
    private string $modalidad;
    private string $descripcion;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        string $id,
        string $nombre,
        float $precio,
        int $horas,
        string $nivel,
        string $profesor,
        string $institucion,
        string $fechaInscripcionInicio,
        string $fechaInscripcionFin,
        string $fechaInicio,
        string $fechaCierre,
        int $numAlumnos,
        string $modalidad,
        string $descripcion,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->horas = $horas;
        $this->nivel = $nivel;
        $this->profesor = $profesor;
        $this->institucion = $institucion;
        $this->fechaInscripcionInicio = $fechaInscripcionInicio;
        $this->fechaInscripcionFin = $fechaInscripcionFin;
        $this->fechaInicio = $fechaInicio;
        $this->fechaCierre = $fechaCierre;
        $this->numAlumnos = $numAlumnos;
        $this->modalidad = $modalidad;
        $this->descripcion = $descripcion;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function precio(): float
    {
        return $this->precio;
    }

    public function horas(): int
    {
        return $this->horas;
    }

    public function nivel(): string
    {
        return $this->nivel;
    }

    public function profesor(): string
    {
        return $this->profesor;
    }

    public function institucion(): string
    {
        return $this->institucion;
    }

    public function fechaInscripcionInicio(): string
    {
        return $this->fechaInscripcionInicio;
    }

    public function fechaInscripcionFin(): string
    {
        return $this->fechaInscripcionFin;
    }

    public function fechaInicio(): string
    {
        return $this->fechaInicio;
    }

    public function fechaCierre(): string
    {
        return $this->fechaCierre;
    }

    public function numAlumnos(): int
    {
        return $this->numAlumnos;
    }

    public function modalidad(): string
    {
        return $this->modalidad;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }
}