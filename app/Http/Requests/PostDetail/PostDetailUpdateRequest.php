<?php

namespace App\Http\Requests\PostDetail;

use Illuminate\Foundation\Http\FormRequest;

class PostDetailUpdateRequest extends FormRequest
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
            'post_id' => 'nullable',
            'type' => 'nullable|in:text,code,image',
            'content' => 'nullable',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.in' => 'Jenis konten yang dipilih tidak valid.',
            'content.mimes' => 'Konten harus berupa file dengan format: :values.',
            'content.max' => 'Ukuran konten tidak boleh lebih dari :max kilobita.'
        ];
    }
}
