<?php

namespace App\Http\Requests\Contracts;

use App\Exceptions\ValidationFailed;
use Illuminate\Contracts\Validation\Validator;

abstract class BaseApiRequest extends BaseRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationFailed($validator))
            ->errorBag($this->errorBag);
    }
}