<?php

require_once __DIR__ . '/../Exceptions/InvalidCursoDataException.php';

class CursoId
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);
        if ($normalizedValue === '') {
            throw InvalidCursoDataException::becauseFieldIsEmpty('id');
        }
        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}