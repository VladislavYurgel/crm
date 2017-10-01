<?php

namespace App\Http\Requests\Contracts;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * User is auth for this request
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }
}