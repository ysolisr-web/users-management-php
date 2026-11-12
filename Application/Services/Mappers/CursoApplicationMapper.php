<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateCursoCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateCursoCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteCursoCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetCursoByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/CursoModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/CursoId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/CursoPrecio.php';

final class CursoApplicationMapper
{
    public static function fromCreateCommandToModel(CreateCursoCommand $command): CursoModel
    {
        $id = $command->getId() !== null && $command->getId() !== ''
            ? new CursoId($command->getId())
            : null;

        return new CursoModel(
            $id,
            $command->getNombre(),
            new CursoPrecio($command->getPrecio()),
            $command->getHoras(),
            $command->getNivel(),
            $command->getProfesor(),
            $command->getInstitucion(),
            $command->getFechaInscripcionInicio(),
            $command->getFechaInscripcionFin(),
            $command->getFechaInicio(),
            $command->getFechaCierre(),
            $command->getNumAlumnos(),
            $command->getModalidad(),
            $command->getDescripcion()
        );
    }

    public static function fromUpdateCommandToModel(UpdateCursoCommand $command): CursoModel
    {
        return new CursoModel(
            new CursoId($command->getId()),
            $command->getNombre(),
            new CursoPrecio($command->getPrecio()),
            $command->getHoras(),
            $command->getNivel(),
            $command->getProfesor(),
            $command->getInstitucion(),
            $command->getFechaInscripcionInicio(),
            $command->getFechaInscripcionFin(),
            $command->getFechaInicio(),
            $command->getFechaCierre(),
            $command->getNumAlumnos(),
            $command->getModalidad(),
            $command->getDescripcion()
        );
    }

    public static function fromGetCursoByIdQueryToCursoId(GetCursoByIdQuery $query): CursoId
    {
        return new CursoId($query->getId());
    }

    public static function fromDeleteCommandToCursoId(DeleteCursoCommand $command): CursoId
    {
        return new CursoId($command->getId());
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromModelToArray(CursoModel $curso): array
    {
        return $curso->toArray();
    }

    /**
     * @param CursoModel[] $cursos
     * @return array<int, array<string, mixed>>
     */
    public static function fromModelsToArray(array $cursos): array
    {
        $result = array();

        foreach ($cursos as $curso) {
            $result[] = self::fromModelToArray($curso);
        }

        return $result;
    }
}