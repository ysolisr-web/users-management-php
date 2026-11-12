<?php

declare(strict_types=1);

final class UpdateCursoCommand
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
        string $descripcion
    ) {
        $this->id = trim($id);
        $this->nombre = trim($nombre);
        $this->precio = $precio;
        $this->horas = $horas;
        $this->nivel = trim($nivel);
        $this->profesor = trim($profesor);
        $this->institucion = trim($institucion);
        $this->fechaInscripcionInicio = trim($fechaInscripcionInicio);
        $this->fechaInscripcionFin = trim($fechaInscripcionFin);
        $this->fechaInicio = trim($fechaInicio);
        $this->fechaCierre = trim($fechaCierre);
        $this->numAlumnos = $numAlumnos;
        $this->modalidad = trim($modalidad);
        $this->descripcion = trim($descripcion);
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

    public function getFechaInscripcionInicio(): string
    {
        return $this->fechaInscripcionInicio;
    }

    public function getFechaInscripcionFin(): string
    {
        return $this->fechaInscripcionFin;
    }

    public function getFechaInicio(): string
    {
        return $this->fechaInicio;
    }

    public function getFechaCierre(): string
    {
        return $this->fechaCierre;
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
}