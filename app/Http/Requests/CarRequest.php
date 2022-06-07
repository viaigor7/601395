<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name' => 'string',
            'model' => 'string',
            'year' => 'integer',
            'category_id' => 'integer',
            'drivers' => 'array'
        ];
    }

    public function messages()
    {
        return [
            'string' => 'Fill in the field :attribute',
            'integer' => 'Select a :attribute'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name Car',
            'model' => 'Model Car',
            'category_id' => 'Year Category',
        ];
    }
}
