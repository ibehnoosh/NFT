<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;

class ActionValidator implements ValidatorInterface
{
    private array $allowedActions = ['plus', 'minus', 'multiply', 'division'];

    public function validate(array $action): bool
    {
        if (!isset($data['action'])) {
            return false;
        }

        $action = $data['action'];
        return in_array($action, $this->allowedActions);
    }
}