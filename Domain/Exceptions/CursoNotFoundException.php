<?php

class CursoNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id)
    {
        return new self('El curso con id ' . $id . ' no fue encontrado.');
    }
}