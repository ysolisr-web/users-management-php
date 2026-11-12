<?php

require_once __DIR__ . '/../Exceptions/InvalidCursoDataException.php';

class CursoModalidadEnum
{
    const PRESENCIAL = 'PRESENCIAL';
    const VIRTUAL = 'VIRTUAL';
    const HIBRIDA = 'HIBRIDA';

    public static function values()
    {
        return array(
            self::PRESENCIAL,
            self::VIRTUAL,
            self::HIBRIDA
        );
    }

    public static function isValid($value)
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid($value)
    {
        if (!self::isValid($value)) {
            throw InvalidCursoDataException::becauseValueIsInvalid('modalidad', $value);
        }
    }
}