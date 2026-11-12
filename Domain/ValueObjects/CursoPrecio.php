<?php

require_once __DIR__ . '/../Exceptions/InvalidCursoDataException.php';

class CursoPrecio
{
    private $value;

    public function __construct($value)
    {
        if (!is_numeric($value) || (float) $value < 0) {
            throw InvalidCursoDataException::becauseNumberIsNegative('precio');
        }
        $this->value = (float) $value;
    }

    public function value()
    {
        return $this->value;
    }
}