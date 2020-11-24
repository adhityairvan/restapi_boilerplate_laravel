<?php

namespace App\Services;

use Sametsahindogan\ResponseObjectCreator\ErrorResult as BaseErrorResult;

/**
 * We extend default class to change the response template
 */
class ErrorResult extends BaseErrorResult{
    /** @var bool $success */
    public $status = 'ERROR';

    /**
     * ErrorResult constructor.
     * @param ErrorBuilder $error_builder
     * @param int $status_code
     */
    public function __construct(ErrorBuilder $error_builder, int $status_code = 400)
    {
        
        unset($this->data);
        unset($this->success);
        $this->message = $error_builder->buildAsArray()['message'];
        $this->status_code = $status_code;
    }
}