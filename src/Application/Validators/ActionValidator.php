<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;
use App\Application\Exceptions\InvalidArgumentExceptionValidator;


class ActionValidator implements ValidatorInterface
{
    private array $allowedActions = ['plus', 'minus', 'multiply', 'division'];

    public function validate(array $data): bool
    {
        if (!isset($data['1'])) {
            return false;
        }

        $action = $data['1'];
        if(!in_array($action, $this->allowedActions))
        {
            throw new InvalidArgumentExceptionValidator('The Action is not Allowed.  Just <plus , minus, multiply, division>  are Allowed');
        }

        return true;
    }
}