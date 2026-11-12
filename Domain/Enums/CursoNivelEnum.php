<?php

require_once __DIR__ . '/../Exceptions/InvalidCursoDataException.php';

class CursoNivelEnum
{
    const BASICO = 'BASICO';
    const INTERMEDIO = 'INTERMEDIO';
    const AVANZADO = 'AVANZADO';

    public static function values()
    {
        return array(
            self::BASICO,
            self::INTERMEDIO,
            self::AVANZADO
        );
    }

    public static function isValid($value)
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid($value)
    {
        if (!self::isValid($value)) {
            throw InvalidCursoDataException::becauseValueIsInvalid('nivel', $value);
        }
    }
}