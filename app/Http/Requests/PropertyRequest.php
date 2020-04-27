<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'name_en' => 'required|string|max:255|unique:properties,name_en' . ($this->property ? ",{$this->property->id}" : ''),
            'name_ru' => 'required|string|max:255|unique:properties,name_ru' . ($this->property ? ",{$this->property->id}" : ''),
            'address' => 'required|string',
            'description_en' => 'required|string|min:20|max:250',
            'description_ru' => 'required|string|min:20|max:250',
            'price' => 'required|numeric',
        ];
    }
}
