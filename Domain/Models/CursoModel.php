<?php

require_once __DIR__ . '/../ValueObjects/CursoId.php';
require_once __DIR__ . '/../ValueObjects/CursoPrecio.php';
require_once __DIR__ . '/../Enums/CursoModalidadEnum.php';
require_once __DIR__ . '/../Enums/CursoNivelEnum.php';
require_once __DIR__ . '/../Exceptions/InvalidCursoDataException.php';

class CursoModel
{
    private $id;
    private $nombre;
    private $precio;
    private $horas;
    private $nivel;
    private $profesor;
    private $institucion;
    private $fechaInscripcionInicio;
    private $fechaInscripcionFin;
    private $fechaInicio;
    private $fechaCierre;
    private $numAlumnos;
    private $modalidad;
    private $descripcion;
    private $createdAt;

    public function __construct(
        ?CursoId $id,
        string $nombre,
        CursoPrecio $precio,
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
        ?string $createdAt = null
    ) {
        $nombre = trim($nombre);
        $profesor = trim($profesor);
        $institucion = trim($institucion);
        $descripcion = trim($descripcion);

        if ($nombre === '') {
            throw InvalidCursoDataException::becauseFieldIsEmpty('nombre');
        }
        if ($horas <= 0) {
            throw InvalidCursoDataException::becauseValueIsInvalid('horas', (string) $horas);
        }
        if ($profesor === '') {
            throw InvalidCursoDataException::becauseFieldIsEmpty('profesor');
        }
        if ($institucion === '') {
            throw InvalidCursoDataException::becauseFieldIsEmpty('institucion');
        }
        if ($numAlumnos < 0) {
            throw InvalidCursoDataException::becauseNumberIsNegative('numAlumnos');
        }
        if ($descripcion === '') {
            throw InvalidCursoDataException::becauseFieldIsEmpty('descripcion');
        }

        CursoNivelEnum::ensureIsValid($nivel);
        CursoModalidadEnum::ensureIsValid($modalidad);

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
    }

    public function id(): ?CursoId
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function precio(): CursoPrecio
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

    public function toArray(): array
    {
        return array(
            'id' => $this->id ? $this->id->value() : null,
            'nombre' => $this->nombre,
            'precio' => $this->precio->value(),
            'horas' => $this->horas,
            'nivel' => $this->nivel,
            'profesor' => $this->profesor,
            'institucion' => $this->institucion,
            'fechaInscripcionInicio' => $this->fechaInscripcionInicio,
            'fechaInscripcionFin' => $this->fechaInscripcionFin,
            'fechaInicio' => $this->fechaInicio,
            'fechaCierre' => $this->fechaCierre,
            'numAlumnos' => $this->numAlumnos,
            'modalidad' => $this->modalidad,
            'descripcion' => $this->descripcion,
            'created_at' => $this->createdAt
        );
    }
}