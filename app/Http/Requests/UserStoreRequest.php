<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
      public function rules()
    {
        return [
            'name'      => ' required | string | max:50 | min:3',
            // 'surname'   => ' required | string | max:50 | min:3',
            'email'     => ' required | email | unique:users',
            'password'  => ' required | string | min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.require'      => 'O nome é obrigatório!!',
            'name.max'          => 'O nome deve ter no máximo 50 caracteres!',
            // 'surname.require'   => 'O sobrenome é obrigatório!!',
            'email.require'     => 'O email é obrigatório!!',
            'email.email'       => 'Informe um email válido!',
            'email.unique'      => 'Email indiponível, cadastre outro email.',
            'password.min'      => 'A senha deve ter no mínimo oito caracteres!',
            'password.require'  => 'A senha é obrigatória!!',
        ];
    }
}
