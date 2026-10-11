<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProdutoUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            "nome"  =>        "nullable | string",
            "preco" =>       ["nullable", "numeric", "min:1.99"],
            "qtd_estoque" => "nullable | integer | min:2",
            "descricao" =>  ["nullable", 'string', "max:500"],
            "importado" =>   "nullable | boolean"
        ];
    }
}
