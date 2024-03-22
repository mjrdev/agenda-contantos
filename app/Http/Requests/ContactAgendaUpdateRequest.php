<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactAgendaUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|size:11',
            'favorito' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um endereço de email válido',
            'email.unique' => 'Já existe um usuário cadastrado com esse email',
            'phone.unique' => 'Já existe um usuário cadastrado com esse telefone',
            'phone.size' => 'O campo telefone deve conter 11 dígitos',
            'phone.required' => 'O campo telefone é obrigatório',
            'favorito.boolean' => 'O campo favorito está incorreto',
        ];

    }
}
