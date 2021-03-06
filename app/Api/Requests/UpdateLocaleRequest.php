<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:5,100',
        ];
    }
}
