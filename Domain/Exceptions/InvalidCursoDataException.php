<?php

class InvalidCursoDataException extends InvalidArgumentException
{
    public static function becauseFieldIsEmpty($field)
    {
        return new self('El campo ' . $field . ' del curso no puede estar vacío.');
    }

    public static function becauseNumberIsNegative($field)
    {
        return new self('El campo ' . $field . ' no puede ser negativo.');
    }

    public static function becauseValueIsInvalid($field, $value)
    {
        return new self('El valor "' . $value . '" no es válido para ' . $field . '.');
    }

    public static function becauseDateRangeIsInvalid($message)
    {
        return new self($message);
    }
}