<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CursoPersistenceDto.php';
require_once __DIR__ . '/../Entity/CursoEntity.php';

require_once __DIR__ . '/../../../../Domain/Models/CursoModel.php';
require_once __DIR__ . '/../../../../Domain/ValueObjects/CursoId.php';
require_once __DIR__ . '/../../../../Domain/ValueObjects/CursoPrecio.php';

final class CursoPersistenceMapper
{
    public function fromModelToDto(CursoModel $curso): CursoPersistenceDto
    {
        return new CursoPersistenceDto(
            $curso->id() !== null ? $curso->id()->value() : null,
            $curso->nombre(),
            $curso->precio()->value(),
            $curso->horas(),
            $curso->nivel(),
            $curso->profesor(),
            $curso->institucion(),
            $curso->fechaInscripcionInicio(),
            $curso->fechaInscripcionFin(),
            $curso->fechaInicio(),
            $curso->fechaCierre(),
            $curso->numAlumnos(),
            $curso->modalidad(),
            $curso->descripcion()
        );
    }

    public function fromRowToEntity(array $row): CursoEntity
    {
        return new CursoEntity(
            (string) $row['id'],
            (string) $row['nombre'],
            (float) $row['precio'],
            (int) $row['horas'],
            (string) $row['nivel'],
            (string) $row['profesor'],
            (string) $row['institucion'],
            (string) $row['fecha_inscripcion_inicio'],
            (string) $row['fecha_inscripcion_fin'],
            (string) $row['fecha_inicio'],
            (string) $row['fecha_cierre'],
            (int) $row['num_alumnos'],
            (string) $row['modalidad'],
            (string) $row['descripcion'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(CursoEntity $entity): CursoModel
    {
        return new CursoModel(
            new CursoId($entity->id()),
            $entity->nombre(),
            new CursoPrecio($entity->precio()),
            $entity->horas(),
            $entity->nivel(),
            $entity->profesor(),
            $entity->institucion(),
            $entity->fechaInscripcionInicio(),
            $entity->fechaInscripcionFin(),
            $entity->fechaInicio(),
            $entity->fechaCierre(),
            $entity->numAlumnos(),
            $entity->modalidad(),
            $entity->descripcion(),
            $entity->createdAt()
        );
    }

    public function fromRowToModel(array $row): CursoModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return CursoModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}