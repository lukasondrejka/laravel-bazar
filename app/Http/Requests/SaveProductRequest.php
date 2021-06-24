<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
        ];

    }

    public function attributes()
    {
    return [
        'title' => 'Nazov inzerátu',
        'category_id' => 'Kategória',
        'description' => 'Popis',
        'price' => 'Cena',
        'type' => 'Typ',
    ];
}

    public function messages()
{
    return [
        'required'  => 'Pole :attribute nesmie byť prázdne',

        //'required'  => ':attribute je požadovaný',
        //'category_id.required'  => ':attribute je požadovaná',
        //'price.required'  => ':attribute je požadovaná',

    ];
}
}
