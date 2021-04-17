<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLocaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'instructions' => 'required',
            'about' => 'required',
            'address' => 'required',
            'name_user' => 'required',
            'phone_user' => 'required',
        ];
    }
}
