<?php

namespace App\Services;

use Sametsahindogan\ResponseObjectCreator\ErrorService\ErrorBuilder as BaseErrorBuilder;

class ErrorBuilder extends BaseErrorBuilder{
    /**
     * we extend ErrorBuilder class to custom our own response template if there's any error
     * @return array
     */
    public function buildAsArray(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}