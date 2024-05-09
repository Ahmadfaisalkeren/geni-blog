<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'post_date' => 'nullable|date',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:jpg,png,svg,jpeg|max:4000',
            'status' => 'nullable|in:publish,hide'
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
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'post_date.date' => 'Tanggal posting harus berupa format tanggal yang valid.',
            'author.string' => 'Penulis harus berupa teks.',
            'author.max' => 'Panjang penulis tidak boleh lebih dari :max karakter.',
            'image.mimes' => 'Gambar harus berupa file dengan format: :values.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
            'status.in' => 'Status yang dipilih tidak valid.'
        ];
    }
}
