<?php

namespace App\Application\Exceptions;

use Exception;

class InvalidArgumentExceptionValidator extends Exception

{

    public function __construct(string $message)
    {
        parent::__construct($message);
    }


    public function __toString(): string
    {
        return "Error on line " . $this->getLine() . ": " . $this->getMessage();
    }
}