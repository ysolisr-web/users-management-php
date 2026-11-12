<?php

declare(strict_types=1);

final class CreateCursoCommand
{
    private string $id;
    private string $nombre;
    private float $precio;
    private int $horas;
    private string $nivel;
    private string $profesor;
    private string $institucion;
    private string $fechaInicio;
    private string $fechaFin;
    private int $numAlumnos;
    private string $modalidad;
    private string $descripcion;
    private string $estado;

    public function __construct(
        string $id,
        string $nombre,
        float $precio,
        int $horas,
        string $nivel,
        string $profesor,
        string $institucion,
        string $fechaInicio,
        string $fechaFin,
        int $numAlumnos,
        string $modalidad,
        string $descripcion,
        string $estado = 'ACTIVO'
    ) {
        $this->id = trim($id);
        $this->nombre = trim($nombre);
        $this->precio = $precio;
        $this->horas = $horas;
        $this->nivel = trim($nivel);
        $this->profesor = trim($profesor);
        $this->institucion = trim($institucion);
        $this->fechaInicio = trim($fechaInicio);
        $this->fechaFin = trim($fechaFin);
        $this->numAlumnos = $numAlumnos;
        $this->modalidad = trim($modalidad);
        $this->descripcion = trim($descripcion);
        $this->estado = trim($estado);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getHoras(): int
    {
        return $this->horas;
    }

    public function getNivel(): string
    {
        return $this->nivel;
    }

    public function getProfesor(): string
    {
        return $this->profesor;
    }

    public function getInstitucion(): string
    {
        return $this->institucion;
    }

    public function getFechaInicio(): string
    {
        return $this->fechaInicio;
    }

    public function getFechaFin(): string
    {
        return $this->fechaFin;
    }

    public function getNumAlumnos(): int
    {
        return $this->numAlumnos;
    }

    public function getModalidad(): string
    {
        return $this->modalidad;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
}