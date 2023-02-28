<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileValidation extends FormRequest
{

    protected $errorBag = 'saveUser';
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'email' => ['required', Rule::unique('users')->ignore($this->user)],
            'cedula' => 'required|numeric',
            'telefono' => 'nullable',
            'fecha_nac' => 'nullable|date',
        ];
    }
}
