<?php

namespace App\Http\Requests\PostDetail;

use Illuminate\Foundation\Http\FormRequest;

class PostDetailStoreRequest extends FormRequest
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
            'post_id' => 'required',
            'type' => 'required|in:text,code,image',
            'content' => $this->contentValidationRule(),
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
            'post_id.required' => 'ID posting harus diisi.',
            'type.required' => 'Jenis konten harus dipilih.',
            'type.in' => 'Jenis konten yang dipilih tidak valid.',
            'content.required' => 'Konten harus diisi.',
            'content.mimes' => 'Konten harus berupa file dengan format: :values.',
            'content.max' => 'Ukuran konten tidak boleh lebih dari :max kilobita.'
        ];
    }

    private function contentValidationRule()
    {
        if ($this->type === "image") {
            return 'required|mimes:jpg,png,svg,jpeg|max:4000';
        }

        return 'required|string';
    }
}
