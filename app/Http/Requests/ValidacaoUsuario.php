<?php

namespace App\Http\Requests;

use App\Models\Tarefa;
use Illuminate\Foundation\Http\FormRequest;

class ValidacaoUsuario extends FormRequest
{
    // alterar para true, para autorizar a validação
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //Função para validar o campos
    public function rules(): array
    {
        $usuarioId = $this->route('usuario')?->id ?? null;

        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuarioId,
            'password' => $usuarioId ? 'nullable|confirmed|min:4' : 'required|confirmed|min:4',
            'password_confirmation' => $usuarioId ? 'nullable' : 'required',
            'setor_id' => 'required|exists:setors,id',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tarefas' => 'nullable|array',
            'tarefas.*' => 'exists:tarefas,id',
            'papel' => 'required',
            'setor_id' => 'required|exists:setors,id',

        ];
    }


    //função para personalizar as mensagens
    public function messages(): array
    {
        return[
           'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'As senhas não conferem.',
            'password.min' => 'A senha deve ter no mínimo 4 caracteres.',
            'setor_id.required' => 'Selecione um setor.',
            'setor_id.exists' => 'Setor inválido.',
            'tarefas.*.exists' => 'Uma das tarefas selecionadas é inválida.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser JPEG, PNG, JPG ou GIF.',
            'imagem.max' => 'A imagem não pode exceder 2MB.',
        ];
    }
}
