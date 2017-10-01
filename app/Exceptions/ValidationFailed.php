<?php

namespace App\Exceptions;

use App\Http\Resources\Contracts\BaseApiResource;
use App\Http\Resources\Contracts\ResponseStatuses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\ValidationException;

class ValidationFailed extends ValidationException implements Renderable
{
    public function __construct($validator, $response = null, $errorBag = 'default')
    {
        parent::__construct($validator, $response = null, $errorBag = 'default');
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        return (new BaseApiResource(null))
            ->addMessage($this->getFirstErrorMessage($this->validator))
            ->setStatus(ResponseStatuses::ERROR);
    }

    private function getFirstErrorMessage($validator)
    {
        $message = $this->getFirstError($validator);

        return is_array($message) ? array_values($message)[0] : $message;
    }

    private function getFirstError($validator)
    {
        $messages = optional($validator->errors())->getMessages();

        return is_array($messages) ? array_shift($messages) : null;
    }
}