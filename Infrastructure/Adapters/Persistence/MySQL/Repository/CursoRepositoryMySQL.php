<?php

declare(strict_types=1);

$rootDir = dirname(__DIR__, 5);
require_once $rootDir . '/Application/Ports/Out/SaveCursoPort.php';
require_once $rootDir . '/Application/Ports/Out/UpdateCursoPort.php';
require_once $rootDir . '/Application/Ports/Out/GetCursoByIdPort.php';
require_once $rootDir . '/Application/Ports/Out/GetAllCursosPort.php';
require_once $rootDir . '/Application/Ports/Out/DeleteCursoPort.php';

require_once __DIR__ . '/../Mapper/CursoPersistenceMapper.php';
require_once $rootDir . '/Domain/Models/CursoModel.php';
require_once $rootDir . '/Domain/ValueObjects/CursoId.php';

final class CursoRepositoryMySQL implements
    SaveCursoPort,
    UpdateCursoPort,
    GetCursoByIdPort,
    GetAllCursosPort,
    DeleteCursoPort
{
    private PDO $pdo;
    private CursoPersistenceMapper $mapper;

    public function __construct(PDO $pdo, CursoPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(CursoModel $curso): CursoModel
    {
        $dto = $this->mapper->fromModelToDto($curso);

        if ($dto->id() !== null && $dto->id() !== '') {
            $sql = '
                INSERT INTO cursos (
                    id,
                    nombre,
                    precio,
                    horas,
                    nivel,
                    profesor,
                    institucion,
                    fecha_inscripcion_inicio,
                    fecha_inscripcion_fin,
                    fecha_inicio,
                    fecha_cierre,
                    num_alumnos,
                    modalidad,
                    descripcion,
                    created_at,
                    updated_at
                ) VALUES (
                    :id,
                    :nombre,
                    :precio,
                    :horas,
                    :nivel,
                    :profesor,
                    :institucion,
                    :fecha_inscripcion_inicio,
                    :fecha_inscripcion_fin,
                    :fecha_inicio,
                    :fecha_cierre,
                    :num_alumnos,
                    :modalidad,
                    :descripcion,
                    NOW(),
                    NOW()
                )
            ';

            $statement = $this->pdo->prepare($sql);
            $statement->execute(array(
                ':id' => $dto->id(),
                ':nombre' => $dto->nombre(),
                ':precio' => $dto->precio(),
                ':horas' => $dto->horas(),
                ':nivel' => $dto->nivel(),
                ':profesor' => $dto->profesor(),
                ':institucion' => $dto->institucion(),
                ':fecha_inscripcion_inicio' => $dto->fechaInscripcionInicio(),
                ':fecha_inscripcion_fin' => $dto->fechaInscripcionFin(),
                ':fecha_inicio' => $dto->fechaInicio(),
                ':fecha_cierre' => $dto->fechaCierre(),
                ':num_alumnos' => $dto->numAlumnos(),
                ':modalidad' => $dto->modalidad(),
                ':descripcion' => $dto->descripcion(),
            ));

            $savedId = $dto->id();
        } else {
            $sql = '
                INSERT INTO cursos (
                    nombre,
                    precio,
                    horas,
                    nivel,
                    profesor,
                    institucion,
                    fecha_inscripcion_inicio,
                    fecha_inscripcion_fin,
                    fecha_inicio,
                    fecha_cierre,
                    num_alumnos,
                    modalidad,
                    descripcion,
                    created_at,
                    updated_at
                ) VALUES (
                    :nombre,
                    :precio,
                    :horas,
                    :nivel,
                    :profesor,
                    :institucion,
                    :fecha_inscripcion_inicio,
                    :fecha_inscripcion_fin,
                    :fecha_inicio,
                    :fecha_cierre,
                    :num_alumnos,
                    :modalidad,
                    :descripcion,
                    NOW(),
                    NOW()
                )
            ';

            $statement = $this->pdo->prepare($sql);
            $statement->execute(array(
                ':nombre' => $dto->nombre(),
                ':precio' => $dto->precio(),
                ':horas' => $dto->horas(),
                ':nivel' => $dto->nivel(),
                ':profesor' => $dto->profesor(),
                ':institucion' => $dto->institucion(),
                ':fecha_inscripcion_inicio' => $dto->fechaInscripcionInicio(),
                ':fecha_inscripcion_fin' => $dto->fechaInscripcionFin(),
                ':fecha_inicio' => $dto->fechaInicio(),
                ':fecha_cierre' => $dto->fechaCierre(),
                ':num_alumnos' => $dto->numAlumnos(),
                ':modalidad' => $dto->modalidad(),
                ':descripcion' => $dto->descripcion(),
            ));

            $savedId = (string) $this->pdo->lastInsertId();
        }

        $savedCurso = $this->findById(new CursoId($savedId));

        if ($savedCurso === null) {
            throw new RuntimeException('The curso could not be recovered after save.');
        }

        return $savedCurso;
    }

    public function update(CursoModel $curso): CursoModel
    {
        $dto = $this->mapper->fromModelToDto($curso);

        $sql = '
            UPDATE cursos
               SET nombre = :nombre,
                   precio = :precio,
                   horas = :horas,
                   nivel = :nivel,
                   profesor = :profesor,
                   institucion = :institucion,
                   fecha_inscripcion_inicio = :fecha_inscripcion_inicio,
                   fecha_inscripcion_fin = :fecha_inscripcion_fin,
                   fecha_inicio = :fecha_inicio,
                   fecha_cierre = :fecha_cierre,
                   num_alumnos = :num_alumnos,
                   modalidad = :modalidad,
                   descripcion = :descripcion,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':precio' => $dto->precio(),
            ':horas' => $dto->horas(),
            ':nivel' => $dto->nivel(),
            ':profesor' => $dto->profesor(),
            ':institucion' => $dto->institucion(),
            ':fecha_inscripcion_inicio' => $dto->fechaInscripcionInicio(),
            ':fecha_inscripcion_fin' => $dto->fechaInscripcionFin(),
            ':fecha_inicio' => $dto->fechaInicio(),
            ':fecha_cierre' => $dto->fechaCierre(),
            ':num_alumnos' => $dto->numAlumnos(),
            ':modalidad' => $dto->modalidad(),
            ':descripcion' => $dto->descripcion(),
        ));

        $updatedCurso = $this->findById(new CursoId((string) $dto->id()));

        if ($updatedCurso === null) {
            throw new RuntimeException('The curso could not be recovered after update.');
        }

        return $updatedCurso;
    }

    public function findById(CursoId $cursoId): ?CursoModel
    {
        $sql = '
            SELECT
                id,
                nombre,
                precio,
                horas,
                nivel,
                profesor,
                institucion,
                fecha_inscripcion_inicio,
                fecha_inscripcion_fin,
                fecha_inicio,
                fecha_cierre,
                num_alumnos,
                modalidad,
                descripcion,
                created_at,
                updated_at
            FROM cursos
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $cursoId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getById(CursoId $cursoId): ?CursoModel
    {
        return $this->findById($cursoId);
    }

    /**
     * @return CursoModel[]
     */
    public function findAll(): array
    {
        $sql = '
            SELECT
                id,
                nombre,
                precio,
                horas,
                nivel,
                profesor,
                institucion,
                fecha_inscripcion_inicio,
                fecha_inscripcion_fin,
                fecha_inicio,
                fecha_cierre,
                num_alumnos,
                modalidad,
                descripcion,
                created_at,
                updated_at
            FROM cursos
            ORDER BY id DESC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    /**
     * @return CursoModel[]
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    public function delete(CursoId $cursoId): void
    {
        $sql = 'DELETE FROM cursos WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $cursoId->value(),
        ));
    }
}