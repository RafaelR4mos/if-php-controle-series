<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'category' => 'nullable|string|in:Estudo,Trabalho,Pessoal,Outro|max:50',
            'priority' => 'integer|min:1|max:5',
            'due_date' => 'required|date|after_or_equal:today',
            'is_completed' => 'boolean',
            'arquivo' => 'nullable|file|max:5120', // max 5MB
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais que 100 caracteres.',
            'description.max' => 'A descrição não pode ter mais que 255 caracteres.',
            'category.max' => 'A categoria não pode ter mais que 50 caracteres.',
            'category.in' => 'A categoria deve ser uma das seguintes opções: Estudo, Trabalho, Pessoal ou Outro.',
            'priority.min' => 'A prioridade mínima é 1.',
            'priority.max' => 'A prioridade máxima é 5.',
            'due_date.required' => 'A data de vencimento é obrigatória.',
            'due_date.date' => 'A data de vencimento deve ser uma data válida.',
            'due_date.after_or_equal' => 'A data de vencimento não pode ser anterior a hoje.',
            'is_completed.boolean' => 'O campo de conclusão deve ser verdadeiro ou falso.',
            'arquivo.file' => 'O arquivo deve ser um arquivo válido.',
            'arquivo.max' => 'O arquivo não pode ser maior que 5MB.',
        ];
    }
}
