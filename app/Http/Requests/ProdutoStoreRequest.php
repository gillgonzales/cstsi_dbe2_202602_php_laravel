<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ProdutoStoreRequest extends FormRequest
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
                'nome' => "required | min:5",
                'descricao' => "required | max:500",
                'qtd_estoque' => "required | integer | min:1",
                'preco' => "required | numeric | min:1.99",
                'importado' => "nullable | boolean"
        ];
    }

    #[Override]
    public function prepareForValidation()
    {
        $this->merge([
            'importado'=>$this->has('importado')
        ]);
    }
}
