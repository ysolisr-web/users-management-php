<?php

declare(strict_types=1);

final class CursoRepositoryMySQL implements CursoRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(CursoModel $curso): void
    {
        $sql = 'INSERT INTO cursos (nombre, descripcion) VALUES (:nombre, :descripcion)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            ':nombre' => $curso->nombre(),
            ':descripcion' => $curso->descripcion(),
        ));
    }

    /**
     * @return CursoModel[]
     */
    public function all(): array
    {
        $sql = 'SELECT id, nombre, descripcion, created_at FROM cursos ORDER BY id DESC';
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cursos = array();
        foreach ($rows as $row) {
            $cursos[] = new CursoModel(
                (int) $row['id'],
                (string) $row['nombre'],
                (string) $row['descripcion'],
                isset($row['created_at']) ? (string) $row['created_at'] : null
            );
        }

        return $cursos;
    }
}